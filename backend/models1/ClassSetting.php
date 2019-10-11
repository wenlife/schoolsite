<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "class_setting".
 *
 * @property int $id
 * @property string $department
 * @property string $name
 * @property int $year
 * @property int $sort
 * @property int $type
 * @property string $note
 */
class ClassSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'class_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department', 'name', 'year', 'sort'], 'required'],
            [['year', 'sort', 'type'], 'integer'],
            [['department', 'name', 'note'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department' => 'Department',
            'name' => 'Name',
            'year' => 'Year',
            'sort' => 'Sort',
            'type' => 'Type',
            'note' => 'Note',
        ];
    }
}
