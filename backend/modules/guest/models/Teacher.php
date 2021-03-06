<?php

namespace backend\modules\guest\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property int $id
 * @property string $name
 * @property string $subject
 * @property string $type
 * @property string $graduate
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
            [['name', 'subject'], 'required'],
            [['name', 'subject','pinx','type', 'graduate', 'username','note'], 'string', 'max' => 100],
            ['secode','string','max'=>5]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'pinx' => '拼写',
            'secode'=>'安全码',
            'subject' => '任教科目',
            'type' => '类型',
            'username'=>'用户名',
            'graduate' => '任教学校',
            'note' => '备注',
        ];
    }
}
