DROP TRIGGER IF EXISTS `check_email`;
DELIMITER $$
-- USE `btl`$$
create trigger`check_email` BEFORE INSERT ON `taikhoan` FOR EACH ROW
BEGIN
     IF NEW.`email` NOT LIKE '%_@%_.__%' THEN
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhap lai emai';
	END IF;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `check_tuoinhanvien`;
DELIMITER $$
CREATE TRIGGER `check_tuoinhanvien` BEFORE INSERT ON `nhanvien` FOR EACH ROW
BEGIN
	declare standard_date date;
	set standard_date = date_sub(now(), interval 18 year);
    if (new.NGAYSINH > standard_date) then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'Nhan vien phai lon hon 18 tuoi ';
	end if ;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `btl`.`check_time_insert_khoahoc`;
DELIMITER $$
CREATE TRIGGER `check_time_insert_khoahoc` BEFORE INSERT ON `khoahoc` FOR EACH ROW
BEGIN
	if DATEDIFF(NEW.NGAYKETTHUC, NEW.NGAYBATDAU) < 0 then
    signal sqlstate '45000' set message_text = 'Ngay bat dau phai nho hon ngay ket thuc';
    end if;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `checkluongUpdate`;
DELIMITER $$
create TRIGGER `checkluongUpdate` BEFORE update ON `nhanvien` FOR EACH ROW
BEGIN
	declare MINLUONG int;
    set MINLUONG = (select LUONG
	from nhanvien s,giangvien g
	where s.LUONG = (select MIN(LUONG) from GIANGVIEN) and g.IDNHANVIEN= s.ID);
	if NEW.ID in (select IDNHANVIEN from btl.ta) and NEW.LUONG > MINLUONG then
		    signal sqlstate '45000' set message_text = 'Luong cua ta phai nho hon luong cua giang vien';
    end if;
END$$
DELIMITER ;


DROP TRIGGER IF EXISTS `tudongnhaptien`;

DELIMITER $$
CREATE TRIGGER `tudongnhaptien` before INSERT ON `hoadon` FOR EACH ROW
BEGIN
    set new.giatien = (select HOCPHI from khoahoc a, hoadon b  where new.IDKHOAHOC = a.ID limit 1);
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS `checkhoadon_khuyenmai`;

DELIMITER $$
USE `btl`$$
CREATE DEFINER = CURRENT_USER TRIGGER `checkhoadon_khuyenmai` BEFORE INSERT ON `khuyenmai_hoadon` FOR EACH ROW
BEGIN
    declare ngayhoadon date;
    declare ngaybd date;
    declare ngaykt date;
    declare giamgia int;
    declare loai varchar(5);
    declare giabandau int;
    if new.IDKHUYENMAI not in (select ID from khuyenmai) then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'khong ton tai ma khuyen mai ';
    end if;
    select a.NGAYBATDAU into ngaybd from khuyenmai a ,khuyenmai_hoadon b where NEW.IDKHUYENMAI = a.ID limit 1;
	select a.NGAYKETTHUC into ngaykt from khuyenmai a ,khuyenmai_hoadon b where NEW.IDKHUYENMAI = a.ID limit 1;
    select a.THOIGIAN into ngayhoadon from hoadon a ,khuyenmai_hoadon b where NEW.IDHOADON = a.ID limit 1;
    if DATEDIFF(ngayhoadon,ngaybd) <0 or DATEDIFF(ngayhoadon,ngaykt) >0 then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'hoa don qua han khuyen mai ';
    end if;
    set giabandau = (select hocphi from khoahoc a,hoadon b where a.ID = b.IDKHOAHOC and b.ID=new.IDHOADON);
    if new.IDKHUYENMAI in (select IDKHUYENMAI from voucher) then
		select loaigiam into loai from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI;
        if loai = '%' then
			set giamgia= (select giatri from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI)*giabandau/100;
            if giamgia > (select giamtoidatheophantram from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI) then
				set giamgia=(select giamtoidatheophantram from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI);
            end if;
            update hoadon set giatien = giabandau-giamgia  where hoadon.ID = new.IDHOADON;
        elseif loai = 'TIEN' then
			set giamgia= (select giatri from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI);
            update hoadon set giatien = giabandau-giamgia  where hoadon.ID = new.IDHOADON;
        end if;
        else update hoadon set giatien = giabandau  where hoadon.ID = new.IDHOADON;
    end if;
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS `xoakhuyenmaihoadon`;
DELIMITER $$
CREATE TRIGGER `xoakhuyenmaihoadon` AFTER DELETE ON `khuyenmai_hoadon` FOR EACH ROW
BEGIN
	declare giabandau int;
	set giabandau = (select hocphi from khoahoc a,hoadon b where a.ID = b.IDKHOAHOC and b.ID=old.IDHOADON);
    update hoadon set giatien = giabandau  where hoadon.ID = old.IDHOADON;
