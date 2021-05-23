// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ønsker du å slette valgte posten";
    if(message=="Please Select Any Record")
    return"Velg eventuelle Record";
    if(message=="Do You Want To Delete")
    return"Har du vil slette";
    if(message=="Record")
    return"Rekord";
    if(message=="All Selected")
    return"all Selected";
    if(message=="Search")
    return"Søke";
    if(message=="None selected")
    return"Ingen er valgt";
    if(message==" 0 character (1 sms)")
    return"0 karakter (en sms)";
    if(message==" characters ")
    return"tegn";
    if(message==" sms)")
    return"tekstmelding)";
if(message=="Searching\u2026")
	return"Søker...";
	if(message=="No matches found")
	return"Ingen treff funnet";
	if(message=="Please enter")
	return"Vennligst skriv inn";
	if(message==" or more character")
	return"eller mer karakter";
	if(message=="Loading failed")
	return"Laster mislyktes";
return"";
}