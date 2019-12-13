<?php
namespace backend\modules\school\forms;

use yii\base\Model;

/**
 * Signup form
 */
class ClassGenerate extends Model
{
    public $department;
    public $start;
    public $end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department','start','end'], 'required'],
            [['department','start','end'],'integer'],
            ['end','compare','compareAttribute'=>'start','operator' =>'>','message'=>'结束序号必须必开始序号大！'],
            //['start','compare','compareAttribute'=>'end','operator' =>'<','message'=>'开始序号必须必结束序号小！']

        ];
    }

    public function attributeLabels()
    {
        return [
            'department'=>'年级部',
            'start'=>'班级起始序列号',
            'end'=>'班级结束序列号',
        ];
    }

}
