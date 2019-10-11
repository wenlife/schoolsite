<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeachsettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教师任教安排';
$this->params['breadcrumbs'][] = $this->title;

$allTerm = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('semester')
                ->indexby('id')
                ->orderby('end desc')
                ->column();

$allDepartment = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('department')
                ->indexby('id')
                ->column();

$allSubject = (new \yii\db\Query())
                ->select(['title','id'])
                ->from('subject')
                ->indexby('id')
                ->column();

$term = ArrayHelper::getValue($var,'term')?ArrayHelper::getValue($var,'term'):key($allTerm);
$department = ArrayHelper::getValue($var,'department')?ArrayHelper::getValue($var,'department'):key($allDepartment);
//var_export($department);
//$department = ArrayHelper::getValue('department');
$allClass = (new \yii\db\Query())
               ->select(['name','id'])
               ->from('class_setting')
               ->where(['department'=>$department])
               ->indexby('id')
               ->column();
//var_export($allSubject);
//var_export($term);
?>
<div class="teachsetting-index">

    <p>
        <?= Html::a('新建任教', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('批量导入', ['import'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('任教总览', ['allview'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('清空数据', ['allview'], ['class' => 'btn btn-danger']) ?>
    </p>

    <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">任教列表</h3>
                <?php $form = ActiveForm::begin(['method'=>'','options'=>['class'=>'form-inline']]); ?>
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                    <?=Html::dropDownList('term',ArrayHelper::getValue($var,'term'),$allTerm,['class'=>'form-control','style'=>'width:150px']);?>
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3">Password</label>
                     <?=Html::dropDownList('department',ArrayHelper::getValue($var,'department'),$allDepartment,['class'=>'form-control','style'=>'width:150px']);?>
                  </div>
                  <button type="submit" class="btn btn-success">查询</button>
                 <?php ActiveForm::end(); ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 200px">班级列表</th>
                  <?php
                     foreach ($allSubject as $id => $subject) {
                         echo '<th style="width: 50px">'.$subject.'</th>';
                     }
                  ?>
                </tr>
                
                <?php
                    foreach ($allClass as $classid => $className) {
                ?>
                   <tr>
                   <td><?=$classid?></td>
                   <td><?=$className?></td>
                  <?php
                    foreach ($allSubject as $subjectid => $subject) {
                    //      echo '<td><a type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    //  <span class="glyphicon glyphicon-plus-sign"></span>
                    // </a></td>';
                    $ifset = (new \yii\db\Query())
                              ->select(['teacher_id','id'])
                              ->from('teach_setting')
                              ->where(['semester'=>$term,'class_id'=>$classid,'subject_id'=>$subjectid])
                              ->indexby('id')
                              ->one();
                             // var_export($ifset['teacher_id']);
                     if($ifset)
                     {   
                        $teacherName = (new \yii\db\Query())
                                    ->select('name')
                                    ->from('teacher')
                                    ->where(['id'=>ArrayHelper::getValue($ifset,'teacher_id')])
                                    ->one();
                        //var_export($teacherName);
                        if($teacherName)
                        {  
                         //echo "<td>".ArrayHelper::getValue($teacherName,'name')."</td>";
                         echo '<td><a type="button" class="btn btn-success" href="'.Url::toRoute(['teachsetting/getteacher',
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

                    echo '<td><a type="button" class="btn btn-info" href="'.Url::toRoute(['teachsetting/getteacher',
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
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
          <!-- /.box -->

         
        </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'class_id',
            'teacher_id',
            'subject_id',
            'semester',
            //'note',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>