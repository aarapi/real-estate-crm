// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ingaba ufuna ukucima irekhodi ekhethiweyo";
    if(message=="Please Select Any Record")
    return"Nceda Khetha Nawuphi Record";
    if(message=="Do You Want To Delete")
    return"Ingaba ufuna ukucima";
    if(message=="Record")
    return"irekhodi";
    if(message=="All Selected")
    return"zonke ezikhethiweyo";
    if(message=="Search")
    return"ukufuna";
    if(message=="None selected")
    return"akukho ekhethiweyo";
    if(message==" 0 character (1 sms)")
    return"0 uphawu (1 sms)";
    if(message==" characters ")
    return"abalinganiswa";
    if(message==" sms)")
    return"i-SMS)";
if(message=="Searching\u2026")
	return"Ukukhangela ...";
	if(message=="No matches found")
	return"Akukho ntelekiso efunyenweyo";
	if(message=="Please enter")
	return"Nceda faka";
	if(message==" or more character")
	return"okanye yomlinganiswa ngaphezulu";
	if(message=="Loading failed")
	return"Ilayisha aluphumelelanga";
return"";
}