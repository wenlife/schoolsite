<?php

namespace frontend\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;


    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'mp4,jpg,jpeg,png'],
		 	[['imageFile'], 'required'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            //2017.1.1 保存文件不再使用中文文件名
            //$name = '中文名字';

            //$url = 'upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/' . $name . '.' . $this->imageFile->extension);
            //$this->imageFile->saveAs($url);
            $url = 'upload/' .uniqid(). '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($url);
            return $url;
        } else {
            exit(var_export($this->getFirstErrors()));
        }
    }
}




?>