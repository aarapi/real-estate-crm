// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Você quer apagar registro selecionado";
    if(message=="Please Select Any Record")
    return"Selecione qualquer registro";
    if(message=="Do You Want To Delete")
    return"Você deseja excluir";
    if(message=="Record")
    return"Registro";
    if(message=="All Selected")
    return"Todos Selecionado";
    if(message=="Search")
    return"Pesquisa";
    if(message=="None selected")
    return"Nenhum selecionado";
    if(message==" 0 character (1 sms)")
    return"0 caracteres (1 sms)";
    if(message==" characters ")
    return"personagens";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Procurando...";
	if(message=="No matches found")
	return"Nenhuma equivalência encontrada";
	if(message=="Please enter")
	return"Por favor, insira";
	if(message==" or more character")
	return"ou mais caracteres";
	if(message=="Loading failed")
	return"Carregando falhou";
return"";
}