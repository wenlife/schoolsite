<?php

namespace backend\modules\school\models;
use Yii;
use yii\helpers\ArrayHelper;
use backend\modules\guest\models\UserTeacher;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachDepartment;
use backend\libary\CommonFunction;

/**
 * This is the model class for table "teach_manage".
 *
 * @property int $id
 * @property int $year_id
 * @property int $class_id
 * @property int $teacher_id
 * @property string $subject
 * @property string $note
 */
class TeachManage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_manage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_id', 'class_id', 'teacher_id', 'subject'], 'required'],
            [['year_id', 'class_id', 'teacher_id'], 'integer'],
            [['subject'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 500],
        ];
    }

    //获取对应教师表的信息
    public function getTeacher()
    {
        return $this->hasOne(UserTeacher::className(),['id'=>'teacher_id']);
    }

    //获取教师表的全部教师,不应该出现在这里
    // public function getTeachers()
    // {
    //     $teachers = UserTeacher::find()->orderBy('pinx')->all();
    //     $re = array();
    //     foreach ($teachers as $key => $teacher) {
    //        $re[$teacher->id] = substr($teacher->pinx,0,1).'-'.$teacher->name;
    //     }

    //     return $re;//ArrayHelper::map($teachers,'id','name');
    // }

    // public function getTeachersGroupBySubject()
    // {
    //     //$subjects = ['yw'=>'语文'];
    //     foreach (CommonFunction::getSubjects() as $key => $subject) {
    //         $teachers = UserTeacher::find()->where(['subject'=>$key])->orderBy('pinx')->all();
    //         $te = array();
    //         foreach ($teachers as $key2 => $teacher) {
    //            $te[$teacher->id] = substr($teacher->pinx,0,1).'-'.$teacher->name;
    //         }

    //         $re[$key] = $te;//ArrayHelper::map($teachers,'id','name');
    //     }
        
    //     return $re;
    // } 
    public static function deleteDepartmentTeach($term,$department)
    {
        $grade = (new TeachDepartment())->getDepartmentYear($department);
        $classArr = (new \yii\db\Query())->select(['id'])->from('teach_class')
                                         ->where(['grade'=>$grade])->indexby('id');
        return TeachManage::deleteAll(['year_id'=>$term,'class_id'=>$classArr]);
    }
    //获取对应学年信息
    public function getYear()
    {
        return $this->hasOne(TeachYearManage::className(),['id'=>'year_id']);
    }
    //获取全部学年
    // public function getYears()
    // {
    //     $years = TeachYearManage::find()->orderBy('start_date')->all();
    //     return ArrayHelper::map($years,'id','title');
    // }

    public function getTeachclass()
    {
        return $this->hasOne(TeachClass::className(),['id'=>'class_id']);
    }

    // public function getTeachclasses()
    // {
    //     $classes = TeachClass::find()->all();
    //     return ArrayHelper::map($classes,'id','title');
    // }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => '学年',
            'class_id' => '班级',
            'teacher_id' => '教师',
            'subject' => '任教科目',
            'note' => '备注',
        ];
    }
}
