<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachCourse */

$this->title = 'Create Teach Course';
$this->params['breadcrumbs'][] = ['label' => 'Teach Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-course-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
