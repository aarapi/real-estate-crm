// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Kas soovid kustutada valitud rekord";
    if(message=="Please Select Any Record")
    return"Palun valige ükskõik rekord";
    if(message=="Do You Want To Delete")
    return"Kas soovite kustutada";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"Kõik valitud";
    if(message=="Search")
    return"otsing";
    if(message=="None selected")
    return"ükski valitud";
    if(message==" 0 character (1 sms)")
    return"0 iseloomu (1 sms)";
    if(message==" characters ")
    return"märki";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Recherche";
	if(message=="No matches found")
	return"Aucun résultat";
	if(message=="Please enter")
	return"Please enter";
	if(message==" or more character")
	return" or more character";
	if(message=="Loading failed")
	return"Loading failed";
return"";
}