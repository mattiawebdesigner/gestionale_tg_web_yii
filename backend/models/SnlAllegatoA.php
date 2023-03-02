<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * 
 */
class SnlAllegatoA extends Model
{
    public $allegatoA;
    public const UPLOAD_DIR = "media_uploads/";

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['allegatoA'], 'required'],
            [['allegatoA'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, pdf, JPG, JPEG', 'checkExtensionByMimeType' => false, 'maxFiles' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'allegatoA' => Yii::t('app', 'Allegato A'),
        ];
    }
    
    /**
     * Upload files
     * 
     * @return boolean|array
     */
    public function upload(){
        if ($this->validate()) {
            echo "Validate OK<br />";
            $out = [];
            foreach ($this->allegatoA as $file) {
                $filename = md5($file->baseName).md5(date('YmdHmi'));//Rename namefile
                $file->saveAs(SELF::UPLOAD_DIR . $filename . '.' . $file->extension);
                
                $out[] = [
                    'fileName'          => $filename,
                    'type'              => $file->type,
                    'extension'         => $file->extension,
                    'uploadDirectory'   => self::UPLOAD_DIR,
                ];
            }
            
            return $out;
        }
        
        return false;
    }
}
