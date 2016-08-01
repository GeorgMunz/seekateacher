<?php

namespace App;

class Fsp
{
    public $url_data = [];

    public $act_data = [];

    public $reg = [];

    public $base = '';

    protected static $_instance;

    public static function get_instance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __get($name)
    {
        return get_instance()->{$name};
    }

    public function init($base = '')
    {
        $this->base = $base ? $base : '/'.$this->uri->segment(1).'/'.$this->uri->segment(2);

        $exp = explode('/', $this->base);
        $offset = count($exp);

        $data = [];
        foreach ($this->uri->uri_to_assoc($offset) as $key => $val) {
            if ($val && $val != '_clear') {
                $data[$key] = $val;
            }
        }

        $this->url_data = $data;

        foreach ($this->url_data as $key => $val) {
            $this->act_data[$key] = $this->dec($val);
        }
    }

    public function url($key, $val = '')
    {
        $arr = $this->url_data;
        unset($arr['page']);

        if ($val == '_clear') {
            unset($arr[$key]);
        } else {
            $arr[$key] = $this->enc($val);
        }

        if ($key == '_clear') {
          $arr = [];
        }

        return $this->base.'/'.$this->uri->assoc_to_uri($arr);
    }

    public function pagination_uri_segment()
    {
        return count($this->uri->segments) - 1;
    }

    public function data($key = '')
    {
        if ($key) {
            return isset($this->act_data[$key]) ? $this->act_data[$key] : false;
        } else {
            return $this->act_data;
        }
    }

    public function page()
    {
        return ($this->data('page')) ? $this->data('page') : 1;
    }

    public function base()
    {
        return $this->base;
    }

    public function reg($key = '', $action = '')
    {
        if (!$key) {
            return $this->reg;
        }
        $this->reg[$key] = $action;
    }

    public function enc($val)
    {
        // $str = str_replace(' ', '-', $val);

        return rawurlencode($val);
    }

    public function dec($val)
    {
        $str = rawurldecode($val);

        // return str_replace('-', ' ', $str);
        return $str;
    }

    public function make_url_safe($raw_data)
    {
        $safe_data = [];
        foreach ($raw_data as $key => $val) {
            $safe_data[$key] = $this->enc($val);
        }

        return $safe_data;
    }

    public function pagi_base_url()
    {
        return $this->base.'/'.$this->uri->assoc_to_uri($this->_upto_page());
    }

    public function pagi_uri_segment()
    {
        return strpos(get_instance()->uri->uri_string(), 'page/') ?
                get_instance()->uri->total_segments() : 1;
    }

    protected function _upto_page()
    {
        $upto_page = [];
        foreach ($this->url_data as $key => $val) {
            if ($key == 'page') {
                break;
            }
            $upto_page[$key] = $val;
        }

        return $upto_page;
    }
}
