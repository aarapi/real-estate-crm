// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Chcete smazat vybraný záznam";
    if(message=="Please Select Any Record")
    return"Prosím, vyberte nějaký záznam";
    if(message=="Do You Want To Delete")
    return"Myslíte, že chcete smazat";
    if(message=="Record")
    return"Záznam";
    if(message=="All Selected")
    return"všechny vybrané";
    if(message=="Search")
    return"Vyhledávání";
    if(message=="None selected")
    return"Žádné vybrána";
    if(message==" 0 character (1 sms)")
    return"0 znak (1 sms)";
    if(message==" characters ")
    return"postavy";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Hledám ...";
	if(message=="No matches found")
	return"nenalezen žádný zápas";
	if(message=="Please enter")
	return"Prosím Vstupte";
	if(message==" or more character")
	return"nebo více znaků";
	if(message=="Loading failed")
	return"Načítání se nezdařilo";
return"";
}