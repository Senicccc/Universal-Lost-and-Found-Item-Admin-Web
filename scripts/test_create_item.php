<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $item = new App\Models\Item();
    $item->user_id = 16;
    $item->title = 'CLI Test Fan';
    $item->description = 'Created via CLI test script';
    $item->city = 'Jakarta';
    $item->province = 'DKI Jakarta';
    $item->address = 'Test Address';
    $item->image_url = '/storage/images/item4.jpg';
    $item->status = 'unclaimed';
    $item->save();
    echo "created item id: {$item->id}\n";
} catch (Exception $e) {
    echo "error: " . $e->getMessage() . "\n";
}

$found = App\Models\Item::where('title','CLI Test Fan')->first();
if ($found) {
    echo "found item via query: {$found->id} - {$found->title}\n";
} else {
    echo "item not found after insertion\n";
}
