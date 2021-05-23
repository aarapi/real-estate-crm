// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Дали сакате да го избришете избраниот запис";
    if(message=="Please Select Any Record")
    return"Ве молам изберете секој запис";
    if(message=="Do You Want To Delete")
    return"Дали сакате да ја избришете";
    if(message=="Record")
    return"рекорд";
    if(message=="All Selected")
    return"сите избрани";
    if(message=="Search")
    return"Барај";
    if(message=="None selected")
    return"Не избравте ништо";
    if(message==" 0 character (1 sms)")
    return"0 карактер (1 SMS)";
    if(message==" characters ")
    return"карактери";
    if(message==" sms)")
    return"порака)";
if(message=="Searching\u2026")
	return"Пребарување ...";
	if(message=="No matches found")
	return"Не се пронајдени резултати";
	if(message=="Please enter")
	return"Ве молиме внесете";
	if(message==" or more character")
	return"или повеќе карактер";
	if(message=="Loading failed")
	return"Неуспешно вчитување";
return"";
}