<?php declare(strict_types=1);

namespace hipanel\modules\hosting\models;

use hipanel\modules\hosting\models\query\BlacklistQuery;

class Blacklisted extends \hipanel\base\Model
{
    public function rules(): array
    {
        return [
            [['name', 'type'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     * @return BlacklistQuery
     */
    public static function find($options = [])
    {
        return new BlacklistQuery(get_called_class(), [
            'options' => $options,
        ]);
    }
}