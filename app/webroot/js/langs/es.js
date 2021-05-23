// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"¿Quieres eliminar el registro seleccionado";
    if(message=="Please Select Any Record")
    return"Por favor, seleccione cualquier registro";
    if(message=="Do You Want To Delete")
    return"Quieres borrar";
    if(message=="Record")
    return"Grabar";
    if(message=="All Selected")
    return"todos los seleccionados";
    if(message=="Search")
    return"Buscar";
    if(message=="None selected")
    return"Ninguna seleccionada";
    if(message==" 0 character (1 sms)")
    return"0 de caracteres (1 sms)";
    if(message==" characters ")
    return"caracteres";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Buscando...";
	if(message=="No matches found")
	return"No se encontraron coincidencias";
	if(message=="Please enter")
	return"Por favor escribe";
	if(message==" or more character")
	return"o más carácter";
	if(message=="Loading failed")
	return"Cargando no";
    if(message=="Area")
    return"Zona";
    if(message=="Amount")
    return"Cantidad";
    if(message=="Discount")
    return"Descuento";
    if(message=="Payable Amount")
    return"Cantidad a pagar";
return"";
}