<?php

namespace backend\models;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $titile
 * @property string|null $description
 *
 * @property ProductPropertyValue[] $productPropertyValues
 * @property Property[] $properties
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['titile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titile' => 'Titile',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[ProductProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropertyValues()
    {
        return $this->hasMany(ProductPropertyValue::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Properties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::class, ['id' => 'property_id'])->viaTable('product_property_value', ['product_id' => 'id']);
    }

    public function getValues()
    {
        return $this->hasMany(Value::class, ['id' => 'value_id'])->viaTable('product_property_value', ['product_id' => 'id']);
    }


}
