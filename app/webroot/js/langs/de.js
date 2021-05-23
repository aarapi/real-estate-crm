// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Wollen Sie ausgewählte Datensatz zu löschen";
    if(message=="Please Select Any Record")
    return"Bitte wählen Nehmen";
    if(message=="Do You Want To Delete")
    return"Sie löschen möchten";
    if(message=="Record")
    return"Aufzeichnen";
    if(message=="All Selected")
    return"Alle ausgewählten";
    if(message=="Search")
    return"Suche";
    if(message=="None selected")
    return"Nichts ausgewählt";
    if(message==" 0 character (1 sms)")
    return"0 Zeichen (1 SMS)";
    if(message==" characters ")
    return"Figuren";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Suche ...";
	if(message=="No matches found")
	return"Keine Treffer gefunden";
	if(message=="Please enter")
	return"Bitte eingeben";
	if(message==" or more character")
	return"oder mehr Zeichen";
	if(message=="Loading failed")
	return"Laden fehlgeschlagen";
return"";
}