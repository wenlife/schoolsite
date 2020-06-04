<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */

$this->title = '报名表';
?>
<div class="sign-sheet-create">

    <h1 style="text-align: center; ">攀枝花第七高级中学校</h1>
    <h3 style="text-align: center;">2020年艺体特长招生考试报名</h3>
    <div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title text-danger">请正确如实填报自己的信息以完成报名</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
</div>
</div>
</div>

<?php
$this->registerJs(<<<JS
$('.field-cat2').hide();
$('.field-cat3').hide();
$('#cat1').change(function(){
	$('.field-cat2').hide();
    $('.field-cat3').hide();
	$('#cat2').html('');
	$('#cat3').val('');
	if(this.value === 'ty'){
		$('.field-cat2').show();
		$("select#cat2").append("<option value>请选择第二专业类别</option>")
		.append("<option value='田径'>田径</option>")
		.append("<option value='女子排球'>女子排球</option>")
		.append("<option value='男子排球'>男子排球</option>")
		.append("<option value='女子足球'>女子足球</option>")
		.append("<option value='男子足球'>男子足球</option>");
	}
	if(this.value === 'yy'){
		$('.field-cat2').show();
		$("select#cat2").append("<option value>请选择第二专业类别</option>")
		.append("<option value='声乐-民族'>声乐-民族</option>")
		.append("<option value='声乐-美声'>声乐-美声</option>")
		.append("<option value='钢琴'>钢琴</option>")
		//.append("<option value='器乐'>器乐</option>")
		.append("<option value='舞蹈-中国舞'>舞蹈-中国舞</option>")
		.append("<option value='舞蹈-民族舞'>舞蹈-民族舞</option>");
	}
	if(this.value === 'ms'){
		//alert('ms');
	}
});
$('#cat2').change(function(){
   $('.field-cat3').hide();
   $('#cat3').val('');
   if(this.value === '器乐')
   {
   	  $('.field-cat3').show();
   }

});

$('#idcard').blur(function(){
    s = this.value;
    year = s.substring(6,10);
    month = s.substring(10,12)
    day = s.substring(12,14);
    //alert(year+'-'+month+'-'+day);
    $('#birth').val(year+'-'+month+'-'+day);
});

$('#submit').click(function(){
    if($('#cat2').html()!='' && $('#cat2').val() == ''){
    	alert('没有选择第二专业');
        return false;
    }else{
    	return true;
    }
});

JS,View::POS_LOAD);
?>
