// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ydych chi am ddileu'r cofnod a ddewiswyd";
    if(message=="Please Select Any Record")
    return"Dewiswch Unrhyw Cofnod";
    if(message=="Do You Want To Delete")
    return"Ydych chi am ddileu'r";
    if(message=="Record")
    return"cofnod";
    if(message=="All Selected")
    return"pob dethol";
    if(message=="Search")
    return"Chwilio";
    if(message=="None selected")
    return"Dim ddewiswyd";
    if(message==" 0 character (1 sms)")
    return"0 gymeriad (1 sms)";
    if(message==" characters ")
    return"cymeriadau";
    if(message==" sms)")
    return"neges destun)";
if(message=="Searching\u2026")
	return"Chwilio ...";
	if(message=="No matches found")
	return"Ni chafwyd gemau";
	if(message=="Please enter")
	return"Rhowch";
	if(message==" or more character")
	return"neu fwy o gymeriad";
	if(message=="Loading failed")
	return"methodd llwytho";
return"";
}