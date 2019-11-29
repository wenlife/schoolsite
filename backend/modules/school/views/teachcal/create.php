<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCal */

$this->title = '新建日历项';
$this->params['breadcrumbs'][] = ['label' => '日历', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-cal-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

