<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class FindForm extends Model
{
    public $kh;
    public $sfzh;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kh', 'sfzh'], 'required'],
            [['kh', 'sfzh'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kh' => '中考考号',
            'sfzh' => '身份证号',
        ];
    }
}
