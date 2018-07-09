<?php
use App\Http\Controllers\BotManController;


$botman = resolve('botman');
$botman->hears('/izinslack {var}', BotManController::class . '@izinSlack');
$botman->hears('/izinweb {var}', BotManController::class . '@izinWeb');