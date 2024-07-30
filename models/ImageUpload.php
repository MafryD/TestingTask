<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class ImageUpload extends Model{
    public $img;
    public function rules()
    {
        return [
            [['img'], 'file', 'extensions' => 'png, jpg','maxSize' => 1024 * 1024 * 2],
        ];
    }
    public function uploadFile($file){
        if($this->validate()){
            $file->saveAs(Yii::getAlias('@webroot').'/uploads/'.$file->name);
            return $file->name;
        }
        
    }
}