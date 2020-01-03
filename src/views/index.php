<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $searchModel yii\db\ActiveRecord */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $indexField array */

$this->title = Yii::t('app', Inflector::humanize(get_class($model)));
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="crud-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create {model}', ['model' => Yii::t('app', Inflector::humanize(get_class($model)))]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => array_merge([['class' => 'yii\grid\SerialColumn']], $indexField, [['class' => 'yii\grid\ActionColumn']]),
    ]); ?>

    <?php Pjax::end(); ?>

</div>
