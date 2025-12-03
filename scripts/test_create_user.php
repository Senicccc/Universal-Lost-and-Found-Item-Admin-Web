<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $u = new App\Models\User();
    $u->name = 'cli-test-2';
    $u->email = 'cli-test-2@example.com';
    $u->password = password_hash('password', PASSWORD_BCRYPT);
    $u->save();
    echo "created user id: {$u->id}\n";
} catch (Exception $e) {
    echo "error: " . $e->getMessage() . "\n";
}

$found = App\Models\User::where('email','cli-test-2@example.com')->first();
if ($found) {
    echo "found user via query: {$found->id} - {$found->email}\n";
} else {
    echo "user not found after insertion\n";
}
