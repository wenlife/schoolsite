<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCal */

$this->title = '更新日历项: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '校历', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="teach-cal-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
