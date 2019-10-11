<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teachsetting */

$this->title = 'Update Teachsetting: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teachsettings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teachsetting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
