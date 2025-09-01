SELECT p.player_id, u.FirstName, COUNT(m.winner_id) AS wins
FROM Player p
JOIN User u ON p.player_id = u.ID
LEFT JOIN Matches m ON p.player_id = m.winner_id
GROUP BY p.player_id, u.FirstName;

SELECT j.judge_id, avg(m.number_of_moves) AS AVG_moves
FROM Judge j
JOIN Matches m ON j.judge_id = m.judge_id
WHERE m.phase = "Finale"
GROUP BY j.judge_id;

SELECT m.mentor_id, COUNT(DISTINCT pl.player_id) AS br_igraci
FROM Mentor m
JOIN Participation p ON m.mentor_id = p.mentor_id
JOIN Player pl ON p.player_id = pl.player_id
JOIN Matches mc ON mc.winner_id = pl.player_id
WHERE mc.phase IN ("Finale" ,"Polufinale")
GROUP BY m.mentor_id
ORDER BY br_igraci DESC
LIMIT 10;

SELECT 
    YEAR(STR_TO_DATE(e.date_event, '%m/%d/%Y')) AS year,
    COUNT(DISTINCT e.event_id) AS broj_na_nastani,
    ROUND(COUNT(m.match_id) / COUNT(DISTINCT e.event_id), 2) AS prosecno_natprevari_po_nastan
FROM Event e
LEFT JOIN Matches m ON e.event_id = m.event_id
GROUP BY YEAR(STR_TO_DATE(e.date_event, '%m/%d/%Y'))
ORDER BY year;


