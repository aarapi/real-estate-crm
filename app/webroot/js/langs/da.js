// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ønsker du at slette valgte post";
    if(message=="Please Select Any Record")
    return"Vælg venligst Enhver Record";
    if(message=="Do You Want To Delete")
    return"Har du ønsker at slette";
    if(message=="Record")
    return"Optage";
    if(message=="All Selected")
    return"Alle valgte";
    if(message=="Search")
    return"Alle valgte";
    if(message=="None selected")
    return"Ingen valgt";
    if(message==" 0 character (1 sms)")
    return"0 tegn (1 sms)";
    if(message==" characters ")
    return"tegn";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Søger...";
	if(message=="No matches found")
	return"Ingen match fundet";
	if(message=="Please enter")
	return"Kom ind";
	if(message==" or more character")
	return"eller mere karakter";
	if(message=="Loading failed")
	return"Loading mislykkedes";
return"";
}