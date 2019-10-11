<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "day_time_schedule".
 *
 * @property int $id
 * @property int $sort
 * @property string $part
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $grade
 * @property string $note
 */
class DayTimeSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day_time_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort', 'part', 'title', 'start', 'end', 'grade'], 'required'],
            [['sort'], 'integer'],
            [['part'], 'string', 'max' => 10],
            [['title', 'start', 'end', 'grade', 'note'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sort' => 'Sort',
            'part' => 'Part',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'grade' => 'Grade',
            'note' => 'Note',
        ];
    }
}
