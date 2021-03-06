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

    public static function getDepartmentArray()
    {
        return static::find()->select(['title','id'])->indexby('id')->column();
    }

    public function getDepartmentYear($id)
    {
        $model = $this->findOne($id);
        if($model)
            return $model->year;
        else
            return null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'title' => '标题',
            'year' => '届次',
            'manager' => '年级管理',
            'note' => '备注',
        ];
    }
}
