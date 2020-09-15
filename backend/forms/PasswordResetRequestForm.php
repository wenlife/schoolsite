<?php
namespace backend\forms;

use common\models\Adminuser;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $name;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Adminuser',
                'filter' => ['status' => Adminuser::STATUS_ACTIVE],
                'message' => '您输入的邮箱地址在系统中不存在.'
            ],
            ['name', 'exist',
                'targetClass' => '\common\models\Adminuser',
                'filter' => ['status' => Adminuser::STATUS_ACTIVE],
                'message' => '您输入的姓名在系统中不存在.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = Adminuser::findOne([
            'status' => Adminuser::STATUS_ACTIVE,
            'email' => $this->email,
            'name'=>$this->name,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!Adminuser::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
        }
        
        if (!$user->save()) {
            return false;
        }


        $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);  
        $mail= Yii::$app->mailer->compose();   
        $mail->setTo( $this->email);  
        $mail->setSubject("密码重置");  
            //$mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("请点击如下链接根据如下内容设置你的密码：  ".$resetLink);    //发布可以带html标签的文本
        if($mail->send())  
            //echo "success"; 
            return true; 
        else 
            return false; 
            //echo "fail";   

        // return Yii::$app
        //     ->mailer
        //     ->compose(
        //         ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
        //        // ['user' => $user]
        //        ['user'=>$this->email]
        //     )
        //     ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
        //     ->setTo($this->email)
        //     ->setSubject('校内网密码重置-' . \Yii::$app->name)
        //     ->send();
    }


     public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'email' => '邮箱地址',
        ];
    }
}
