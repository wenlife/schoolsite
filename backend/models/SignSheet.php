<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sign_sheet".
 *
 * @property int $id id
 * @property string $name 姓名
 * @property string $gender 性别
 * @property string $minzu 民族
 * @property int $old 年龄
 * @property string $idcard 身份证号
 * @property string $birth 出生日期
 * @property string $graduate 毕业学校
 * @property string $cat1 专业类别1
 * @property string $cat2 专业类别2
 * @property string $cat3 专业类别3
 * @property double $height 身高
 * @property double $weight 体重
 * @property string $photo 照片
 * @property string $graduate_id 会考考号
 * @property string $prizedetail 获奖情况
 * @property double $score 最近一次文化成绩总分11科
 * @property string $parentname 父母姓名
 * @property string $parentrelation 关系
 * @property string $parentphone 联系电话
 * @property string $note beizhu
 */
class SignSheet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $captcha;
    public $imageFile;
    public static function tableName()
    {
        return 'sign_sheet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gender', 'old', 'idcard', 'birth', 'graduate', 'cat1', 'height', 'weight', 'photo', 'graduate_id', 'score', 'parentname', 'parentrelation', 'parentphone'], 'required'],
            //['note','required','message'=>'请备注缴费账号昵称，否则将影响参考！'],
            ['idcard', 'unique', 'targetClass' => '\backend\models\SignSheet', 'message' => '该身份证号已经存在，请确认自己是否已经报名，如有疑问请电话咨询学校'],
            [['old', 'verify'], 'integer'],
            [['height', 'weight', 'score'], 'number'],
            [['photo', 'prizedetail'], 'string'],
            [['name', 'minzu', 'cat1', 'cat2', 'graduate_id'], 'string', 'max' => 50],
            [['gender', 'parentrelation'], 'string', 'max' => 10],
            [['idcard', 'parentphone'], 'string', 'max' => 20],
            [['birth'], 'string', 'max' => 30],
            [['graduate', 'cat3', 'parentname', 'note','verifymsg'], 'string', 'max' => 100],
            ['idcard','match','pattern'=>'/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/','message'=>'身份证号格式不正确！'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['imageFile'], 'file', 'skipOnEmpty' => false,'on'=>'create'],
            ['captcha','required','message'=>'验证码不能为空'],  //必须输入验证码      
            ['captcha','captcha','captchaAction'=>'signsheet/captcha','message'=>'验证码不正确']
        ];
    }


    public function upload()
    {
        if ($this->validate(['imageFile'])) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            $name = uniqid().'.'.$this->imageFile->extension;
            $url = 'upload/files/' .$name;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/cover/' . $name . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs('upload/files/' . $name);
             
            //$this->scaleImg($url,'upload', $maxx = 295, $maxy = 413);
            return $url;
        } else {
            exit(var_export($this->getErrors()));
            return false;
        }
    }

    public function getNation(){
       return  $this->hasOne(SysNation::className(),['id'=>'minzu']);
    }


      /**
     *等比例缩放函数（以保存新图片的方式实现）
     * @param string $picName 被缩放的处理图片源
     * @param string $savePath 保存路径
     * @param int $maxx 缩放后图片的最大宽度
     * @param int $maxy 缩放后图片的最大高度
     * @param string $pre 缩放后图片的前缀名
     * @return $string 返回后的图片名称（） 如a.jpg->s.jpg
     *
     **/
    protected function scaleImg($picName,$savePath, $maxx = 295, $maxy = 413)
    {
        $info = getimageSize($picName);//获取图片的基本信息
        $w = $info[0];//获取宽度
        $h = $info[1];//获取高度

        if($w<=$maxx&&$h<=$maxy){
            return $picName;
        }
        //获取图片的类型并为此创建对应图片资源
        switch ($info[2]) {
            case 1://gif
                $im = imagecreatefromgif($picName);
                break;
            case 2://jpg
                $im = imagecreatefromjpeg($picName);
                break;
            case 3://png
                $im = imagecreatefrompng($picName);
                break;
            default:
                die("图像类型错误");
        }
        //计算缩放比例
        if (($maxx / $w) > ($maxy / $h)) {
            $b = $maxy / $h;
        } else {
            $b = $maxx / $w;
        }
        //计算出缩放后的尺寸
        $nw = floor($w * $b);
        $nh = floor($h * $b);
        //$nw = $maxx;
        //$nh = $maxy;
        //创建一个新的图像源（目标图像）
        $nim = imagecreatetruecolor($nw, $nh);

        //透明背景变黑处理
        //2.上色
        $color=imagecolorallocate($nim,255,255,255);
        //3.设置透明
        imagecolortransparent($nim,$color);
        imagefill($nim,0,0,$color);

        //执行等比缩放
        imagecopyresampled($nim, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        //输出图像（根据源图像的类型，输出为对应的类型）
        $picInfo = pathinfo($picName);//解析源图像的名字和路径信息
        $savePath =  $picName;//$savePath. "/pic" . $picInfo["basename"];
        switch ($info[2]) {
            case 1:
                imagegif($nim, $savePath);
                break;
            case 2:
                imagejpeg($nim, $savePath);
                break;
            case 3:
                imagepng($nim, $savePath);
                break;

        }
        //释放图片资源
        imagedestroy($im);
        imagedestroy($nim);
        //返回结果
        return $savePath;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           'id' => '编号',
           'name' => '姓名',
           'gender' => '性别',
           'old' => '年龄',
           'minzu' => '民族',
           'idcard' => '身份证号',
           'birth' => '出生日期',
           'graduate' => '毕业学校',
           'cat1' => '专业Ⅰ类',
           'cat2' => '专业Ⅱ类',
           'cat3' => '具体乐器类型',
           'height' => '身高(cm)',
           'weight' => '体重(kg)',
           'photo' => '照片',
           'graduate_id' => '中考报名号',
           'prizedetail' => '获奖情况',
           'score' => '最近一次文化模拟考试成绩（11科）',
           'parentname' => '监护人姓名',
           'parentrelation' => '监护人关系',
           'parentphone' => '监护人联系方式',
           'note' => '备注',
           'verify' => '审核',
           'verifymsg' => '审核信息',
        ];
    }



   


}
