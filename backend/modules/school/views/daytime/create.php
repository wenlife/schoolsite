<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDaytime */

$this->title = '新建作息表项';
$this->params['breadcrumbs'][] = ['label' => '作息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-daytime-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
