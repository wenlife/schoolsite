<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "teach_daytime".
 *
 * @property int $id
 * @property int $department
 * @property int $sort
 * @property string $part
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $note
 */
class TeachDaytime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_daytime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department', 'sort', 'part', 'title', 'start', 'end'], 'required'],
            [['department', 'sort'], 'integer'],
            [['part'], 'string', 'max' => 10],
            [['title', 'start', 'end', 'note'], 'string', 'max' => 100],
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
            'sort' => 'Sort',
            'part' => 'Part',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'note' => 'Note',
        ];
    }
}
