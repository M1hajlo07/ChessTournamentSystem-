SET SQL_SAFE_UPDATES = 0;

UPDATE Event e
SET number_of_participants = (
    SELECT COUNT(*) 
    FROM Participation p 
    WHERE p.event_id = e.event_id
);

SET SQL_SAFE_UPDATES = 1;
