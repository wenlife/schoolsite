<?php

namespace backend\modules\school\models;

use Yii;

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
