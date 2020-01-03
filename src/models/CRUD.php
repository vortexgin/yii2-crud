<?php

namespace vortexgin\yii2\crud\models;

use yii\base\Component;

class CRUD extends Component
{

    const FIELD_TYPE_TEXT = 'text';
    const FIELD_TYPE_EMAIL = 'email';
    const FIELD_TYPE_PASSWORD = 'password';
    const FIELD_TYPE_NUMBER = 'number';
    const FIELD_TYPE_HIDDEN = 'hidden';
    const FIELD_TYPE_FILE = 'file';
    const FIELD_TYPE_CHECKBOX = 'checkbox';
    const FIELD_TYPE_RADIO = 'radio';
    const FIELD_TYPE_SELECT = 'select';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_RICHTEXT = 'richtext';

}