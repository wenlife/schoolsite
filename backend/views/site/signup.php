<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
$this->title = "注册新用户";
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>信息技术</b>系统注册</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">填入获得的信息以注册</p>

              <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('用户名') ?>

                <?= $form->field($model, 'secode')->label('安全码(请联系管理员获取)') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('密码') ?>
                <?= $form->field($model, 'password_repeat')->passwordInput()->label('密码确认') ?>

                <?= $form->field($model, 'email')->label('电子邮件') ?>
                <ul>
                    <?php
                    if(isset($errMSG))
                    {
                        foreach ($errMSG as $km => $vm) {
                            echo "<li class='text-danger'>".$vm."</li>";
                         }
                    }

                    ?>
                </ul>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>


        <!-- /.social-auth-links -->

        <a href="index.php?r=site/login">已经有账号，直接登录</a><br>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
