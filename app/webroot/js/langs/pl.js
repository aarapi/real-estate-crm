// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Czy chcesz usunąć zaznaczony rekord";
    if(message=="Please Select Any Record")
    return"Wybierz dowolny rekord";
    if(message=="Do You Want To Delete")
    return"Czy chcesz usunąć";
    if(message=="Record")
    return"Rekord";
    if(message=="All Selected")
    return"Wszystkie wybrane";
    if(message=="Search")
    return"Poszukiwanie";
    if(message=="None selected")
    return"Nie wybrano";
    if(message==" 0 character (1 sms)")
    return"0 znaków (1 SMS)";
    if(message==" characters ")
    return"postacie";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Badawczy...";
	if(message=="No matches found")
	return"Nie znaleziono żadnego meczu";
	if(message=="Please enter")
	return"Podaj";
	if(message==" or more character")
	return"lub więcej znaków";
	if(message=="Loading failed")
	return"Ładowanie nie powiodło się";
return"";
}