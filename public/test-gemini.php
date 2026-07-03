<?php
$key = 'AQ.Ab8RN6KnWpUi4OvcXjSYUJ6Becig_4-XYyYfH3EZN0cpZ0RVHQ';
$url = 'https://generativelanguage.googleapis.com/v1beta/models?key=' . $key;
$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);
$response = file_get_contents($url, false, $context);
$data = json_decode($response, true);
foreach($data['models'] as $m) {
    if(strpos($m['name'], 'flash') !== false) {
        echo $m['name'] . "\n";
    }
}
