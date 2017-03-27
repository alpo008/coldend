<?php

namespace app\controllers;

use app\models\User;
use yii;
use app\models\Mattypes;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MattypesController implements the CRUD actions for Mattypes model.
 */
class MattypesController extends Controller
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
                'only' => ['index', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['site/login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'delete'],
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
     * Lists all Mattypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->goHome();
        };
        
        $model = new Mattypes();
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new Mattypes();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Mattypes::find()->orderBy('id DESC'),
        ]);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing Mattypes model.
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
     * Finds the Mattypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mattypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mattypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
