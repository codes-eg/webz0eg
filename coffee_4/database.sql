/* Run this code on local machine for hosting of the site */

/* To set up database */

MySQL

\connect -h localhost -u root -p

\sql

CREATE DATABASE coffeeusers;

CREATE TABLE coffeesignup (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `emailaddress` varchar(130) NOT NULL,
  `firstname` varchar(130) NOT NULL,
  `lastname` varchar(130) NOT NULL,
  `username` varchar(250) NOT NULL,
  `userpassword` varchar(250) NOT NULL
);

/* To view the database */

MySQL

\connect -h localhost -u root -p;

\sql

USE coffeeusers;

SELECT * FROM coffeesignup;


/*-----------------------*/