END$$
DELIMITER ;

DROP TRIGGER IF EXISTS `btl`.`update_khuyenmai_hoadon`;

DELIMITER $$
CREATE TRIGGER `update_khuyenmai_hoadon` BEFORE UPDATE ON `khuyenmai_hoadon` FOR EACH ROW
BEGIN
	declare ngayhoadon date;
    declare ngaybd date;
    declare ngaykt date;
    declare giamgia int;
    declare loai varchar(5);
    declare giabandau int;
    if new.IDKHUYENMAI not in (select ID from khuyenmai) then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'khong ton tai ma khuyen mai ';
    end if;
    select a.NGAYBATDAU into ngaybd from khuyenmai a ,khuyenmai_hoadon b where NEW.IDKHUYENMAI = a.ID limit 1;
	select a.NGAYKETTHUC into ngaykt from khuyenmai a ,khuyenmai_hoadon b where NEW.IDKHUYENMAI = a.ID limit 1;
    select a.THOIGIAN into ngayhoadon from hoadon a ,khuyenmai_hoadon b where NEW.IDHOADON = a.ID limit 1;
    if DATEDIFF(ngayhoadon,ngaybd) <0 or DATEDIFF(ngayhoadon,ngaykt) >0 then
		SIGNAL SQLSTATE VALUE '45000'
		SET MESSAGE_TEXT = 'hoa don qua han khuyen mai ';
    end if;
    set giabandau = (select hocphi from khoahoc a,hoadon b where a.ID = b.IDKHOAHOC and b.ID=new.IDHOADON);
    if new.IDKHUYENMAI in (select IDKHUYENMAI from voucher) then
		select loaigiam into loai from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI;
        if loai = '%' then
			set giamgia= (select giatri from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI)*giabandau/100;
            if giamgia > (select giamtoidatheophantram from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI) then
				set giamgia=(select giamtoidatheophantram from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI);
            end if;
            update hoadon set giatien = giabandau-giamgia  where hoadon.ID = new.IDHOADON;
        elseif loai = 'TIEN' then
			set giamgia= (select giatri from voucher a where a.IDKHUYENMAI = new.IDKHUYENMAI);
            update hoadon set giatien = giabandau-giamgia  where hoadon.ID = new.IDHOADON;
        end if;
        else update hoadon set giatien = giabandau  where hoadon.ID = new.IDHOADON;
    end if;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `checksodienthoai`;
DELIMITER $$
CREATE  trigger `checksodienthoai` BEFORE INSERT ON `hocvien` FOR EACH ROW
BEGIN
	if new.sdt not REGEXP '^0[0-9]{9}' then
	SIGNAL SQLSTATE VALUE '45000'
	SET MESSAGE_TEXT = 'Nhap lai SDT';
    end if;
END$$
DELIMITER ;
DROP TRIGGER IF EXISTS `capnhattaikhoan`;
DELIMITER $$
CREATE trigger `capnhattaikhoan` BEFORE INSERT ON `hocvien` FOR EACH ROW
BEGIN
	if new.TENDANGNHAP not in (select TENDANGNHAP from taikhoan) then
		insert taikhoan values(new.TENDANGNHAP,'1',new.MAIL);
    end if;
END$$
DELIMITER ;

