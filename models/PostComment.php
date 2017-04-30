<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_comments".
 *
 * @property int $comment_id
 * @property string $comment_content
 * @property string $date_create
 * @property int $author_id
 * @property int $post_id
 * @property Post $post
 * @property BlogUser $author
 */
class PostComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_content', 'date_create', 'author_id', 'post_id'], 'required'],
            [['author_id', 'post_id'], 'integer'],
            [['comment_content'], 'string', 'max' => 1000],
            [['date_create'], 'string', 'max' => 20],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'post_id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogUser::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'comment_content' => 'Content',
            'date_create' => 'Date Create',
            'author_id' => 'Author ID',
            'post_id' => 'Post ID'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['post_id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(BlogUser::className(), ['id' => 'author_id']);
    }
}
