<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sys\models\SysswitchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统功能管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-switch-index">

    <p>
        <?= Html::a('新建开关', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'state',
            'start',
            'end',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>


</div>
