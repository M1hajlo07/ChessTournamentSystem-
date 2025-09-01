CREATE DATABASE IF NOT EXISTS chess_warehouse;
USE chess_warehouse;

CREATE TABLE Dim_Player (
    player_key INT PRIMARY KEY AUTO_INCREMENT,
    player_id INT UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    rating INT
);

CREATE TABLE Dim_Mentor (
    mentor_key INT PRIMARY KEY AUTO_INCREMENT,
    mentor_id INT UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    club VARCHAR(100)
);

CREATE TABLE Dim_Judge (
    judge_key INT PRIMARY KEY AUTO_INCREMENT,
    judge_id INT UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    organization VARCHAR(100)
);

CREATE TABLE Dim_Event (
    event_key INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT UNIQUE NOT NULL,
    event_name VARCHAR(255),
    event_type VARCHAR(50) NOT NULL,
    event_date VARCHAR(20) NOT NULL,
    event_location VARCHAR(100) NOT NULL
);

CREATE TABLE Fact_Match (
    match_fact_key INT PRIMARY KEY AUTO_INCREMENT,
    match_id INT UNIQUE NOT NULL,
    event_key INT NOT NULL,
    judge_key INT,
    player1_key INT,
    player2_key INT,
    winner_key INT,
    winning_player_mentor_key INT,
    number_of_moves INT NOT NULL,
    match_phase VARCHAR(20) NOT NULL,
    is_final_or_semifinal BOOLEAN NOT NULL DEFAULT FALSE,
    is_winner_flag BOOLEAN NOT NULL DEFAULT FALSE,
    match_date DATE,
    FOREIGN KEY (event_key) REFERENCES Dim_Event(event_key),
    FOREIGN KEY (judge_key) REFERENCES Dim_Judge(judge_key),
    FOREIGN KEY (player1_key) REFERENCES Dim_Player(player_key),
    FOREIGN KEY (player2_key) REFERENCES Dim_Player(player_key),
    FOREIGN KEY (winner_key) REFERENCES Dim_Player(player_key),
    FOREIGN KEY (winning_player_mentor_key) REFERENCES Dim_Mentor(mentor_key)
);

INSERT INTO Dim_Player (player_id, first_name, last_name, username, rating)
SELECT
    p.player_id,
    u.FirstName,
    u.LastName,
    u.UserName,
    p.rating
FROM
    chess_tournament.Player p
JOIN
    chess_tournament.User u ON p.player_id = u.ID;

INSERT INTO Dim_Mentor (mentor_id, full_name, club)
SELECT
    m.mentor_id,
    CONCAT(u.FirstName, ' ', u.LastName),
    m.club
FROM
    chess_tournament.Mentor m
JOIN
    chess_tournament.User u ON m.mentor_id = u.ID;

INSERT INTO Dim_Judge (judge_id, full_name, organization)
SELECT
    j.judge_id,
    CONCAT(u.FirstName, ' ', u.LastName),
    j.organization
FROM
    chess_tournament.Judge j
JOIN
    chess_tournament.User u ON j.judge_id = u.ID;

INSERT INTO Dim_Event (event_id, event_type, event_location, event_date)
SELECT
    e.event_id,
    e.type_event,
    e.location_event,
    e.date_event
FROM
    chess_tournament.Event e;

INSERT INTO Fact_Match (
    match_id,
    event_key,
    judge_key,
    player1_key,
    player2_key,
    winner_key,
    winning_player_mentor_key,
    number_of_moves,
    match_phase,
    is_final_or_semifinal,
    is_winner_flag,
    match_date
)
SELECT
    m.match_id,
    de.event_key,
    dj.judge_key,
    dp1.player_key,
    dp2.player_key,
    dpw.player_key,
    COALESCE(dpm.mentor_key, NULL) AS winning_player_mentor_key,
    m.number_of_moves,
    m.phase AS match_phase,
    CASE WHEN m.phase IN ('Finale', 'Polufinale') THEN TRUE ELSE FALSE END AS is_final_or_semifinal,
    CASE WHEN m.winner_id IS NOT NULL THEN TRUE ELSE FALSE END AS is_winner_flag,
    STR_TO_DATE(oe.date_event, '%m/%d/%Y') AS match_date
FROM
    chess_tournament.Matches m
LEFT JOIN
    chess_tournament.Event oe ON m.event_id = oe.event_id
LEFT JOIN
    Dim_Event de ON m.event_id = de.event_id
LEFT JOIN
    Dim_Judge dj ON m.judge_id = dj.judge_id
LEFT JOIN
    Dim_Player dp1 ON m.player1_id = dp1.player_id
LEFT JOIN
    Dim_Player dp2 ON m.player2_id = dp2.player_id
LEFT JOIN
    Dim_Player dpw ON m.winner_id = dpw.player_id
LEFT JOIN
    chess_tournament.Participation op_winner ON m.winner_id = op_winner.player_id AND m.event_id = op_winner.event_id
LEFT JOIN
    Dim_Mentor dpm ON op_winner.mentor_id = dpm.mentor_id;
