<?php
require_once __DIR__ . '/../../core/database.php';

class CommitteeModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }

    public function getCommitteeData($userId) {
        $stmt = $this->pdo->prepare("
            SELECT u.UserName, c.organization
            FROM User u
            JOIN Judge c ON u.ID = c.judge_id
            WHERE u.ID = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getApplications(){
        $stmt = $this->pdo->prepare("
            SELECT a.number_app, u.UserName, e.location_event, e.type_event, STR_TO_DATE(e.date_event, '%m/%d/%Y') AS event_date
            FROM Application a
            JOIN User u ON a.user_id = u.ID
            JOIN Event e ON a.event_id = e.event_id
            WHERE a.status_app = 'Pending'
            ORDER BY event_date DESC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateApplicationStatus($appNumber, $status) {
        $stmt = $this->pdo->prepare("
            UPDATE Application
            SET status_app = ?
            WHERE number_app = ?
        ");
        $stmt->execute([$status, $appNumber]);
        return $stmt->rowCount() > 0;
    }
}
