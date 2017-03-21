<?php

namespace app\controllers;

use Yii;
use app\models\Usages;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsagesController implements the CRUD actions for Usages model.
 */
class UsagesController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Usages::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $machinesId = explode('-', $id)[0];
        $unitId = explode('-', $id)[1];
        $model = new Usages();
        $model->machines_id = $machinesId;
        $model->unit_id = $unitId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['machines/view', 'id' => $machinesId]);
        } else {
            return $this->render('create', [
               'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Usages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $machinesId = $model->machines_id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->unit_qty > 0){
                $model->save();
            }else{
                $model->delete();
            }

            return $this->redirect(['machines/view', 'id' => $machinesId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $usage = $this->findModel($id);
        $machinesId = $usage->machines_id;
        $usage->delete();
        return $this->redirect(['machines/view', 'id' => $machinesId]);
    }

    /**
     * Finds the Usages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
