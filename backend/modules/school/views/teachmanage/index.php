<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
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
        <?= Html::a('任教总览', ['allview'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('清空数据', ['allview'], ['class' => 'btn btn-danger']) ?>
    </p>
</div>
<div class="tab">
<?php Pjax::begin(); ?>
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">教师任教表</h3>
        <?php $form = ActiveForm::begin(['id'=>'form1','options'=>['class'=>'form-inline']]); ?>
        <div class="form-group">
          <?php echo Html::dropDownList('yearpost',$term,$allTerm,['class'=>'form-control']);?>
        </div>
        <div class="form-group">
          <?php echo Html::dropDownList('department',$department,$allDepartment,['class'=>'form-control']);?>
        </div>
        <button type="submit" class="btn btn-primary">查询</button>
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
                    //      echo '<td><a type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    //  <span class="glyphicon glyphicon-plus-sign"></span>
                    // </a></td>';
                    $ifset = (new \yii\db\Query())
                              ->select(['teacher_id','id'])
                              ->from('teach_manage')
                              ->where(['year_id'=>$term,'class_id'=>$classid,'subject'=>$subjectid])
                              ->indexby('id')
                              ->one();
                             // var_export($ifset['teacher_id']);
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
                         //echo "<td>".ArrayHelper::getValue($teacherName,'name')."</td>";
                         echo '<td><a type="button" class="" href="'.Url::toRoute(['teachmanage/add',
                                'subject'=>$subjectid,
                                'term' => $term,
                                'banji' => $classid,
                        ]).'">
                          '.ArrayHelper::getValue($teacherName,'name').'
                          </a></td>';
                        }else{
                          echo "<td>".ArrayHelper::getValue($ifset,'teacher_id')."</td>";
                        }

                    }else{

                    echo '<td><a type="button" class="" href="'.Url::toRoute(['teachmanage/add',
                            'subject'=>$subjectid,
                            'term' => $term,
                            'banji' => $classid,
                        ]).'">
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
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>
