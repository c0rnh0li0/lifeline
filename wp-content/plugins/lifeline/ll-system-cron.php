<?php

// $dir = 'E:/wamp64/www/tepperefka';

include_once 'wp-load.php';

require 'wp-content/plugins/lifeline/vendor/autoload.php';

set_time_limit(0);

$ll_sync = new \Lifeline\Controller\LifelineSync();

$ll_sync->sync($ll_sync::SYNC_TYPE_CRON);