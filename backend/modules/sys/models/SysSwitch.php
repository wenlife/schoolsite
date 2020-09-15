<?php

namespace backend\modules\sys\models;

use Yii;

/**
 * This is the model class for table "sys_switch".
 *
 * @property int $id
 * @property string $name
 * @property int $state
 * @property string|null $start
 * @property string|null $end
 * @property string|null $note
 */
class SysSwitch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_switch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state'], 'required'],
            [['state'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['start', 'end', 'note'], 'string', 'max' => 100],
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
            'state' => 'State',
            'start' => 'Start',
            'end' => 'End',
            'note' => 'Note',
        ];
    }
}
