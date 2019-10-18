<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDaytime */

$this->title = 'Create Teach Daytime';
$this->params['breadcrumbs'][] = ['label' => 'Teach Daytimes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-daytime-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
