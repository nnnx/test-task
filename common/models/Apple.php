<?php

namespace common\models;

use Yii;

/**
 * Class Apple
 * @package common\models
 *
 * @property string $state
 * @property float $size
 * @property string $statusLabel
 * @property string $stateLabel
 */
class Apple extends \common\models\base\Apple
{
    const STATUS_ON_TREE = 0;
    const STATUS_ON_FLOOR = 1;

    const STATE_ON_TREE = 'on_tree';
    const STATE_FALLEN = 'fallen';
    const STATE_ROTTEN = 'rotten';

    const ROTTING_TIME = 60 * 60 * 5;

    /**
     * @return array
     */
    public static function getStateLabels()
    {
        return [
            self::STATE_ON_TREE => 'Висит на дереве',
            self::STATE_FALLEN => 'Упало/лежит на земле',
            self::STATE_ROTTEN => 'Сгнило'
        ];
    }

    /**
     * @return array
     */
    public static function getStatusLabels()
    {
        return [
            self::STATUS_ON_TREE => 'На дереве',
            self::STATUS_ON_FLOOR => 'На полу',
        ];
    }

    /**
     * @return string
     */
    public static function getRandColor()
    {
        $values = ['red', 'green', 'yellow'];
        return $values[array_rand($values)];
    }

    /**
     * {@inheritdoc}
     */
    public function __construct($color = null)
    {
        $this->color = $color ?? self::getRandColor();
        $this->date_create = date('Y-m-d H:i:s', rand(1, time()));
        $this->eaten = 0;
        $this->status = self::STATUS_ON_TREE;
        parent::__construct([]);
    }

    /**
     * Уронить
     * @throws \Exception
     */
    public function fallToGround()
    {
        if ($this->status != self::STATUS_ON_TREE) {
            throw new \Exception('Нельзя сбросить, яблоко уже на земле');
        }
        $this->status = self::STATUS_ON_FLOOR;
        $this->date_fall = date('Y-m-d H:i:s');
        $this->save();
    }

    /**
     * Съесть
     * @param float $percent
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eat(float $percent)
    {
        if ($this->status == self::STATUS_ON_TREE) {
            throw new \Exception('Нельзя есть пока висит на дереве');
        }
        if ($percent > 100 - $this->eaten) {
            throw new \Exception('Нельзя съесть столько ' . $percent . ' ' . (100 - $this->eaten));
        }
        if ($this->getState() == self::STATE_ROTTEN) {
            throw new \Exception('Нельзя есть гнилое');
        }
        $this->eaten += $percent;
        $this->save();

        if ($this->eaten == 100) {
            $this->delete();
        }
    }

    /**
     * Получить состояние
     * @return string
     */
    public function getState()
    {
        if ($this->status == self::STATUS_ON_TREE) {
            return self::STATE_ON_TREE;
        }
        if ($this->status == self::STATUS_ON_FLOOR) {
            if (time() - strtotime($this->date_fall) >= self::ROTTING_TIME) {
                return self::STATE_ROTTEN;
            }
            return self::STATE_FALLEN;
        }
    }

    /**
     * Размер оставшегося яблока
     * @return float|int
     */
    public function getSize()
    {
        return (100 - $this->eaten) / 100;
    }

    /**
     * @return mixed|null
     */
    public function getStatusLabel()
    {
        return self::getStatusLabels()[$this->status] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getStateLabel()
    {
        return self::getStateLabels()[$this->state] ?? null;
    }
}