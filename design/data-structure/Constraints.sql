alter table users add constraint fk_users_roles foreign key (user_role) references user_role (role_id);

alter table users add constraint fk_users_cc foreign key (cc_number) references credit_card (cc_number);

alter table album add constraint fk_album_users foreign key (artist_id) references users (user_id);

alter table playlist
add constraint fk_playlist_users foreign key (user_id) references users (user_id);

alter table song add constraint fk_song_user foreign key (artist_id) references users (user_id),
add constraint fk_song_album foreign key (album_id) references album (album_id);

alter table permissions add constraint fk_permissions_user_role foreign key (user_role_id) references user_role (role_id);

alter table bill add constraint fk_bill_users foreign key (user_id) references users (user_id);

alter table giftcard add constraint fk_giftcard_users foreign key (user_id) references users (user_id);

alter table song_playlist
add constraint fk_song_id_to_song foreign key (song_id) references song (song_id),
add constraint fk_playlist_id_to_playlist foreign key (playlist_id) references playlist (playlist_id) ON DELETE CASCADE;

alter table song add constraint legal_prices
check ((Price >= 0.10) and (Price <= 3.00));

alter table users 
ADD CONSTRAINT check_password_length CHECK (LENGTH(Password) >= 8);

alter table credit_card 
add constraint check_expiration_date check (CAST( now() AS Date ) < Expiration_Date);
                            
ALTER TABLE users
add CONSTRAINT check_16_years_old
CHECK (date_part('year', age(Date_Of_Birth)) >= 16);


create or replace function checkUploadPermission()
returns trigger as $$
begin
if (select p.upload_songs 
from permissions p
inner join user_role ur on p.user_role_id = ur.role_id 
inner join users u on ur.role_id = u.user_role
where u.user_id = new.artist_id) = false
then
return null;
end if;
return new;
end;
$$ language plpgsql;

CREATE TRIGGER checkUploadPermission
AFTER INSERT ON song
FOR EACH ROW execute procedure checkUploadPermission();

