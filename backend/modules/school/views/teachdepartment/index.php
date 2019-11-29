<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\school\models\TeachdepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教学级部';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
<div class="teach-department-index">
    <p>
        <?= Html::a('新建级部', ['create'], ['class' => 'btn btn-success']) ?>
        <p>请及时更新年级部的年级数据,影响到系统班级新建和查询功能</p>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'year',
            'manager',
            'note',
            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{update}&nbsp&nbsp{delete}',
            ],
        ],
    ]); ?>


</div>
</div>
</div>
