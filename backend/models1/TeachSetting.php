<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teach_setting".
 *
 * @property int $id
 * @property int $class_id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $semester
 * @property string $note
 */
class TeachSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['class_id', 'teacher_id', 'subject_id', 'semester'], 'required'],
            [['class_id', 'teacher_id', 'subject_id', 'semester'], 'integer'],
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
            'class_id' => 'Class ID',
            'teacher_id' => 'Teacher ID',
            'subject_id' => 'Subject ID',
            'semester' => 'Semester',
            'note' => 'Note',
        ];
    }
}
