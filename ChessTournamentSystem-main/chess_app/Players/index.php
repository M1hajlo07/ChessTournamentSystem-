<?php
require_once __DIR__ . '../../core/database.php';
require_once __DIR__ . '../../core/errorcontrol.php';
require_once __DIR__ . '../../core/connection.php';
require_once __DIR__ . '../model/playersmodel.php';  

$pdo = getDB();

$model = new PlayersModel($pdo);
$players = $model->getTopPlayers(20);

require 'view/playersview.php';
