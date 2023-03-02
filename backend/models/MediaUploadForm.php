<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class MediaUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $mediaFile;
    
    public const UPLOAD_DIR = "media_uploads/";
    
    public function rules()
    {
        return [
            [['mediaFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, jif, webp'],
        ];
    }
    
    public function upload()
    {
        echo "<pre>";
        echo "--<br />";
        print_r($this);
        echo "</pre>";
        if ($this->validate()) {
            echo "OK";
            $filename = uniqid(md5($this->mediaFile->baseName).md5(date('YmdHmi')));//Rename namefile
            $this->mediaFile->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $this->mediaFile->extension);
            
            return [
                'fileName'          => $filename,
                'type'              => $this->mediaFile->type,
                'extension'         => $this->mediaFile->extension,
                'uploadDirectory'   => self::UPLOAD_DIR,
            ];
        } else {
            echo "no";
            return false;
        }
    }
}

