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
    public const TEMPLATES = [
        'countries' => 'countries',
        'cities' => 'cities',
        'rating' => 'rating',
        'guide' => 'guide',
        'blog' => 'blog',
        'about' => 'about',
        'privacy policy' => 'privacy policy'
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
                    $items = Post::findPublishedGuides();
                    break;
                case 'blog':
                    $items = Post::findPublishedPosts();
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
