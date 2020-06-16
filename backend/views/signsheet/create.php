<?php

use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Alert;
use backend\models\SysNotice;
/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */
$msg = SysNotice::findOne(['pos'=>'pos_ytbm']);



$this->title = '报名表';
?>
<div class="sign-sheet-create">

    <h1 style="text-align: center; ">攀枝花第七高级中学校</h1>
    <h3 style="text-align: center;">2020年艺体特长招生考试报名</h3>
    <div class="box box-primary">
    <div class="box-header with-border">
      <?php
      if($msg)
        {
        echo Alert::widget([
          'options' => [
              'class' => $msg->level,
          ],
           'body' => $msg->content,
        ]);
        }
      ?>
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


// $('#submit').click(function(){
//     if($('#cat2').html()!='' && $('#cat2').val() == ''){
//     	alert('没有选择第二专业');
//         return false;
//     }else{
//     	return true;
//     }
// });

JS,View::POS_LOAD);
?>
