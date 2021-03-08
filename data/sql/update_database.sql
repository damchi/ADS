-- You will add in this file your changes for the database
ALTER TABLE vehicle ADD created DATETIME;
ALTER TABLE vehicle_model ADD created DATETIME;
ALTER TABLE vehicle_make ADD created DATETIME;

ALTER TABLE vehicle ADD updated DATETIME;
ALTER TABLE vehicle_model ADD updated DATETIME;
ALTER TABLE vehicle_make ADD updated DATETIME;

ALTER TABLE vehicle ADD state int(1) DEFAULT 1;
ALTER TABLE vehicle_model ADD  state int(1) DEFAULT 1;
ALTER TABLE vehicle_make ADD state int(1) DEFAULT 1;

ALTER TABLE vehicle ADD CONSTRAINT duplicate UNIQUE KEY(vehicle_make_id,vehicle_model_id,vehicle_year);

