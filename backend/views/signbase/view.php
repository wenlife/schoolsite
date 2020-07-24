<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SignBase */

$this->title = $model->xm;
$this->params['breadcrumbs'][] = ['label' => '基础信息库', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sign-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('辅助填报', ['kszbm/report', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('更改信息', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<<返回查询页面', ['kszbm/query'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
           ['attribute'=>'flag','value'=>function($model){ 
                $state = ['0'=>'未录取','1'=>'已录取','2'=>'异常状态'];
                return ArrayHelper::getValue($state,$model->flag);
            }],
            'lqxx',
            'kh',
            'xm',
            'lxdh',
            'bmd',
            'xb',
            'byzx',
            'bjdm',
            'csny',
            
            'txdz',
            'sfzh',
            // 'yw',
            // 'sx',
            // 'wy',
            // 'wl',
            // 'hx',
            // 'zz',
            // 'ls',
            // 'sw',
            // 'dl',
            // 'sy',
            // 'ty',
            //'zf',
            'lqzf',
            'note',
        ],
    ]) ?>
</div>
</div>
</div>
