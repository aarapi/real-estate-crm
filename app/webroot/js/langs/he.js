// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"האם אתה רוצה למחוק שנבחר שיא";
    if(message=="Please Select Any Record")
    return"אנא בחר כל שיא";
    if(message=="Do You Want To Delete")
    return"האם אתה רוצה למחוק";
    if(message=="Record")
    return"רשומה";
    if(message=="All Selected")
    return"כל נבחרות";
    if(message=="Search")
    return"חפש";
    if(message=="None selected")
    return"לא נבחר אף אחד";
    if(message==" 0 character (1 sms)")
    return"0 תו (1 sms)";
    if(message==" characters ")
    return"דמויות";
    if(message==" sms)")
    return"סמס)";
if(message=="Searching\u2026")
	return"מחפש...";
	if(message=="No matches found")
	return"אין תוצאות מתאימות";
	if(message=="Please enter")
	return"בבקשה היכנס";
	if(message==" or more character")
	return"או יותר אופי";
	if(message=="Loading failed")
	return"טעינה נכשלה";
return"";
}