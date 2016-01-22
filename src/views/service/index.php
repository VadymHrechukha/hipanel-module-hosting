<?php
/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

use hipanel\modules\hosting\grid\ServiceGridView;
use hipanel\widgets\ActionBox;
use hipanel\widgets\Pjax;

$this->title                    = Yii::t('hipanel/hosting', 'Services');
$this->params['breadcrumbs'][]  = $this->title;
$this->params['subtitle']       = array_filter(Yii::$app->request->get($model->formName(), [])) ? 'filtered list' : 'full list';
?>

<?php Pjax::begin(array_merge(Yii::$app->params['pjax'], ['enablePushState' => true])); ?>

<?php $box = ActionBox::begin(['model' => $model, 'dataProvider' => $dataProvider]) ?>
    <?php $box->beginActions() ?>
        <?= $box->renderCreateButton(Yii::t('app', 'Create service')) ?>
        <?= $box->renderSearchButton() ?>
        <?= $box->renderSorter([
            'attributes' => [
                'client',
                'seller',
                'name',
                'soft',
            ],
        ]) ?>
        <?= $box->renderPerPage() ?>
    <?php $box->endActions() ?>
    <?php $box->beginBulkActions() ?>
        <?= $box->renderDeleteButton() ?>
    <?php $box->endBulkActions() ?>
    <?= $box->renderSearchForm(['stateData' => $stateData, 'typeData' => $typeData]) ?>
<?php $box->end(); ?>

<?php $box->beginBulkForm() ?>
    <?= ServiceGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $model,
        'columns'      => [
            'checkbox',
            'seller_id',
            'client_id',
            'server',
            'object',
            'ip',
            'soft',
            'state',
            'actions',
        ],
    ]) ?>
<?php $box->endBulkForm() ?>
<?php Pjax::end();


