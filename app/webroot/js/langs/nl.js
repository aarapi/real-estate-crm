// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Wilt u geselecteerde record te verwijderen";
    if(message=="Please Select Any Record")
    return"Selecteer de Record";
    if(message=="Do You Want To Delete")
    return"Heeft u wilt verwijderen";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"alle Selected";
    if(message=="Search")
    return"Zoeken";
    if(message=="None selected")
    return"Geen geselecteerd";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karakters";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Zoeken ...";
	if(message=="No matches found")
	return"Geen overeenkomsten gevonden";
	if(message=="Please enter")
	return"Kom binnen alstublieft";
	if(message==" or more character")
	return"of meer karakter";
	if(message=="Loading failed")
	return"Laden is mislukt";
return"";
}