<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\school\models\TeachDepartment */

$this->title = '新建年级部';
$this->params['breadcrumbs'][] = ['label' => '年级部', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-department-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
