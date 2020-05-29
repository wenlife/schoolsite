<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_nation".
 *
 * @property string $id
 * @property string $nation
 */
class SysNation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_nation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string', 'max' => 32],
            [['nation'], 'string', 'max' => 64],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getList()
    {
        return static::find()->select(['nation','id'])->orderby('id')->indexby('id')->column();
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nation' => 'Nation',
        ];
    }
}
