<?php

namespace backend\models;
use yii\helpers\ArrayHelper;
use Yii;
use backend\models\ProductPropertyValue;

/**
 * This is the model class for table "property".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property ProductProperty[] $productProperties
 * @property Product[] $products
 * @property PropertyValue[] $propertyValues
 * @property Value[] $values
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ProductProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropertyValues()
    {
        return $this->hasMany(ProductPropertyValue::className(), ['property_id' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_property_value', ['property_id' => 'id']);
    }

    /**
     * Gets query for [[PropertyValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValues()
    {
        return $this->hasMany(PropertyValue::class, ['property_id' => 'id']);
    }

    /**
     * Gets query for [[Values]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::class, ['id' => 'value_id'])->viaTable('property_value', ['property_id' => 'id']);
    }

    /**
     *  Gets array values for property by id
     * 
     * @param integer $id
     * @return array
     */
    public function getValueList($id)
    {
        return $this->find()
            ->joinWith('values')
            ->where(['property.id' => $id])
            ->asArray()
            ->all();
    }



}
