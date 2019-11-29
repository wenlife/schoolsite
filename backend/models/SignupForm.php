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
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '用户名已经存在'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['secode', 'filter', 'filter' => 'trim'],
            ['secode', 'required'],
            ['secode', 'string', 'max' => 4],
            ['email','required']
            ['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '邮件地址已经存在'],
            ['name', 'string', 'max' => 100],
            [['password','password_repeat'], 'required'],
            [['password','password_repeat'], 'string', 'min' => 6],
            ['password_repeat','compare','compareAttribute'=>'password']
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
