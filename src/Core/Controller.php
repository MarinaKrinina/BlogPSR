<?php
namespace MyBlog\Core;

use MyBlog\Core\View;

class Controller 
{    
    public $model;
    public $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
}
