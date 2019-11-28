<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\DaytimeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '作息表管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-daytime-index">
<div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

    <p>
        <?= Html::a('新建作息表项', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['attribute'=>'department','value'=>'departmentname.title'], 
            'sort',
            'part',
            'title',
            'start',
            'end',
           // 'note',
            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{update}&nbsp&nbsp{delete}',
            ],
        ],
    ]); ?>


</div>
</div>
</div>
