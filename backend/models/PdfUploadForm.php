<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PdfUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    
    public const UPLOAD_DIR = "iloveteatro/pdf_uploads/";
    
    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }
    
    public function upload()
    {
        
        if ($this->validate()) {   
            $filename = uniqid(rand(), true);//Rename namefile
            $this->file->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $this->file->extension);
            
            return [
                'fileName'          => Yii::$app->params['site_protocol'].Yii::$app->params['backend'].'web/iloveteatro/pdf_uploads/'.$filename.".".$this->file->extension,
                'type'              => $this->file->type,
                'extension'         => $this->file->extension,
                'uploadDirectory'   => self::UPLOAD_DIR,
            ];
        } else {
            return false;
        }
    }
}

