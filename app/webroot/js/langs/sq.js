// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"A doni t� fshini rekord zgjedhur";
    if(message=="Please Select Any Record")
    return"Ju lutemi Zgjidh �do Record";
    if(message=="Do You Want To Delete")
    return"A doni t� Fshij";
    if(message=="Record")
    return"rekord";
    if(message=="All Selected")
    return"All zgjedhura";
    if(message=="Search")
    return"k�rkim";
    if(message=="None selected")
    return"Asnj� zgjedhur";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karaktere";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Duke k�rkuar ...";
	if(message=="No matches found")
	return"Nuk u gjet";
	if(message=="Please enter")
	return"Ju lutemi shkruani";
	if(message==" or more character")
	return"ose m� shum� karakter";
	if(message=="Loading failed")
	return"Loading d�shtuar";
return"";
}