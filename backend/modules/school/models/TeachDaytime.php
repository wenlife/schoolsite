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

    public static function getDepartmentDaytime($department)
    {
        return static::find()->where(['department'=>$department])->orderby('sort')->indexby('sort')->all();
    }

    /**
     * {@inheritdoc}
     */   
    public function getDepartmentname()
    {
       return  $this->hasOne(TeachDepartment::className(),['id'=>'department']);
    }
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'department' => '年级部',
            'sort' => '序号',
            'part' => '时段',
            'title' => '标题',
            'start' => '开始时间',
            'end' => '结束时间',
            'note' => '备注',
        ];
    }
}
