<?php

namespace common\models;

use common\components\MetaTagBehavior;
use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property string $url
 * @property string $refer_link
 * @property string $title
 * @property string $h1
 * @property string $h1_desc_html
 * @property string $desc
 * @property string $html_content
 *
 * @property ModelMeta[] $model_meta
 */
class Review extends \yii\db\ActiveRecord
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
        return 'review';
    }
    protected $model_meta = [];
    protected $pros_cons_title = [];
    protected $pros = [];
    protected $cons = [];
    protected $steps_head = [];
    protected $steps = [];
    protected $steps_footer = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'refer_link', 'title', 'h1', 'h1_desc_html', 'desc', 'html_content'], 'required'],
            [['h1_desc_html', 'html_content'], 'string'],
            [['url', 'refer_link', 'title', 'h1'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 500],
            [['model_meta','pros_cons_title','pros','cons','steps_head','steps','steps_footer'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'url' => Yii::t('backend', 'Url'),
            'refer_link' => Yii::t('backend', 'Refer Link'),
            'title' => Yii::t('backend', 'Title'),
            'h1' => Yii::t('backend', 'H1'),
            'h1_desc_html' => Yii::t('backend', 'H1 Desc Html'),
            'desc' => Yii::t('backend', 'Desc'),
            'html_content' => Yii::t('backend', 'Html Content'),
        ];
    }
    public function getModel_meta()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"');
    }

    public function getPros_cons_title()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "pros_cons_title"');
    }
    public function getPros()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "pros"');
    }
    public function getCons()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "cons"');
    }
    public function getSteps_head()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "steps_head"');
    }
    public function getSteps()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "steps"');
    }
    public function getSteps_footer()
    {
        return $this->hasMany(ModelMeta::className(), ['model_id' => 'id'])
            ->andOnCondition('model = "Review"')
            ->andOnCondition('meta_key = "steps_footer"');
    }


    public function afterSave($insert, $changedAttributes)
    {
        foreach (ModelMeta::find()->where(['model_id' => $this->id])->andOnCondition('model = "Review"')->all() as $meta) {
            $meta->delete();
        }

//        echo $this->meta_header;
        $this->model_meta = array_merge($this->pros_cons_title, $this->pros, $this->cons, $this->steps_head, $this->steps, $this->steps_footer);
        if (is_array($this->model_meta) && !empty($this->model_meta)) {
            $data = [];
            foreach ($this->model_meta as $meta) {
                $data[] = ['Review', $this->id, $meta['meta_key'], $meta['meta_title'], $meta['meta_value']];
            }
            self::getDb()->createCommand()
                ->batchInsert(ModelMeta::tableName(), ['model','model_id', 'meta_key', 'meta_title', 'meta_value'], $data)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }
    public function afterDelete()
    {
        foreach (ModelMeta::find()->where(['model_id' => $this->id])->andOnCondition('model = "Review"')->all() as $meta) {
            $meta->delete();
        }

        parent::afterDelete();
    }
}
