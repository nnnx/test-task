<?php

namespace backend\models\form;

use common\models\Apple;
use yii\base\Model;

class EatForm extends Model
{
    public $percent;

    public function rules()
    {
        return [
            ['percent', 'required'],
            ['percent', 'number', 'min' => 0, 'max' => 100, 'numberPattern' => '/^\d+(.\d{1,2})?$/'],
        ];
    }

    /**
     * @param Apple $apple
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function process(Apple $apple)
    {
        $apple->eat($this->percent);
    }
}