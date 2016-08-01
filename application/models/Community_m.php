<?php

require_once __DIR__.'/Attach/Attach_trait.php';

class Community_m extends App\Model
{
    use Attach_trait;

    protected $_table = 'community';

    protected $__events_callbacks_always = [
        'before_insert' => ['created_at'],
    ];

    const TYPE_EVENT = 1;
    const TYPE_REQUEST = 2;
    const TYPE_RECOMMENDATION = 3;

    public function attach_url($row)
    {
        if ($row->type == self::TYPE_EVENT) {
            $row->url = '/community/detail/'.self::TYPE_EVENT."/$row->id";
        } elseif ($row->type == self::TYPE_REQUEST) {
            $row->url = '/community/detail/'.self::TYPE_REQUEST."/$row->id";
        } elseif ($row->type == self::TYPE_RECOMMENDATION) {
            $row->url = '/community/detail/'.self::TYPE_RECOMMENDATION."/$row->id";
        } else {
            die('ERROR in Community data');
        }

        return $row;
    }

    public function attach_comments_count($row)
    {
        $row->comments_count = model('community_comment')
                                ->count_by('community_id', $row->id);
        return $row;
    }
}
