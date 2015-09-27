<?php
/**
 * @author Labuta Ruslan
 */
//Path aliases
Yii::setAlias('@frontend', realpath(__DIR__.'/../../mobfrontend'));
// Url Aliases
Yii::setAlias('@frontendUrl', getenv('MOB_FRONTEND_URL'));