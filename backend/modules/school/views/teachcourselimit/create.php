<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourseLimit */

$this->title = 'Create Teach Course Limit';
$this->params['breadcrumbs'][] = ['label' => 'Teach Course Limits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-course-limit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
