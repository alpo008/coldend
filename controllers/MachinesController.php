<?php

namespace app\controllers;

use app\models\Usages;
use app\models\User;
use yii;
use app\models\Machines;
use app\models\search\MachinesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MachinesController implements the CRUD actions for Machines model.
 */
class MachinesController extends Controller
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
                'only' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Machines models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        };
        
        $searchModel = new MachinesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Machines model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $usagesModel = new Usages();
        if ($usagesModel->load(Yii::$app->request->post())) {
            $existingRow = Usages::findOne(['machines_id' => $usagesModel->machines_id, 'unit_id' => $usagesModel->unit_id, 'materials_id' => $usagesModel->materials_id]);
            if (!!$existingRow) {
                $existingRow->unit_qty += $usagesModel->unit_qty;
                if ($existingRow->unit_qty == 0){
                    $existingRow->delete();
                }else{
                $existingRow->save();
                }
            } else {
                $usagesModel->save();
            }
            $usagesModel = new Usages();
        }
        $existingUsages = Usages::find()->where(['machines_id' => $id]);

        return $this->render('view', [
            'model' => $model,
            'usagesModel' => $usagesModel,
            'existingUsages' => $existingUsages,
        ]);
    }

    /**
     * Creates a new Machines model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Machines();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Machines model.
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
     * Deletes an existing Machines model.
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
     * Finds the Machines model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Machines the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Machines::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
