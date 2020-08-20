<?php
namespace MyBlog\Entity;

use MyBlog\Core\Entity;

class User extends Entity
{
    public function checkUser($login, $password)
    {
        $mysqli = new \mysqli("blogmvc.ru", "mysql", "mysql", "blog");
            if ($mysqli->connect_errno) {
                die("Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
            }
            $res = $mysqli->query("SELECT * FROM users WHERE login=".$login." AND password=".$password.";");
            if ($res) {
                return mysqli_fetch_array($res)['id'];
            } else {
                return null;
            }
    }
    
    public function saveUser($login, $password, $avatar)
    {
        $mysqli = new \mysqli("blogmvc.ru", "mysql", "mysql", "blog");
            if ($mysqli->connect_errno) {
                die("Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
            }

            $filePath  = $avatar['tmp_name'];
            $errorCode = $avatar['error'];
            if (($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) && $errorCode !== UPLOAD_ERR_NO_FILE) {
                $errorMessages = array(
                    UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                    UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                    UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                    UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                    UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
                );
                $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
                $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                die($outputMessage);
            }
            if ($errorCode == UPLOAD_ERR_OK) {
                //проверка является ли файл изображением. раскомментить в php.ini extension=fileinfo.so или extension=php_fileinfo.dll
                $fi = finfo_open(FILEINFO_MIME_TYPE);
                $mime = (string) finfo_file($fi, $filePath);
                if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
                
                $avatarName = time();
                $image = getimagesize($filePath);
                $extension = image_type_to_extension($image[2]);
                $format = str_replace('jpeg', 'jpg', $extension);
                if (!move_uploaded_file($filePath, __DIR__ . '/../../upload/' . $avatarName . $format)) {
                    die('При записи изображения на диск произошла ошибка');
                }
            } else {
                $avatarName='null';
            }
            $res = $mysqli->query("INSERT INTO users(Login,Avatar,Password) VALUES (".$login.", ".$avatarName.", ".$password.");");
            return true;
    }
}
