<?php declare(strict_types=1);

namespace hipanel\modules\hosting\models\query;

use hiqdev\hiart\ActiveQuery;

class BlacklistQuery extends ActiveQuery
{
    public function check(string $type, string $value): self
    {
        return $this->action('check')
            ->andFilterWhere(['type' => $type])
            ->andFilterWhere(['name' => $value]);
    }
}