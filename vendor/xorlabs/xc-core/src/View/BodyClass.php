<?php

namespace XORLabs\XC\Core\View;

class BodyClass
{
    protected $classes = [];

    public function __get($name)
    {
        return get_instance()->$name;
    }

    public function add($classes)
    {
        if (!is_array($classes)) {
            $classes = explode(',', $classes);
        }

        foreach ($classes as $class) {
            $this->classes[] = trim($class);
        }

        return view();
    }

    public function remove($classes)
    {
        if (!is_array($classes)) {
            $classes = [$classes];
        }

        foreach ($classes as $class) {
            $key = array_search($class, $this->classes);

            if ($key !== false) {
                unset($this->classes[$key]);
            }
        }
    }

    public function display()
    {
        $this->_set_default();

        $str = '';
        foreach ($this->classes as $class) {
            $str .= $class.' ';
        }

        return $str;
    }

    public function has($class)
    {
        return array_search($class, $this->classes) === false ? false : true;
    }

    protected function _set_default()
    {
        $this->add('layout-'.view()->get_layout());
        $this->add('page-'.str_replace('/', '-', $this->uri->uri_string()));
    }
}
