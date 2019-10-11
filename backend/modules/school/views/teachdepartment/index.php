<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\TeachdepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teach Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-department-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teach Department', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'name',
            'manager',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
