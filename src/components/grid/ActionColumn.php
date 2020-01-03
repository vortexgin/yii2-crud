<?php

namespace vortexgin\yii2\crud\components\grid;

use yii\grid\ActionColumn as BaseActionColumn;
use yii\bootstrap4\Html;

class ActionColumn extends BaseActionColumn
{

    /**
     * {@inheritDoc}
     * @var string $template
     */
    public $template = '
    <div class="dropdown groups-action text-center">
        <button class="btn btn-default" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            {view}
            {update}
            <div class="dropdown-divider"></div>
            {delete}
        </div>
    </div>
    ';

    /**
     * {@inheritDoc}
     * @var array
     */
    public $buttonOptions = [
        'class' => 'dropdown-item',
    ];

    /**
     * {@inheritDoc}
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = \Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = \Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = \Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName mr-2"]);
                return Html::a(sprintf('%s %s', $icon, $title), $url, $options);
            };
        }
    }
}