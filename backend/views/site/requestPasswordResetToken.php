<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '重新设置我的密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请输入自己的姓名和注册时的邮箱</p>
    <p>重置密码的连接会被发送到注册邮箱，请登录自己的邮箱查看</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true])?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])?>

                <div class="form-group">
                    <?= Html::submitButton('发送重置链接', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
