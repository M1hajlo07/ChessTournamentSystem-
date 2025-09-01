
INSERT INTO Application (number_app, user_id, event_id, status_app)
SELECT CONCAT('AUTO_', m.player1_id), m.player1_id, m.event_id, 'Aktiven'
FROM Matches m
JOIN Player p ON m.player1_id = p.player_id
LEFT JOIN Application a ON a.user_id = m.player1_id AND a.event_id = m.event_id
WHERE a.application_id IS NULL;

INSERT INTO Application (number_app, user_id, event_id, status_app)
SELECT CONCAT('AUTO_', m.player2_id), m.player2_id, m.event_id, 'Aktiven'
FROM Matches m
JOIN Player p ON m.player2_id = p.player_id
LEFT JOIN Application a ON a.user_id = m.player2_id AND a.event_id = m.event_id
WHERE a.application_id IS NULL;


INSERT INTO Application (number_app, user_id, event_id, status_app)
SELECT CONCAT('AUTO_', m.judge_id), m.judge_id, m.event_id, 'Aktiven'
FROM Matches m
JOIN Judge j ON m.judge_id = j.judge_id
LEFT JOIN Application a ON a.user_id = m.judge_id AND a.event_id = m.event_id
WHERE a.application_id IS NULL;
