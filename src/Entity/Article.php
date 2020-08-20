<?php
namespace MyBlog\Entity;

use MyBlog\Core\Entity;

class Article extends Entity
{
    public function getData($sortBy='rate')
    {
        $mysqli = new \mysqli("blogmvc.ru", "mysql", "mysql", "blog");
        if ($mysqli->connect_errno) {
            die("Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        }
        $res = $mysqli->query("SELECT id,date,title,avg(rate) as rate FROM articles left join Rates on Id=ArticleId group by id ORDER BY ".$sortBy." DESC");
        while($rows[] = mysqli_fetch_assoc($res));
        array_pop($rows);
        return json_encode($rows);
    }

    public function getOneArticle($id)
    {
        $mysqli = new \mysqli("blogmvc.ru", "mysql", "mysql", "blog");
        if ($mysqli->connect_errno) {
            die("Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        }
        $res = $mysqli->query("SELECT id,date,title,text,avg(rate) as rate FROM articles left join Rates on Id=ArticleId group by id having id=".$id);
        $row = mysqli_fetch_array($res);
        return $row;
    }
}
