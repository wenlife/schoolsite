<?php
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;

$this->title = '任教管理';
$this->params['breadcrumbs'][] = $this->title;
$allSubject = CommonFunction::getAllSubjects();

?>
<div class="teach-manage-index">
<div class="box box-success">
    <div class="box-header with-border">
        <p>
        <?= Html::a('新建任教', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量导入', ['import'], ['class' => 'btn btn-primary']) ?>      
        </p>
        <?php $form = ActiveForm::begin(['id'=>'form1','action'=>'index.php?r=school/teachmanage','method'=>'get','options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('term',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$allDepartment,['class'=>'form-control','id'=>'department']);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
        <?= Html::a('清空数据', ['delete','term'=>$term,'department'=>$department], ['class' => 'btn btn-danger pull-right','onclick'=>'return confirm("确实要删除当前级部的任教信息吗？")']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
            <div class="box-body">
              <table class="my table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 100px">班级列表</th>
                  <th style="width: 50px">类型</th>
                  <?php foreach ($allSubject as $id => $subject) { echo '<th>'.$subject.'</th>';}?>
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
                      //更改逻辑，如果查找不到，直接显示添加符号
                      $dis_teacher_name = '<span class="glyphicon glyphicon-plus-sign"></span>';
                      $manMSG = ArrayHelper::getValue($allTeach,$classid.'-'.$subjectid);
                      if($manMSG&&$manMSG->teacher)
                      {
                            $dis_teacher_name = $manMSG->teacher->name;
                      }
                      echo  '<td><a type="button" href="#" class="" data-toggle="modal"
                              data-term = "'.$term.'""
                              data-subject="'.$subjectid.'" 
                              data-banji="'.$classid.'"
                              data-target="#exampleModal">'.$dis_teacher_name.'</a></td>';
                    }
                  ?>
                </tr>   
                <?php  }?>  
              </tbody>
            </table>
            </div>
    </div>
</div>
</div>

<div class="modal fade" id="exampleModal" class="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-body">
            <?php $form = ActiveForm::begin(['id'=>'form2','action'=>'#','options'=>['class'=>'form-inline']]); ?>
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
<?php
$this->registerJs(<<<JS
  $(function(){
    $('#exampleModal').on('show.bs.modal', function (event) {
      //模态窗口居中显示
      var modal = $(this)
      var modal_dialog = modal.find('.modal-dialog');
      modal.css('display', 'block');
      modal_dialog.css({'margin-top': Math.max(0, ($(window).height() - modal_dialog.height()) / 2)-150 });
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
    $("select#department").on('change',
      function(e2){ 
          $("#form1").submit();
    });

    $("select#teacher").on('change',
      function(e1){ 
          $("#form2").submit();
        });
    });
JS,View::POS_LOAD)
?>
