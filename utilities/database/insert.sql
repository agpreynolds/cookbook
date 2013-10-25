INSERT INTO cuisine (name)
VALUES 
('american'),
('chinese'),
('english'),
('french'),
('greek'),
('indian'),
('italian'),
('japanese'),
('spanish'),
('thai');

INSERT INTO ingredient (name,foodGroup)
VALUES
('onion','vegetable'),
('bacon','meat'),
('pineapple','fruit'),
('cod','fish');

INSERT INTO user (username,password)
VALUES
('root','test');

INSERT INTO recipe (authorID,name)
VALUES
(1,'pizza');

INSERT INTO recipeIngredient (recipeID,ingredientID,quantity,weight)
VALUES
(1,1,1,NULL),
(1,2,NULL,'250g'),
(1,3,0.5,NULL);

INSERT INTO recipeCuisine (recipeID,cuisineID)
VALUES
(1,7);

INSERT INTO mealType (name)
VALUES
('breakfast'),
('lunch'),
('dinner');

INSERT INTO recipeMealType (recipeID,mealTypeID)
VALUES
(1,3);

select r.name 
from 
recipe as r,
cuisine as c,
recipeCuisine as rc,
mealType as m, 
recipeMealType as rm 
where c.name = 'italian' and m.name = 'dinner' 
and rm.mealTypeID = m.mealTypeID and c.cuisineID = rc.cuisineID;
