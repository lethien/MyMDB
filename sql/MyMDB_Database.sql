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
-- CREATE TABLE Movie
-- (

-- );

-- Create Review table
-- CREATE TABLE Review 
-- (

-- );