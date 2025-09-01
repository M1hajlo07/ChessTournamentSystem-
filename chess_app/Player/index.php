<?php
require_once __DIR__ . '/../core/session.php';
require_once __DIR__ . '/../core/database.php';
Session::start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'player') {
    header("Location: ../user/login.php");
    exit;
}

require_once __DIR__ . '/model/PlayerModel.php';

$model = new PlayerModel();
$userId = $_SESSION['user_id'];

$playerData = $model->getPlayerData($userId);
$eventList = $model->getEventData();

$applicationSuccess = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number_app = trim($_POST['number_app']);
    $selected_event = $_POST['event_id'];

    if (!empty($selected_event) && !empty($number_app)) {
        $data = [
            'number_app' => $number_app,
            'player_id' => $userId
        ];
        $applicationSuccess = $model->fillApllication($data, $selected_event);
    } else {
        $applicationSuccess = false;
    }
}

require_once __DIR__ . '/view/dashboard.php';
