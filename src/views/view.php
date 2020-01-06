<?php

use common\components\ActiveRecord;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\Html;
use yii\helpers\Inflector;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yii\db\ActiveRecord */
/* @var $viewField array */

/** @var \ReflectionClass $reflector */
$reflector = new \ReflectionClass($model);
$plural = Inflector::pluralize(Inflector::humanize(Inflector::underscore($reflector->getShortName()), true));
$singular = Inflector::singularize(Inflector::humanize(Inflector::underscore($reflector->getShortName()), true));

$this->title = Yii::t('app', 'View {model}: {id}', ['model' => $singular, 'id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $plural), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="crud-view">

    <div class="row mb-3">
        <div class="col-12">
            <?php if ($model->hasAttribute('updated_at')): ?>
                <div class="last-update float-right">Last updated: <?= gmdate("d M Y H:i", $model->updated_at) ?></div>
            <?php endif; ?>

            <?php if ($model->hasAttribute('status')): ?>
                <div class="float-left">
                    <?php $items = [] ?>
                    <?php foreach(ActiveRecord::getConstantKeys('STATUS') as $key=>$status): ?>
                        <?php $items[] = ['label' => $status, 'url' => sprintf('%s?%s', Yii::$app->request->pathInfo, http_build_query(array_merge(Yii::$app->request->queryParams, ['status' => $key])))] ?>
                    <?php endforeach; ?>

                    <?php $btnClass = 'btn-success' ?>
                    <?php if ($model->status == ActiveRecord::STATUS_INACTIVE): ?>
                        <?php $btnClass = 'btn-warning' ?>
                    <?php elseif ($model->status == ActiveRecord::STATUS_DELETED): ?>
                        <?php $btnClass = 'btn-danger' ?>
                    <?php endif; ?>

                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= ButtonDropdown::widget([
                        'label' => ActiveRecord::getConstantKeys('STATUS', $model->status),
                        'buttonOptions' => ['class' => $btnClass],
                        'dropdown' => [
                            'items' => $items
                        ],
                    ])?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => !empty($viewField) ? $viewField : $model->attributes(),
    ]) ?>

</div>
