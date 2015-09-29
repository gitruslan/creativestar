<?php
// Path aliases
Yii::setAlias('@base', realpath(__DIR__.'/../../'));
Yii::setAlias('@common', realpath(__DIR__.'/../../common'));
Yii::setAlias('@backend', realpath(__DIR__.'/../../backend'));
Yii::setAlias('@frontend', realpath(__DIR__.'/../../frontend'));
Yii::setAlias('@mobile', realpath(__DIR__.'/../../mobile'));
Yii::setAlias('@console', realpath(__DIR__.'/../../console'));
Yii::setAlias('@storage', realpath(__DIR__.'/../../storage'));
Yii::setAlias('@tests', realpath(__DIR__.'/../../tests'));

// Url Aliases
Yii::setAlias('@backendUrl', getenv('BACKEND_URL'));
Yii::setAlias('@mobileUrl', getenv('MOB_FRONTEND_URL'));
Yii::setAlias('@storageUrl', getenv('STORAGE_URL'));
Yii::setAlias('@frontendUrl', getenv('FRONTEND_URL'));
