// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ali želite izbrisati izbrani zapis";
    if(message=="Please Select Any Record")
    return"Izberi Vse Record";
    if(message=="Do You Want To Delete")
    return"Želite Delete";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"vse Izbrano";
    if(message=="Search")
    return"Iskanje";
    if(message=="None selected")
    return"ni izbrano";
    if(message==" 0 character (1 sms)")
    return"0 znak (1 sms)";
    if(message==" characters ")
    return"znaki";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Iskanje ...";
	if(message=="No matches found")
	return"Ni zadetkov";
	if(message=="Please enter")
	return"vnesite";
	if(message==" or more character")
	return"ali več znakov";
	if(message=="Loading failed")
	return"Nalaganje ni uspelo";
return"";
}