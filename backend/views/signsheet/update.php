<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */

$this->title = 'Update Sign Sheet: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sign Sheets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sign-sheet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
