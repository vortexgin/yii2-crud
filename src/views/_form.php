<?php

use vortexgin\yii2\crud\models\CRUD;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model yii\db\ActiveRecord */
/* @var $formField array */
?>

<div class="crud-form">
    <?php if ($model->hasErrors()): ?>
        <?php foreach ($model->getErrors() as $error): ?>
            <div class="alert alert-danger"><?= implode(', ', $error) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php $labels = $model->attributeLabels() ?>
    <?php $hints = $model->attributeHints() ?>

    <?php if (empty($formField)): ?>
        <?php foreach($model->attributes() as $field): ?>
            <?php $defaultLabel = !empty($labels[$field]) ? $labels[$field] : false ?>
            <?php $defaultHint = !empty($hints[$field]) ? $hints[$field] : false ?>

            <?= $form->field($model, $field)
                ->textInput([])
                ->label($defaultLabel)
                ->hint($defaultHint) ?>
        <?php endforeach; ?>
    <?php else: ?>
        <?php foreach($formField as $field): ?>
            <?php $defaultLabel = !empty($labels[$field['field']]) ? $labels[$field['field']] : false ?>
            <?php $defaultHint = !empty($hints[$field['field']]) ? $hints[$field['field']] : false ?>
            <?php $field['type'] = !empty($field['type']) ? $field['type'] : CRUD::FIELD_TYPE_TEXT ?>

            <?php if($field['type'] == CRUD::FIELD_TYPE_EMAIL): ?>
                <?= $form->field($model, $field['field'])
                        ->input('email', !empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_PASSWORD): ?>
                <?= $form->field($model, $field['field'])
                        ->passwordInput(!empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_NUMBER): ?>
                <?= $form->field($model, $field['field'])
                        ->input('number', !empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_HIDDEN): ?>
                <?= $form->field($model, $field['field'])
                        ->hiddenInput(!empty($field['options']) ? $field['options'] : []) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_FILE): ?>
                <?= $form->field($model, $field['field'])
                        ->fileInput(!empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_CHECKBOX): ?>
                <?= $form->field($model, $field['field'])
                        ->checkboxList(!empty($field['items']) ? $field['items'] : [], !empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_RADIO): ?>
                <?= $form->field($model, $field['field'])
                        ->radioList(!empty($field['items']) ? $field['items'] : [], !empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_SELECT): ?>
                <?= $form->field($model, $field['field'])
                        ->dropDownList(!empty($field['items']) ? $field['items'] : [], !empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_TEXTAREA): ?>
                <?= $form->field($model, $field['field'])
                        ->textarea(!empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_RICHTEXT): ?>
                <?= $form->field($model, $field['field'])
                        ->widget(\vova07\imperavi\Widget::className(), [
                            'settings' => [
                                'lang' => 'en',
                                'minHeight' => 300,
                                'buttons' => ['bold', 'italic', 'underline', 'unorderedlist', 'orderedlist', 'link'],
                                'linebreaks' => true,
                                'source' => false
                            ],
                        ])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php else: ?>
                <?= $form->field($model, $field['field'])
                        ->textInput(!empty($field['options']) ? $field['options'] : [])
                        ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                        ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
