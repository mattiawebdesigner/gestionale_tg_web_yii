<?php   

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lns_articoli".
 *
 * @property int $id
 * @property string $titolo
 * @property string $contenuto
 * @property string|null $data_pubblicazione
 * @property string|null $inizio_pubblicazione
 * @property string|null $fine_pubblicazione
 * @property string|null $immagine_in_evidenza
 * @property string|null $meta_description
 * @property string|null $meta_keyword
    * @property int $in_evidenza 10: Si 1: No 
 * @property int|null $edizione
 * @property int $categoria
 * @property int $utente
 * @property int|null $edizione 
 *
 * @property Categorie $categoria0
 * @property Utenti $utente0
 * @property Edizione $edizione0 
 */
class SnlArticoli extends \yii\db\ActiveRecord
{
    const IN_EVIDENCE = 10;
    const NOT_IN_EVIDENCE = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lns_articoli';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titolo', 'contenuto', 'categoria', 'utente'], 'required'],
            [['contenuto', 'in_evidenza'], 'string'],
            [['data_pubblicazione', 'inizio_pubblicazione', 'fine_pubblicazione'], 'safe'],
            [['in_evidenza', 'categoria', 'utente', 'edizione'], 'integer'],
            [['titolo'], 'string', 'max' => 255],
            [['immagine_in_evidenza'], 'string', 'max' => 300],
            [['meta_description', 'meta_keyword'], 'string', 'max' => 100],
            [['categoria'], 'exist', 'skipOnError' => true, 'targetClass' => SnlCategorie::className(), 'targetAttribute' => ['categoria' => 'id']],
            [['utente'], 'exist', 'skipOnError' => true, 'targetClass' => Utenti::className(), 'targetAttribute' => ['utente' => 'id']],
             [['edizione'], 'exist', 'skipOnError' => true, 'targetClass' => SnlEdizione::className(), 'targetAttribute' => ['edizione' => 'id']], 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titolo' => Yii::t('app', 'Titolo'),
            'contenuto' => Yii::t('app', 'Contenuto'),
            'data_pubblicazione' => Yii::t('app', 'Data Pubblicazione'),
            'inizio_pubblicazione' => Yii::t('app', 'Inizio Pubblicazione'),
            'fine_pubblicazione' => Yii::t('app', 'Fine Pubblicazione'),
            'immagine_in_evidenza' => Yii::t('app', 'Immagine In Evidenza'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keyword' => Yii::t('app', 'Meta Keyword'),
            'categoria' => Yii::t('app', 'Categoria'),
            'utente' => Yii::t('app', 'Utente'),
            'in_evidenza' => Yii::t('app', 'In Evidenza'),
            'edizione' => Yii::t('app', 'Edizione evento di riferimento'),
        ];
    }

    /**
     * Gets query for [[ArticoliCommentis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticoliCommentis()
    {
        return $this->hasMany(SnlArticoliCommenti::className(), ['articolo' => 'id']);
    }

    /**
     * Gets query for [[Categoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(Categorie::className(), ['id' => 'categoria']);
    }

    /**
     * Gets query for [[Utente0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtente0()
    {
        return $this->hasOne(Utenti::className(), ['id' => 'utente']);
    }

    /**
    * Gets query for [[Edizione0]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getEdizione0() 
    { 
        return $this->hasOne(SnlEdizione::className(), ['id' => 'edizione']); 
    } 
}
