<form action='/user/createUser' method='post' enctype='multipart/form-data'>
Логин <input type='text' name='login'/>
<input type='hidden' name='MAX_FILE_SIZE' value='524288000' />
Аватар <input type='file' accept='image/*'/ name='avatar'>
Пароль <input type='password' name='password1'/>
Повтор пароля <input type='password' name='password2'/>
<input type='submit' value='Зарегистрироваться' />
</form>