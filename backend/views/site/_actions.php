<?php

/**
 * @var $model \common\models\Apple
 * @var $eatForm \backend\models\form\EatForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="form-group">
    <div class="btn-group btn-group-justified">
        <?= Html::a('Уронить', ['fall', 'id' => $model->id], [
            'class' => 'btn btn-default btn-sm'
        ]) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-default btn-sm',
            'data-confirm' => ' '
        ]) ?>
    </div>
</div>

<?php $form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['eat', 'id' => $model->id],
    'enableAjaxValidation' => true,
    'options' => [
        'id' => uniqid(),
    ]
]) ?>

<div class="input-group">
    <?= $form->field($eatForm, 'percent')->textInput([
        'class' => 'form-control input-sm',
        'placeholder' => '%'
    ])->label(false) ?>
    <div class="input-group-btn">
        <?= Html::submitButton('Съесть', ['class' => 'btn btn-default btn-sm']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>



