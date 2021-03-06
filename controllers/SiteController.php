<?php

namespace app\controllers;

use app\models\User;
use app\security\ForgotForm;
use app\security\LoginForm;
use app\security\RegistrationForm;
use app\security\ResetPwdForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use app\models\Project;
use app\models\Invite;
use app\models\ProjectRate;

class SiteController extends Controller {

    private ?User $user = null;

    public function __construct($id, $module,
                                $config = []) {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index', [
            'projects' => Project::find()->count(),
            'sums' => Project::find()->where(['invested' => true])->sum('finance') ?: 0,
            'invites' => Invite::find()->count(),
            'users' => User::find()->count(),
            'rates' => ProjectRate::find()->count(),
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Регистрация пользователя
     */
    public function actionRegistration() {
        $model = Yii::$container->get(RegistrationForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['/user/confirm', 'id' => $model->getUser()->id]);
        }

        return $this->render('registration', [
            'model' => $model,
        ]);
    }

    /**
     * Забыл пароль
     */
    public function actionForgot() {
        $model = Yii::$container->get(ForgotForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->restore()) {
            return $this->render('forgot-send');
        }
        return $this->render('forgot', [
            'model' => $model,
        ]);
    }

    /**
     * Сброс паролья
     */
    public function actionResetPwd(string $token) {
        $user = $this->userRepository->findOneByResetToken($token);
        if ($user === null || ($user && $user->pwd_reset_token_unixtime > time() + Yii::$app->params['tokenLive'])) {
            throw new NotFoundHttpException('Указанный вами токен не действителен!');
        }
        $model = new ResetPwdForm();
        $model->user = $user;
        if ($model->load(Yii::$app->request->post()) && $model->setNewPwd()) {
            return $this->redirect(['/site/login']);
        }
        return $this->render('reset-pwd', [
            'model' => $model,
        ]);
    }

}
