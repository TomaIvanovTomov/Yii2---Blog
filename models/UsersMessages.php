<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_messages".
 *
 * @property int $message_id
 * @property string $message_title
 * @property string $message_content
 * @property string $message_author
 * @property string $author_email
 *
 * @property Users $user
 */
class UsersMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_title', 'message_content', 'message_author', 'author_email'], 'required'],
            [['message_content'], 'string'],
            [['message_title'], 'string', 'max' => 100],
            [['message_author'], 'string', 'max' => 50],
            ['author_email', 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message_id' => 'Message ID',
            'message_title' => 'Title:',
            'message_content' => 'Content:',
            'message_author' => 'Author:',
            'author_email' => 'Email:'
        ];
    }
}
