<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use backend\libary\CommonFunction;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = '任教管理';
$this->params['breadcrumbs'][] = $this->title;

$allTerm = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('teach_year_manage')
                ->indexby('id')
                ->orderby('end_date desc')
                ->column();
//$yearpost = ArrayHelper::getValue('post','yearpost')?ArrayHelper::getValue('post','yearpost'):key($allTerm);
//$yearpost = $yearpost?$yearpost:key($allTerm);
$term = $yearpost?$yearpost:key($allTerm);

$allDepartment = (new \yii\db\Query())->select(['title','id'])->from('teach_department')->indexby('id')->column();

$allSubject = CommonFunction::getAllTeachDuty();


//$department = ArrayHelper::getValue($var,'department')?ArrayHelper::getValue($var,'department'):key($allDepartment);
$department = $department?$department:key($allDepartment);
//var_export($department);
//$department = ArrayHelper::getValue('department');
$allClass = (new \yii\db\Query())
              // ->select(['title','id'])
               ->from('teach_class')
               ->where(['department_id'=>$department])
               ->indexby('id')
              // ->column();
              ->all();
?>
<div class="teach-manage-index">
    <p>
        <?= Html::a('新建任教', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量导入', ['import'], ['class' => 'btn btn-primary']) ?>
        
    </p>
</div>
<div class="tab">
<?php Pjax::begin(); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">教师任教表</h3>
        <?php $form = ActiveForm::begin(['id'=>'form1','action'=>'index.php?r=school/teachmanage','method'=>'get','options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('yearpost',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$allDepartment,['class'=>'form-control']);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
        <?= Html::a('清空数据', ['delete','yearpost'=>$term,'department'=>$department], ['class' => 'btn btn-danger pull-right','onclick'=>'return confirm("确实要删除当前级部的任教信息吗？")']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 200px">班级列表</th>
                  <th style="width: 50px">类型</th>
                  <?php
                     foreach ($allSubject as $id => $subject) {
                         echo '<th style="width: 50px">'.$subject.'</th>';
                     }
                  ?>
                </tr>
                
                <?php
                    foreach ($allClass as $classid => $classContent) {
                ?>
                   <tr>
                   <td><?=$classid?></td>
                   <td><?=ArrayHelper::getValue($classContent,'title')?></td>
                   <td><?php echo ArrayHelper::getValue($classContent,'type')=='lk'?'理科':'文科'?></td>
                  <?php
                    foreach ($allSubject as $subjectid => $subject) {
                      $ifset = (new \yii\db\Query())
                                ->select(['teacher_id','id'])->from('teach_manage')
                                ->where(['year_id'=>$term,'class_id'=>$classid,'subject'=>$subjectid])
                                ->indexby('id')->one();
                               // var_export($ifset['teacher_id']);
                      $dis_teacher_name = '<span class="glyphicon glyphicon-plus-sign"></span>';
                      if($ifset)
                       {   
                          $teacherName = (new \yii\db\Query())
                                      ->select('name')
                                      ->from('user_teacher')
                                      ->where(['id'=>ArrayHelper::getValue($ifset,'teacher_id')])
                                      ->one();
                          //var_export($teacherName);
                          if($teacherName)
                          { 
                            $dis_teacher_name = ArrayHelper::getValue($teacherName,'name');
                          }else{
                            $dis_teacher_name = ArrayHelper::getValue($ifset,'teacher_id');
                          }
                        }
                        echo  '<td><a type="button" href="#" class=""
                                data-toggle="modal"
                                data-term = "'.$term.'""
                                data-subject="'.$subjectid.'" 
                                data-banji="'.$classid.'"
                                data-target="#exampleModal">'.$dis_teacher_name.
                              '</a></td>';
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
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>
<div class="modal fade" id="exampleModal" class="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-body">
            <?php $form = ActiveForm::begin(['id'=>'form2','action'=>Url::toRoute(['getteachers']),'options'=>['class'=>'form-inline']]); ?>
            <div class="form-group">
              <?php echo Html::dropDownList('subject',null,CommonFunction::getAllSubjects(),
                ['class'=>'form-control subject_choice','style'=>'width:100px','id'=>'subject']);
              ?>
            </div> 
            <div class="form-group">       
              <?php echo Html::dropDownList('teacher',null,$teachers,['class'=>'form-control','style'=>'width:100px','id'=>'teacher','prompt'=>'选择教师']);?>
            </div> 
            <div class="form-group">
              <input name="term" type="text" id='term' class="form-control hide" id="recipient-name">
              <input name="subject" type="text" id='subject' class="form-control hide" id="recipient-name">
              <input name="banji" type="text" id='banji' class="form-control hide" id="recipient-name">
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
      modal.find('.modal-body input#term').val(button.data('term'))
      modal.find('.modal-body input#banji').val(recipient)
      modal.find('.modal-body input#subject').val(button.data('subject'))
      //首次载入确定科目，并且主动触发change事件，载入教师信息
      $('select#subject').val(button.data('subject'));
      $('select#subject').trigger("change");

      $("#form2").submit(function(e1){
        e1.preventDefault();
        formdata = $('#form2').serialize();
        url_1 = "index.php?r=school/teachmanage/setmanage";
         $.post(url_1,formdata,function(msg){
              if(msg != 'success')
                       alert(msg);
              else
                document.location.reload();
         });
      });
    });

    $("select#subject").on('change',function(e){
        $("select#teacher").empty();
        url_2 = "index.php?r=school/teachmanage/getteachers&subject="+$(this).val();
        $.post(url_2,null,function(data){
          var result = JSON.parse(data);
          for(var x in result)
          {
              $("select#teacher").append("<option value="+x+">"+result[x]+"</option>");
          }
        });
    });

    $("select#teacher").on('change',
      function(e1){ 
          $("#form2").submit();
        });
    });

</script>