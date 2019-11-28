<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourseLimit */

$this->title = '新增课程限制';
$this->params['breadcrumbs'][] = ['label' => '课程数量限制', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-course-limit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
