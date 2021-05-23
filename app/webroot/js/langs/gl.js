// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Quere eliminar rexistro seleccionado";
    if(message=="Please Select Any Record")
    return"Seleccione calquera rexistro";
    if(message=="Do You Want To Delete")
    return"Desexa eliminar";
    if(message=="Record")
    return"rexistro";
    if(message=="All Selected")
    return"All Selected";
    if(message=="Search")
    return"busca";
    if(message=="None selected")
    return"ningún seleccionado";
    if(message==" 0 character (1 sms)")
    return"0 caracteres (1 sms)";
    if(message==" characters ")
    return"caracteres";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Buscar ...";
	if(message=="No matches found")
	return"Non hai rexistro de partidos";
	if(message=="Please enter")
	return"Introduza";
	if(message==" or more character")
	return"ou máis caracteres";
	if(message=="Loading failed")
	return"cargando fallou";
return"";
}