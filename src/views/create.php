<?php

use yii\helpers\Html;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $formField array */

/** @var \ReflectionClass $reflector */
$reflector = new \ReflectionClass($model);
$plural = Inflector::pluralize($reflector->getShortName());
$singular = Inflector::singularize($reflector->getShortName());

$this->title = Yii::t('app', 'Create {model}', ['model' => Yii::t('app', $singular)]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $plural), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'formField' => $formField,
    ]) ?>

</div>
