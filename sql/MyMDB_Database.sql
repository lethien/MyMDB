-- Drop if Lab08 database exist
DROP DATABASE IF EXISTS MyMDB;

-- Create database Lab08
CREATE DATABASE MyMDB;

-- Use database Lab08
USE MyMDB;

/*
+----------+------------------+------+-----+---------+----------------+
| Field    | Type             | Null | Key | Default | Extra          |
+----------+------------------+------+-----+---------+----------------+
| UserID   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| UserName | char(50)         | NO   | UNI | NULL    |                |
| Password | text             | NO   |     | NULL    |                |
| Email    | char(50)         | NO   |     | NULL    |                |
+----------+------------------+------+-----+---------+----------------+
*/
-- Create User table
CREATE TABLE User
( 
    UserID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    UserName CHAR(50) NOT NULL,
    Password TEXT NOT NULL,
    Email CHAR(50) NOT NULL,
    PRIMARY KEY (UserID),
    UNIQUE KEY(UserName)
);

/*
+-------------+------------------+------+-----+---------+----------------+
| Field       | Type             | Null | Key | Default | Extra          |
+-------------+------------------+------+-----+---------+----------------+
| MovieID     | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| Title       | char(50)         | NO   | UNI | NULL    |                |
| Poster      | char(255)        | NO   |     | NULL    |                |
| PlotSummary | text             | NO   |     | NULL    |                |
| Runtime     | int(11)          | NO   |     | NULL    |                |
| Genres      | text             | NO   |     | NULL    |                |
| Crew        | text             | NO   |     | NULL    |                |
| Directors   | text             | NO   |     | NULL    |                |
| Awards      | text             | NO   |     | NULL    |                |
| CreatedBy   | int(11)          | NO   |     | NULL    |                |
+-------------+------------------+------+-----+---------+----------------+
*/
-- Create Movie table
CREATE TABLE Movie
(
	MovieID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	Title CHAR(50) NOT NULL UNIQUE KEY,
	Poster CHAR(255) NOT NULL,  
	PlotSummary TEXT NOT NULL,
	Runtime INT NOT NULL,
	Genres TEXT NOT NULL,
	Crew TEXT NOT NULL, -- cast showed up as a keyword in my text editor so I changed it
	Directors TEXT NOT NULL,
	Awards TEXT NOT NULL,
	CreatedBy INT NOT NULL 
);

/*
+---------+------------------+------+-----+---------+-------+
| Field   | Type             | Null | Key | Default | Extra |
+---------+------------------+------+-----+---------+-------+
| UserID  | int(10) unsigned | NO   | PRI | NULL    |       |
| MovieID | int(10) unsigned | NO   | PRI | NULL    |       |
| Rating  | int(11)          | NO   |     | NULL    |       |
| Review  | text             | NO   |     | NULL    |       |
+---------+------------------+------+-----+---------+-------+ 
*/
-- Create Review table
CREATE TABLE Review 
(
	UserID INT UNSIGNED NOT NULL,
	MovieID INT UNSIGNED NOT NULL,
	Rating INT NOT NULL,
	Review TEXT NOT NULL,
	CHECK (Rating=1 OR Rating=2 OR Rating=3 OR Rating=4 OR Rating=5),
	PRIMARY KEY (UserID, MovieID),
	FOREIGN KEY (UserID) REFERENCES User (UserID),
	FOREIGN KEY (MovieID) REFERENCES Movie (MovieID)
);
