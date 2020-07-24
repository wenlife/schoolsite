<?php

namespace backend\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ExcelUpload extends Model
{
    /**
     * @var TM_file
     */
    public $imageFile;
   
	

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xls,xlsx'],

        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            //$name = $this->imageFile->baseName;
            //文件系统支持gb2312，系统使用utf-8，因此保存文件名用GB2312,存储用UTF-8；
            $name = uniqid().'.'.$this->imageFile->extension;
            $url = 'upload/excel/' .$name;
            //$name = iconv("utf-8","gb2312",$this->imageFile->baseName);
            //$this->imageFile->saveAs('upload/cover/' . $name . '.' . $this->imageFile->extension);
            $this->imageFile->saveAs('upload/excel/' . $name);
            return $url;
        } else {
            exit('uploadonly form validate error!');
            return false;
        }
    }
}




?>