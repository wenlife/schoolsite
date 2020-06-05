<?php
use yii\web\View;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */

$this->title = '修改学生信息';
$this->params['breadcrumbs'][] = ['label' => '报名表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
