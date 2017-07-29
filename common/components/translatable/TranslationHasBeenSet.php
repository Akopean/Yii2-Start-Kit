<?php

namespace common\components\translatable;

use yii\base\Model;

class TranslationHasBeenSet
{
    /** @var HasTranslations */
    public $model;

    /** @var string */
    public $key;

    /** @var string */
    public $locale;

    public $oldValue;
    public $newValue;

    public function __construct(Model $model, string $key, string $locale, $oldValue, $newValue)
    {
        $this->model = $model;

        $this->attributeName = $key;

        $this->locale = $locale;

        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
}
