<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color Цвет
 * @property string $date_create Дата появления
 * @property string|null $date_fall Дата появления
 * @property int $status Статус
 * @property float $eaten Съедено, %
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'date_create', 'status'], 'required'],
            [['date_create', 'date_fall'], 'safe'],
            [['status'], 'integer'],
            [['eaten'], 'number'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'date_create' => 'Дата появления',
            'date_fall' => 'Дата появления',
            'status' => 'Статус',
            'eaten' => 'Съедено, %',
        ];
    }
}
