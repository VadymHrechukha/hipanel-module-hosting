<?php
/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\modules\hosting\models;

use Yii;

class Request extends \hipanel\base\Model
{

    use \hipanel\base\ModelTrait;

    /** @inheritdoc */
    public function rules () {
        return [
            [['id', 'object_id', 'service_id', 'client_id', 'account_id', 'server_id'], 'integer'],
            [['realm', 'object', 'service', 'client', 'account', 'server'],             'safe'],
            [['type', 'type_label', 'state', 'state_label'],                            'safe'],
            [['tries_left', 'pid', 'time_lag'],                                         'integer'],
            [['object_name'],                                                           'safe'],
            [['time'],                                                                  'date'],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels () {
        return $this->mergeAttributeLabels([
            'object_name'           => Yii::t('app', 'Object Name'),
            'tries_left'            => Yii::t('app', 'Tries left'),
            'time_lag'              => Yii::t('app', 'Time lag'),
        ]);
    }
}
