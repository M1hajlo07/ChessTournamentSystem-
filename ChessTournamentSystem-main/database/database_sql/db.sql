CREATE TABLE User (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    UserName VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    DataR VARCHAR(50) NOT NULL
);


CREATE TABLE Player (
    player_id INT PRIMARY KEY,
    number_of_matches INT NOT NULL DEFAULT 0,
    rating INT NOT NULL DEFAULT 0,
    FOREIGN KEY (player_id) REFERENCES User(ID)
);


CREATE TABLE Mentor (
    mentor_id INT PRIMARY KEY,
    club VARCHAR(100) NOT NULL,
    FOREIGN KEY (mentor_id) REFERENCES User(ID)
);


CREATE TABLE Judge (
    judge_id INT PRIMARY KEY,
    organization VARCHAR(100) NOT NULL,
    FOREIGN KEY (judge_id) REFERENCES User(ID)
);


CREATE TABLE Comittee (
    comittee_id INT PRIMARY KEY AUTO_INCREMENT
);


CREATE TABLE Event (
    event_id INT PRIMARY KEY AUTO_INCREMENT,
    date_event VARCHAR(20) NOT NULL,
    location_event VARCHAR(100) NOT NULL,
    number_of_participants INT NOT NULL DEFAULT 0,
    comittee_id INT,
    type_event VARCHAR(50) NOT NULL,
    FOREIGN KEY (comittee_id) REFERENCES Comittee(comittee_id)
);


CREATE TABLE Participation (
    participation_id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    player_id INT,
    mentor_id INT,
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (player_id) REFERENCES Player(player_id),
    FOREIGN KEY (mentor_id) REFERENCES Mentor(mentor_id)
);


CREATE TABLE Judge_Comittee (
    judge_committee_id INT PRIMARY KEY AUTO_INCREMENT,
    judge_id INT,
    comittee_id INT,
    FOREIGN KEY (judge_id) REFERENCES Judge(judge_id),
    FOREIGN KEY (comittee_id) REFERENCES Comittee(comittee_id)
);


CREATE TABLE Application (
    application_id INT PRIMARY KEY AUTO_INCREMENT,
    number_app VARCHAR(50) NOT NULL,
    user_id INT,
    event_id INT,
    status_app VARCHAR(20) NOT NULL DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES User(ID),
    FOREIGN KEY (event_id) REFERENCES Event(event_id)
);

CREATE TABLE Matches (
    match_id INT PRIMARY KEY AUTO_INCREMENT,
    player1_id INT,
    player2_id INT,
    judge_id INT,
    status_match VARCHAR(20) NOT NULL,
    phase VARCHAR(20) NOT NULL,
    number_of_moves INT NOT NULL DEFAULT 0,
    event_id INT,
    winner_id INT,
    FOREIGN KEY (player1_id) REFERENCES Player(player_id),
    FOREIGN KEY (player2_id) REFERENCES Player(player_id),
    FOREIGN KEY (judge_id) REFERENCES Judge(judge_id),
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (winner_id) REFERENCES Player(player_id)
);

CREATE TABLE Preparation (
	prep_id INT PRIMARY KEY,
    player_id INT,
    event_id INT,
    mentor_id INT,
    type_p VARCHAR(20) NOT NULL,
    FOREIGN KEY (player_id) REFERENCES Player(player_id),
    FOREIGN KEY (event_id) REFERENCES Event(event_id),
    FOREIGN KEY (mentor_id) REFERENCES Mentor(mentor_id)
);


