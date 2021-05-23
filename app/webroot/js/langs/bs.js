// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Želite li izbrisati odabrani zapis";
    if(message=="Please Select Any Record")
    return"Molimo izaberite svaki trag";
    if(message=="Do You Want To Delete")
    return"Da li želite da obrišete";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"sve izabrane";
    if(message=="Search")
    return"pretraživanje";
    if(message=="None selected")
    return"Nema odabira";
    if(message==" 0 character (1 sms)")
    return"0 karaktera ( 1 sms )";
    if(message==" characters ")
    return"likovi";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Tražim ...";
	if(message=="No matches found")
	return"Nije pronađen nikakav meč";
	if(message=="Please enter")
	return"Molimo unesite";
	if(message==" or more character")
	return"ili više karaktera";
	if(message=="Loading failed")
	return"loading nije";
return"";
}