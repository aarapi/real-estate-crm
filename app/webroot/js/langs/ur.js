// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"آپ کے منتخب کردہ ریکارڈ کو حذف کرنا چاہتے ہیں";
    if(message=="Please Select Any Record")
    return"کوئی ریکارڈ نہیں براہ مہربانی منتخب کریں";
    if(message=="Do You Want To Delete")
    return"آپ حذف کرنا چاہتے ہیں";
    if(message=="Record")
    return"ریکارڈ";
    if(message=="All Selected")
    return"تمام منتخب شدہ";
    if(message=="Search")
    return"تلاش کریں";
    if(message=="None selected")
    return"کوئی منتخب";
    if(message==" 0 character (1 sms)")
    return"0 کردار (1 SMS)";
    if(message==" characters ")
    return"کرداروں";
    if(message==" sms)")
    return"پیغام)";
	if(message=="Searching\u2026")
	return"تلاش ہو ...";
	if(message=="No matches found")
	return"کوئی مماثلت نہیں ملی";
	if(message=="Please enter")
	return"درج کریں";
	if(message==" or more character")
	return"یا اس سے زیادہ حروف";
	if(message=="Loading failed")
	return"لوڈ ہونے میں ناکام رہا";	
return"";
}