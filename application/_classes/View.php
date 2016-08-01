<?php

namespace App;

class View extends \XORLabs\XC\Core\View
{
    public $breadcrumbs = [];
    public $breadcrumbs_path = '';
  // Set default theme to sat.com-template-
  protected $_theme = 'sat.com-template';

    public $js_arr = [];
    public $css_arr = [];

    public function breadcrumbs($arr)
    {
        foreach ($arr as $link => $text) {
            $this->breadcrumbs[$link] = $text;
        }

        return $this;
    }

    public function js($js)
    {
        foreach ($this->js_arr as $key => $arr) {
            if ($key == $js) {
                $this->insert_js($arr[0]);

                return $this;
            }
        }
        echo '<pre>';
        echo debug_print_backtrace();
        echo '</pre>';
        die($key.' JS not found');
    }

    public function css($css)
    {
        foreach ($this->css_arr as $key => $arr) {
            if ($key == $css) {
                $this->insert_css($arr[0]);

                return $this;
            }
        }
        echo '<pre>';
        echo debug_print_backtrace();
        echo '</pre>';
        die($key.' CSS not found');
    }

    public function cj($key)
    {
        $this->css($key);
        $this->js($key);

        return $this;
    }
}
