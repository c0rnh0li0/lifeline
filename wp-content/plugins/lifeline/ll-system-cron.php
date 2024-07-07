<?php

include_once ABSPATH . 'wp-load.php';

require ABSPATH . 'wp-content/plugins/lifeline/vendor/autoload.php';

set_time_limit(0);

$ll_sync = new \Lifeline\Controller\LifelineSync();

$ll_sync->sync(isset($sync_type) ? $sync_type : $ll_sync::SYNC_TYPE_CRON);