<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "teach_department".
 *
 * @property int $id
 * @property string $title
 * @property string $year
 * @property string $manager
 * @property string $note
 */
class TeachDepartment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'year'], 'required'],
            [['title', 'year', 'note'], 'string', 'max' => 100],
            [['manager'], 'string', 'max' => 50],
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
            'year' => 'Year',
            'manager' => 'Manager',
            'note' => 'Note',
        ];
    }
}
