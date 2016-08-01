<?php

function form_validation() {
  return App\Form_validation::get_instance();
}

function form_checkbox_custom($name = '', $val = '', $checked = '', $extra = '') {
	return '<label '.$extra.'>
		<input type="checkbox" name="'.$name.'" value="'.$val.'" '. ($checked?'checked':'') .'>
		<span></span>
	</label>';
}

function form_radio_custom($name = '', $val = '', $checked = '', $extra = '') {
	return '<label '.$extra.'>
		<input type="radio" name="'.$name.'" value="'.$val.'" '. ($checked?'checked':'') .'>
		<span></span>
	</label>';
}


function form_textarea($name, $value = '', $attr = '') {
  return "<textarea name='{$name}' {$attr}>{$value}</textarea>";
}

function form_email($name, $value = '', $attr = '') {
  return "<input name='{$name}' type='email' value='{$value}' {$attr}>";
}

function form_number($name, $value = '', $attr = '') {
  return "<input name='{$name}' type='number' value='{$value}' {$attr}>";
}

function form_open($action = '', $attributes = array(), $id = '')
{
  $CI =& get_instance();

  if (is_string($attributes))
  {
    $attributes .= ' enctype="multipart/form-data"';
  }
  else
  {
    $attributes['enctype'] = 'multipart/form-data';
  }

  // If no action is provided then set to the current url
  if ( ! $action)
  {
    $action = $CI->config->site_url($CI->uri->uri_string());
  }
  // If an action is not a full URL then turn it into one
  elseif (strpos($action, '://') === FALSE)
  {
    $action = $CI->config->site_url($action);
  }

  $attributes = _attributes_to_string($attributes);

  if (stripos($attributes, 'method=') === FALSE)
  {
    $attributes .= ' method="post"';
  }

  if (stripos($attributes, 'accept-charset=') === FALSE)
  {
    $attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
  }

  $form = '<form action="'.$action.'"'.$attributes.">\n";

  // Add CSRF field if enabled, but leave it out for GET requests and requests to external websites
  if ($CI->config->item('csrf_protection') === TRUE && strpos($action, $CI->config->base_url()) !== FALSE && ! stripos($form, 'method="get"'))
  {
    $hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();
  }

  if (is_array(view()->template['form']) && count(view()->template['form']))
  {
    foreach (view()->template['form'] as $name => $value)
    {
      $form .= '<input type="hidden" name="'.$name.'" value="'.html_escape($value).'" style="display:none;" />'."\n";
    }
  }

  return $form;
}
