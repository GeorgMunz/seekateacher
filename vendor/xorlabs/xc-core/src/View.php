<?php

namespace XORLabs\XC\Core;

class View
{
    protected $_theme = 'default';
    protected $_layout = 'default';
    protected $_partials = [];

    protected static $_instance;

    public $template = [
      'page' => '',
      'head' => '',
      'foot' => '',
      'partials' => [],
      'bc' => '',
      'form' => [],
    ];

    public $data = [];

    public static function get_instance()
    {
        if (!static::$_instance) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public function __construct()
    {
        $this->bc = new View\BodyClass();
        $this->a = new View\Active();

        // my css and js
        // $assets = Template\Assets::get();
        // $this->insert_css('/themes/custom' . $assets['main_css']);
        // $this->insert_js('/themes/custom' . $assets['main_js']);
    }

    public function __get($name)
    {
        return get_instance()->$name;
    }

    public function get_layout()
    {
        return $this->_layout;
    }

    public function set_theme($theme)
    {
        $this->_theme = $theme;

        return $this;
    }

    public function get_theme()
    {
        return $this->_theme;
    }

    public function set_layout($layout)
    {
        $this->_layout = $layout;

        return $this;
    }

    public function set_partial($name, $view, $data = [], $theme = '')
    {
        $theme = !$theme ? $this->_theme : $theme;

        $this->_partials[] = (object) [
          'name' => $name,
          'view' => $view,
          'data' => $data,
          'theme' => $theme,
        ];

        return $this;
    }

    public function build($page, $data = [])
    {
        $data = array_merge($this->data, $data);

        $page_path = "{$this->_theme}/pages/{$page}";

        $this->template['bc'] = $this->bc->display();

        foreach ($this->_partials as $partial) {
            $partial_path = "/{$partial->theme}/partials/{$partial->view}";
            $this->template['partials'][$partial->name] = $this->load->view($partial_path, $partial->data, true);
        }

        if (count($this->breadcrumbs)) {
            $breadcrumbs_path = (!$this->breadcrumbs_path) ? "{$this->_theme}/partials/breadcrumbs" : $this->breadcrumbs_path;
            $this->template['breadcrumbs'] = $this->load->view($breadcrumbs_path, ['breadcrumbs' => $this->breadcrumbs], true);
        }

        $this->template['theme_uri'] = "/themes/{$this->_theme}";

        $data = (array) $data;
        $data['template']['theme_uri'] = $this->template['theme_uri'];
        $this->template['page'] = $this->load->view($page_path, $data, true);

        $layout_path = "{$this->_theme}/layouts/{$this->_layout}";
        $this->load->view($layout_path, array_merge(['template' => $this->template], $data));
    }

    public function view($view, $type = 'page', $data = [])
    {
        if ($type == 'layout') {
            $path = "themes/{$this->_theme}/layouts/{$view}";
        } elseif ($type == 'page') {
            $path = "themes/{$this->_theme}/pages/{$view}";
        } elseif ($type == 'partial') {
            $path = "themes/{$this->_theme}/partials/{$view}";
        } else {
            die('View Type error');
        }

        return $this->load->view($path, $data, true);
    }

    public function insert_js($link)
    {
        $script = '<script src="'.$link.'"></script>';
        $this->template['foot'] .= $script;

        return $this;
    }

    public function insert_css($link)
    {
        $link = '<link rel="stylesheet" href="'.$link.'">';
        $this->template['head'] .= $link;

        return $this;
    }

    public function display_partial($view, $data = [], $theme = '')
    {
        $theme = $theme ? $theme : $this->_theme;
        $partial_path = "/{$theme}/partials/{$view}";

        $data = array_merge(get_instance()->load->get_vars(), $data);
        // will save even partial vars WHICH IS NOT REQUIRED
        // $this->load->view($partial_path, $data);

        // converting $data into indiviuals vars
        foreach ($data as $key => $val) {
            $$key = $val;
        }
        include VIEWPATH.$partial_path.'.php';
    }

    public function active($link)
    {
        $this->a->add($link);

        return $this;
    }

    public function is_active($link)
    {
        return $this->a->is($link);
    }

    public function form()
    {
        $args = func_get_args();
        if (is_string($args[0])) {
            $this->template['form'][$args[0]] = $args[1];
        } else {
            $this->template['form'] = array_merge($this->template['form'], $args);
        }

        return $this;
    }

    public function data()
    {
        $args = func_get_args();

        if (!count($args)) {
            return $this->data;
        } elseif (count($args) == 2) {
            $this->data[$args[0]] = $args[1];
        } elseif (is_array($args[0])) {
            $this->data = array_merge($this->data, $args[0]);
        }
    }
}
