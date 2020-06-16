<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
?>
<div class="box box-primary">
<div class="box-header with-border">
	报名情况查询
</div>
    <!-- /.box-header -->
<div class="box-body">
<?php 
$form = ActiveForm::begin(['id'=>'form1','method'=>'get',
   	                       'action'=>Url::toRoute(['query']),
                           'options'=>['class'=>'form-inline',]]); 
?>
<?=Html::input('input','idcard',null,['placeholder'=>'请输入身份证号码：','class'=>'form-control'])?>
<button type="submit" class="btn btn-primary">查询</button>
<?php ActiveForm::end(); ?>
<hr>
<?php if(isset($msg)&&$msg!=''){ ?>

<table class="table table-bordered">
	<thead>
		<tr><th>身份证号</th><th>姓名</th>
			<th>报名审核情况</th><th>审核结果信息</th><th>可用操作</th></tr>
		<tr><td><?=$msg->idcard?></td><td><?=$msg->name?></td>
			<td><?php
			   $arr = CommonFunction::getVerifyState();
			    echo ArrayHelper::getValue($arr,$msg->verify);?></td>
		    <td><?=$msg->verifymsg?></td>
		    <td><?php
               if($msg->verify == 2)
               {
               		echo Html::a('修改报名信息',['rewrite','idcard'=>$msg->idcard],['class'=>"btn btn-primary"]);
               }
		    ?></td>
		</tr>
	</thead>
</table>

<?php }elseif(isset($msg)&&$msg == ''){
	echo "没有查询到报名信息";
}

?>
</div>
</div>