<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $post_id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property string $date_create
 *
 * @property BlogUser $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content', 'date_create'], 'required'],
            [['user_id'], 'integer'],
            [['date_create'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 5000],
            [['user_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => BlogUser::className(),
                'targetAttribute' => ['user_id' => 'id'],
                'message' => 'Author doesn`t exist',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'title' => 'Title:',
            'content' => 'Content',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BlogUser::className(), ['id' => 'user_id']);
    }
}
