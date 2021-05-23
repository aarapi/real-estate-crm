// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Vai vēlaties dzēst izvēlēto ierakstu";
    if(message=="Please Select Any Record")
    return"Lūdzu, izvēlieties jebkuru ierakstu";
    if(message=="Do You Want To Delete")
    return"Vai vēlaties dzēst";
    if(message=="Record")
    return"ieraksts";
    if(message=="All Selected")
    return"visi atlasīts";
    if(message=="Search")
    return"Meklēt";
    if(message=="None selected")
    return"Nav atlasīts";
    if(message==" 0 character (1 sms)")
    return"0 raksturs (1 SMS)";
    if(message==" characters ")
    return"zīmes";
    if(message==" sms)")
    return"īsziņa)";
if(message=="Searching\u2026")
	return"Meklē ...";
	if(message=="No matches found")
	return"Nav atrasts neviens sērkociņi";
	if(message=="Please enter")
	return"ievadiet";
	if(message==" or more character")
	return"vai vairāk rakstzīmju";
	if(message=="Loading failed")
	return"iekraušana neizdevās";
return"";
}