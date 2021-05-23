// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ingabe ufuna ukususa irekhodi akhethiwe";
    if(message=="Please Select Any Record")
    return"Sicela ukhethe noma iyiphi Record";
    if(message=="Do You Want To Delete")
    return"Ingabe ufuna ukususa";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"Zonke Kukhethwe";
    if(message=="Search")
    return"Ukucinga";
    if(message=="None selected")
    return"Akukho okukhethiwe";
    if(message==" 0 character (1 sms)")
    return"0 uhlamvu (1 sms)";
    if(message==" characters ")
    return"izinhlamvu";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Ukusesha ...";
	if(message=="No matches found")
	return"Akukho okufanayo okutholiwe";
	if(message=="Please enter")
	return"Sicela ufake";
	if(message==" or more character")
	return"noma uhlamvu ngaphezulu";
	if(message=="Loading failed")
	return"Ukulayisha kuhlulekile";
return"";
}