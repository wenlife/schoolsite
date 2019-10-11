<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "semester".
 *
 * @property int $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $note
 */
class Semester extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semester';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'start', 'end'], 'required'],
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
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'note' => 'Note',
        ];
    }
}
