// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Do inti tixtieq li tħassar rekord magħżula";
    if(message=="Please Select Any Record")
    return"Jekk jogħġbok Agħżel Kwalunkwe Rekord";
    if(message=="Do You Want To Delete")
    return"Tixtieq Ħassar";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"kollha Magħżula";
    if(message=="Search")
    return"Fittex";
    if(message=="None selected")
    return"Xejn magħżula";
    if(message==" 0 character (1 sms)")
    return"0 karattru (1 sms)";
    if(message==" characters ")
    return"karattri";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Tiftix ...";
	if(message=="No matches found")
	return"Ebda taqbila misjuba";
	if(message=="Please enter")
	return"Jekk jogħġbok daħħal";
	if(message==" or more character")
	return"jew aktar karattru";
	if(message=="Loading failed")
	return"tagħbija naqset";
return"";
}