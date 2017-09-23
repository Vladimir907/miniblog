<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $date
 * @property integer $post_id
 * @property integer $author_id
 * @property string $text
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'default', 'value' => Date('Y-m-d')],
            [['post_id'], 'default'],
            [['author_id'], 'default', 'value'=>Yii::$app->user->id],
            [['text'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'post_id' => 'Post ID',
            'author_id' => 'Author ID',
            'text' => 'Text',
        ];
    }

    public function beforeSave($insert)
    {
        $post_id = self::find()->where(['id' => $this->id])->one();

        if (!$this->isNewRecord) {
            $this->post_id = $post_id->post_id;
        }

        return parent::beforeSave($insert);
    }

    public function getByPost($id)
    {
        $sql = 'SELECT comment.*, user.name as author 
                FROM comment 
                LEFT JOIN user ON comment.author_id=user.id
                WHERE post_id = '.$id.'
                ORDER BY date asc';
                
        $data = self::findBySql($sql)->asArray()->all();
        return $data;
    }
}
