<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachYearManage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '学年度', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-year-manage-view">


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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'start_date',
            'end_date',
            'note',
        ],
    ]) ?>

</div>
