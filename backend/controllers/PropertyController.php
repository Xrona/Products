<?php

namespace backend\controllers;

use Yii;
use backend\models\Property;
use backend\models\Value;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PropertyController implements the CRUD actions for Property model.
 */
class PropertyController extends Controller
{
    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * Lists all Property models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Property::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Property model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $valueList = $this->findModel($id)->getValueList($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'valueList' => $valueList,
        ]);
    }

     /**
     * Create a new Value model for Property $id
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionValueCreate($id)
    {
        $model = new Value();

        if ($model->load(Yii::$app->request->post()) && $model->saveValue($id)) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('createValue', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Property model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Property();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Property model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

        /**
     * Updates an existing Value model.
     * If update is successful, the browser will be redirected to the 'view' page Property by $id.
     * @param integer $id  - id property
     * @param integer $idv - id value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionValueUpdate($id, $idv)
    {
        $model = $this->findValueModel($idv);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('updateValue', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Property model.
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
     * Deletes an existing Value model.
     * If deletion is successful, the browser will be redirected to the 'view' page property by $id.
     * @param integer $id - id property
     * @param integer $idv - id value
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionValueDelete($id, $idv)
    {
        $this->findValueModel($idv)->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Property model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Property the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Property::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Value model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Value the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findValueModel($id)
    {
        if (($model = Value::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
