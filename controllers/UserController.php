<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\security\ChangePwdForm;
use app\security\EmailConfirmForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    private ?User $user = null;

    public function __construct(
        $id,
        $module,
        $config = []
    ) {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view', 'change-pwd', 'change-pwd-validate', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => $this->user,
                    ],
                    [
                        'actions' => ['confirm', 'registration-success'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$model->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        return $this->render('view', [
            'model' => $model,
            'canEdit' => $this->user->isAdmin || $id == $this->user->id,
            'canEditRoles' => $this->user->isAdmin
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id) {
        $model = $this->findModel($id);
        $stream = $model->image ? stream_get_contents($model->image) : false;
        if (!$model->isAdmin && $model->id != $this->user->id) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            } elseif ($stream) {
                $model->image = $stream;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Подтверждение email
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm(int $id) {
        $user = $this->findModel($id);
        $model = new EmailConfirmForm();
        $model->user = $user;
        if ($model->load(Yii::$app->request->post()) && $model->confirm()) {
            return $this->redirect(['registration-success']);
        }

        return $this->render('confirm', [
            'model' => $model,
        ]);
    }

    public function actionRegistrationSuccess() {
        return $this->render('registration_success');
    }

    public function actionChangePwd() {
        if (Yii::$app->request->isAjax) {
            $model = new ChangePwdForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->setNewPwd()) {
                    return $this->redirect(['/user/view', 'id' => $this->user->id]);
                }
            }
        }
        return $this->redirect(['site/index']);
    }

    public function actionChangePwdValidate() {
        if (Yii::$app->request->isAjax) {
            $model = new ChangePwdForm();
            if ($model->load(Yii::$app->request->post())) {
                $model->validate();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }
        return $this->redirect(['site/index']);
    }

}
