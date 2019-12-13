<?php

namespace backend\modules\guest\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\libary\CommonFunction;
/**
 * This is the model class for table "user_teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $subject
 * @property integer $gender
 * @property string $note
 */
class UserTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'subject'], 'required'],
            [['gender'], 'integer'],
            [['name','username','pinx','type'], 'string', 'max' => 100],
            ['secode','string','max'=>50],
            ['secode','unique','message'=>'安全码已经存在，请重设！'],
            [['subject'], 'string', 'max' => 20],
            [['note'], 'string', 'max' => 200]
        ];
    }


    public function getSubjectTeacherArray($subject)
    {
        return $this->find()->select(['name','id'])->where(['subject'=>$subject])->indexby('id')->orderby('pinx ASC')->column();
    }

    public function getAllTeacherIndexbyName()
    {
        $model =  $this->find()->select(['id','name','subject'])->asArray(true)->all();
        return ArrayHelper::index($model,'subject','name');
    }

    //该方法仅供导入数据的时候使用
    /*@data 二维数组 第一层为数字键，第二层为 科目=>姓名   */
    public function translateNametoId(array $data)
    {
        $teachDuty = CommonFunction::getAllTeachDuty();
        $allTeacher = $this->getAllTeacherIndexbyName();
        $translatedData = array();
        foreach ($data as $key1 => $classData) {
            $temp = array();
            foreach ($teachDuty as $duty_en => $duty_cn) {
                $tname = trim(ArrayHelper::getValue($classData,$duty_cn));
                if($duty_en == 'bzr')
                {
                    $tarr = ArrayHelper::getValue($allTeacher,$tname);
                    //如果找到的不是一个人，则跳过设置步骤
                    if(count($tarr)!=1)
                        $tarr = [];
                    else
                       $tarr = current($tarr);
                }
                else{
                    $tarr = ArrayHelper::getValue($allTeacher,$tname.'.'.$duty_en);
                }
                $temp[$duty_en] = ArrayHelper::getValue($tarr,'id');
                //array_push($temp,[$duty_en=>ArrayHelper::getValue($tarr,'id')]);
                //var_export($tarr);
                //exit();
            }
            $translatedData[$key1+1] = $temp;
            //array_push($translatedData,$temp);
            //var_export($translatedData);
         }
         return $translatedData;
         //var_export($translatedData);

    }

    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'pinx' => '拼写',
            'subject' => '任教科目',
            'secode'=>'安全码',
            'type' => '类型',
            'graduate' => '任教学校',
            'note' => '备注',
        ];
    }
}
