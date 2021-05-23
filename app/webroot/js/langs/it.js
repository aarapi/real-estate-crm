// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Vuoi eliminare record selezionato";
    if(message=="Please Select Any Record")
    return"Per favore selezionate un record";
    if(message=="Do You Want To Delete")
    return"Vuoi eliminare";
    if(message=="Record")
    return"Disco";
    if(message=="All Selected")
    return"tutti i selezionati";
    if(message=="Search")
    return"Ricerca";
    if(message=="None selected")
    return"Nessuno selezionato";
    if(message==" 0 character (1 sms)")
    return"0 carattere (1 sms)";
    if(message==" characters ")
    return"personaggi";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Ricerca in corso ...";
	if(message=="No matches found")
	return"Nessun risultato trovato";
	if(message=="Please enter")
	return"Prego entra";
	if(message==" or more character")
	return"o più carattere";
	if(message=="Loading failed")
	return"Caricamento fallito";
return"";
}