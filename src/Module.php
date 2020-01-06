<?php

namespace vortexgin\yii2\crud;

class Module extends \yii\base\Module
{

    public $googleApiKey = null;

    public $googleMapsEnable = false;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }
}