<?php

namespace app\models;

use function PHPSTORM_META\elementType;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $auth_key
 * @property string $image
 */
class UpdateForm extends \yii\db\ActiveRecord
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
            [['email', 'password', 'username'], 'required'],
            [['email', 'password', 'username'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
            [['username', 'password', 'email'], 'trim'],
            ['email', 'email'],
            [[ 'email', 'username'], 'unique',
                                     'targetAttribute' => ['email', 'username'],
                                     'message' => 'The combination of username and password is already taken'],
        ];
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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'image' => 'Image',
        ];
    }
}
