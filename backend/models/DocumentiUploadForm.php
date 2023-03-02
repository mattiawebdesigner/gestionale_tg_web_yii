<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class DocumentiUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $mediaFile;
    
    public const UPLOAD_DIR = "documents_uploads/";
    
    public function rules()
    {
        return [
            [['mediaFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, jif, webp, pdf'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $filename = md5($this->mediaFile->baseName).md5(date('YmdHmi'));//Rename namefile
            $this->mediaFile->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $this->mediaFile->extension);
            
            return [
                'fileName'          => $filename,
                'type'              => $this->mediaFile->type,
                'extension'         => $this->mediaFile->extension,
                'uploadDirectory'   => self::UPLOAD_DIR,
            ];
        } else {
            return false;
        }
    }
}

