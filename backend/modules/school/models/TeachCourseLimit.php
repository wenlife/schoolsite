<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "teach_course_limit".
 *
 * @property int $id
 * @property int $department_id
 * @property string $course_id
 * @property int $course_limit
 * @property string $note
 */
class TeachCourseLimit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_course_limit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'course_limit'], 'integer'],
            [['course_id'], 'required'],
            [['course_id'], 'string', 'max' => 6],
            [['note'], 'string', 'max' => 100],
        ];
    }


    public function getDepartment()
    {
        return $this->hasOne(TeachDepartment::className(),['id'=>'department_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'department_id' => '年级部',
            'course_id' => '科目',
            'course_limit' => '课程数量',
            'note' => '备注',
        ];
    }
}
