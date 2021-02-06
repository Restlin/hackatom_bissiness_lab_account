<?php

namespace app\controllers;

use app\models\RequestSearch;
use Yii;
use app\services\ProjectService;
use app\models\User;
use app\models\Project;
use app\models\Status;
use app\models\Type;
use app\models\ProjectSearch;
use app\models\ProjectPartSearch;
use app\models\ProjectAccessSearch;
use app\models\ProjectRateSearch;
use app\models\ProjectRate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        if(!$this->user->isAdmin) {
            $searchModel->public = true;
        }        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'statusList' => Status::getList(),
        ]);
    }

    private function renderProjectPartIndex(Project $project, $canEdit) {
        $searchModel = new ProjectPartSearch();
        $searchModel->project_id = $project->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('/project-part/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'canEdit' => $canEdit,
            'canReady' => $this->user && $this->user->isCurator,
        ]);
    }

    private function renderProjectAccessIndex(Project $project) {
        $searchModel = new ProjectAccessSearch();
        $searchModel->project_id = $project->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('/project-access/index', [
            'canInvite' => ProjectService::canInvite($project, $this->user),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    private function renderProjectRateIndex(Project $project) {
        $searchModel = new ProjectRateSearch();
        $searchModel->project_id = $project->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('/project-rate/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'canRate' => ProjectRate::find()->andWhere(['project_id' => $project->id, 'user_id' => Yii::$app->user->id])->one() ? false : true,
            'rateAvg' => ProjectRate::find()->andWhere(['project_id' => $project->id])->average('rate')
        ]);
    }

    private function renderRequestIndex(Project $project) {
        $searchModel = new RequestSearch();
        $searchModel->project_id = $project->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return '';
        return $this->renderPartial('/request/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $tab = 'info')
    {
        $project = $this->findModel($id);
        $canEdit = $this->user && ProjectService::canEdit($project, $this->user);
        $canInvest = $this->user && ProjectService::canInvest($project, $this->user);
        return $this->render('view', [
            'model' => $project,
            'tab' => $tab,
            'canInvest' => $canInvest,
            'canEdit' => $canEdit,
            'statuses' => Status::getList(),
            'projectPartIndex' => $this->renderProjectPartIndex($project, $canEdit),
            'projectRateIndex' => $this->renderProjectRateIndex($project),
            'projectAccessIndex' => $this->renderProjectAccessIndex($project),
            'requestIndex' => $this->renderRequestIndex($project),
        ]);
    }
    
    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPdf($id)
    {
        $project = $this->findModel($id);
        $mpdf = new \Mpdf\Mpdf(['tempDir' => Yii::getAlias('@runtime/mpdf')]);        
        
        $html = $this->renderPartial('pdf', ['project' => $project]);
        $mpdf->WriteHTML($html);         
        $mpdf->Output($project->name, \Mpdf\Output\Destination::DOWNLOAD); // Output a PDF file directly to the browser
        
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();
        $model->status_id = Status::DRAFT;
        $model->public = true;
        $model->rating = 0;

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        return $this->render('create', [
            'model' => $model,
            'types' => Type::getList(),
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $stream = $model->image ? stream_get_contents($model->image) : false;

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image=file_get_contents($image->tempName);
            } elseif($stream) {
                $model->image = $stream;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        return $this->render('update', [
            'model' => $model,
            'types' => Type::getList(),
        ]);
        
    }
    
    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInvest($id)
    {
        $model = $this->findModel($id);                

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ProjectService::recalcProject($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('invest', [
            'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
