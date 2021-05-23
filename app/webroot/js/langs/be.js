// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Вы хочаце, каб выдаліць выбраны запіс";
    if(message=="Please Select Any Record")
    return"Выберыце любую запіс";
    if(message=="Do You Want To Delete")
    return"Ці вы хочаце выдаліць";
    if(message=="Record")
    return"запіс";
    if(message=="All Selected")
    return"усе выбраныя";
    if(message=="Search")
    return"пошук";
    if(message=="None selected")
    return"Нічога не вылучана";
    if(message==" 0 character (1 sms)")
    return"0 сімвал (1 cmc)";
    if(message==" characters ")
    return"сімвалы";
    if(message==" sms)")
    return"смс)";
if(message=="Searching\u2026")
	return"Ідзе пошук ...";
	if(message=="No matches found")
	return"Нічога не знойдзена";
	if(message=="Please enter")
	return"Калі ласка, увядзіце";
	if(message==" or more character")
	return"або больш сімвалаў";
	if(message=="Loading failed")
	return"памылка загрузкі";
return"";
}