<?php

namespace app\controllers;

use yii;
use app\models\Materials;
use app\models\search\MaterialsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Relations;

/**
 * MaterialsController implements the CRUD actions for Materials model.
 */
class MaterialsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['site/login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'matchCallback' => function ($rule, $action) {
                            return User::checkRights(Yii::$app->user->identity['role'], $this->uniqueId, $action->id);
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Materials models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        };
        $searchModel = new MaterialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materials model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $relationsModel = new Relations();
        if ($relationsModel->load(Yii::$app->request->post())) {
            $existingRow1 = Relations::findOne(['parent_id' => $relationsModel->parent_id, 'child_id' => $relationsModel->child_id]);
            $existingRow2 = Relations::findOne(['parent_id' => $relationsModel->child_id, 'child_id' => $relationsModel->parent_id]);
            if ($relationsModel->partType == 'del'){
                if (!!$existingRow1){
                    $existingRow1->delete();
                }
                if (!!$existingRow2){
                    $existingRow2->delete();
                }

            }elseif (!$existingRow1 && !$existingRow2){
                $relationsModel->save();
            }
        }

        if (!!$model->getChildren()->one() && !$model->getParents()->one()){
            $relationsModel->partType = 'parent';
            $existingRelations = $model->getChildren();
        }elseif (!$model->getChildren()->one() && !!$model->getParents()->one()){
            $existingRelations = $model->getParents();
            $relationsModel->partType = 'child';
        }else{
            $existingRelations = NULL;
            $relationsModel->partType = NULL;
        }

        return $this->render('view', [
            'model' => $model,
            'relationsModel' => $relationsModel,
            'existingRelations' => $existingRelations,
        ]);
    }

    /**
     * Creates a new Materials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materials();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Materials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Materials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Materials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materials::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
