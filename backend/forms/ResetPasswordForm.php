<?php
namespace backend\forms;

use common\models\Adminuser;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('请通过系统重置密码连接进入.');
        }
        $this->_user = Adminuser::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('重置密码链接已经失效，请重新操作.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','password_repeat'], 'required','message' => '请确认您输入的密码！'],
            [['password','password_repeat'], 'string', 'min' => 6,'tooShort' => '密码长度至少为六位！'],
            ['password_repeat','compare','compareAttribute'=>'password','message'=>'两次输入的密码不相同！']
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    public function attributeLabels()
    {
        return [
            'password' => '输入新密码',
            'password_repeat' => '确认新密码',
        ];
    }
}
