// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Vill du ta bort markerade posten";
    if(message=="Please Select Any Record")
    return"Välj Alla Record";
    if(message=="Do You Want To Delete")
    return"Äger du vill radera";
    if(message=="Record")
    return"Spela in";
    if(message=="All Selected")
    return"alla valda";
    if(message=="Search")
    return"Sök";
    if(message=="None selected")
    return"inga valda";
    if(message==" 0 character (1 sms)")
    return"0 tecken (en sms)";
    if(message==" characters ")
    return"tecken";
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