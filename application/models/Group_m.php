<?php

require_once __DIR__.'/Attach/Attach_trait.php';

class Group_m extends App\Model
{
    use Attach_trait;

    public $fsp_base = '/group/listing/sc';

    public $__events_callbacks_always = [
        'before_insert' => ['created_at', 'updated_at'],
        'before_update' => ['updated_at'],
    ];

    public function attach_actions($row)
    {
        $row->actions = true;
        $row->edit_url = "/group/form/{$row->id}";

        return $row;
    }

    public function attach_url($row)
    {
        $row->url = "/group/detail/{$row->id}";
    }

    public function attach_comments_count($row)
    {
        $row->comments_count = model('group_comment')
                                ->count_by('group_id', $row->id);

        return $row;
    }
}
