<?php

namespace common\models;

use common\components\MetaTagBehavior;
use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $url
 * @property string $refer_link
 * @property string $h1
 * @property string $desc
 * @property string $html_content_top
// * @property string $html_content_middle
 * @property string $html_content_bottom
 *
 * @property ModelMeta[] $model_meta
 */
class Locations extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            'MetaTag' => [
                'class' => MetaTagBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locations';
    }
    protected $model_meta = [];
    protected $meta_header = [];
    protected $reasons_head = [];
    protected $reasons = [];
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['url', 'refer_link', 'h1', 'desc', 'html_content_top', 'html_content_middle', 'html_content_bottom'], 'required'],
            [['html_content_top', 'html_content_middle', 'html_content_bottom'], 'string'],
            [['url', 'h1'], 'string', 'max' => 55],
            [['refer_link'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 500],
            [['model_meta','reasons_head','meta_header','reasons'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'parent_id' => Yii::t('backend', 'Parent ID'),
            'url' => Yii::t('backend', 'Url'),
            'refer_link' => Yii::t('backend', 'Refer Link'),
            'h1' => Yii::t('backend', 'H1'),
            'desc' => Yii::t('backend', 'Desc'),
            'html_content_top' => Yii::t('backend', 'Html Content Top'),
//            'html_content_middle' => Yii::t('backend', 'Html Content Middle'),
            'html_content_bottom' => Yii::t('backend', 'Html Content Bottom'),
            'meta_header' => Yii::t('backend', 'Top header'),
        ];
    }

//    public function setModel_meta(array $metasData): void
//    {
//        $this->model_meta = $metasData;
//    }
    /**
     * @return \yii\db\ActiveQuery     */
    public function getModel_meta()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Locations"');
    }

    public function getMeta_header()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Locations"')
            ->andOnCondition('meta_key = "top"');
    }
    public function getReasons_head()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Locations"')
            ->andOnCondition('meta_key = "reasons_head"');
    }
    public function getReasons()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Locations"')
            ->andOnCondition('meta_key = "reasons"');
    }
    public function afterSave($insert, $changedAttributes)
    {
        foreach (ModelMeta::find()->where(['model_id' => $this->id])->andOnCondition('model = "Locations"')->all() as $meta) {
            $meta->delete();
        }

//        echo $this->meta_header;
        $this->model_meta = array_merge($this->meta_header, $this->reasons_head, $this->reasons);
        if (is_array($this->model_meta) && !empty($this->model_meta)) {
            $data = [];
            foreach ($this->model_meta as $meta) {
                $data[] = ['Locations', $this->id, $meta['meta_key'], $meta['meta_title'], $meta['meta_value']];
            }
            self::getDb()->createCommand()
                ->batchInsert(ModelMeta::tableName(), ['model','model_id', 'meta_key', 'meta_title', 'meta_value'], $data)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }
    public function afterDelete()
    {
        foreach (ModelMeta::find()->where(['model_id' => $this->id])->andOnCondition('model = "Locations"')->all() as $meta) {
            $meta->delete();
        }

        parent::afterDelete();
    }
}
