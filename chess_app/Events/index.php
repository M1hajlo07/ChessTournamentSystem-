<?php
require_once __DIR__ . '../../core/database.php';
require_once __DIR__ . '../../core/errorcontrol.php';
require_once __DIR__ . '../../core/connection.php';
require_once __DIR__ . '../model/eventsmodel.php';

$pdo = getDB();

$model = new EventsModel($pdo);
$events = $model->getUpcomingEvents();

require 'view/eventsview.php';
?>