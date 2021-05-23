// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"A doni të fshini rekord zgjedhur";
    if(message=="Please Select Any Record")
    return"Ju lutemi Zgjidh Çdo Record";
    if(message=="Do You Want To Delete")
    return"A doni të Fshij";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"All zgjedhura";
    if(message=="Search")
    return"kërkim";
    if(message=="None selected")
    return"Asnjë zgjedhur";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karaktere";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Duke kërkuar ...";
	if(message=="No matches found")
	return"Nuk u gjet";
	if(message=="Please enter")
	return"Ju lutemi shkruani";
	if(message==" or more character")
	return"ose më shumë karakter";
	if(message=="Loading failed")
	return"Loading dështuar";
return"";
}