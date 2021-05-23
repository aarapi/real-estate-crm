// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Wil jy gekies rekord verwyder";
    if(message=="Please Select Any Record")
    return"Kies enige rekord";
    if(message=="Do You Want To Delete")
    return"Wil jy 'Verwyder";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"Alle gekeurde";
    if(message=="Search")
    return"Soek";
    if(message=="None selected")
    return"Geen gekies";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karakters";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Soek ...";
	if(message=="No matches found")
	return"Geen items wat pas";
	if(message=="Please enter")
	return"voer";
	if(message==" or more character")
	return"of meer karakter";
	if(message=="Loading failed")
	return"laai kon";
return"";
}