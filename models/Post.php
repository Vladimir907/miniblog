<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $date
 * @property string $title
 * @property string $text
 * @property string $img
 * @property integer $author_id
 * @property integer $iscommen
 */
class Post extends \yii\db\ActiveRecord
{
    public $path;
    public $filename;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['title'], 'string', 'max' => 255],
            [['text'], 'string'],
            [['author_id'], 'default', 'value' => Yii::$app->user->id],
            [['iscomment'], 'integer'],
            [['img'], 'file'],
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
            'title' => 'Title',
            'text' => 'Text',
            'img' => 'Img',
            'author_id' => 'Author ID',
            'iscomment' => 'Iscomment',
        ];
    }

    public function beforeSave($insert)
    {
        $old_image = self::find()->where(['id' => $this->id])->one();

        $image = UploadedFile::getInstance($this, 'img');
        if ($image) {
            $this->img = $image;
            $this->filename = strtolower(md5(uniqid($this->img->name)).'.'.$this->img->extension);
            $this->path = 'images/post/'.$this->filename;
            $this->img->SaveAs($this->path);
            $this->img = '/'.$this->path;
        } else {
            $this->img = $old_image->img;
        }

        return parent::beforeSave($insert);
    }

    /*public function resizeImg ($filename)
    {
        list($width, $height) = getimagesize($filename);
        $img_height = (self::img_width / $width) * $height;
        $image_p = imagecreatetruecolor(self::img_width, $img_height);
        $image = imagecreatefromjpeg($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, self::img_width, $img_height, $width, $height);
        return imagejpeg($image_p, null, 100);
    }*/

    public function getAll()
    {
        $sql = 'SELECT post.*, user.name as author 
                FROM post 
                LEFT JOIN user ON post.author_id=user.id 
                ORDER BY date desc';
                
        $data = self::findBySql($sql)->asArray()->all();
        return $data;
    }


    public function getByUser($user_id)
    {
        $data = self::find()->orderBy(['date' => SORT_DESC])->where(['author_id' => $user_id])->asArray()->all();
        return $data;
    }
}
