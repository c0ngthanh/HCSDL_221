delimiter $$
 CREATE FUNCTION `CourseRating`(CourseID char(10)) 
 RETURNS decimal(2,1)
    READS SQL DATA
    DETERMINISTIC
BEGIN
	DECLARE RATE DECIMAL (2,1);
	IF EXISTS (SELECT * FROM danhgia WHERE IDKHOAHOC=CourseID) 
		THEN SET RATE= (SELECT AVG(SOSAO) FROM danhgia WHERE IDKHOAHOC= CourseID );
    END IF;    
RETURN RATE;
END$$
delimiter ;


delimiter $$
CREATE FUNCTION PassOrFail(ClassID char(10),StuID char(10)) 
RETURNS varchar(50) 
    READS SQL DATA
	DETERMINISTIC

begin
declare dkt,dthi int;
declare s varchar(50);
if EXISTS (SELECT * FROM hocvien_lophoc where IDLOPHOC=ClassID and IDHOCVIEN=StuID) then

	set dthi=(select diemthi from hocvien_lophoc where IDLOPHOC=ClassID and IDHOCVIEN=StuID);
	set dkt= (select diemkiemtra from hocvien_lophoc where IDLOPHOC=ClassID and IDHOCVIEN=StuID);
    
	if dthi*0.7 + dkt*0.3 > 5 then set s='PASS' ;
	else set s='FAIL';
	end if;

ELSE SET s='STUDENTS NOT INROLLED IN THIS CLASS';
END IF;
return (s);
end $$
delimiter ;

select PassorFail('LOPHOC3','HOCVIEN1');
select PassorFail('LOPHOC1','HOCVIEN1')
