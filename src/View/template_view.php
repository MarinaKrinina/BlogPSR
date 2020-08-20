<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="/src/css/blog.css">
    <title></title>
</head>
<body>
    <?php 
        include 'header.php';
        include 'src/view/'.$contentView; 
    ?>
</body>
</html>