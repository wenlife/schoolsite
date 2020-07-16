<?php
/* @var $this yii\web\View */
/* @year 学年度 */
/* @model BackendLoginForm */
/* @courseArr array */
/* @teacher_id  id */
/* @subject  string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use backend\libary\CommonFunction;
use backend\models\SysNotice;
$this->title = '教师中心';
$this->params['breadcrumbs'][] = $this->title;
$week = CommonFunction::getWeekday();
$msg = SysNotice::findOne(['pos'=>'pos_course']);
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
<div class="row">
<div class="col-md-9">
<div class="tab">
<div class="box box-primary">
  <div class="box-header with-border">
      <?php 
      $form = ActiveForm::begin(
        ['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]
      ); ?>
      <div class="form-group">
        <?php echo Html::dropDownList('year',Html::encode($term),$allTerm,['class'=>'form-control']);?>
      </div>
      <div class="form-group">
        <?php echo Html::dropDownList('subject',Html::encode($subject),CommonFunction::getAllSubjects(),[
        'class'=>'form-control',
        'onChange'=>'
              $("select#teacheroption").empty();
              url = "index.php?r=tcenter/getteacher&subject="+$(this).val();           
              $.post(url,null,function(data){
                var result = JSON.parse(data);
                for(var x in result)
                {
                    $("select#teacheroption").append("<option value="+x+">"+result[x]+"</option>");
                }
              });
        ']);?>
      </div>
      <div class="form-group">
        <?php echo Html::dropDownList('teacher_id',$teacher_id,$teachers,['class'=>'form-control','id'=>'teacheroption',
         'onChange'=>'$("#form1").submit();']);?>
      </div>
      <button type="submit" class="btn btn-primary">查询</button>
      <?php ActiveForm::end(); ?>
  </div>
  <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>  
            <tr><th>节次</th><?php  foreach ($week as $id => $weekday) {echo '<th>'.$weekday.'</th>';}?></tr>
          </thead>
          <tbody id="table-body">
          <?php
            foreach ($allDaytime as $time_id => $daytime) {
               if($time_id>=2 &&(ArrayHelper::getValue($allDaytime,($time_id-1).'.part')!=$daytime['part']))
                {
                    echo "<tr style='border-top:2px solid'>";
                }else{
                     echo "<tr>";
                }
                $setime = ArrayHelper::getValue($daytime,'start')."-".ArrayHelper::getValue($daytime,'end');

                echo "<td><small style='cursor:pointer' title='".$setime."'>".ArrayHelper::getValue($daytime,'title')."</small></td>";
              foreach ($week as $week_id => $weekday) { 

                $banji = ArrayHelper::getValue($courseArr,$week_id.'.'.$daytime['sort']);
                echo "<td>";
                if($banji&&!is_string($banji))
                 {
                    echo '<a href="index.php?r=tcenter/bcourse&class_id='.$banji->id.'">'.$banji->title."</a>";
                 }else{
                    echo $banji;
                 }
                echo "</td>";
              }
              echo "</tr>";
            }
          ?> 
        </tbody>
      </table>
  </div>
</div>
</div>
</div>
<div class="col-md-3">
<?php
 if(Yii::$app->user->isGuest)
 {
     echo $this->render("login_bar",['model'=>$model]);
 }else{
     echo $this->render("left_bar",['model'=>$model]);
 }
?>
</div>
</div>
<style type="text/css">
 table,td,th{
     /*边框合并*/
     border-collapse: collapse;
     border: 1px solid #337ab7;
     text-align: center;
 }
table th{
  background-color: #337ab7;
  color:#fff;
}
</style>

