<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "property_value".
 *
 * @property int $property_id
 * @property int $value_id
 *
 * @property Property $property
 * @property Value $value
 */
class PropertyValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['property_id', 'value_id'], 'required'],
            [['property_id', 'value_id'], 'integer'],
            [['property_id', 'value_id'], 'unique', 'targetAttribute' => ['property_id', 'value_id']],
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
            'property_id' => 'Property ID',
            'value_id' => 'Value ID',
        ];
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
}
