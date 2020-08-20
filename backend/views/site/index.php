<?php

/**
 * @var $this yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $eatForm \backend\models\form\EatForm
 */

use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<p>
    <a href="<?= Url::to(['create']) ?>" class="btn btn-primary mb-5">Создать несколько яблок</a>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-striped table-hover'],
    'summary' => '',
    'columns' => [
        'id',
        'color',
        'date_create:dateTime',
        'eaten',
        [
            'label' => 'Статус',
            'content' => function ($model) {
                return $model->statusLabel;
            }
        ],
        [
            'label' => 'Состояние',
            'content' => function ($model) {
                return $model->stateLabel;
            }
        ],
        [
            'label' => 'Действия',
            'headerOptions' => ['style' => 'width:150px'],
            'content' => function ($model) use ($eatForm) {
                return $this->render('_actions', [
                    'model' => $model,
                    'eatForm' => $eatForm,
                ]);
            }
        ],
    ],
]) ?>

<style>
    .help-block {
        position: absolute;
        margin: 0;
        top: 100%;
        font-size: 12px;
    }
</style>
