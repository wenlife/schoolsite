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
     <!--  <h1 id="show">距离报名结束：<span></span>天<span></span>小时<span></span>分<span></span>秒</h1> -->
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

  var show=document.getElementById("show").getElementsByTagName("span");
  
  setInterval(function(){
  var timeing=new Date();
  var time=new Date(2020,7,16,23,30,0);
        var num=time.getTime()-timeing.getTime();
        
        var day=parseInt(num/(24*60*60*1000));      
        num=num%(24*60*60*1000);
        var hour=parseInt(num/(60*60*1000));            
        num=num%(60*60*1000);
        var minute=parseInt(num/(60*1000));
        num=num%(60*1000);
        var seconde=parseInt(num/1000);
         
          show[0].innerHTML=day;
          show[1].innerHTML=hour;
          show[2].innerHTML=minute;
          show[3].innerHTML=seconde;
        },100)
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


    
    <script>

            
            
    </script>
