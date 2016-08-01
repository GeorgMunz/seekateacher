<?php

namespace XORLabs\XC\Helpers;

require_once __DIR__.'../vendor/chriskacerguis/codeigniter-restserver-master/application/libraries/REST_Controller.php';
require_once __DIR__.'../vendor/chriskacerguis/codeigniter-restserver-master/application/libraries/Format.php';

class Rest extends \REST_Controller
{
    /**
   * Constructor for the REST API.
   *
   * @param string $config Configuration filename minus the file extension
   * e.g: my_rest.php is passed as 'my_rest'
   */
  public function __construct($config = 'rest')
  {
      parent::__construct();

    // Disable XML Entity (security vulnerability)
    libxml_disable_entity_loader(true);

    // Check to see if PHP is equal to or greater than 5.4.x
    if (is_php('5.4') === false) {
        // CodeIgniter 3 is recommended for v5.4 or above
      throw new Exception('Using PHP v'.PHP_VERSION.', though PHP v5.4 or greater is required');
    }

    // Check to see if this is CI 3.x
    if (explode('.', CI_VERSION, 2)[0] < 3) {
        throw new Exception('REST Server requires CodeIgniter 3.x');
    }

    // Set the default value of global xss filtering. Same approach as CodeIgniter 3
    $this->_enable_xss = ($this->config->item('global_xss_filtering') === true);

    // Don't try to parse template variables like {elapsed_time} and {memory_usage}
    // when output is displayed for not damaging data accidentally
    $this->output->parse_exec_vars = false;

    // Start the timer for how long the request takes
    $this->_start_rtime = microtime(true);

    // Load the rest.php configuration file
    $this->load->config($config);

    // At present the library is bundled with REST_Controller 2.5+, but will eventually be part of CodeIgniter (no citation)
    // $this->load->library('format');
    $this->format = new \Format();

    // Determine supported output formats from configiguration.
    $supported_formats = $this->config->item('rest_supported_formats');

    // Validate the configuration setting output formats
    if (empty($supported_formats)) {
        $supported_formats = [];
    }

      if (!is_array($supported_formats)) {
          $supported_formats = [$supported_formats];
      }

    // Add silently the default output format if it is missing.
    $default_format = $this->_get_default_output_format();
      if (!in_array($default_format, $supported_formats)) {
          $supported_formats[] = $default_format;
      }

    // Now update $this->_supported_formats
    $this->_supported_formats = array_intersect_key($this->_supported_formats, array_flip($supported_formats));

    // Get the language
    $language = $this->config->item('rest_language');
      if ($language === null) {
          $language = 'english';
      }

    // Load the language file
    $this->lang->load('rest_controller', $language);

    // Initialise the response, request and rest objects
    $this->request = new \stdClass();
      $this->response = new \stdClass();
      $this->rest = new \stdClass();

    // Check to see if the current IP address is blacklisted
    if ($this->config->item('rest_ip_blacklist_enabled') === true) {
        $this->_check_blacklist_auth();
    }

    // Determine whether the connection is HTTPS
    $this->request->ssl = is_https();

    // How is this request being made? GET, POST, PATCH, DELETE, INSERT, PUT, HEAD or OPTIONS
    $this->request->method = $this->_detect_method();

    // Create an argument container if it doesn't exist e.g. _get_args
    if (isset($this->{'_'.$this->request->method.'_args'}) === false) {
        $this->{'_'.$this->request->method.'_args'} = [];
    }

    // Set up the query parameters
    $this->_parse_query();

    // Set up the GET variables
    $this->_get_args = array_merge($this->_get_args, $this->uri->ruri_to_assoc());

    // Try to find a format for the request (means we have a request body)
    $this->request->format = $this->_detect_input_format();

    // Not all methods have a body attached with them
    $this->request->body = null;

      $this->{'_parse_'.$this->request->method}();

    // Now we know all about our request, let's try and parse the body if it exists
    if ($this->request->format && $this->request->body) {
        $this->request->body = $this->format->factory($this->request->body, $this->request->format)->to_array();
      // Assign payload arguments to proper method container
      $this->{'_'.$this->request->method.'_args'} = $this->request->body;
    }

    // Merge both for one mega-args variable
    $this->_args = array_merge(
    $this->_get_args,
    $this->_options_args,
    $this->_patch_args,
    $this->_head_args,
    $this->_put_args,
    $this->_post_args,
    $this->_delete_args,
    $this->{'_'.$this->request->method.'_args'}
  );

  // Which format should the data be returned in?
  $this->response->format = $this->_detect_output_format();

  // Which language should the data be returned in?
  $this->response->lang = $this->_detect_lang();

  // Extend this function to apply additional checking early on in the process
  $this->early_checks();

  // Load DB if its enabled
  if ($this->config->item('rest_database_group') && ($this->config->item('rest_enable_keys') || $this->config->item('rest_enable_logging'))) {
      $this->rest->db = $this->load->database($this->config->item('rest_database_group'), true);
  }

  // Use whatever database is in use (isset returns FALSE)
  elseif (property_exists($this, 'db')) {
      $this->rest->db = $this->db;
  }

  // Check if there is a specific auth type for the current class/method
  // _auth_override_check could exit so we need $this->rest->db initialized before
  $this->auth_override = $this->_auth_override_check();

  // Checking for keys? GET TO WorK!
  // Skip keys test for $config['auth_override_class_method']['class'['method'] = 'none'
  if ($this->config->item('rest_enable_keys') && $this->auth_override !== true) {
      $this->_allow = $this->_detect_api_key();
  }

  // Only allow ajax requests
  if ($this->input->is_ajax_request() === false && $this->config->item('rest_ajax_only')) {
      // Display an error response
    $this->response([
      $this->config->item('rest_status_field_name') => false,
      $this->config->item('rest_message_field_name') => $this->lang->line('text_rest_ajax_only'),
    ], self::HTTP_NOT_ACCEPTABLE);
  }

  // When there is no specific override for the current class/method, use the default auth value set in the config
  if ($this->auth_override === false && !($this->config->item('rest_enable_keys') && $this->_allow === true)) {
      $rest_auth = strtolower($this->config->item('rest_auth'));
      switch ($rest_auth) {
      case 'basic':
      $this->_prepare_basic_auth();
      break;
      case 'digest':
      $this->_prepare_digest_auth();
      break;
      case 'session':
      $this->_check_php_session();
      break;
    }
      if ($this->config->item('rest_ip_whitelist_enabled') === true) {
          $this->_check_whitelist_auth();
      }
  }
  }
}
