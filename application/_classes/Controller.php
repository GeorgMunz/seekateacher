<?php

namespace App;

class Controller extends \CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        \XORLabs\XC\Core\Url_session::record($this->uri->uri_string());

        if ($this->uri->segment(1) == 'admin') {
            view()->set_theme('ace-sat');
            include APPPATH.'/../public_html/themes/ace-sat/_data/_reg_css_js.php';
        } else {
            include APPPATH.'/../public_html/themes/sat.com-template/_data/_reg_css_js.php';
        }
    }
}
