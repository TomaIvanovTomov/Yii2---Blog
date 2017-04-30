<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $repeat_password
 * @property string $username
 */
class RegisterForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'username', 'repeat_password'], 'required'],
            [['email', 'password', 'username'], 'string', 'max' => 50],
            ['password', 'passLength'],
            ['password', 'digitsLetters'],
            ['email', 'email'],
            [['username', 'email'], 'unique'],
            [['username', 'password', 'email'], 'trim'],
            ['repeat_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match!']
        ];
    }

    public function passLength($attribute)
    {
        if(strlen($this->password) < 6)
        {
            $this->addError($attribute,"Password should be at least 6 symbols!");
        }
    }

    public function digitsLetters($attribute)
    {
        if(!preg_match('/[A-Za-z]{1,}/', $this->password))
        {
            $this->addError($attribute, "Password must contain at least 1 letter");
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'repeat_password' => 'Repeat',
            'username' => 'Username',
        ];
    }
}
