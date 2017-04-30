<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => "<img src='../images/logo.png' class='img-responsive' />",
        'brandOptions' => ['class' => 'custom-logo'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top bg-custom-color',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Contact', 'url' => ['/site/contact']],

            Yii::$app->user->isGuest ? (
            ''
            ) : (
                ['label' => 'Posts', 'url' => ['/post/index']]
            ),

            Yii::$app->user->isGuest ? (
                    ['label' => 'Register', 'url' => ['/site/register']]
            ) : (
                    ['label' => 'Profile', 'url' => ['/user/view']]
            ),

            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

    </div>
</div>

<footer class="footer custom-footer">
    <div class="container">
        <div class="row">
           <div class="col-md-3">
               <p><strong><em>&copy; Let`s Blog<?= date('Y') ?></em></strong></p>
           </div>
            <div class="col-md-6 col-md-offset-2">
                <span><strong><em>Find us at</em></strong> &nbsp&nbsp&nbsp</span>
                <?=
                Html::a(
                    Html::img('../images/insta.jpg'), 'https://www.instagram.com/'
                )
                ?>
                <?=
                Html::a(
                    Html::img('../images/twit.gif'), 'https://www.twitter.com/'
                )
                ?>
                <?=
                Html::a(
                    Html::img('../images/face.png'), 'https://www.facebook.com/'
                )
                ?>
            </div>
        </div>

    </div>
    <?php if(!(\Yii::$app->user->isGuest)): ?>
    <div class="chat-box">
        <p class="text-center"><strong>Chat here :)</strong></p>
    </div>
    <?php endif; ?>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
