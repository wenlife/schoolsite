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

$allTerm = (new \yii\db\Query())->select(['title','id'])->from('teach_year_manage')
                                ->indexby('id')->orderby('start_date desc')->column();
$yearpost = ArrayHelper::getValue($var,'yearpost')?ArrayHelper::getValue($var,'yearpost'):key($allTerm);

$allDepartment = (new \yii\db\Query())->select(['title','id'])->from('teach_department')
                ->indexby('id')->column();

$allSubject = CommonFunction::getAllTeachDuty();

$term = ArrayHelper::getValue($var,'yearpost')?ArrayHelper::getValue($var,'yearpost'):key($allTerm);
$department = ArrayHelper::getValue($var,'department')?ArrayHelper::getValue($var,'department'):key($allDepartment);
$allClass = (new \yii\db\Query())->select(['title','id'])->from('teach_class')
               ->where(['department_id'=>$department])->indexby('id')->column();
$banji = ArrayHelper::getValue($var,'banji')?ArrayHelper::getValue($var,'banji'):key($allClass);
//需要增加对教学部的判断，每个教学部的作息表不一致
$allDaytime = (new \yii\db\Query())->from('teach_daytime')->orderby('sort')->all();
$week = CommonFunction::getWeekday();
?>
<div class="teach-manage-index">
  <p>
  <?= Html::a('导入课程', ['import'], ['class' => 'btn btn-success']) ?>
  <?= Html::a('清空年级任教数据', ['delete','year'=>$term,'department'=>$department], ['class' => 'btn btn-danger pull-right','onclick'=>'return confirm("您确定要删出当前年级的全部课程安排吗？")']) ?>
  </p>
</div>
<div class="row">
<div class="col-md-7">
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
                  <?php foreach ($week as $id => $weekday) {echo '<th style="width: 150px">'.$weekday.'</th>';}?>
                </tr>
                </thead>
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
                                ->from('teach_course')->where(['year_id'=>$yearpost])
                                ->andwhere(['class_id'=>$banji,'weekday'=>$week_id,'day_time_id'=>$daytime['id']])
                                ->indexby('id')->one();
                          $courseName = '<span class="glyphicon glyphicon-plus-sign"></span>';
                         if($ifset)
                          {   
                            $getcourseName = ArrayHelper::getValue(CommonFunction::getAllSubjects(),ArrayHelper::getValue($ifset,'subject_id'));
                            if($courseName)
                            {  
                                $courseName = $getcourseName;
                            }
                          }
                          echo '<td><a type="button" href="#" class="" data-toggle="modal"
                                   data-year = "'.$term.'""
                                   data-banji="'.$banji.'" 
                                   data-weekday="'.$week_id.'"
                                   data-daytime="'.$daytime['id'].'"
                                   data-target="#exampleModal">'.$courseName.'</a></td>';
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
<div class="col-md-5">
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title" >当前课表统计信息</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">

            <div class="box-body">
              <table class="table table-bordered">

              <thead>
                <tr>
              <?php 
                 $nameArr = CommonFunction::getAllSubjects();
                 $courseCount = (new \yii\db\Query())
                                ->select(["count('id') as num",'subject_id'])
                                ->from('teach_course')
                                ->where(['year_id'=>$yearpost,'class_id'=>$banji])
                                ->indexby('subject_id')
                                ->groupby('subject_id')->column();
                $courseLimit = (new \yii\db\Query())
                                ->select(['course_limit','course_id'])
                                ->from('teach_course_limit')
                                ->where(['department_id'=>$department])
                                ->indexby('course_id')
                                ->column();

                foreach ($courseCount as $course_title => $course_num) {
                    echo "<th>".$nameArr[$course_title]."</th>";
                }

              ?>
              </tr>
              </thead>
                <tbody>
                <tr>
                  <?php
                  foreach ($courseCount as $course_title => $course_num) {
                    $courseThis = ArrayHelper::getValue($courseLimit,$course_title)?ArrayHelper::getValue($courseLimit,$course_title):20;
                      if($courseThis<$course_num){
                        echo "<script>alert('".$nameArr[$course_title]."课程总是超过了限制@！')</script>";
                        echo '<td style="color:red">';
                      }else if($courseThis == $course_num){
                        echo '<td class="text-success">';
                      }else{
                        echo '<td class="text-primary">';
                      }
                      echo $course_num."</td>";
                  }
                  ?>
                </tr>
              </tbody></table>
            </div>

</div>
</div>
<?php
  if($teacherName != null ){
?>
<div class="tab">
<div class="box box-success">
        <div class="box-header with-border"><h3 class="box-title" >当前<b class="text-danger"><?=ArrayHelper::getValue($allSubject,$subject)?></b>教师<b class="text-danger"><?=$teacherName?></b>课程表</h3>
        </div>
        <div class="box-body no-padding" style="font-size:10px">
          <table class="table table-bordered">
            <thead>  
            <tr>
              <th>节次</th>
              <?php  foreach ($week as $id => $weekday) {echo '<th>'.$weekday.'</th>';}?>
            </tr>
            </thead>
            <tbody id="table-body">
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
            <?php foreach ($week as $week_id => $weekday) { 
                //var_export($courseArr);
               echo '<td>'.(isset($courseArr[$week_id][$daytime['id']]) ? $courseArr[$week_id][$daytime['id']] : null).'</td>';
               //echo '<td>'.$week_id.$daytime['id'].'</td>';
            }
            ?>
            </tr>   
            <?php }?>   
          </tbody>
        </table>
      </div>
</div>
</div>

<?php }?>

</div>
</div>
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>

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
        //alert(data);
          if(data=="SaveError")
          {
            alert(data);
          }else{
            //alert(data);
            data = JSON.parse(data);
            //alert(data);
            var thisURL = document.location.href;
            thisURL = thisURL.split("&");
            thisURL = thisURL[0]+'&teacher='+data['teacher_id']+'&yearpost='+data['yearpost']+'&subject='+data['subject']+'&banji='+recipient+'&department='+<?=$department?>;
            document.location.href = thisURL;
          }
        });
})
});

$("select.subject_choice").on('change',
function(e){ 
    $("#form2").submit();
  });
});

</script>