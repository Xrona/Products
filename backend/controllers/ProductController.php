<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductPropertyValue;
use backend\models\Value;
use backend\models\Property;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $data = new ProductPropertyValue();
        $propertyValueList = $data->getPropertyValueList($id);

        return $this->render('view', [
            'model' => $model,
            'propertyValueList' => $propertyValueList,
         
        ]);
    }

    /**
     * add property for product by id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAddProperty($id)
    {
        $model = new Property();
        $propertyList = ArrayHelper::map(Property::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post())) {
            $id_property = ArrayHelper::getValue(Yii::$app->request->post(), 'Property.title');
            return $this->redirect( ['add-value','id'=> $id, 'idp'=> $id_property]);
        }

        return $this->render('addProperty', [
            'model' => $model,
            'propertyList' => $propertyList,
        ]);
    }

    /**
     * add value of property by idp for product by id
     * @param integer $id -id product
     * @param integer $idp  - id property
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAddValue($id,$idp)
    {
        $model = new Value();
        $valueList = ArrayHelper::map(Value::find()->joinWith('propertyValues')->where(['property_id' => $idp])->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post())) {
            $id_value = ArrayHelper::getValue(Yii::$app->request->post(), 'Value.title');
            $saveModel = new ProductPropertyValue();
            $saveModel->saveData($id,$idp,$id_value);
            return $this->redirect( ['view','id'=> $id]);
        }

        return $this->render('addValue',[
            'model' => $model,
            'valueList' => $valueList,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateValue($id)
    {
        $model = $this->findProductPropertyValueModel($id);
        $valueList = ArrayHelper::map(Value::find()->joinWith('propertyValues')->where(['property_id' => $model->property_id])->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->product_id]);
        }

        return $this->render('updateValue', [
            'model' => $model,
            'valueList' => $valueList,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'view' page product by $id.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteProductPropertyValue($id)
    {
        $this->findProductPropertyValueModel($id)->delete();

        return $this->redirect(['view', 'id' => $id]);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductPropertyValueModel($id)
    {
        if (($model = ProductPropertyValue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
