<?php

namespace app\controllers;

use app\models\Invite;
use app\models\InviteSearch;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * InviteController implements the CRUD actions for Invite model.
 */
class InviteController extends Controller
{
    private ?User $user = null;

    public function __construct($id, $module,
                                $config = []) {
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'new-request'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Invite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InviteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invite model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $canEdit = $model->project->iniciator->id === $this->user->id;
        $canRequest = true; // todo может ли пользователь откликнуться // проверять 1. есть ли уже права на участие 2. роль пользователя ?
        return $this->render('view', [
            'model' => $model,
            'canEdit' => $canEdit,
            'canRequest' => $canRequest,
        ]);
    }

    public function actionNewRequest($id)
    {
        $model = $this->findModel($id);
        $canRequest = true; // todo может ли пользователь откликнуться // проверять 1. есть ли уже права на участие 2. роль пользователя ?
        if ($canRequest) {
            $params = [
                'Request[project_id]' => $model->project_id,
                'Request[user_id]' => $this->user->id,
                'Request[author_id]' => $this->user->id,
                'Request[executor_id]' => $model->project->iniciator->id,
            ];
            $this->redirect(ArrayHelper::merge(['request/create'], $params));
        } else {
            throw new ForbiddenHttpException("Вы не можете подать заявку на участие в этом проекте!");
        }
    }

    /**
     * Creates a new Invite model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invite();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Invite model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Invite model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invite model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invite the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invite::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