<button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#avatar-modal" style="margin: 10px;">
        修改头像
    </button>
    <div class="user_pic" style="margin: 10px;">
      <img src=""/>
    </div>

    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!--<form class="avatar-form" action="upload-logo.php" enctype="multipart/form-data" method="post">-->
          <form class="avatar-form">
            <div class="modal-header">
              <button class="close" data-dismiss="modal" type="button">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">
                <div class="avatar-upload">
                  <input class="avatar-src" name="avatar_src" type="hidden">
                  <input class="avatar-data" name="avatar_data" type="hidden">
                  <label for="avatarInput" style="line-height: 35px;">图片上传</label>
                  <button class="btn btn-danger"  type="button" style="height: 35px;" onclick="$('input[id=avatarInput]').click();">请选择图片</button>
                  <span id="avatar-name"></span>
                  <input class="avatar-input hide" id="avatarInput" name="avatar_file" type="file"></div>
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg" id="imageHead"></div>
                    <!--<div class="avatar-preview preview-md"></div>
                <div class="avatar-preview preview-sm"></div>-->
                  </div>
                </div>
                <div class="row avatar-btns">
                  <div class="col-md-4">
                    <div class="btn-group">
                      <button class="btn btn-danger fa fa-undo" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"> 向左旋转</button>
                    </div>
                    <div class="btn-group">
                      <button class="btn  btn-danger fa fa-repeat" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"> 向右旋转</button>
                    </div>
                  </div>
                  <div class="col-md-5" style="text-align: right;">               
                    <button class="btn btn-danger fa fa-arrows" data-method="setDragMode" data-option="move" type="button" title="移动">
                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                          </span>
                        </button>
                        <button type="button" class="btn btn-danger fa fa-search-plus" data-method="zoom" data-option="0.1" title="放大图片">
                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
                            <!--<span class="fa fa-search-plus"></span>-->
                          </span>
                        </button>
                        <button type="button" class="btn btn-danger fa fa-search-minus" data-method="zoom" data-option="-0.1" title="缩小图片">
                          <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
                            <!--<span class="fa fa-search-minus"></span>-->
                          </span>
                        </button>
                        <button type="button" class="btn btn-danger fa fa-refresh" data-method="reset" title="重置图片">
                            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;reset&quot;)" aria-describedby="tooltip866214">
                       </button>
                      </div>
                  <div class="col-md-3">
                    <button class="btn btn-danger btn-block avatar-save fa fa-save" type="button" data-dismiss="modal"> 保存修改</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
<link href="specialcontent/head/cropper.min.css" rel="stylesheet">
<link href="specialcontent/head/sitelogo.css" rel="stylesheet">
<?php
$this->registerJsFile('specialcontent\head\cropper.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\head\sitelogo.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\head\html2canvas.min.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJs(<<<JS
//做个下简易的验证  大小 格式 
    $('#avatarInput').on('change', function(e) {
      var filemaxsize = 1024 * 5;//5M
      var target = $(e.target);
      var Size = target[0].files[0].size / 1024;
      if(Size > filemaxsize) {
        alert('图片过大，请重新选择!');
        $(".avatar-wrapper").childre().remove;
        return false;
      }
      if(!this.files[0].type.match(/image.*/)) {
        alert('请选择正确的图片!')
      } else {
        var filename = document.querySelector("#avatar-name");
        var texts = document.querySelector("#avatarInput").value;
        var teststr = texts; //你这里的路径写错了
        testend = teststr.match(/[^\\]+\.[^\(]+/i); //直接完整文件名的
        filename.innerHTML = testend;
      }
    
    });

    $(".avatar-save").on("click", function() {
      var img_lg = document.getElementById('imageHead');
      // 截图小的显示框内的内容
      html2canvas(img_lg, {
        allowTaint: true,
        taintTest: false,
        onrendered: function(canvas) {
          canvas.id = "mycanvas";
          //生成base64图片数据
          var dataUrl = canvas.toDataURL("image/jpeg");
          var newImg = document.createElement("img");
          newImg.src = dataUrl;
          imagesAjax(dataUrl)
        }
      });
    })
    
    function imagesAjax(src) {
      var data = {};
      data.img = src;
      data.jid = $('#jid').val();
      $.ajax({
        url: "index.php?r=tcenter/avatar",
        data: data,
        type: "POST",
        dataType: 'json',
        success: function(re) {
          if(re.status == '1') {
            $('.user_pic img').attr('src',src );
          }else{
            console.log(re);
          }
        }
      });
    }

JS,View::POS_LOAD);
?>


