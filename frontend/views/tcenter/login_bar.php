<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="box box-primary">
  <div class="box-body box-profile">
<div class="login-box-body">
    <p class="login-box-msg">登录系统</p>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="input" name='username' class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
          <input type="checkbox" checked="checked" name="rememberMe" >记住我
        </div>  
      </div>
      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        <a type="submit" class="btn btn-primary btn-block btn-flat">注册</a>
      </div>
    </form>
  </div>
</div>
</div>