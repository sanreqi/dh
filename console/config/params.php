<?php
$params = array_merge(
    require __DIR__ . '/params-local.php',
    require __DIR__ . '/../../common/config/permissions.php'
);

return $params;

