
INSERT INTO User_JSON (user_id, user_data)
SELECT
    ID,
    JSON_OBJECT(
        'ID', ID,
        'FirstName', FirstName,
        'LastName', LastName,
        'UserName', UserName,
        'Password', Password,
        'DataR', DataR
    )
FROM User;

INSERT INTO Player_JSON (player_id, player_data)
SELECT
    player_id,
    JSON_OBJECT(
        'player_id', player_id,
        'number_of_matches', number_of_matches,
        'rating', rating
    )
FROM Player;

INSERT INTO Mentor_JSON (mentor_id, mentor_data)
SELECT
    mentor_id,
    JSON_OBJECT(
        'mentor_id', mentor_id,
        'club', club
    )
FROM Mentor;

INSERT INTO Judge_JSON (judge_id, judge_data)
SELECT
    judge_id,
    JSON_OBJECT(
        'judge_id', judge_id,
        'organization', organization
    )
FROM Judge;

INSERT INTO Comittee_JSON (comittee_id, comittee_data)
SELECT
    comittee_id,
    JSON_OBJECT(
        'comittee_id', comittee_id
    )
FROM Comittee;

INSERT INTO Event_JSON (event_id, event_data)
SELECT
    event_id,
    JSON_OBJECT(
        'event_id', event_id,
        'date_event', date_event,
        'location_event', location_event,
        'number_of_participants', number_of_participants,
        'comittee_id', comittee_id,
        'type_event', type_event
    )
FROM Event;

INSERT INTO Participation_JSON (participation_id, participation_data)
SELECT
    participation_id,
    JSON_OBJECT(
        'participation_id', participation_id,
        'event_id', event_id,
        'player_id', player_id,
        'mentor_id', mentor_id
    )
FROM Participation;

INSERT INTO Judge_Comittee_JSON (judge_committee_id, judge_committee_data)
SELECT
    judge_committee_id,
    JSON_OBJECT(
        'judge_committee_id', judge_committee_id,
        'judge_id', judge_id,
        'comittee_id', comittee_id
    )
FROM Judge_Comittee;

INSERT INTO Application_JSON (application_id, application_data)
SELECT
    application_id,
    JSON_OBJECT(
        'application_id', application_id,
        'number_app', number_app,
        'user_id', user_id,
        'event_id', event_id,
        'status_app', status_app
    )
FROM Application;

INSERT INTO Matches_JSON (match_id, match_data)
SELECT
    match_id,
    JSON_OBJECT(
        'match_id', match_id,
        'player1_id', player1_id,
        'player2_id', player2_id,
        'judge_id', judge_id,
        'status_match', status_match,
        'phase', phase,
        'number_of_moves', number_of_moves,
        'event_id', event_id,
        'winner_id', winner_id
    )
FROM Matches;

INSERT INTO Preparation_JSON (prep_id, preparation_data)
SELECT
    prep_id,
    JSON_OBJECT(
        'prep_id', prep_id,
        'player_id', player_id,
        'event_id', event_id,
        'mentor_id', mentor_id,
        'type_p', type_p
    )
FROM Preparation;

