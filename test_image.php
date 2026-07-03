<?php
require 'vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

try {
    $manager = new ImageManager(new Driver());
    echo 'Success Intervention Image ' . get_class($manager);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
