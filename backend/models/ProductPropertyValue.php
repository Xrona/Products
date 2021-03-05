<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_property_value".
 *
 * @property int $product_id
 * @property int $property_id
 * @property int $value_id
 *
 * @property Product $product
 * @property Property $property
 * @property Value $value
 */
class ProductPropertyValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_property_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'property_id', 'value_id'], 'required'],
            [['product_id', 'property_id', 'value_id'], 'integer'],
            [['product_id', 'property_id', 'value_id'], 'unique', 'targetAttribute' => ['product_id', 'property_id', 'value_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
            [['value_id'], 'exist', 'skipOnError' => true, 'targetClass' => Value::className(), 'targetAttribute' => ['value_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'property_id' => 'Property ID',
            'value_id' => 'Value ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Property]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }

    /**
     * Gets query for [[Value]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(Value::className(), ['id' => 'value_id']);
    }

    public function getPropertyValueList($id)
    {
       return $this->find()
                ->select(['product_id','property_id','value_id','property.title AS prop', 'value.title AS val'])
                ->joinWith('property')
                ->joinWith('value')
                ->where(['product_id' => $id])
                ->asArray()
                ->all();
    }

    public function saveData($id, $idp, $idv)
    {
        $this->product_id = $id;
        $this->property_id = $idp;
        $this->value_id = $idv;
        return $this->save();
    }


}
