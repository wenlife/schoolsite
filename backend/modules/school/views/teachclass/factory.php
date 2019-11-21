<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\guest\models\TeachClass */

$this->title = '创建新班级';
$this->params['breadcrumbs'][] = ['label' => 'Teach Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
 if($errMSG)
 {
?>
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> 注意事项！</h4>
    <ul>
    <?=$errMSG?>
  </ul>
</div>
<?php
}
?>
<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title">批量班级生成</h3>
</div>
<?=Html::beginForm() ?>
  <div class="box-body">
    <div class="form-group">
      <label>年级部</label>
      <?=Html::dropDownList('department',null,(new \yii\db\Query())
                                              ->select(['title','id'])
                                              ->from('teach_department')
                                              ->indexby('id')->column(),['prompt'=>"请选择部门",'id'=>'department','class'=>'form-control']);?>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">起始班级序列号</label>
      <?=Html::dropDownList('start',null,range(0,40),['prompt'=>'请选择班级序号','id'=>'start','class'=>'form-control'])?>
    </div>
    <div class="form-group">
      <label for="exampleInputFile">结束班级序列号</label>
     <?=Html::dropDownList('end',null,range(0,40),['prompt'=>'请选择班级序号','id'=>'end','class'=>'form-control'])?>

      <p class="help-block">注意事项</p>
      <ul>
      	<li class="text-danger">班级名称同级部设置，请确认级部<b>年级选项</b>设置是否正确</li>
      	<li class="text-danger">所有生成班级类别为理科班，请稍后修改</li>
      	<li class="text-danger">班级标题生成格式：2018届18班</li>
      </ul>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">批量生成</button>
  </div>
   <?=Html::endForm()?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){

	$('form').submit(function(){
	    var var1 = $('#department').val()
	    var var2 = $('#start').val()
	    var var3 = $('#end').val()
		if(var1&&var2&&var3)
		{
			return true;
		}else{
			alert('选项不能为空！，请选择后提交！');
			return false;
		}
		
	});

});
</script>


