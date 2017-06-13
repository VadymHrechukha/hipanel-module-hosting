<?php

use hipanel\widgets\BulkOperation;

echo BulkOperation::widget([
    'model' => $model,
    'models' => $models,
    'scenario' => 'disable-block',
    'affectedObjects' => Yii::t('hipanel:hosting', 'Affected accounts'),
    'formatterField' => 'login',
    'hiddenInputs' => ['id', 'login'],
    'visibleInputs' => ['comment'],
    'submitButton' => Yii::t('hipanel', 'Disable block'),
    'submitButtonOptions' => ['class' => 'btn btn-danger'],
    'dropDownInputs' => ['type' => $blockReasons ],
]);

