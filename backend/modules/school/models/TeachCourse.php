<?php

namespace backend\modules\school\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachDaytime;
/**
 * This is the model class for table "teach_course".
 *
 * @property int $id
 * @property int $class_id
 * @property string $weekday
 * @property int $day_time_id
 * @property string $subject_id
 * @property string $subject2_id
 * @property string $note
 */
class TeachCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['year_id', 'class_id', 'weekday', 'day_time_id', 'subject_id'], 'required'],
           [['year_id', 'class_id', 'day_time_id'], 'integer'],
           [['weekday'], 'string', 'max' => 50],
           [['subject_id', 'subject2_id'], 'string', 'max' => 11],
           [['note'], 'string', 'max' => 100],
        ];
    }

    public function getWeekCourse($term,$class_id)
    {
      $allDaytime = TeachDaytime::find()->orderby('sort')->indexby('sort')->all();
      $week       = CommonFunction::getWeekday();
      $subjects   = CommonFunction::getAllSubjects();
      $subs = $this->find()->where(['year_id'=>$term,
                                 'class_id'=>$class_id])->indexby(function($row){
                                    return $row['day_time_id'].'-'.$row['weekday'];
                                 })->all();
      $teachers = TeachManage::find()->select(['teacher_id','subject'])->where(['year_id'=>$term,
                                                'class_id'=>$class_id])->indexby('subject')->column();
      foreach ($allDaytime as $time_id=>$daytime) {
        foreach ($week as $week_id => $weekday) { 
            //注意：此处的daytime的index值是用sort的值，不是id值
            $sub = ArrayHelper::getValue($subs,$daytime->id.'-'.$week_id);
            if($sub)
            {
                $weekCourse[$time_id][$week_id] = ['sub'=>ArrayHelper::getValue($subjects,$sub->subject_id),
                                                   't_id'=>ArrayHelper::getValue($teachers,$sub->subject_id)];
            }
            
        }
      }
      return $weekCourse;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class_id' => '班级',
            'weekday' => '星期',
            'day_time_id' => '节次',
            'subject_id' => '科目',
            'subject2_id' => '科目2',
            'note' => '备注',
        ];
    }

    public function getBanji()
    {
        return $this->hasOne(TeachClass::className(),['id'=>'class_id']);
    }
}
