// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Chcete zmazať vybratý záznam";
    if(message=="Please Select Any Record")
    return"Prosím, vyberte nejaký záznam";
    if(message=="Do You Want To Delete")
    return"Myslíte, že chcete zmazať";
    if(message=="Record")
    return"záznam";
    if(message=="All Selected")
    return"všetky vybrané";
    if(message=="Search")
    return"Vyhľadanie";
    if(message=="None selected")
    return"žiadne vybraná";
    if(message==" 0 character (1 sms)")
    return"0 znak (1 sms)";
    if(message==" characters ")
    return"znaky";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Vyhľadávanie ...";
	if(message=="No matches found")
	return"Žiadne zhody nenájdené";
	if(message=="Please enter")
	return"Prosím Vlož";
	if(message==" or more character")
	return"alebo viac znakov";
	if(message=="Loading failed")
	return"načítanie zlyhalo";
return"";
}