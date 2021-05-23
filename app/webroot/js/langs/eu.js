// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ez hautatutako erregistroa ezabatu nahi dituzula";
    if(message=="Please Select Any Record")
    return"Aukeratu Edozein grabatu";
    if(message=="Do You Want To Delete")
    return"Ezabatu nahi duzu";
    if(message=="Record")
    return"Grabatu";
    if(message=="All Selected")
    return"guztiak Aukeratutako";
    if(message=="Search")
    return"Search";
    if(message=="None selected")
    return"Ez da ezer aukeratu";
    if(message==" 0 character (1 sms)")
    return"0 pertsonaia (1 sms)";
    if(message==" characters ")
    return"karaktere";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Bilatzen ...";
	if(message=="No matches found")
	return"Ez da emaitzarik aurkitu";
	if(message=="Please enter")
	return"Mesedez sartu";
	if(message==" or more character")
	return"edo pertsonaia gehiago";
	if(message=="Loading failed")
	return"huts Lanean";
return"";
}