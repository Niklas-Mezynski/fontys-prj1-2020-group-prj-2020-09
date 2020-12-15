INSERT INTO user_role(role_id,role_name,role_description)VALUES
(0, 'Blocked', 'Blocked users dont have any permission'),
(1,'User','Regular Users do not have any special permissions'),
(2,'Subscriber','Subscribed users are able to listen to songs and create playlists'),
(3,'Artist','Artists are able to upload music and create albums'),
(4,'Admin','Administrators can do enything, including managing users');

INSERT INTO permissions(user_role_id,manage_users,upload_songs,listen_to_songs,create_playlist,create_albums)VALUES
(0,false,false,false,false,false),
(1,false,false,false,false,false),
(2,false,false,true,true,false),
(3,false,true,true,true,true),
(4,true,true,true,true,true);

INSERT INTO credit_card(cc_number,cvc_cvv_code,type_of_card,first_name,last_name,expiration_date)VALUES
(4175002145914542,563,'visa-electron','Duke','Nukem','2022-10-13'),
(3531650456173404,798,'jcb','Helmut','Rütgers','2021-11-23'),
(3535929089852667,390,'jcb','Eric','Cartman','2022-10-25');

INSERT INTO users(first_name,last_name,date_of_birth,email,password,user_name,street, house_nr, zip_code, city, country,blocked,subscription_status,user_role,cc_number)VALUES
('Mark','Salzberg','1986-05-13','m.salzberg@songify.com','S5OfaS3Jo2/aitVJZK6d/VOz+ucxo6ILvJK5ZmovWTA=','M_Salzberg','Silicon Square', '4', '40670', 'Meerbusch', 'Germany' ,false,false,4,NULL),
('Susanna','Neubau','1975-11-14','s.neubau@songify.com','9f2/Ioux7NmNmnD05NxtIr8wJTjJognR2DznewF5nrg=','S_Neubau','Silicon Square', '4', '40670', 'Meerbusch', 'Germany',false,false,4,NULL),
('Kevin','Alex','2003-04-14','kevin.alex@gmail.com','NDfLApxCJc0ru88Z3CeYbswMz8OxvhZ3djS8nurv8lo=','Kevin','Silicon Square', '4', '40670', 'Meerbusch', 'Germany',false,false,1,NULL),
('Duke','Nukem','1997-01-20','duke.nukem@gmail.com','/+t9dZeX9d9+AS6PAbPWTYIc+ef0fo4tdtPoYInHvLQ=','Sporty Nukem','Silicon Square', '4', '40670', 'Meerbusch', 'Germany',true,false,1,4175002145914542),
('Helmut','Rütgers','1935-06-07','ruetgers.helmut@gmx.de','GqB43PSQW3Sh8OLRsV5TDqUeZ9SkJoeYncKw2/uVTwQ=','Neuzeit Opa','Silicon Square', '4', '40670', 'Meerbusch', 'Germany',false,true,2,3531650456173404),
('Eric','Cartman','2000-09-10','cartman.records@ukmail.com','HRXRDIoNhYsmRSbAk4JkWabZLXLOx7JN/sVMT8p5kbM=','Eric Cartman','Silicon Square', '4', '40670', 'Meerbusch', 'Germany',false,true,3,3535929089852667);

INSERT INTO giftcard(code,value,status,user_id)VALUES
('5TZ489I7Z6RE',8,false,4),
('OL7F3WQ0FG6N',12,true,5),
('JF8WU76WJFI5',6,true,2);

INSERT INTO bill(date,price,status,payment_method,user_id)VALUES
('2020-10-12',1.45,true,'Credit Card',4),
('2020-01-01',5.99,true,'Giftcard',5),
('2020-05-08',5.99,true,'Giftcard',2);

INSERT INTO album(title,date,artist_id,label,publisher)VALUES
('Wonderful Day','2020-03-05',6,'Royal Records','Cartmaners'),
('Best Year Ever','2019-12-31',6,'Royal Records','Cartmaners');

INSERT INTO song(title,date,artist_id,label,publisher,price,listens,album_id)VALUES
('Day In Hidepark','2020-02-24',6,'Royal Records','Cartmaners',2.99,462319,1),
('Hallo Steve my old friend','2020-02-25',6,'Royal Records','Cartmaners',1.59,5460,1),
('BBQ in Siberia','2020-02-28',6,'Royal Records','Cartmaners',2.50,369834512,1),
('Party In Iran','2019-12-28',6,'Royal Records','Cartmaners',3.00,456,2),
('Call Me President Whatever you think','2019-12-29',6,'Royal Records','Cartmaners',2.99,561238,2),
('Dinner in Wuhan','2019-12-30',6,'Royal Records','Cartmaners',1.79,5921357,2);

INSERT INTO playlist(name,user_id,public)VALUES
('Do Some Sport Bro',4,true),
('Songs to calm down',5,false),
('Top Tracks',6,true);

INSERT INTO song_playlist(playlist_id,song_id)VALUES
(1,3),
(1,5),
(2,2),
(2,6),
(3,1),
(3,2),
(3,3),
(3,4),
(3,5),
(3,6);
