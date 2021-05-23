// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"آیا شما می خواهید به حذف رکورد انتخاب شده";
    if(message=="Please Select Any Record")
    return"لطفا هر گونه ضبط انتخاب کنی";
    if(message=="Do You Want To Delete")
    return"آیا شما می خواهید برای پاک کردن";
    if(message=="Record")
    return"رکورد";
    if(message=="All Selected")
    return"همه انتخاب";
    if(message=="Search")
    return"جستجو کردن";
    if(message=="None selected")
    return"هیچکدام انتخاب";
    if(message==" 0 character (1 sms)")
    return"0 شخصیت (1 اس ام اس)";
    if(message==" characters ")
    return"شخصیت ها";
    if(message==" sms)")
    return"پیامک)";
if(message=="Searching\u2026")
	return"...جستجوکردن";
	if(message=="No matches found")
	return"جستجو حاصلی دربرنداشت";
	if(message=="Please enter")
	return"لطفا وارد";
	if(message==" or more character")
	return"یا شخصیت بیشتر";
	if(message=="Loading failed")
	return"در حال بارگذاری شکست خورده";
return"";
}