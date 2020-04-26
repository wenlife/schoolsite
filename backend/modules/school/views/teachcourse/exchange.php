<?php
use yii\web\View;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\libary\CommonFunction;
$this->title = '班级课程安排';
$this->params['breadcrumbs'][] = $this->title;
$week = CommonFunction::getWeekday();
$allSubject = CommonFunction::getAllSubjects();
?>
<div class="teach-manage-index">
  <p>
  <?= Html::a('导入课程', ['import'], ['class' => 'btn btn-success']) ?>
  <?= Html::a('清空年级课程数据', ['delete','year'=>$term,'department'=>$department], 
                                 ['class' => 'btn btn-danger pull-right','onclick'=>'return confirm("您确定要删出当前年级的全部课程安排吗？")']) ?>
  </p>
</div>
<div class="row">
<div class="col-md-7">
<div class="tab">
<div class="box box-success">
    <div class="box-header no-border">
        <h3 class="box-title" style="text-align:center;padding-bottom:5px;margin-bottom: 15px;border-bottom: 1px dashed #ccc;width:100%">班级课程安排表</h3>
        <?php 
            $form = ActiveForm::begin(['id'=>'form1','method'=>'get','action'=>Url::toRoute(['index']),'options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('term',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$departments,[
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
          <?php echo Html::dropDownList('banji',$banji,$allClass,['class'=>'form-control autosubmit','id'=>'classoption','style'=>"width:120px"]);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <div class="box-body">
        <table class="my table table-bordered">
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
                  if($time_id>=2 &&(ArrayHelper::getValue($allDaytime,($time_id-1).'.part')!=$daytime['part']))
                  {
                      echo "<tr style='border-top:2px solid #ccc'>";
                  }else{
                      echo "<tr>";
                  }
              echo "<td>".ArrayHelper::getValue($daytime,'sort')."</td>";
              echo "<td>".ArrayHelper::getValue($daytime,'title')."</td>";
              foreach ($week as $week_id => $weekday) { 
                    $courseName = '<span class="glyphicon glyphicon-plus-sign"></span>';
                    $name = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub');
                    $name2 = ArrayHelper::getValue($courseArr,$time_id.'.'.$week_id.'.sub2');
                    if($name)
                    	$courseName = $name;
                    echo '<td><a type="button" href="#" class="" 
                             data-toggle="modal"
                             data-year = "'.$term.'""
                             data-banji="'.$banji.'" 
                             data-weekday="'.$week_id.'"
                             data-daytime="'.$daytime['id'].'"
                             data-target="#exampleModal">';
                      if($name2){
                        echo '<small>'.$courseName.'/'.$name2.'</small>';
                      }else{
                        echo $courseName;
                      }
                      echo '</a></td>';
              }
              echo "</tr>";
             }?>  
        </tbody>
      </table>
      </div>
    </div>
</div>
</div>
</div>
<div class="col-md-5">
<div class="box box-success">
    <div class="box-header with-border"><h3 class="box-title" >当前课表统计信息</h3></div>
    <div class="box-body no-padding">
	<div class="box-body">
	  <table class="my table table-bordered">
	  <thead>
	    <tr><?php foreach ($allSubject as $c_en => $c_cn) {echo "<th>".$c_cn."</th>";}?></tr>
	  </thead>
	    <tbody>
	    <tr>
	      <?php
            foreach ($allSubject as $c_en => $c_cn) {
            	$sub_course_num = ArrayHelper::getValue($courseCount,$c_en,0);
              if(isset($courseLimit[$c_en][0]))
              {
                $sub_course_limit = ArrayHelper::getValue($courseLimit,$c_en,0);
                //$sub_course_limit = ArrayHelper::getValue($courseLimit,$c_en,0);
                if($sub_course_num != $sub_course_limit){
                //echo "<script>alert('".$c_cn."课程总是超过了限制@！')</script>";
                echo '<td style="color:red">';
                }else{
                  echo "<td>";
                }
              }else{
                $sub_course_limit = 'N';
                echo '<td style="color:red">';

              }
            	echo $sub_course_num.'/'.$sub_course_limit."</td>";
            }
	      ?>
	    </tr>
	  </tbody>
	 </table>
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
          <table class="my table table-bordered">
            <thead>  
            <tr><th>节次</th><?php foreach ($week as $id => $weekday) {echo '<th>'.$weekday.'</th>';}?></tr>
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
                echo "<td>".ArrayHelper::getValue($daytime,'title')."</td>";
                foreach ($week as $week_id => $weekday) { 
                	$banji = ArrayHelper::getValue($tcourseArr,$week_id.'.'.$daytime['id']);
	            	echo "<td>";
	            	if($banji&&!is_string($banji))
	             	{
	                	echo $banji->title;
	             	}else{
	                	echo "<span class='text-danger'>".$banji.'</span>';
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

<?php }?>

</div>
</div>

<div class="modal fade" id="exampleModal" class="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-body">
            <?php $form = ActiveForm::begin(['id'=>'form2','action'=>Url::toRoute(['setcourse']),'options'=>['class'=>'form-inline']]); ?>

            <div class="input-group">
              <div class="input-group-addon"><input type="checkbox" name="turn" id="double" title="设置轮换科目"></div>
              <?php echo Html::dropDownList('subject',null,CommonFunction::getAllSubjects(),
                ['class'=>'form-control subject_choice','style'=>'width:200px']);?>
              <?php echo Html::dropDownList('subject2',null,CommonFunction::getAllSubjects(),
                ['class'=>'form-control subject_choice2','style'=>'width:200px']);?>
            </div>
             <div class="form-group">
                <input name="year" type="text" id='year' class="form-control hide" id="recipient-name">
                <input name="banji" type="text" id='banji' class="form-control hide" id="recipient-name">
                <input name="weekday" type="text" id='weekday' class="form-control hide" id="recipient-name">
                <input name="daytime" type="text" id='daytime' class="form-control hide" id="recipient-name">
            </div> 
             <div class="form-group">
              <button type="submit" class="btn sb btn-success">提交</button>
             </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(function(){
  alert('11');
});
</script>