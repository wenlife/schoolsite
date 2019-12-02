<?php
namespace backend\models;

use common\models\Adminuser;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $name;
    public $email;
    public $secode;
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message'=>'用户名不能为空!'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已经存在'],
            ['username', 'string', 'min' => 2, 'max' => 255,'tooShort' => '用户名必须在2-255长度之间！'],
            ['secode', 'filter', 'filter' => 'trim'],
            ['secode', 'required','message'=>'安全码不能为空！'],
            ['secode', 'string', 'max' => 4,'tooLong' => '安全码长度最高为4位！'],
            ['email','email', 'message' => '邮件格式不正确'],
            ['email','required', 'message' => '邮件地址不能为空'],
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮件地址已经存在'],
            ['name', 'string', 'max' => 100],
            [['password','password_repeat'], 'required','message' => '请确认您输入的密码！'],
            [['password','password_repeat'], 'string', 'min' => 6,'tooShort' => '密码长度至少为六位！'],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不相同！']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Adminuser();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->name = $this->name;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }else{
            return null;
        }

    }
}
