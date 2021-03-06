-- Drop if Lab08 database exist
DROP DATABASE IF EXISTS MyMDB;

-- Create database MyMDB
CREATE DATABASE MyMDB;

-- Use database MyMDB
USE MyMDB;

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

-- Create Movie table
CREATE TABLE Movie
(
	MovieID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	Title CHAR(50) NOT NULL UNIQUE KEY,
	Poster CHAR(255) NOT NULL,  
	PlotSummary TEXT NOT NULL,
	Runtime INT NOT NULL,
	Genres TEXT NOT NULL,
	Crew TEXT NOT NULL,
	Directors TEXT NOT NULL,
	Awards TEXT,
	CreatedBy INT UNSIGNED NOT NULL,
	PRIMARY KEY (MovieID),
	FOREIGN KEY (CreatedBy) REFERENCES User (UserID) ON DELETE CASCADE
);

-- Create Review table
CREATE TABLE Review 
(
	UserID INT UNSIGNED NOT NULL,
	MovieID INT UNSIGNED NOT NULL,
	Rating INT NOT NULL,
	Review TEXT NOT NULL,
	CHECK (Rating=1 OR Rating=2 OR Rating=3 OR Rating=4 OR Rating=5),
	PRIMARY KEY (UserID, MovieID),
	FOREIGN KEY (UserID) REFERENCES User (UserID) ON DELETE CASCADE,
	FOREIGN KEY (MovieID) REFERENCES Movie (MovieID) ON DELETE CASCADE
);
