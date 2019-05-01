<?php
/**
 * Created by PhpStorm.
 * User: alona
 * Date: 30.04.2019
 * Time: 21:21
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadImageForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 6],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('images/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}