<?php
require_once __DIR__ . '/../core/session.php';
require_once __DIR__ . '/../core/database.php';
Session::start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'mentor') {
    header("Location: ../user/login.php");
    exit;
}

require_once __DIR__ . '/model/MentorModel.php';

$model = new MentorModel();
$userId = $_SESSION['user_id'];

$mentorData = $model->getMentorData($userId);
$eventsWithPlayers = $model->getEventsWithPlayers($userId);

$prepSuccess = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $preparation_id = trim($_POST['preparation_id']);
    $event_id = $_POST['event_id'];
    $player_id = $_POST['player_id'];
    $description = trim($_POST['description']);

    if (!empty($event_id) && !empty($player_id) && !empty($description)) {
        $data = [
            'preparation_id' => $preparation_id,
            'player_id' => $player_id,
            'event_id' => $event_id,
            'mentor_id' => $userId,
            'description' => $description
        ];
        $prepSuccess = $model->createPreparation($data);
    } else {
        $prepSuccess = false;
    }
}

include __DIR__ . '/view/dashboard.php';
