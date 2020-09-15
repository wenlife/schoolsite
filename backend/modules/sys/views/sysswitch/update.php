<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\SysSwitch */

$this->title = 'Update Sys Switch: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sys Switches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-switch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
