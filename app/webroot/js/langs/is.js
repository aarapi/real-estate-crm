// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Viltu eyða völdu met";
    if(message=="Please Select Any Record")
    return"Vinsamlegast Veldu Allir Record";
    if(message=="Do You Want To Delete")
    return"Gera Þú Vilja Til Eyða";
    if(message=="Record")
    return"Met";
    if(message=="All Selected")
    return"Allt Valin";
    if(message=="Search")
    return"leit";
    if(message=="None selected")
    return"ekkert valið";
    if(message==" 0 character (1 sms)")
    return"0 staf (1 SMS)";
    if(message==" characters ")
    return"stafir";
    if(message==" sms)")
    return"smáskilaboð)";
if(message=="Searching\u2026")
	return"Leita...";
	if(message=="No matches found")
	return"Engar niðurstöður fundust";
	if(message=="Please enter")
	return"vinsamlegast sláðu";
	if(message==" or more character")
	return"eða meira karakter";
	if(message=="Loading failed")
	return"Ekki tókst að hlaða";
return"";
}