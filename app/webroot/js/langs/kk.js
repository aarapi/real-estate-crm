// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Егер сіз Таңдалған жазба жою керек пе";
    if(message=="Please Select Any Record")
    return"Кез келген Жазу таңдаңыз";
    if(message=="Do You Want To Delete")
    return"Сіз өшіргіңіз келе ме";
    if(message=="Record")
    return"рекорд";
    if(message=="All Selected")
    return"барлық таңдалған";
    if(message=="Search")
    return"іздеу";
    if(message=="None selected")
    return"None таңдалған";
    if(message==" 0 character (1 sms)")
    return"0 сипаты (1 SMS)";
    if(message==" characters ")
    return"таңбалар";
    if(message==" sms)")
    return"қысқаша хабар қызметі)";
if(message=="Searching\u2026")
	return"Іздеу ...";
	if(message=="No matches found")
	return"сәйкестіктер табылған жоқ";
	if(message=="Please enter")
	return"енгізіңіз";
	if(message==" or more character")
	return"немесе одан да көп сипаты";
	if(message=="Loading failed")
	return"Loading сәтсіз";
return"";
}