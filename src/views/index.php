<?php

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $searchModel yii\db\ActiveRecord */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $indexField array */

/** @var \ReflectionClass $reflector */
$reflector = new \ReflectionClass($model);
$plural = Inflector::pluralize(Inflector::humanize(Inflector::underscore($reflector->getShortName()), true));
$singular = Inflector::singularize(Inflector::humanize(Inflector::underscore($reflector->getShortName()), true));

$this->title = Yii::t('app', $plural);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crud-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', $singular)]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => array_merge([['class' => 'yii\grid\SerialColumn']], $indexField, [['class' => 'vortexgin\yii2\crud\components\grid\ActionColumn']]),
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>
