<?php

namespace XORLabs\XC\Core\View;

class Active
{
    /**
     * A multidimensional array of links.
     */
    protected $links = [];

    /**
     * Cleverly adding class.
     */
    public function add($links)
    {
        // Single string passed
        if (!is_array($links)) {
            $links = explode(',', $links);
        }

        // Adding all the links
        foreach ($links as $link) {
            $this->links[] = trim($link);
        }
    }

    public function is($link)
    {
        if (
          array_search($link, $this->links) ||
          $link == '/'.get_instance()->uri->uri_string()
        ) {
            return 'active';
        }
    }
}
