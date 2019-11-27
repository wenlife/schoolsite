<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "重置密码";

?>
<div class="teacher-index">
<div class="box box-success">
    <div class="box-header">
        <?=Html::a('回到管理页面',['index'])?>

    </div>
    <!-- /.box-header -->
    <div class="box-body">

<div class="adminuser-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">

        <label>请输入新密码:</label>

        <?= Html::textInput('pwd',null,['class'=>'form-control']) ?>
    
    </div>

    <div class="form-group">
        <?= Html::submitButton('重置密码', ['class'=>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
</div>