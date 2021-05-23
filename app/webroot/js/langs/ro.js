// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Doriți să ștergeți înregistrarea selectată";
    if(message=="Please Select Any Record")
    return"Vă rugăm să selectați orice înregistrare";
    if(message=="Do You Want To Delete")
    return"Doriți să Ștergeți";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"Au fost selectate toate";
    if(message=="Search")
    return"Căutare";
    if(message=="None selected")
    return"Nici unul selectat";
    if(message==" 0 character (1 sms)")
    return"0 caractere (1 sms)";
    if(message==" characters ")
    return"caractere";
    if(message==" sms)")
    return"mesaj)";
if(message=="Searching\u2026")
	return"In cautarea...";
	if(message=="No matches found")
	return"Nu s-a gasit nici o potrivire";
	if(message=="Please enter")
	return"Te rog intra";
	if(message==" or more character")
	return"sau mai multe caractere";
	if(message=="Loading failed")
	return"Se încarcă nu a reușit";
return"";
}