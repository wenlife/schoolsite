<?php
use yii\web\View;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */

$this->title = '修改学生信息';
?>
<div class="sign-sheet-update">

    <h1><?= Html::encode($this->title) ?></h1>
   <div class="box box-primary">
    <!-- /.box-header -->
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
