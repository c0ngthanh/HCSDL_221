drop procedure if exists InsertHocVien;
drop procedure if exists updateSDT;
drop procedure if exists deleteHocVien;
drop procedure if exists bill;
delimiter $$
create procedure InsertHocVien(ID CHAR(50),
TEN VARCHAR(30),
SDT CHAR(10) ,
DIACHI VARCHAR(50),
MAIL VARCHAR(30),
NAMSINH DATE,
TRINHDODAUVAO VARCHAR(5),
TENDANGNHAP VARCHAR(30))
begin
if MAIL NOT LIKE '%_@%_.__%' THEN
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhap lai emai';
END IF;
if SDT not regexp '^0[0-9]{9}' THEN
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhap lai SDT-SDT gom 10 chu so va bat dau bang so 0';
END IF;
if TRINHDODAUVAO not regexp 'BASIC|GOOD|PROFESSION' THEN
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhap lai trinh do- BASIC,GOOD,PRO';
END IF;
INSERT INTO `hocvien` VALUES (ID, TEN, SDT, DIACHI, MAIL, NAMSINH, TRINHDODAUVAO, TENDANGNHAP);
end$$
delimiter ;

delimiter $$
create procedure updateSDT(hocvien_ID CHAR(50),
hocvien_SDT CHAR(10))
begin
if hocvien_ID not in (select `ID` from hocvien) then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'ID khong ton tai, vui long thu lai';
end if;
if hocvien_SDT not regexp '^0[0-9]{9}' THEN
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhap lai SDT-SDT gom 10 chu so va bat dau bang so 0';
END IF;
UPDATE `hocvien` SET `SDT` = hocvien_SDT WHERE (`hocvien`.`ID` = hocvien_ID);
end$$
delimiter ;
delimiter $$
create procedure deleteHocVien(hocvien_ID CHAR(50))
begin
	-- declare tdn char(50);
    -- set tdn = (select tendangnhap from taikhoan,hocvien where taikhoan.tendangnhap= hocvien.tendangnhap and hocvien.ID = hocvien_ID );
if hocvien_ID not in (select `ID` from hocvien) then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'ID khong ton tai, vui long thu lai';
end if;
DELETE FROM `hocvien` WHERE (`hocvien`.`ID` = hocvien_ID);
end$$
delimiter ;
delimiter $$
CREATE PROCEDURE bill (ID char(50))
BEGIN
  select *
  from hoadon s, hocvien p
  where p.ID = ID and p.ID = s.IDHOCVIEN
  order by p.ID;

END $$
delimiter ;
drop procedure if exists countlophoc;

delimiter $$
CREATE PROCEDURE countlophoc (ID char(50))
BEGIN
  select s.tenkhoa, count(p.IDKHOAHOC) AS 'Số Lớp'
  from khoahoc s, lophoc p
  where s.ID= p.IDKHOAHOC and s.ID = ID
  group by   s.tenkhoa
  having count(p.IDKHOAHOC)>=0
  order by count(p.IDKHOAHOC);

END $$
delimiter 

