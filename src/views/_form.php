<?php

use vortexgin\yii2\crud\models\CRUD;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Inflector;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model yii\db\ActiveRecord */
/* @var $formField array */

/** @var \ReflectionClass $reflector */
$reflector = new \ReflectionClass($model);
$plural = Inflector::pluralize($reflector->getShortName());
$singular = Inflector::singularize($reflector->getShortName());
?>

<div class="crud-form">
    <?php if ($model->hasErrors()): ?>
        <?php foreach ($model->getErrors() as $error): ?>
            <div class="alert alert-danger"><?= implode(', ', $error) ?></div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

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
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_SELECT2): ?>
                <?= $form->field($model, $field['field'])
                        ->widget(\kartik\select2\Select2::classname(), [
                            'data' => !empty($field['items']) ? $field['items'] : [],
                            'language' => 'en',
                            'options' => ['placeholder' => Yii::t('app', 'Select a {model} ...', ['model' => $reflector->getShortName()])],
                            'pluginOptions' => !empty($field['options']) ? $field['options'] : [],
                        ])
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
            <?php elseif($field['type'] == CRUD::FIELD_TYPE_MAPS): ?>
                <?= $form->field($model, $field['field'])
                    ->textInput(!empty($field['options']) ? $field['options'] : [])
                    ->label(!empty($field['label']) ? $field['label'] : $defaultLabel)
                    ->hint(!empty($field['hint']) ? $field['hint'] : $defaultHint) ?>
                <div id="map-<?= $field['field'] ?>" style="height: 300px; width: 100%;"></div>
                <div class="form-group">
                    <?= Html::textInput(sprintf('location-search-%s', $field['field']), '', [
                        'id' => sprintf('location-search-%s', $field['field']),
                        'class' => 'form-control',
                        'placeholder' => Yii::t('app', 'Search location. Example: Monas, Balai Kartini')
                    ]) ?>
                </div>
                <script>
                    function initMap<?= $field['field'] ?>() {
                        var defaultPosition = {lat: -6.21462, lng: 106.84513},
                            zoom = 12;

                        <?php if (!empty($position = $model->getAttribute($field['field']))): ?>
                            <?php $exp = explode(',', $position) ?>
                            defaultPosition = {lat: <?= $exp[0] ?>, lng: <?= $exp[1] ?>};
                            zoom = 15;
                        <?php endif; ?>


                        var inputMap = document.getElementById('<?= sprintf('%s-%s', strtolower($reflector->getShortName()), $field['field']) ?>');
                        inputMap.value = defaultPosition.lat + ',' + defaultPosition.lng;

                        var map = new google.maps.Map(document.getElementById('map-<?= $field['field'] ?>'), {
                            center: defaultPosition,
                            zoom: zoom
                        });

                        var marker = new google.maps.Marker({
                            position: defaultPosition,
                            map: map
                        });

                        var searchInput = document.getElementById('<?= sprintf('location-search-%s', $field['field']) ?>');
                        var searchBox = new google.maps.places.SearchBox(searchInput);
                        map.controls[google.maps.ControlPosition.TOP_LEFT].push(searchInput);

                        map.addListener('click', function(event) {
                            marker.setMap(null);
                            marker = new google.maps.Marker({
                                position: {lat: event.latLng.lat(), lng: event.latLng.lng()},
                                map: map
                            })

                            inputMap.value = event.latLng.lat() + ',' + event.latLng.lng();
                        });

                        searchBox.addListener('places_changed', function() {
                            var places = searchBox.getPlaces();

                            if (places.length == 0) {
                                return;
                            }

                            var place = places[0];

                            marker.setMap(null);
                            marker = new google.maps.Marker({
                                position: place.geometry.location,
                                map: map
                            })

                            inputMap.value = place.geometry.location.lat() + ',' + place.geometry.location.lng();

                            var bounds = new google.maps.LatLngBounds();
                            if (place.geometry.viewport) {
                                // Only geocodes have viewport.
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                            map.fitBounds(bounds);
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=<?= Yii::$app->getModule('yii2-crud')->googleApiKey ?>&libraries=places&callback=initMap<?= $field['field'] ?>" async defer></script>
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
