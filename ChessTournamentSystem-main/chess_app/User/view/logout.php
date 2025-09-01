<?php
require_once __DIR__ . '../../../core/session.php';
Session::start();
Session::destroy();
header("Location: login.php");
exit;
