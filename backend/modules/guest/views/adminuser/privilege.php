<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '用户权限设置';
$this->params['breadcrumbs'][] = ['label' => 'Adminusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
    <?=Html::a('回到管理页面',['index'])?>
    </div>
    <!-- /.box-header -->
<div class="box-body">
<div class="adminuser-create">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
    <?=Html::checkboxList('newPri',$AuthAssignmentsArray,$allPrivilegeArray,['class'=>'checkbox']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('提交', ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>