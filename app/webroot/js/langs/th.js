// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"คุณต้องการที่จะลบบันทึกที่เลือก";
    if(message=="Please Select Any Record")
    return"กรุณาเลือกบันทึกใด ๆ";
    if(message=="Do You Want To Delete")
    return"คุณต้องการที่จะลบ";
    if(message=="Record")
    return"บันทึก";
    if(message=="All Selected")
    return"ทั้งหมดที่เลือก";
    if(message=="Search")
    return"ค้นหา";
    if(message=="None selected")
    return"ไม่มีรายการที่เลือก";
    if(message==" 0 character (1 sms)")
    return"0 ตัวอักษร (1 SMS)";
    if(message==" characters ")
    return"ตัวละคร";
    if(message==" sms)")
    return"ข้อความ)";
if(message=="Searching\u2026")
	return"ค้นหา ...";
	if(message=="No matches found")
	return"ไม่พบ";
	if(message=="Please enter")
	return"กรุณากรอก";
	if(message==" or more character")
	return"หรือตัวละครมากขึ้น";
	if(message=="Loading failed")
	return"ไม่สามารถโหลด";
return"";
}