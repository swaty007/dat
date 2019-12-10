<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "model_meta".
 *
 * @property int $id
 * @property string $model
 * @property int $model_id
 * @property string|null $meta_key
 * @property string $meta_title
 * @property string $meta_value
 *
 * @property Locations $location
 */
class ModelMeta extends \yii\db\ActiveRecord
{
    public const LOCATION_KEYS = [
        'top' => 'Top',
        'reasons_head' => 'Reasons head (only one)',
        'reasons' => 'Reasons',
    ];
    public const REVIEW_KEYS = [
        'pros_cons' => 'Pros/Cons h2',
        'pros_cons_title' => 'Pros/Cons h2',
        'steps_head' => 'Steps Header',
        'steps' => 'Steps',
        'steps_footer' => 'Steps Footer',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'model_meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'meta_title', 'meta_value'], 'required'],
            [['model_id'], 'integer'],
            [['meta_value'], 'string'],
            [['model', 'meta_key', 'meta_title'], 'string', 'max' => 255],
            [['model', 'model_id'], 'unique', 'targetAttribute' => ['model', 'model_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'model' => Yii::t('backend', 'Model'),
            'model_id' => Yii::t('backend', 'Model ID'),
            'meta_key' => Yii::t('backend', 'Meta Key'),
            'meta_title' => Yii::t('backend', 'Meta Title'),
            'meta_value' => Yii::t('backend', 'Meta Value'),
        ];
    }

    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'model_id'])
            ->andOnCondition(['"Locations" = "'.$this->model.'"']);
//            ->via('informer_tag');
    }
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'model_id'])
            ->andOnCondition(['"Review" = "'.$this->model.'"']);
    }
//    public function getInformer_tag()
//    {
//        return $this->hasMany(InformerTag::className(), ['informer_id' => 'id'])->andWhere(['test' => 'тест']);
//    }
}
