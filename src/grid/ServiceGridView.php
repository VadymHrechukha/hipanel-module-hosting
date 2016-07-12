<?php

/*
 * Hosting Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-hosting
 * @package   hipanel-module-hosting
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

namespace hipanel\modules\hosting\grid;

use hipanel\grid\ActionColumn;
use hipanel\grid\MainColumn;
use hipanel\grid\RefColumn;
use hipanel\modules\hosting\models\DbSearch;
use hipanel\modules\hosting\models\HdomainSearch;
use hipanel\modules\hosting\models\Service;
use hipanel\modules\hosting\models\Soft;
use hipanel\modules\server\grid\ServerColumn;
use hipanel\widgets\ArraySpoiler;
use hipanel\widgets\State;
use Yii;
use yii\base\InvalidParamException;
use yii\bootstrap\Button;
use yii\helpers\Html;

class ServiceGridView extends \hipanel\grid\BoxedGridView
{
    public static function defaultColumns()
    {
        return [
            'service' => [
                'class' => MainColumn::class,
                'attribute' => 'name',
                'filterAttribute' => 'service_like',
            ],
            'server' => [
                'class' => ServerColumn::class,
            ],
            'object' => [
                'format' => 'raw',
                'header' => Yii::t('hipanel/hosting', 'Object'),
                'value' => function ($model) {
                    $html = $model->name;
                    if ($model->objects_count > 0) {
                        $html .= ' ';
                        if ($model->soft_type === Soft::TYPE_DB) {
                            $html .= Html::a(
                                Yii::t('hipanel/hosting', '{0, plural, one{# DB} other{# DBs}}', $model->objects_count),
                                ['@db', (new DbSearch)->formName() => ['server' => $model->server, 'service' => $model->name]],
                                ['class' => 'btn btn-default btn-xs']
                            );
                        } elseif ($model->soft_type === Soft::TYPE_WEB) {
                            $html .= Html::a(
                                Yii::t('hipanel/hosting', '{0, plural, one{# domain} other{# domains}}', $model->objects_count),
                                ['@hdomain', (new HdomainSearch)->formName() => ['server' => $model->server, 'service' => $model->name]],
                                ['class' => 'btn btn-default btn-xs']
                            );
                        } else {
                            throw new InvalidParamException('The object type is not supported', $model);
                        }
                    }

                    return $html;
                },
            ],
            'ip' => [
                'format' => 'raw',
                'label' => Yii::t('hipanel/hosting', 'IP'),
                'value' => function ($model) {
                    return ArraySpoiler::widget(['data' => array_unique(array_merge((array)$model->ip, (array)$model->ips))]);
                },
            ],
            'bin' => [
                'format' => 'html',
                'value' => function ($model) {
                    return $model->bin ? Html::tag('code', $model->bin) : '';
                }
            ],
            'etc' => [
                'format' => 'html',
                'value' => function ($model) {
                    return $model->etc ? Html::tag('code', $model->etc) : '';
                }
            ],
            'soft' => [
                'value' => function ($model) {
                    return $model->soft;
                }
            ],
            'state' => [
                'class' => RefColumn::class,
                'i18nDictionary' => 'hipanel/hosting',
                'format' => 'raw',
                'value' => function ($model) {
                    return State::widget(compact('model'));
                },
                'gtype' => 'state,service',
            ],
            'actions' => [
                'class' => ActionColumn::class,
                'template' => '{view}',
                'header' => Yii::t('hipanel/hosting', 'Actions'),
            ],
        ];
    }
}
