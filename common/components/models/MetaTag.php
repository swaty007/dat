<?php
namespace common\components\models;
use common\components\MetaTags;
use Yii;
use yii\behaviors\TimestampBehavior;


class MetaTag extends \yii\db\ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%meta_tags}}';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['model', 'model_id'], 'required'],
            [['model_id', 'time_update'], 'integer'],
            ['description', 'string'],
            [['model', 'title', 'keywords'], 'string', 'max' => 255],
            [['model', 'model_id', 'title', 'keywords', 'description'], 'safe'],
        ];
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'title' => MetaTags::t('messages', 'model_title'),
            'keywords' => MetaTags::t('messages', 'model_keywords'),
            'description' => MetaTags::t('messages', 'model_description'),
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'time_update',
            ],
        ];
    }
}