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

    public function beforeSave($insert){
        if(parent::beforeSave($insert))
        {
            $ifset = 1;
            while($ifset)
            {
              $code  = $this->getRandomStr(4,false);
              $ifset = UserTeacher::find()->where(['secode'=>$code])->one();
            }

            $this->secode = $code;
        }
        return true;
    }


    public static function getSubjectTeacherArray($subject)
    {
        return static::find()->select(['name','id','pinx'])->where(['subject'=>$subject])->indexby('id')->orderby('pinx')->column();
    }

    public static function getAllTeacherIndexbyName()
    {
        $model =  static::find()->select(['id','name','subject'])->asArray(true)->all();
        return ArrayHelper::index($model,'subject','name');
    }

    //该方法仅供导入数据的时候使用
    /*@data 二维数组 第一层为数字键，第二层为 科目=>姓名   */
    public static function translateNametoId(array $data)
    {
        $teachDuty = CommonFunction::getAllTeachDuty();
        $allTeacher = static::getAllTeacherIndexbyName();
        $translatedData = array();
        foreach ($data as $key1 => $classData) {
            $temp = array();
            foreach ($teachDuty as $duty_en => $duty_cn) {
                $tname = trim(ArrayHelper::getValue($classData,$duty_cn));
                //当前科目设置为空，直接进入下一步
                if(!$tname) continue;
                if($duty_en == 'bzr')
                {
                    if($tarr = ArrayHelper::getValue($allTeacher,$tname))
                    {
                        //如果找到的不是一个人，则跳过设置步骤
                        if(count($tarr)!=1){
                           // $tarr = [];
                            $translatedData['error'][] ='设置'.($key1+1).'班的'.$duty_cn.'时，教师：'.$tname.'在系统中找到的人数超过1个，跳过设置!';
                            continue;
                        }else{
                           $tarr = current($tarr);
                        }
                    }else{
                        //$tarr = [];
                        $translatedData['error'][] = $tname.'在系统中不存在!';
                        continue;
                    }

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
    protected function getRandomStr($len, $special=true){
        // $chars = array(
        //     "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        //     "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        //     "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        //     "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        //     "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        //     "3", "4", "5", "6", "7", "8", "9"
        // );
        $chars = array(
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
            "l", "m", "n", "p", "q", "r", "s", "t", "u", "v",
            //"w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9"
            "w", "x", "y", "z", "2", "3", "4", "5", "6", "7", "8", "9"
        );

        if($special){
            $chars = array_merge($chars, array(
                "!", "@", "#", "$", "?", "|", "{", "/", ":", ";",
                "%", "^", "&", "*", "(", ")", "-", "_", "[", "]",
                "}", "<", ">", "~", "+", "=", ",", "."
            ));
        }

        $charsLen = count($chars) - 1;
        shuffle($chars);                            //打乱数组顺序
        $str = '';
        for($i=0; $i<$len; $i++){
            $str .= $chars[mt_rand(0, $charsLen)];    //随机取出一位
        }
        return $str;
    }
}
