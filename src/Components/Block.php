<?php

namespace Silver\Ghost\Components;

class Block
{
    private $pattern = "/#block\\((.*)\\)/";


    //load blocks from view

    /**
     * @return mixed
     */
    public function replace()
    {
        $body = preg_replace_callback($this->pattern, function ($match) {
            $blockname = trim($match[1]);
            return "{{{ \$_block_{$blockname} }}}";
        }, $body);

        return $body;
    }
}