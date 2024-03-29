<?php

namespace common\models;



use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\components\MetaTagBehavior;
/**
 * Post model.
 *
 * @property string $id
 * @property string $url
 * @property string $h1
 * @property string $desc
 * @property string $type
 * @property string $background_img
 * @property string $anons
 * @property string $content
 * @property string $category_id
 * @property string $author_id
 * @property string $publish_status
 * @property string $publish_date
 *
 * @property User $author
 * @property Category $category
 * @property Comment[] $comments
 */
class Post extends ActiveRecord
{
    public const STATUS_PUBLISH = 'publish';
    public const STATUS_DRAFT = 'draft';
    public const TYPE_BLOG_POST = 'blog';
    public const TYPE_BLOG_GUIDE = 'guide';
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
     * Tag list
     * @var array
     */
    protected $tags = [];

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['h1','desc','type','url'], 'required'],
            [['category_id', 'author_id'], 'integer'],
            [['anons', 'content', 'publish_status'], 'string'],
            [['background_img'], 'string', 'max' => 255],
            [['publish_date', 'tags'], 'safe'],
            [['h1','url'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1000],
            [['backgroundImage'], 'file', 'extensions' => 'png, jpg, svg'],
            [['type', 'url'], 'unique', 'targetAttribute' => ['type', 'url']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'url' => Yii::t('backend', 'Url'),
            'h1' => Yii::t('backend', 'Title h1'),
            'desc' => Yii::t('backend', 'Description'),
            'type' => Yii::t('backend', 'Type'),
            'anons' => Yii::t('backend', 'Announce'),
            'content' => Yii::t('backend', 'Content'),
            'category' => Yii::t('backend', 'Category'),
            'tags' => Yii::t('backend', 'Tags'),
            'category_id' => Yii::t('backend', 'Category ID'),
            'author' => Yii::t('backend', 'Author'),
            'author_id' => Yii::t('backend', 'Author ID'),
            'publish_status' => Yii::t('backend', 'Publish status'),
            'publish_date' => Yii::t('backend', 'Publish date'),
        ];
    }

    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getComments(): ActiveQuery
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    public function getPublishedComments(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->getComments()
                ->where(['publish_status' => Comment::STATUS_PUBLISH])
        ]);
    }

    public function getBackground_img_url(){
        return Yii::$app->params['uploadsWeb'].$this->background_img;
    }

    public function setTags(array $tagsId): void
    {
        $this->tags = $tagsId;
    }

    /**
     * Return tag ids
     */
    public function getTags(): array
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }

    /**
     * Return tags for post
     *
     * @return ActiveQuery
     */
    public function getTagPost(): ActiveQuery
    {
        return $this->hasMany(
            TagPost::class, ['post_id' => 'id']
        );
    }

    public static function findPublished(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => self::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
                ->orderBy(['publish_date' => SORT_DESC])
        ]);
    }
    public static function findPublishedByType($type)
    {
         return self::find()
             ->where(['type' => $type])
             ->andWhere(['publish_status' => self::STATUS_PUBLISH])
             ->orderBy(['publish_date' => SORT_DESC])->all();
    }

    /**
     * @throws NotFoundHttpException
     */
    public static function findById(int $id, bool $ignorePublishStatus = null): Post
    {
        if (($model = Post::findOne($id)) !== null) {
            if ($model->isPublished() || $ignorePublishStatus) {
                return $model;
            }
        }

        throw new NotFoundHttpException('The requested post does not exist.');
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
            $pimgName =  'post' . time() . $this->id . '.' . $this->backgroundImage->extension;
            $this->backgroundImage->saveAs(Yii::$app->params['uploadsDir'] . $pimgName);
            $this->background_img = $pimgName;
        } else {
            $this->background_img = $this->oldAttributes['background_img'];
        }
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        TagPost::deleteAll(['post_id' => $this->id]);

        if (is_array($this->tags) && !empty($this->tags)) {
            $values = [];
            foreach ($this->tags as $id) {
                $values[] = [$this->id, $id];
            }
            self::getDb()->createCommand()
                ->batchInsert(TagPost::tableName(), ['post_id', 'tag_id'], $values)->execute();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    protected function isPublished(): bool
    {
        return $this->publish_status === self::STATUS_PUBLISH;
    }
}
