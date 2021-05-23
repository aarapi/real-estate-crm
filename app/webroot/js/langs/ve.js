// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Do you want to delete selected record";
    if(message=="Please Select Any Record")
    return"Please Select Any Record";
    if(message=="Do You Want To Delete")
    return"Do You Want To Delete";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"All Selected";
    if(message=="Search")
    return"Search";
    if(message=="None selected")
    return"None selected";
    if(message==" 0 character (1 sms)")
    return" 0 character (1 sms)";
    if(message==" characters ")
    return" characters ";
    if(message==" sms)")
    return" sms)";
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