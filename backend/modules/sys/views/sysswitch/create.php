<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\sys\models\SysSwitch */

$this->title = 'Create Sys Switch';
$this->params['breadcrumbs'][] = ['label' => 'Sys Switches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-switch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
