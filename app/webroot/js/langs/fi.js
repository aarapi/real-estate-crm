// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Haluatko poistaa valitun tietueen";
    if(message=="Please Select Any Record")
    return"Valitse Mikä tahansa Record";
    if(message=="Do You Want To Delete")
    return"Do haluat poistaa";
    if(message=="Record")
    return"Ennätys";
    if(message=="All Selected")
    return"kaikki valitut";
    if(message=="Search")
    return"Haku";
    if(message=="None selected")
    return"Ei valittu";
    if(message==" 0 character (1 sms)")
    return"0 merkki (1 sms)";
    if(message==" characters ")
    return"merkkiä";
    if(message==" sms)")
    return" sms)";
if(message=="Searching\u2026")
	return"Etsiä...";
	if(message=="No matches found")
	return"Ei hakua vastaavia tuloksia";
	if(message=="Please enter")
	return"Käy sisään";
	if(message==" or more character")
	return"tai enemmän luonnetta";
	if(message=="Loading failed")
	return"Ladataan epäonnistui";
return"";
}