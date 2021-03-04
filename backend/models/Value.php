<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "value".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property PropertyValue[] $propertyValues
 * @property Property[] $properties
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'value';
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
     * Gets query for [[PropertyValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyValues()
    {
        return $this->hasMany(PropertyValue::className(), ['value_id' => 'id']);
    }

    /**
     * Gets query for [[Properties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['id' => 'property_id'])->viaTable('property_value', ['value_id' => 'id']);
    }
}
