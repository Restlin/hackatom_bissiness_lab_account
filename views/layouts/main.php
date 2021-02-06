<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header class="header">
    <div class="header__wrapper  wrapper">
        <div class="header__logo">
            <a href="https://www.rosatom.ru" title="Росатом">
                <img src="../media/logo.jpg" alt="Росатом" />
            </a>
        </div>
        <?php if (Yii::$app->user->isGuest): ?>

        <div class="header__enter header__nav-item">
            <?= Html::a('Войти', ['/site/login']) ?>
        </div>

        <?php else: $user = Yii::$app->user->getIdentity()->getUser(); ?>
        <div class="header__layer"></div>
        <div class="header__burg js-burg">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header__hide js-menu">
            <nav class="header__nav nav">
                <ul class="header__nav-left">
                    <li class="header__nav-item">
                        <?= Html::a('Главная', ['site/index']) ?>
                    </li>
                    <li class="header__nav-item">
                        <?= Html::a('Объявления', ['invite/index']) ?>
                    </li>
                    <li class="header__nav-item">
                        <?= Html::a('Проекты', ['project/index']) ?>
                    </li>
                    <li class="header__nav-item">
                        <?= Html::a('Запросы', ['request/index']) ?>
                    </li>
                    <li class="header__nav-item">
                        <?= Html::a('Пользователи', ['user/index']) ?>
                    </li>
                    <!--<li class="header__nav-item">
                        <?= Html::a('Файлы', ['file/index']) ?>
                    </li>!-->
                    <li class="header__nav-item header__exit header__nav-item--light">
                        <?= Html::a('Настройки', ['user/view', 'id' => $user->id]) ?>
                    </li>
                    <li class="header__nav-item header__exit header__nav-item--light">
                        <?= Html::a('Выход', ['site/logout']) ?>
                    </li>
                </ul>
            </nav>
            <div class="header__right">
                <div class="header__avatar-wrapper">
                    <div class="header__avatar avatar">
                        <?= Html::beginTag('a', ['href' => Url::to(['user/view', 'id' => $user->id])]); ?>

                            <?php
                                $stream = $user->image ? stream_get_contents($user->image) : false;
                                if ($stream) {
                                    $image = 'data:image/jpeg;charset=utf-8;base64,' . base64_encode($stream);
                                    echo Html::img($image, ['style' => '...']);
                                }else {
                                    echo Html::img('../media/123.png');
                                }
                            ?>
                        <?= Html::endTag('a'); ?>
                    </div>
                    <p><?= $user->name . ' ' . $user->surname ?></p>
                </div>

                <div class="header__nav-right">
                    <li class="header__nav-item header__nav-item--light">
                        <?= Html::a('Настройки', ['user/view', 'id' => $user->id]) ?>
                    </li>
                    <li class="header__nav-item header__nav-item--light">
                        <?= Html::a('Выход', ['site/logout']) ?>
                    </li>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

</header>

    <section >
        <div class="wrapper">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </section>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
