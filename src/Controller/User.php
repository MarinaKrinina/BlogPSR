<?php
namespace MyBlog\Controller;

use MyBlog\Entity\User as EntityUser;
use MyBlog\Core\View;
use MyBlog\Core\Controller;

class User extends Controller
{
    public function __construct()
    {
      $this->model = new EntityUser();
      $this->view = new View();
    }

    public function login()
    {
        $this->view->generate('login.php', 'template_view.php');
    }

    public function registration()
    {
        $this->view->generate('registration.php', 'template_view.php');
    }

    public function exitUser()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function getUser()
    {
      $login=$_POST['login'];
        $password=$_POST['password'];
        if ($login!='' && $password!='') {
            $user_id = $this->model->checkUser($login, $password);
            $this->view->generate('login.php', 'template_view.php');
            if ($user_id) {
                session_start();
                $_SESSION["user"]=$user_id;
                echo "Вы успешно зашли";
            } else {
                echo "Неверный логин или пароль";
            }
        }
    }

    public function createUser()
    {
        $login=$_POST['login'];
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $avatar = $_FILES['avatar'];
        $this->view->generate('registration.php', 'template_view.php');
        if ($password1!=$password2) {
            echo "Введенные пароли не совпадают";
        } elseif ($password1=='' || $login=='') {
            echo "Логин и пароль - обязательные для заполнения поля";
        } else {
            $success = $this->model->saveUser($login, $password1, $avatar);
            if ($success) {
              session_start();
              $_SESSION["user"]=1;
              echo "Вы успешно зарегистировались";
           }
        }
    }
}
