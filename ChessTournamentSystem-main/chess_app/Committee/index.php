<?php
require_once __DIR__ . '/../core/session.php';
require_once __DIR__ . '/../core/database.php';
Session::start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'committee') {
    header("Location: ../user/login.php");
    exit;
}

require_once __DIR__ . '/model/CommitteeModel.php';

$model = new CommitteeModel();
$userId = $_SESSION['user_id'];

$committeeData = $model->getCommitteeData($userId);

$validationSuccess = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['validate'])) {
    $appNumber = $_POST['app_number'];
    $status = 'Approved';
    $success = $model->updateApplicationStatus($appNumber, $status);
    $validationSuccess = $success;
}

$applications = $model->getApplications();

include __DIR__ . '/view/dashboard.php';
