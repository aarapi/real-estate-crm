// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ar mhaith leat taifead roghnaithe a scriosadh";
    if(message=="Please Select Any Record")
    return"oghnaigh le do thoil ar bith Taifead";
    if(message=="Do You Want To Delete")
    return"An bhfuil tú Want a Scrios";
    if(message=="Record")
    return"taifead";
    if(message=="All Selected")
    return"Gach Roghnaithe";
    if(message=="Search")
    return"Search";
    if(message=="None selected")
    return"Níl aon rud roghnaithe";
    if(message==" 0 character (1 sms)")
    return"0 carachtar (1 SMS)";
    if(message==" characters ")
    return"carachtair";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Ag cuardach ...";
	if(message=="No matches found")
	return"aimsíodh Níor";
	if(message=="Please enter")
	return"Cuir isteach";
	if(message==" or more character")
	return"nó carachtar níos";
	if(message=="Loading failed")
	return"theip Loading";
return"";
}