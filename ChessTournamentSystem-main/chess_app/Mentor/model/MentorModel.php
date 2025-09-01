<?php
require_once __DIR__ . '/../../core/database.php';

class MentorModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getDB();
    }

    public function getMentorData($userId) {
        $stmt = $this->pdo->prepare("
            SELECT u.UserName, m.club
            FROM User u
            JOIN Mentor m ON u.ID = m.mentor_id
            WHERE u.ID = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEventsWithPlayers($mentorId){
        $stmt = $this->pdo->prepare("
            SELECT 
                e.event_id, 
                e.location_event, 
                e.type_event, 
                STR_TO_DATE(e.date_event, '%m/%d/%Y') AS event_date,
                p.player_id,
                u.UserName as player_name
            FROM Event e
            JOIN Participation p ON e.event_id = p.event_id
            JOIN User u ON p.player_id = u.ID
            WHERE p.mentor_id = ?
            ORDER BY event_date DESC
        ");
        $stmt->execute([$mentorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPreparation($data){
        $stmt = $this->pdo->prepare("
            INSERT INTO Preparation (prep_id, player_id, event_id, mentor_id, type_p)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['preparation_id'], 
            $data['player_id'], 
            $data['event_id'],  
            $data['mentor_id'], 
            $data['description']
        ]);
        return $stmt->rowCount() > 0;
    }
}
