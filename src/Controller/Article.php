<?php
namespace MyBlog\Controller;

use MyBlog\Entity\Article as EntityArticle;
use MyBlog\Core\View;
use MyBlog\Core\Controller;

class Article extends Controller
{
    public function __construct()
    {
      $this->model = new EntityArticle();
      $this->view = new View();
    }
    
    public function showAll()
    {
      $sortBy = 'rate';
      if ($_GET['sortBy']) {
          $sortBy = $_GET['sortBy'];
      }
      $this->view->generate('main.php', 'template_view.php');
    }
    
    public function showAllAjax()
    {
      $sortBy = 'rate';
      if ($_GET['sortBy']) {
          $sortBy = $_GET['sortBy'];
      }
      $data = $this->model->getData($sortBy);
      echo $data;
    }
    
    public function showOne()
    {
      $id = $_GET['id'];
      $data = $this->model->getOneArticle($id);
      $this->view->generate('showOneArticle.php', 'template_view.php', $data);
    }
}
