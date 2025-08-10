<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

echo "=== PRODUCTS TABLE STRUCTURE ===\n";
$columns = Schema::getColumnListing('products');
foreach ($columns as $column) {
    $type = DB::getSchemaBuilder()->getColumnType('products', $column);
    echo "Column: {$column} - Type: {$type}\n";
} 