CREATE DATABASE SONGIFY;
CREATE TABLE Users (
	User_ID serial primary key,
	First_Name varchar(255) not null,
	Last_Name varchar(255) not null,
	Date_Of_Birth date not null,
	Email varchar(255) unique,
	Password varchar(32) not null,
	User_Name varchar(20) not null,
	Street varchar(255) not null,
	House_Nr varchar(10) not null,
	Zip_Code varchar(10) not null,
	City varchar(255) not null,
	Country varchar(60) not null,
	Blocked boolean default false,
	Subscription_Status boolean default false,
	User_Role int,
	CC_Number varchar(25)	 
);
CREATE TABLE Album (
	Album_ID serial primary key,
	Title varchar(999) not null,
	Date date,
	Artist_ID serial ,
	Label varchar(255),
	Publisher varchar(255)
);
CREATE TABLE Song (
	Song_ID serial primary key,
	Title varchar(255) not null,
	Date date,
	Artist_ID int,
	Label varchar(255),
	Publisher varchar(255),
	Price numeric(2,2),
	Listens int,
	Album_ID serial 
);
CREATE TABLE Playlist (
	Playlist_ID serial  primary key,
	Name varchar(50) not null,
	User_ID int,
	Public boolean default false
);
CREATE TABLE Song_Playlist (
	Playlist_ID serial ,
	Song_ID serial ,
	primary key (Playlist_ID,Song_ID)
);
CREATE TABLE Permissions ( 
	Manage_Users boolean default false,
	Upload_Songs boolean default false,
	Listen_To_Songs boolean default false,
	Create_Playlist boolean default false,
	Create_Albums boolean default false,
	User_Role_ID serial  primary key
);
CREATE TABLE User_Role (
	Role_ID serial  primary key,
	Role_Name varchar(15) not null,
	Role_Description varchar(255)
);
CREATE TABLE Credit_Card (
	CC_Number varchar(25) primary key,
	CVC_CVV_Code char(3) not null,
	Type_Of_Card varchar(50) not null,
	First_Name varchar(255) not null,
	Last_Name varchar(255) not null,
	Expiration_Date date not null
);
CREATE TYPE payment AS enum ('Credit Card','Giftcard');
CREATE TABLE Bill ( 
	Bill_ID serial  primary key,
	Date date not null,
	Price money not null,
	Status boolean default false,
	Payment_Method payment,
	User_ID int
);
CREATE TABLE Giftcard (
	Code char(12) primary key,
	Value int not null,
	Status boolean default false,
	User_ID serial
);
