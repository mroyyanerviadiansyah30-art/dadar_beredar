<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

foreach(DB::select('SHOW TABLES') as $t) {
    $tbl = array_values((array)$t)[0];
    echo $tbl . ': ' . DB::table($tbl)->count() . PHP_EOL;
}
