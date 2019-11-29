<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "teach_cal".
 *
 * @property int $id
 * @property string $title
 * @property string $grade
 * @property string $start
 * @property string $end
 * @property string $color
 */
class TeachCal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_cal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'grade', 'start', 'end'], 'required'],
            [['title', 'start', 'end', 'color'], 'string', 'max' => 100],
            [['grade'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '编号',
            'title' => '标题',
            'grade' => '年级',
            'start' => '开始日期',
            'end' => '结束日期',
            'color' => '颜色',
        ];
    }
}
