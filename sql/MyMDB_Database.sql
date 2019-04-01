-- Drop if Lab08 database exist
DROP DATABASE IF EXISTS MyMDB;

-- Create database Lab08
CREATE DATABASE MyMDB;

-- Use database Lab08
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

-- Create Review table
-- CREATE TABLE Review 
-- (

-- );
