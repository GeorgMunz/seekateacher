<?php

class Option_m extends App\Model
{
    const USER_DUMMY_PROFILE_PICS = 'user_dummy_profile_pics';

    public function get_user_dummy_profile_pics()
    {
        $pics = $this->map('value')
                     ->get_by('key', self::USER_DUMMY_PROFILE_PICS);
        $pics = explode(',', $pics);

        return $pics;
    }

    public function values($key, $type = '', $map = '')
    {
        $result = $this->get_by('key', $key);
        if ($result) {
            $type = ($type) ? $type : 'newline';
            $func = "_values_{$type}";

            return $this->$func($result->value, $map);
        }

        return false;
    }

    public function values_2($key)
    {
        $return = $this->map('value')
                       ->get_by('key', $key);

        return explode("\n", $return);
    }

    public function dropdown()
    {
        $args = func_get_args();
        $key = $args[0];
        $type = isset($args[1]) ? $args[1] : '';
        $obj_key = isset($args[2]) ? $args[2] : '';

        $arr = $this->values($key, $type);
        $ret = ['' => ''];
        foreach ($arr as $val) {
            if ($obj_key) {
                $ret[$val->$obj_key] = $val->$obj_key;
            } else {
                $ret[$val] = $val;
            }
        }

        return $ret;
    }

    public function value($key)
    {
        return trim($this->get_by('key', $key)->value);
    }

    protected function _values_newline($value)
    {
        $vals = explode("\n", $value);
        $return = [];
        foreach ($vals as $val) {
            $val = trim($val);
            $return[$val] = $val;
        }

        return $return;
    }

    protected function _values_json($value, $map = '')
    {
        $dec = json_decode($value);
        $ret = [];
        if ($map) {
            foreach ($dec as $val) {
                $ret[$val->$map] = $val->$map;
            }
        } else {
            $ret = $dec;
        }

        return $ret;
    }

    /**
     * Special Cases
     */
    public function job_subtypes($type = '') {
        $arr = $this->values('job_types', 'json');
        $subtypes = [''=>''];
        foreach ($arr as $item) {
            if ($type && $type == $item->type) {
                return $item->subtypes;
            }
            foreach ($item->subtypes as $value) {
                $subtypes[$value] = $value;
            }
        }
        return $subtypes;
    }
}
