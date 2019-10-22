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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'course_id' => 'Course ID',
            'course_limit' => 'Course Limit',
            'note' => 'Note',
        ];
    }
}
