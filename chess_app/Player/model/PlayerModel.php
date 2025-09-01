<?php
require_once __DIR__ . '/../../core/database.php';

class PlayerModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }

    public function getPlayerData($userId) {
        $stmt = $this->pdo->prepare("
            SELECT u.UserName, p.number_of_matches, p.rating
            FROM User u
            JOIN Player p ON u.ID = p.player_id
            WHERE u.ID = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEventData(){
        $stmt = $this->pdo->prepare("
            SELECT e.event_id, e.location_event, e.type_event, STR_TO_DATE(e.date_event, '%m/%d/%Y') AS event_date
            FROM Event e
            ORDER BY event_date DESC
            LIMIT 20
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fillApllication($data, $eventId) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Application (number_app, user_id, event_id, status_app)
            VALUES (?, ?, ?, 'Pending')
        ");
        $stmt->execute([$data['number_app'],$data['player_id'], $eventId]);
        return $stmt->rowCount() > 0;

    }
}
