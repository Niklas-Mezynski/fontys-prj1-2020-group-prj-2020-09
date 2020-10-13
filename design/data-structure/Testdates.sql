INSERT INTO user_role(role_id,role_name,role_description)VALUES
(1,'User','Regular Users do not have any special permissions'),
(2,'Subscriber','Subscribed users are able to listen to songs and create playlists'),
(3,'Artist','Artists are able to upload music and create albums'),
(4,'Admin','Administrators can do enything, including managing users');

INSERT INTO permissions(user_role_id,manage_users,upload_songs,listen_to_songs,create_playlist,create_albums)VALUES
(1,false,false,false,false,false),
(2,false,false,true,true,false),
(3,false,true,true,true,true),
(4,true,true,true,true,true);

INSERT INTO credit_card(cc_number,cvc_cvv_code,type_of_card,first_name,last_name,expiration_date)VALUES
(4175002145914542,563,'visa-electron','Duke','Nukem','2022-10-13'),
(3531650456173404,798,'jcb','Helmut','Rütgers','2020-11-23'),
(3535929089852667,390,'jcb','Eric','Cartman','2022-10-25');

INSERT INTO users(user_id,first_name,last_name,date_of_birth,email,password,user_name,address,blocked,subscription_status,user_role,cc_number)VALUES
(1,'Mark','Salzberg','1986-05-13','m.salzberg@songify.com','Song!fyIsT€B€st','M_Salzberg','Silicon Sqare 4',false,false,4,NULL),
(2,'Susanna','Neubau','1975-11-14','s.neubau@songify.com','!havAHobby','S_Neubau','Harbour Street 76',false,false,4,NULL),
(3,'Kevin','Alex','2003-04-14','kevin.alex@gmail.com','IbntheKevin','Kevin','Cartlos Street 12',false,false,1,NULL),
(4,'Duke','Nukem','1997-01-20','duke.nukem@gmail.com','DoSomSportBro','Sporty Nukem','Lake Street 1',true,false,1,4175002145914542),
(5,'Helmut','Rütgers','1935-06-07','ruetgers.helmut@gmx.de','IchBinDerHelmut','Neuzeit Opa','Hindenburgstraße 45',false,true,2,3531650456173404,798),
(6,'Eric','Cartman','2000-09-10','cartman.records@ukmail.com','!AMTHEBEST','Eric Cartman','Elizabethstreet 6a',false,true,3,3535929089852667);

INSERT INTO giftcard(code,value,status,user_id)VALUES
('5TZ489I7Z6RE',8,false,4),
('OL7F3WQ0FG6N',12,true,5);

INSERT INTO bill(bill_id,date,price,status,payment_method,user_id)VALUES
(1,'2020-10-12',1.45,true,'credit_card',4),
(2,'2020-01-01',5.99,true,'giftcard',5);

INSERT INTO album(album_id,title,date,artist_id,label,publisher)VALUES
(1,'Wonderful Day','2020-03-05',6,'Royal Records','Cartmaners'),
(2,'Best Year Ever','2019-12-31',6,'Royal Records','Cartmaners');

INSERT INTO song(song_id,title,date,artist_id,label,publisher,price,listens,album_id)VALUES
(1,'Day In Hidepark','2020-02-24',6,'Royal Records','Cartmaners',2.99,462319,1),
(2,'Hallo Steve my old friend','2020-02-25',6,'Royal Records','Cartmaners',1.59,5460,1),
(3,'BBQ in Siberia','2020-02-30',6,'Royal Records','Cartmaners',7.56,369834512,1),
(4,'Party In Iran','2019-12-28',6,'Royal Records','Cartmaners',3.45,456,2),
(5,'Call Me President Whatever you think','2019-12-29',6,'Royal Records','Cartmaners',2.99,561238,2),
(6,'Dinner in Wuhan','2019-12-30',6,'Royal Records','Cartmaners',1.79,5921357,2);

INSERT INTO playlist(playlist_id,name,user_id,public)VALUES
(1,'Do Some Sport Bro',4,true),
(2,'Songs to calm down',5,false),
(3,'Top Tracks',6,true);

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