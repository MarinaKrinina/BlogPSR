<?php
namespace MyBlog\Core;

class View
{
    public function generate($contentView, $templateView, $data = null)
    {
        include 'src/view/'.$templateView;
    }
}
