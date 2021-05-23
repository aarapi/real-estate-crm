// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ar norite ištrinti pasirinktą įrašą";
    if(message=="Please Select Any Record")
    return"Išrinkite jokio įrašo";
    if(message=="Do You Want To Delete")
    return"Ar norite ištrinti";
    if(message=="Record")
    return"įrašas";
    if(message=="All Selected")
    return"visi atrinkti";
    if(message=="Search")
    return"Paieška";
    if(message=="None selected")
    return"Nieko nepasirinkta";
    if(message==" 0 character (1 sms)")
    return"0 charakteris (1 trumpoji žinutė)";
    if(message==" characters ")
    return"personažai";
    if(message==" sms)")
    return"trumpoji žinutė)";
if(message=="Searching\u2026")
	return"Ieškoma ...";
	if(message=="No matches found")
	return"Nerasta atitikmenų";
	if(message=="Please enter")
	return"Prašome įvesti";
	if(message==" or more character")
	return"arba daugiau simbolių";
	if(message=="Loading failed")
	return"Kraunasi nepavyko";
return"";
}