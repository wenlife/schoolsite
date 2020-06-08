<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SysNotice */

$this->title = '查看详细内容';
$this->params['breadcrumbs'][] = ['label' => 'Sys Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-notice-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

        <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title text-danger"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pos',
            'level',
            'content:ntext',
        ],
    ]) ?>
</div>
</div>

</div>
