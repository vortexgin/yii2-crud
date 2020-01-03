<?php

use yii\helpers\Html;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $formField array */

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', Inflector::humanize(get_class($model)))]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', Yii::t('app', Inflector::humanize(get_class($model)))), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formField' => $formField,
    ]) ?>

</div>
