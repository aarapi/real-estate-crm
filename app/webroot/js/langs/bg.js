// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Смятате ли, че искате да изтриете избрания запис";
    if(message=="Please Select Any Record")
    return"Моля изберете нито един запис";
    if(message=="Do You Want To Delete")
    return"Смятате ли искате да изтриете";
    if(message=="Record")
    return"рекорд";
    if(message=="All Selected")
    return"Всички избрани";
    if(message=="Search")
    return"Търсене";
    if(message=="None selected")
    return"Не е избрана";
    if(message==" 0 character (1 sms)")
    return"0 характер ( 1 СМС )";
    if(message==" characters ")
    return"знаци";
    if(message==" sms)")
    return"СМС)";
if(message=="Searching\u2026")
	return"Търсене ...";
	if(message=="No matches found")
	return"Няма намерени съвпадения";
	if(message=="Please enter")
	return"Моля, въведете";
	if(message==" or more character")
	return"или повече характер";
	if(message=="Loading failed")
	return"Зарежда се провали";
return"";
}