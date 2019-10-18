<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\libary\CommonFunction;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = '班级课程安排';
$this->params['breadcrumbs'][] = $this->title;

$allTerm = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('teach_year_manage')
                ->indexby('id')
                ->orderby('end_date desc')
                ->column();
$yearpost = ArrayHelper::getValue('post','yearpost')?ArrayHelper::getValue('post','yearpost'):key($allTerm);

$allDepartment = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('teach_department')
                ->indexby('id')
                ->column();

$allSubject = CommonFunction::getAllTeachDuty();

$term = ArrayHelper::getValue($var,'yearpost')?ArrayHelper::getValue($var,'yearpost'):key($allTerm);
$department = ArrayHelper::getValue($var,'department')?ArrayHelper::getValue($var,'department'):key($allDepartment);
//var_export($department);
//$department = ArrayHelper::getValue('department');
$allClass = (new \yii\db\Query())
               ->select(['title','id'])
               ->from('teach_class')
               ->where(['department_id'=>$department])
               ->indexby('id')
               ->column();

$banji = ArrayHelper::getValue($var,'banji')?ArrayHelper::getValue($var,'banji'):key($allClass);

$allDaytime = (new \yii\db\Query())->from('teach_daytime')->orderby('sort')->all();
//var_export($allDaytime);
$week = CommonFunction::getWeekday();
?>
<div class="teach-manage-index">
    <p>
        <?= Html::a('课程总览', ['allview'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('清空数据', ['allview'], ['class' => 'btn btn-danger']) ?>
    </p>
</div>
<div class="row">
<div class="col-md-8">
<div class="tab">
<?php Pjax::begin(); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" style="text-align:center;padding-bottom:5px;margin-bottom: 15px;border-bottom: 1px dashed #ccc;width:100%">班级课程安排表</h3>
        <?php 
            $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('yearpost',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$allDepartment,[
            'class'=>'form-control',
            'onChange'=>'
                  $("select#classoption").empty();
                  url = "index.php?r=school/teachcourse/getclass&department="+$(this).val();           
                  $.post(url,null,function(data){
                    var result = JSON.parse(data);
                    for(var x in result)
                    {
                        $("select#classoption").append("<option value="+x+">"+result[x]+"</option>");
                    }
                  });
            ']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('banji',$banji,$allClass,['class'=>'form-control','id'=>'classoption','style'=>"width:120px"]);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 100px">节次</th>
                
                 
                  <?php
                    //$week = ['0'=>'星期天','1'=>'星期一','2'=>'星期二','3'=>'星期三','4'=>'星期四','5'=>'星期五','6'=>'星期六'];
                     foreach ($week as $id => $weekday) {
                         echo '<th style="width: 150px">'.$weekday.'</th>';
                     }
                  ?>
                </tr>
                </thead>
     <!--  =============================================================== -->
                <tbody>
                <?php
                    foreach ($allDaytime as $time_id => $daytime) {//注意此处没有使用indexby来让ID成为key
                        if($time_id>=2 &&($allDaytime[$time_id-1]['part']!=$allDaytime[$time_id]['part']))
                        {
                            echo "<tr style='border-top:2px solid #ccc'>";
                        }else{
                             echo "<tr>";
                        }
                ?>
                   <td><?=ArrayHelper::getValue($daytime,'sort')?></td>
                   <td><?=ArrayHelper::getValue($daytime,'title')?></td>
                  <?php
                    foreach ($week as $week_id => $weekday) {
                          $ifset = (new \yii\db\Query())
                                //->select(['subject_id','id'])
                                ->from('teach_course')
                                ->where(['class_id'=>$banji,'weekday'=>$week_id,'day_time_id'=>$daytime['id']])
                                ->indexby('id')
                                ->one();
                               //var_export($ifset['teacher_id']);
                         if($ifset)
                         {   
                            $courseName = ArrayHelper::getValue(CommonFunction::getAllSubjects(),ArrayHelper::getValue($ifset,'subject_id'));
                            //var_export($teacherName);
                            if($courseName)
                            {  
                             //echo "<td>".ArrayHelper::getValue($teacherName,'name')."</td>";
                             echo '<td><a type="button" class="" href="'.Url::toRoute(['teachmanage/add',
                                    // 'subject'=>$subjectid,
                                    // 'term' => $term,
                                    // 'banji' => $classid,
                            ]).'">'.$courseName.'</a></td>';
                            }else{
                              echo "<td>".ArrayHelper::getValue($ifset,'subject_id')."</td>";
                            }

                        }else{

                        echo '<td><a type="button" href="#" class="" data-toggle="modal"
                                         data-year = "'.$term.'""
                                         data-banji="'.$banji.'" 
                                         data-weekday="'.$week_id.'"
                                         data-daytime="'.$daytime['id'].'"
                               data-target="#exampleModal">
                              <span class="glyphicon glyphicon-plus-sign"></span></a></td>';
                        }
                    
                    }
                  ?>
                </tr>   
                <?php  }?>  
              </tbody></table>
            </div>

</div>
</div>
<?php Pjax::end(); ?>
</div>
</div>
<div class="col-md-4">


<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" >当前课表统计信息</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
 
              </tbody></table>
            </div>

</div>
</div>


<div class="tab">
<?php Pjax::begin(); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" >当前教师课程表</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  
                  <th>节次</th>
                  <?php
                    
                     foreach ($week as $id => $weekday) {
                         echo '<th>'.$weekday.'</th>';
                     }
                  ?>
                </tr>
                <?php
                    foreach ($allDaytime as $time_id => $daytime) {
                        if($time_id>=2 &&($allDaytime[$time_id-1]['part']!=$allDaytime[$time_id]['part']))
                        {
                            echo "<tr style='border-top:2px solid #ccc'>";
                        }else{
                             echo "<tr>";
                        }
                ?>
                   
                   <td><?=ArrayHelper::getValue($daytime,'title')?></td>
                  <?php
                    foreach ($week as $week_id => $weekday) {
                    echo '<td></td>';
                    
                    }
                  ?>
                </tr>   
                <?php  }?>  
              </tbody></table>
            </div>

</div>
</div>
<?php Pjax::end(); ?>
</div>
</div>
</div>
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>

<!-- <div class="modal fade modal-primary bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"> -->
<div class="modal fade" id="exampleModal" class="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-body">
            <?php $form = ActiveForm::begin(['id'=>'form2','action'=>Url::toRoute(['setcourse']),'options'=>['class'=>'form-inline']]); ?>
            <div class="form-group">
              <?php echo Html::dropDownList('subject',null,CommonFunction::getAllSubjects(),
                ['class'=>'form-control subject_choice','style'=>'width:200px']);?>
            </div> 
             <div class="form-group">
                <input name="year" type="text" id='year' class="form-control hide" id="recipient-name">
                <input name="banji" type="text" id='banji' class="form-control hide" id="recipient-name">
                <input name="weekday" type="text" id='weekday' class="form-control hide" id="recipient-name">
                <input name="daytime" type="text" id='daytime' class="form-control hide" id="recipient-name">
            </div> 
            <button type="submit" class="btn btn-success">提交</button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $('#exampleModal').on('show.bs.modal', function (event) {
    //模态窗口居中显示
    var modal = $(this)
    var $modal_dialog = modal.find('.modal-dialog');
    modal.css('display', 'block');
    $modal_dialog.css({'margin-top': Math.max(0, ($(window).height() - $modal_dialog.height()) / 2)-150 });
    //模态窗口数据填充
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('banji') // Extract info from data-* attributes
    modal.find('.modal-body input#year').val(button.data('year'))
    modal.find('.modal-body input#banji').val(recipient)
    modal.find('.modal-body input#weekday').val(button.data('weekday'))
    modal.find('.modal-body input#daytime').val(button.data('daytime'))
    url = "index.php?r=school/teachcourse/setcourse";
    $("#form2").submit(function(e){
       e.preventDefault();
       formdata = $('#form2').serialize()
       $.post(url,formdata,function(data){
          if(data=="success")
          {
            //$('#exampleModal').modal("hide");
           // val = $("select.subject_choice option:selected").html();
           // button.html(val);
            //alert("success!");
            location.reload();
          }else{
            alert(data);
          }
        });
})
});

// $('body').on('hidden.bs.modal', '.modal', function () {
//           console.log("RemoveData before:" + $(this).data("bs.modal"));
//           $("#form2").reset();
//       });

$("select.subject_choice").on('change',
function(e){ 
    $("#form2").submit();
  });
});
</script>