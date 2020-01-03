<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $viewField array */

/** @var \ReflectionClass $reflector */
$reflector = new \ReflectionClass($model);
$plural = Inflector::pluralize($reflector->getShortName());
$singular = Inflector::singularize($reflector->getShortName());

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $plural), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organizer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => !empty($viewField) ? $viewField : $model->attributes(),
    ]) ?>

</div>
