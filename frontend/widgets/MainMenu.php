<?php

namespace frontend\widgets;


use common\models\Page;
use Yii;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

class MainMenu extends \yii\bootstrap\Widget
{
    public $closeButton = [];

    public function init()
    {
        parent::init();

        NavBar::begin([
            'brandLabel' => 'Mob Latin',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        $menuItems = Page::getMenuItems();
        $menuItems[] = ['label' => Yii::t('frontend', 'About'), 'url' => ['/site/about']];
        $menuItems[] = ['label' => Yii::t('frontend', 'Contact'), 'url' => ['/site/contact']];
        $menuItems[] = ['label' => Yii::t('frontend', 'Blog'), 'url' => ['/post/index']];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => Yii::t('frontend', 'Sign up'), 'url' => ['/site/signup']];
            $menuItems[] = ['label' => Yii::t('frontend', 'Login'), 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => Yii::t('frontend', 'Logout ({username})', ['username' => Yii::$app->user->identity->username]),
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
            $menuItems[] = [
                'label' => Yii::t('frontend', 'Administration'),
                'url' => ['/admin/site']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();

    }
}
