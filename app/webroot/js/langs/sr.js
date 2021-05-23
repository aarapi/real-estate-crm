// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Да ли желите да избришете изабрани запис";
    if(message=="Please Select Any Record")
    return"Молимо изаберите Ани Рецорд";
    if(message=="Do You Want To Delete")
    return"Да ли желите да избришете";
    if(message=="Record")
    return"запис";
    if(message=="All Selected")
    return"све Селецтед";
    if(message=="Search")
    return"Претраживање";
    if(message=="None selected")
    return"none селецтед";
    if(message==" 0 character (1 sms)")
    return"0 карактер (1 СМС)";
    if(message==" characters ")
    return"карактера";
    if(message==" sms)")
    return"СМС)";
if(message=="Searching\u2026")
	return"Сеарцхинг ...";
	if(message=="No matches found")
	return"Без подударања";
	if(message=="Please enter")
	return"Унесите";
	if(message==" or more character")
	return"или више карактера";
	if(message=="Loading failed")
	return"лоадинг фаилед";
return"";
}