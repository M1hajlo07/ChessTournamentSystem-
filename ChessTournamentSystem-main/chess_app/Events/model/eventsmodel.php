<?php

class EventsModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUpcomingEvents() {
    $stmt = $this->pdo->prepare("
        SELECT 
            str_to_date(date_event, '%m/%d/%Y') as event_date, 
            location_event, 
            type_event
        FROM event 
        WHERE str_to_date(date_event, '%m/%d/%Y') >= '2024-01-01'
        ORDER BY event_date DESC
        LIMIT 20
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}