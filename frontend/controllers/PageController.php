<?php
namespace frontend\controllers;

use common\models\Locations;
use common\models\Page;
use common\models\Post;
use common\models\Review;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Page controller
 */
class PageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
//            'access' => [
//                'class' => AccessControl::class,
//                'only' => ['logout', 'signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::class,
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * @param null $page_url
     * @param null $model_url
     * @param null $model_child
     */
    public function actionIndex($page_url = null, $model_url = null, $model_child = null)
    {
        $data = [];
        if ( ($page = Page::findOne(['url' => $page_url])) ) {
            $data['model'] = $page;
            if (is_null($model_url)) {
                return $this->render($page->template, $data);
            }

            switch ($page->template) {
                case 'guide':
                case 'blog':
                    return $this->post($model_url, $page->template);
                    break;
                case 'rating':
                    return $this->review($model_url, $page->template);
                    break;


                case 'cities':
                case 'countries':
                    return $this->location($model_url, 'locations', $model_child);
                    break;
            }
        }
        throw new NotFoundHttpException('The requested post does not exist.', 404);
    }

    private function post($url, $type) {
        $data = [];
        if ( ($model = Post::findOne(['url' => $url, 'type' => $type])) ) {
            $data['model'] = $model;
            return $this->render($type.'_open', $data);
        }
        throw new NotFoundHttpException('The requested post does not exist.', 404);
    }
    private function review($url, $type) {
        $data = [];
        if ( ($model = Review::findOne(['url' => $url])) ) {
            $data['model'] = $model;
            return $this->render($type.'_open', $data);
        }
        throw new NotFoundHttpException('The requested post does not exist.', 404);
    }

    private function location($url, $type, $model_child) {
        $data = [];
        if ( ($model = Locations::findOne(['url' => $url])) ) {
            $data['model'] = $model;
            return $this->render($type.'_open', $data);
        }
        throw new NotFoundHttpException('The requested post does not exist.', 404);
    }
}
