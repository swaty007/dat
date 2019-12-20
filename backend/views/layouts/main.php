<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Mob Latin',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => Yii::t('backend', 'Home'), 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => Yii::t('frontend', 'Login'), 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => Yii::t('backend', 'Logout ({username})', [
                        'username' => Yii::$app->user->identity->username
                    ]),
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            $menuItems[] = ['label' => Yii::t('backend', 'Site'), 'url' => ['../']];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        Blog
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                <li><a href="<?= Url::toRoute('post/index'); ?>"><?= Yii::t('backend', 'Posts') ?></a></li>
                <li><a href="<?= Url::toRoute('category/index'); ?>"><?= Yii::t('backend', 'Categories') ?></a></li>
                <li><a href="<?= Url::toRoute('tags/index'); ?>"><?= Yii::t('backend', 'Tags') ?></a></li>
                <li><a href="<?= Url::toRoute('comment/index'); ?>"><?= Yii::t('backend', 'Comments') ?></a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::toRoute('page/index'); ?>"><?= Yii::t('backend', 'Pages') ?></a></li>
                <li><a href="<?= Url::toRoute('locations/index'); ?>"><?= Yii::t('backend', 'Locations') ?></a></li>
                <li><a href="<?= Url::toRoute('review/index'); ?>"><?= Yii::t('backend', 'Review') ?></a></li>
                <li><a href="<?= Url::toRoute('user/index'); ?>"><?= Yii::t('backend', 'Users') ?></a></li>
            </ul>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <a href="https://infinitum.tech" target="_blank">sllite.ru</a> <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
