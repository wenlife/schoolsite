<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="box box-primary">
  <div class="box-body box-profile">
<div class="login-box-body">
    <p class="login-box-msg">登录系统</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form','action'=>'index.php?r=site/login', 'enableClientValidation' => false]); ?>
      <div class="form-group has-feedback">
        <?= $form->field($model, 'username')->label(false)->textInput(['maxlength' => true,'class'=>'form-control','placeholder'=>"用户名"]) ?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?= $form->field($model, 'password')->label(false)->passwordInput(['maxlength' => true,'class'=>'form-control','placeholder'=>"用户名"]) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
          <input type="checkbox" checked="checked" name="rememberMe" >记住我
        </div>  
      </div>
      <div class="form-group has-feedback">
        <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        <a type="submit" href="index.php?r=site/signup" class="btn btn-primary btn-block btn-flat">注册</a>
      </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>
</div>


 