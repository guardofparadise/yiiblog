<?php

namespace app\models;
use app\models\ImageUpload;
use yii\helpers\ArrayHelper;

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
            'id' 					=> 'ID',
            'title' 			=> 'Title',
            'description' => 'Description',
            'content' 		=> 'Content',
            'date' 				=> 'Date',
            'image' 			=> 'Image',
            'viewed' 			=> 'Viewed',
            'user_id' 		=> 'User ID',
            'status' 			=> 'Status',
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

		public function getCategory() {
			return $this->hasOne(Category::className(), ['id' => 'category_id']);
		}

		public function saveCategory($category_id) {
			$category = Category::findOne($category_id);
			if($category != null) {
				$this->link('category', $category);
				return true;
			}
		}

		public function getTags() {
			return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
				->viaTable('article_tag', ['article_id' => 'id']);
		}

		public function getSelectedTags() {
			$selectedTags = $this->getTags()->select('id')->asArray()->all();
			return ArrayHelper::getColumn($selectedTags, 'id');
		}

		public function getDate() {
			return Yii::$app->formatter->asDate($this->date);
		}

		public function saveTags($tags) {
			if(is_array($tags)) {

				ArticleTag::deleteAll(['article_id' => $this->id]);

				foreach($tags as $tag_id) {

					$tag = Tag::findOne($tag_id);
					$this->link('tags', $tag);

				}
			}
		}
}
