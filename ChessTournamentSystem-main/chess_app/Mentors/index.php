<?php
require_once __DIR__ . '../../core/database.php';
require_once __DIR__ . '../../core/errorcontrol.php';
require_once __DIR__ . '../../core/connection.php';
require_once __DIR__ . '../model/mentorsmodel.php';

$pdo = getDB();

$model = new MentorsModel($pdo);
$mentors = $model->getTopMentors(10);

require 'view/mentorsview.php';