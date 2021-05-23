// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"आपके द्वारा चयनित अभिलेख को नष्ट करना चाहते हैं";
    if(message=="Please Select Any Record")
    return"कृपया चुनें कोई रिकॉर्ड";
    if(message=="Do You Want To Delete")
    return"आप को मिटाना चाहते हैं";
    if(message=="Record")
    return"अभिलेख";
    if(message=="All Selected")
    return"सभी चयनित";
    if(message=="Search")
    return"खोज";
    if(message=="None selected")
    return"कोई भी नहीं चुना गया";
    if(message==" 0 character (1 sms)")
    return"0 वर्ण (1 एसएमएस)";
    if(message==" characters ")
    return"वर्ण";
    if(message==" sms)")
    return"एसएमएस)";
if(message=="Searching\u2026")
	return"खोज कर...";
	if(message=="No matches found")
	return"कोई मेल नहीं मिले";
	if(message=="Please enter")
	return"कृपया दर्ज करें";
	if(message==" or more character")
	return"या अधिक चरित्र";
	if(message=="Loading failed")
	return"लोड विफल रहा है";
return"";
}