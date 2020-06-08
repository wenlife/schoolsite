<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysNotice */

$this->title = '新建通知';
$this->params['breadcrumbs'][] = ['label' => 'Sys Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-notice-create">
	<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title text-danger"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>

</div>
