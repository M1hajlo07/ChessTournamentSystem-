<?php

class MentorsModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getTopMentors($limit = 10) {
        $stmt = $this->pdo->prepare("SELECT u.FirstName, u.LastName, COUNT(DISTINCT pl.player_id) AS br_igraci
                                    FROM Mentor m
                                    JOIN User u ON m.mentor_id = u.ID
                                    JOIN Participation p ON m.mentor_id = p.mentor_id
                                    JOIN Player pl ON p.player_id = pl.player_id
                                    JOIN Matches mc ON mc.winner_id = pl.player_id
                                    WHERE mc.phase IN (\"Finale\" ,\"Polufinale\")
                                    GROUP BY m.mentor_id
                                    ORDER BY br_igraci DESC
                                    LIMIT :limit;");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}