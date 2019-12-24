<?php

namespace common\models;

use common\components\MetaTagBehavior;
use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $url
 * @property string $h1
 * @property string $desc
 * @property string $background_img
 * @property string $template
 */
class Page extends \yii\db\ActiveRecord
{
    const TEMPLATE_COUNTRIES = "countries";
    const TEMPLATE_CITIES = "cities";
    const TEMPLATE_RATING = "rating";
    const TEMPLATE_GUIDE = "guide";
    const TEMPLATE_BLOG = "blog";
    const TEMPLATE_ABOUT = "about";
    const TEMPLATE_POLICY = "privacy policy";
    public const TEMPLATES = [
        self::TEMPLATE_COUNTRIES => 'countries',
        self::TEMPLATE_CITIES => 'cities',
        self::TEMPLATE_RATING => 'rating',
        self::TEMPLATE_GUIDE => 'guide',
        self::TEMPLATE_BLOG => 'blog',
        self::TEMPLATE_ABOUT => 'about',
        self::TEMPLATE_POLICY => 'privacy policy'
    ];
    public $backgroundImage;
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
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'h1', 'desc', 'template'], 'required'],
            [['url', 'h1', 'template'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1000],
            [['backgroundImage'], 'file', 'extensions' => 'png, jpg, svg'],
            [['url'], 'unique'],
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
            'h1' => Yii::t('backend', 'H1'),
            'desc' => Yii::t('backend', 'Desc'),
            'background_img' => Yii::t('backend', 'Background Img'),
            'template' => Yii::t('backend', 'Template'),
        ];
    }
    public function getItems() {
        switch ($this->template) {
            case self::TEMPLATE_CITIES:
                return Locations::findCities();
//                return $this->hasMany(Locations::class, ['NOT', ['parent_id' => null]]);
                break;
            case self::TEMPLATE_COUNTRIES:
                return Locations::findCountries();
                break;
            case self::TEMPLATE_GUIDE:
            case self::TEMPLATE_BLOG:
                return Post::findPublishedByType($this->template);
                break;
            case self::TEMPLATE_RATING:
                return null;
                break;
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->backgroundImage) {
            if(!empty($this->oldAttributes['background_img']))
            {
                unlink(Yii::$app->params['uploadsDir'] . $this->oldAttributes['background_img']);
            }
            $pimgName =  'page' . time() . $this->id . '.' . $this->backgroundImage->extension;
            $this->backgroundImage->saveAs(Yii::$app->params['uploadsDir'] . $pimgName);
            $this->background_img = $pimgName;
        } else {
            $this->background_img = $this->oldAttributes['background_img'];
        }
        return parent::beforeSave($insert);
    }

    public static function getMenuItems() {
        $menuItems = [];
        $pages = Page::find()->where(['template' => array_keys(Page::TEMPLATES)])->all();
        foreach ($pages as $page) {
            $menuItem = [
                'label' => $page->template,
//                'encode' => false,
                'url' => '/'.$page->url,
//                'options' => ['class'=>'dropdown'],
//                'template' => '<a href="{url}" class="url-class">{label}</a><a href="{url}" class="url-class">{label}</a>',
                'items' => []
            ];
            switch ($page->template) {
                case 'countries':
                    $items = Locations::findCountries();
                    break;
                case 'cities':
                    $items = Locations::findCities();
                    break;
                case 'rating':
                    $items = Review::find()->all();
                    break;
                case 'guide':
                case 'blog':
                    $items = Post::findPublishedByType($page->template);
                    break;
                default:
                    $menuItems[] = ['label' => $page->template, 'url' => '/'.$page->url];
                    continue;
                    break;
            }
            foreach ($items as $item) {
                $menuItem['items'][] = ['label' => $page->template == 'rating' ? $item->title : $item->h1, 'url' => '/'.$page->url.'/'.$item->url];
            }
            $menuItems[] = $menuItem;
        }
        return $menuItems;
    }
}
