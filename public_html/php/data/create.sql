DROP DATABASE cookbook;
CREATE DATABASE cookbook;
USE cookbook;

CREATE TABLE user
(
userID integer(8) NOT NULL primary key AUTO_INCREMENT,
username varchar(15) NOT NULL,
password char(30) NOT NULL,
dateJoined DATETIME,
UNIQUE (username)
);

CREATE TABLE equipment
(
equipmentID integer(8) NOT NULL primary key AUTO_INCREMENT,
name varchar(50),
description varchar(1000),
UNIQUE (name)
);

CREATE TABLE recipe
(
recipeID integer(8) NOT NULL primary key AUTO_INCREMENT,
authorID integer(8) NOT NULL,
name varchar(50) NOT NULL,
isComplete tinyint(1),
description varchar(1000),
dateUploaded DATETIME,
dateLastUpdated DATETIME,
UNIQUE (name),
FOREIGN KEY (authorID) references user(userID)
);

CREATE TABLE ingredient
(
ingredientID integer(8) NOT NULL primary key AUTO_INCREMENT,
name varchar(50) NOT NULL,
foodGroup varchar(20) NOT NULL,
description varchar(1000),
UNIQUE (name)
);

CREATE TABLE recipeIngredient
(
recipeID integer(8) NOT NULL,
ingredientID integer(8) NOT NULL,
quantity integer(1),
weight varchar(30),
isOptional tinyint(1),
FOREIGN KEY (recipeID) references recipe(recipeID),
FOREIGN KEY (ingredientID) references ingredient(ingredientID)
);

CREATE TABLE cuisine
(
cuisineID integer(8) NOT NULL primary key AUTO_INCREMENT,
name varchar(50) NOT NULL,
UNIQUE (name)
);

CREATE TABLE recipeCuisine
(
recipeID integer(8) NOT NULL,
cuisineID integer(8) NOT NULL,
FOREIGN KEY (recipeID) references recipe(recipeID),
FOREIGN KEY (cuisineID) references cuisine(cuisineID)
);

CREATE TABLE mealType
(
mealTypeID integer(8) NOT NULL primary key AUTO_INCREMENT,
name varchar(50),
UNIQUE (name)
);

CREATE TABLE recipeMealType
(
recipeID integer(8) NOT NULL,
mealTypeID integer(8) NOT NULL,
FOREIGN KEY (recipeID) references recipe(recipeID),
FOREIGN KEY (mealTypeID) references mealType(mealTypeID)
);

CREATE TABLE userEquipment
(
userID integer(8) NOT NULL,
equipmentID integer(8) NOT NULL,
FOREIGN KEY (userID) references user(userID),
FOREIGN KEY (equipmentID) references equipment(equipmentID)
);

CREATE TABLE recipeEquipment
(
recipeID integer(8) NOT NULL,
equipmentID integer(8) NOT NULL,
FOREIGN KEY (recipeID) references recipe(recipeID),
FOREIGN KEY (equipmentID) references equipment(equipmentID)
);