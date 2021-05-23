// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Szeretné törölni a kiválasztott rekord";
    if(message=="Please Select Any Record")
    return"Kérem válasszon a Record";
    if(message=="Do You Want To Delete")
    return"Akarsz törlése";
    if(message=="Record")
    return"Rekord";
    if(message=="All Selected")
    return"Az összes kiválasztott";
    if(message=="Search")
    return"Keres";
    if(message=="None selected")
    return"Nincs kiválasztva";
    if(message==" 0 character (1 sms)")
    return"0 karaktert (1 sms)";
    if(message==" characters ")
    return"karakterek";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Keresés ...";
	if(message=="No matches found")
	return"Nincs találat";
	if(message=="Please enter")
	return"Kérlek lépj be";
	if(message==" or more character")
	return"vagy több karakter";
	if(message=="Loading failed")
	return"A betöltés sikertelen";
return"";
}