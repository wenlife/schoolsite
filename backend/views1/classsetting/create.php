<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClassSetting */

$this->title = 'Create Class Setting';
$this->params['breadcrumbs'][] = ['label' => 'Class Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
