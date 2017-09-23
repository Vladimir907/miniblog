<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->registerCssFile('/css/login.css');
?>

<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    
<form id="login-form" name="login-form" class="login-form" action="/auth/login" method="post">
    <input type="hidden" name="_csrf" value="3yLMBXB1L0QnuMZ8Z4ijLdIwalybaafZBCxnFo-Vx5RZfPDO0D1BXopq1Xq2a4lwtSdYAKk-hnbH6JN3cjKSzw==">
    <div class="header">
        <h1>Авторизация</h1>
        <span>Введите ваши регистрационные данные для входа в ваш личный кабинет. </span>
    </div>

    <div class="content">
        <input name="username" type="text" class="input username" value="Логин" onfocus="this.value=''" />
        <input name="password" type="password" class="input password" value="Пароль" onfocus="this.value=''" />
    </div>

    <div class="footer">
        <input type="submit" name="submit" value="ВОЙТИ" class="button" />
        <input type="submit" name="submit" value="Регистрация" class="register" />
    </div>

</form>
</div>
    
</div>
