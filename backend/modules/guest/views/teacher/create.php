<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\Teacher */

$this->title = '添加新教师';
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
