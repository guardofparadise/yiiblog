<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ImageUpload extends Model {

	public $image;

	public function rules() {
		return [
			[['image'], 'required'],
			[['image'], 'file', 'extensions' => 'jpg,png']
		];
	}

	public function uploadFile($file, $currentImage) {

		$this->image = $file;

		if($this->validate()) {

			$this->deleteCurrentImage($currentImage);
	
			$filename = $this->generateFilename();
	
			$file->saveAs($this->getFolder() . $filename);
	
			return $filename;

		}

	}

	private function getFolder() {
		return Yii::getAlias('@web') . 'uploads/';
	}

	private function generateFilename() {
		return strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);
	}

	public function deleteCurrentImage($currentImage) {
		if(file_exists($this->getFolder() . $currentImage)) {

			unlink($this->getFolder() . $currentImage);

		}
	}

}