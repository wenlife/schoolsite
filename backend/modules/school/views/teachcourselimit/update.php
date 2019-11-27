<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourseLimit */

$this->title = '更新课程数量限制: ' . $model->course_id;
$this->params['breadcrumbs'][] = ['label' => '课程数量', 'url' => ['index']];

?>
<div class="teach-course-limit-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
