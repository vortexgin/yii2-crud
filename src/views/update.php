<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $formField array */

$this->title = Yii::t('app', 'Update {model}: {name}', [
    'model' => Yii::t('app', Inflector::humanize(get_class($model))),
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', Inflector::humanize(get_class($model))), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="crud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formField' => $formField,
    ]) ?>

</div>
