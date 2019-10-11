<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $title
 * @property string $pinx
 * @property string $note
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'pinx'], 'required'],
            [['title', 'pinx'], 'string', 'max' => 50],
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
            'title' => 'Title',
            'pinx' => 'Pinx',
            'note' => 'Note',
        ];
    }
}
