<?php declare(strict_types=1);

namespace hipanel\modules\hosting\validators;

use hipanel\modules\hosting\models\Blacklisted;
use hiqdev\hiart\ResponseErrorException;
use yii\validators\Validator;

class BlacklistValidator extends Validator
{
    public function validateAttribute($model, $attribute): void
    {
        $value = strtolower($model->$attribute);
        $query = Blacklisted::find()
            ->check('domain', $value);

        try {
            $query->exists();
        } catch (ResponseErrorException $e) {
            $this->addError($model, $attribute, 'The value "{value}" is blacklisted.', ['value' => $model->$attribute]);
        }
    }
}