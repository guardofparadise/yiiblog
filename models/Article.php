<?php

namespace app\models;
use app\models\ImageUpload;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $date
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $status
 * @property int $category_id
 *
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
						[['title'], 'required'],
            [['title', 'description', 'content'], 'string'],
						[['date'], 'date', 'format' => 'php:Y-m-d'],
						[['date'], 'default', 'value' => date('Y-m-d')],
            [['viewed', 'user_id', 'status', 'category_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    public function saveImage($filename) {
			$this->image = $filename;
			return $this->save(false);
		}

		public function getImage() {
			return ($this->image) ? '/uploads/' . $this->image : '/no-image.png';
		}

		public function deleteImage() {
			$imageUploadModel = new ImageUpload();
			$imageUploadModel->deleteCurrentImage($this->image);
		}

		public function beforeDelete() {
			$this->deleteImage();
			return parent::beforeDelete();
		}
}
