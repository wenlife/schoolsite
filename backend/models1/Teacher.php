<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string $name
 * @property string $pinx
 * @property string $gender
 * @property string $subject
 * @property string $department
 * @property string $note
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['pinx', 'department'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 10],
            [['subject'], 'string', 'max' => 20],
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
            'name' => 'Name',
            'pinx' => 'Pinx',
            'gender' => 'Gender',
            'subject' => 'Subject',
            'department' => 'Department',
            'note' => 'Note',
        ];
    }
}
