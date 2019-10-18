<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourse */

$this->title = 'Update Teach Course: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Teach Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teach-course-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
