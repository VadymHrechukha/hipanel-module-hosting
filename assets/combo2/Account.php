<?php

namespace hipanel\modules\hosting\assets\combo2;

use hipanel\widgets\Combo2Config;
use yii\helpers\ArrayHelper;

/**
 * Class Account
 */
class Account extends Combo2Config
{
    /** @inheritdoc */
    public $type = 'account';

    /** @inheritdoc */
    public $_primaryFilter = 'login_like';

    /** @inheritdoc */
    public $url = '/hosting/account/search';

    public $_return = ['id', 'client', 'client_id', 'device', 'device_id'];

    public $_rename = ['text' => 'login'];

    public $_filter = [
        'client' => 'client',
        'server' => 'server'
    ];

    /** @inheritdoc */
    function getConfig ($config = []) {
        $config = ArrayHelper::merge([
            'clearWhen'     => ['client', 'server'],
            'affects'       => [
                'client' => 'client',
                'server' => 'device'
            ]
        ], $config);

        return parent::getConfig($config);
    }
}