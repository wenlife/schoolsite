<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\TeachcourselimitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程数量限制';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-course-limit-index">

    <p>
        <?= Html::a('设置课程限制', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'department_id',
            'course_id',
            'course_limit',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
