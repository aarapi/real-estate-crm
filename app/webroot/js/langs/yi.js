// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"צי איר ווילן צו ויסמעקן אויסגעקליבן רעקאָרד";
    if(message=="Please Select Any Record")
    return"ביטע סעלעקט קיין רעקאָרד";
    if(message=="Do You Want To Delete")
    return"דו זאלסט איר ווילן צו ויסמעקן";
    if(message=="Record")
    return"רעקאָרד";
    if(message=="All Selected")
    return"אַלע אויסגעקליבן";
    if(message=="Search")
    return"זוכן";
    if(message=="None selected")
    return"קיין אויסגעקליבן";
    if(message==" 0 character (1 sms)")
    return"0 כאַראַקטער (1 SMS)";
    if(message==" characters ")
    return"אותיות";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"זוכנדיק ...";
	if(message=="No matches found")
	return"ניט קיין שוועבעלעך געפֿונען";
	if(message=="Please enter")
	return"ביטע אַרייַן";
	if(message==" or more character")
	return"אָדער מער כאַראַקטער";
	if(message=="Loading failed")
	return"לאָודינג אַנדערש";
return"";
}