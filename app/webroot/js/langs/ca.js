// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Vols eliminar el registre seleccionat";
    if(message=="Please Select Any Record")
    return"Seleccioneu qualsevol registre";
    if(message=="Do You Want To Delete")
    return"És vostè vol esborrar";
    if(message=="Record")
    return"registre";
    if(message=="All Selected")
    return"tots els seleccionats";
    if(message=="Search")
    return"Cerca";
    if(message=="None selected")
    return"cap seleccionada";
    if(message==" 0 character (1 sms)")
    return"0 de caràcters (1 sms)";
    if(message==" characters ")
    return"personatges";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Buscant ...";
	if(message=="No matches found")
	return"No s'han trobat coincidències";
	if(message=="Please enter")
	return"Si us plau, introdueixi";
	if(message==" or more character")
	return"o més caràcter";
	if(message=="Loading failed")
	return"carregant no";
return"";
}