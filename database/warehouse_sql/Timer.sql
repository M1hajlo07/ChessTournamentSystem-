USE chess_warehouse;

CREATE TABLE IF NOT EXISTS dw_load_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    table_name VARCHAR(100) UNIQUE NOT NULL,
    last_load_timestamp DATETIME NOT NULL
);


INSERT INTO dw_load_status (table_name, last_load_timestamp)
VALUES ('Fact_Match', '1970-01-01 00:00:00')
ON DUPLICATE KEY UPDATE last_load_timestamp = VALUES(last_load_timestamp);