<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_notice".
 *
 * @property int $id
 * @property string $pos
 * @property int $level
 * @property string $content
 */
class SysNotice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_notice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pos', 'level', 'content'], 'required'],
            [['content'], 'string'],
            [['pos', 'level'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'pos' => '位置',
            'level' => '级别',
            'content' => '内容',
        ];
    }
}
