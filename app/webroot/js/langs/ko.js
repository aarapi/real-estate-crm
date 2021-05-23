// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"당신이 선택한 레코드를 삭제 하시겠습니까";
    if(message=="Please Select Any Record")
    return"모든 레코드를 선택하세요";
    if(message=="Do You Want To Delete")
    return"당신은 삭제 하시겠습니까";
    if(message=="Record")
    return"기록";
    if(message=="All Selected")
    return"모든 선택";
    if(message=="Search")
    return"수색";
    if(message=="None selected")
    return"아무도 선택하지";
    if(message==" 0 character (1 sms)")
    return"0 문자 (1 SMS)";
    if(message==" characters ")
    return"등장 인물";
    if(message==" sms)")
    return"문자)";
if(message=="Searching\u2026")
	return"수색...";
	if(message=="No matches found")
	return"일치하는 항목이 없습니다";
	if(message=="Please enter")
	return"들어 오세요";
	if(message==" or more character")
	return"이상의 문자";
	if(message=="Loading failed")
	return"로드 실패";
return"";
}