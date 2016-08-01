<?php

namespace App;

class Model extends \XORLabs\XC\Core\Model
{
    public $fsp;
    public $fsp_base;

    public function id()
    {
        $row = call_user_func_array([$this, 'get_by'], func_get_args());

        return $row ? $row->id : null;
    }

    public function map($key)
    {
        $this->map = $key;

        return $this;
    }

    public function paginate($per_page = 10, $fsp_base = '')
    {
        fsp('init', $fsp_base);
        $this->fsp();
        $pagi['per_page'] = $per_page;
        $pagi['cur_page'] = fsp('page');
        $pagi['offset'] = ($pagi['cur_page'] - 1) * $per_page;
        $pagi['base_url'] = fsp('pagi_base_url');
        $pagi['uri_segment'] = fsp('pagi_uri_segment');
        $pagi['total_rows'] = $this->count_all_results(false);
        $pagi['total_pages'] = $pagi['total_rows'] / $pagi['per_page'];
        $this->dont_from = true;
        $result = $this->limit($pagi['per_page'], $pagi['offset'])->get_all();
        pagi()->initialize($pagi);

        return $result;
    }

    public function paginate_ajax($per_page = 10, $base_url = '')
    {
        $pagi['per_page'] = $per_page;
        $pagi['cur_page'] = get('page') ? get('page') : 1;
        $pagi['offset'] = ($pagi['cur_page'] - 1) * $per_page;
        $pagi['total_rows'] = $this->count_all_results(false);
        $pagi['total_pages'] = $pagi['total_rows'] / $pagi['per_page'];

        $this->dont_from = true;
        $result = $this->limit($pagi['per_page'], $pagi['offset'])->get_all();
        pagi()->initialize($pagi);

        return $result;
    }

    public function fsp()
    {
        foreach (fsp('data') as $key => $val) {
            if ($key == 'page') {
                continue;
            }
            if ($key == 'timeline') {
                model('job')->fsp_timeline();
                continue;
            }

            if (isset($this->fsp[$key])) {
                $how = isset($this->fsp[$key][0]) ? $this->fsp[$key][0] : '';
                $model = isset($this->fsp[$key][1]) ? $this->fsp[$key][1] : '';
                if (strpos($how, 'like') === 0) {
                    // like:title|detail
                    // extract ['title', 'detail']
                    $how = str_replace('like:', '', $how);

                    // removing first
                    $how2likes = explode('|', $how);

                    if (count($how2likes)) {
                        // we have provided options how2like
                        $this->group_start();
                        $this->like(array_shift($how2likes), $val, '', $model);
                        foreach ($how2likes as $how2like) {
                            $this->or_like($how2like, $val, '', $model);
                        }
                        $this->group_end();
                    } else {
                        // means $key is $how2like
                        $this->like($key, $val, '', $model);
                    }
                } else {
                    // just do simple where
                    $this->where($key, $val, $model);
                }
            } else {
                // just do simple where
                $this->where($key, $val);
            }
        }

        return $this;
    }
}
