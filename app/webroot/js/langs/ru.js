// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Вы хотите, чтобы удалить выбранную запись";
    if(message=="Please Select Any Record")
    return"Выберите любую запись";
    if(message=="Do You Want To Delete")
    return"Хотите ли вы удалить";
    if(message=="Record")
    return"запись";
    if(message=="All Selected")
    return"Все выбранные";
    if(message=="Search")
    return"Поиск";
    if(message=="None selected")
    return"Не выбрано, ничего не выбрано";
    if(message==" 0 character (1 sms)")
    return"0 символ (1 SMS)";
    if(message==" characters ")
    return"персонажи";
    if(message==" sms)")
    return"cmc)";
if(message=="Searching\u2026")
	return"Идет поиск ...";
	if(message=="No matches found")
	return"Совпадений не найдено";
	if(message=="Please enter")
	return"Пожалуйста входите";
	if(message==" or more character")
	return"или более символов";
	if(message=="Loading failed")
	return"Ошибка загрузки";
return"";
}