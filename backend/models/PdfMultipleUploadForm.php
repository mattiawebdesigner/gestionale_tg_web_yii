<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class PdfMultipleUploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $multipleFile;
    public $multipleFile2;
    
    public const UPLOAD_DIR = "iloveteatro/pdf_uploads/";
    
    public function rules()
    {
        return [
            [['multipleFile'], 'file', 'maxFiles' => 30, 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['multipleFile2'], 'file', 'maxFiles' => 30, 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }
    
    public function upload()
    {        
        $result = [];
        
        
        if ($this->validate()) {
            if(!empty($this->multipleFile)){
                foreach ($this->multipleFile as $file){
                    $filename = md5($file->baseName).md5(date('YmdHmi'));//Rename namefile
                    $file->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $file->extension);

                    $result[] = [
                        'fileName'      => Yii::$app->params['site_protocol'].Yii::$app->params['backend'].'web/iloveteatro/pdf_uploads/'.$filename . '.' . $file->extension,
                        'originalName'  => $file->baseName,
                    ];
                }
            }
            if(!empty($this->multipleFile2)){
                foreach ($this->multipleFile2 as $file){
                    $filename = md5($file->baseName).md5(date('YmdHmi'));//Rename namefile
                    $file->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $file->extension);

                    $result[] = [
                        'fileName'      => Yii::$app->params['site_protocol'].Yii::$app->params['backend'].'web/iloveteatro/pdf_uploads/'.$filename . '.' . $file->extension,
                        'originalName'  => $file->baseName,
                    ];
                }
            }
            
            
            return $result;
        }
        
        return false;
    }
}

