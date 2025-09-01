<?php
class PlayersModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getTopPlayers($limit = 20)
    {
        $stmt = $this->db->prepare("SELECT u.FirstName, u.LastName, p.rating FROM player p INNER JOIN user u ON p.player_id = u.ID ORDER BY p.rating DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
