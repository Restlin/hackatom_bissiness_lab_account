<?php

namespace app\controllers;

use app\models\Project;
use app\models\ProjectAccess;
use app\models\Role;
use app\models\User;
use Yii;
use app\models\Request;
use app\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->executor_id = $this->user->id;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Request();
        $model->load(Yii::$app->request->get());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/project/view', 'id' => $model->project_id]);
        }
        $user = new User();
        $user->load(Yii::$app->request->get());

        return $this->render('_form', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionAutocreate($projectId)
    {
        $project = Project::findOne($projectId);
        if (!$project) {
            throw new NotFoundHttpException('Проект не найден');
        }
        $model = new Request();
        $model->project_id = $project->id;
        $model->author_id = $this->user->id;
        $user = new User();
        $user->load(Yii::$app->request->post());
        $foundUser = User::findOne(['email' => $user->email]);
        if ($model->load(Yii::$app->request->post()) && $foundUser) {
            $model->executor_id = $foundUser->id;
            $model->user_id = $foundUser->id;
            if ($model->save()) {
                return $this->redirect(['/project/view', 'id' => $model->project_id]);
            }
        }

        return $this->render('_form', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    public function actionExecute($id, $role)
    {
        $model = $this->findModel($id);
        if ($role == Role::ASSISTANT) {
            $access = new ProjectAccess();
            $access->user_id = $model->user_id;
            $access->project_id = $model->project_id;
            $access->role_id = $role;
            $access->save();

        }
        $model->delete();
        $this->redirect(['index']);
    }

    /**
     * Updates an existing Request model.
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
     * Deletes an existing Request model.
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
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
