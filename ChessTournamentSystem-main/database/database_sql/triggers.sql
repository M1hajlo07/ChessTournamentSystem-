DELIMITER $$

CREATE TRIGGER trg_update_event_participant_count
AFTER INSERT ON Participation
FOR EACH ROW
BEGIN
    UPDATE Event
    SET number_of_participants = number_of_participants + 1
    WHERE event_id = NEW.event_id;
END$$

DELIMITER ;