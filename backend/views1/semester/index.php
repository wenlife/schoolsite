<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SemesterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '学期安排';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semester-index">
    <p>
        <?= Html::a('新建学期', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'start',
            'end',
            'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
