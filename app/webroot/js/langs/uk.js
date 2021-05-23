// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ви хочете, щоб видалити вибраний запис";
    if(message=="Please Select Any Record")
    return"Виберіть будь-який запис";
    if(message=="Do You Want To Delete")
    return"Чи хочете ви видалити";
    if(message=="Record")
    return"запис";
    if(message=="All Selected")
    return"всі вибрані";
    if(message=="Search")
    return"пошук";
    if(message=="None selected")
    return"Нічого не вибрано";
    if(message==" 0 character (1 sms)")
    return"0 символ (1 SMS)";
    if(message==" characters ")
    return"символи";
    if(message==" sms)")
    return"смс)";
if(message=="Searching\u2026")
	return"Йде пошук ...";
	if(message=="No matches found")
	return"Співпадінь не знайдено";
	if(message=="Please enter")
	return"Будь ласка введіть";
	if(message==" or more character")
	return"або більше символів";
	if(message=="Loading failed")
	return"Помилка завантаження";
return"";
}