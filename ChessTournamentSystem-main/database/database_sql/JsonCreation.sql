
CREATE TABLE User_JSON (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_data JSON NOT NULL
);


CREATE TABLE Player_JSON (
    player_id INT PRIMARY KEY AUTO_INCREMENT,
    player_data JSON NOT NULL
);


CREATE TABLE Mentor_JSON (
    mentor_id INT PRIMARY KEY AUTO_INCREMENT,
    mentor_data JSON NOT NULL
);


CREATE TABLE Judge_JSON (
    judge_id INT PRIMARY KEY AUTO_INCREMENT,
    judge_data JSON NOT NULL
);


CREATE TABLE Comittee_JSON (
    comittee_id INT PRIMARY KEY AUTO_INCREMENT,
    comittee_data JSON NOT NULL
);


CREATE TABLE Event_JSON (
    event_id INT PRIMARY KEY AUTO_INCREMENT,
    event_data JSON NOT NULL
);


CREATE TABLE Participation_JSON (
    participation_id INT PRIMARY KEY AUTO_INCREMENT,
    participation_data JSON NOT NULL
);


CREATE TABLE Judge_Comittee_JSON (
    judge_committee_id INT PRIMARY KEY AUTO_INCREMENT,
    judge_committee_data JSON NOT NULL
);


CREATE TABLE Application_JSON (
    application_id INT PRIMARY KEY AUTO_INCREMENT,
    application_data JSON NOT NULL
);


CREATE TABLE Matches_JSON (
    match_id INT PRIMARY KEY AUTO_INCREMENT,
    match_data JSON NOT NULL
);


CREATE TABLE Preparation_JSON (
    prep_id INT PRIMARY KEY AUTO_INCREMENT,
    preparation_data JSON NOT NULL
);