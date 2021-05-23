// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"هل تريد حذف السجل المحدد";
    if(message=="Please Select Any Record")
    return"يرجى تحديد أي سجل";
    if(message=="Do You Want To Delete")
    return"هل تريد حذف";
    if(message=="Record")
    return"سجل";
    if(message=="All Selected")
    return"كل مختارة";
    if(message=="Search")
    return"بحث";
    if(message=="None selected")
    return"لم يتم التحديد";
    if(message==" 0 character (1 sms)")
    return"0 حرف (1 القصيرة)";
    if(message==" characters ")
    return"الشخصيات";
    if(message==" sms)")
    return"رسالة قصيرة)";
if(message=="Searching\u2026")
	return"...البحث";
	if(message=="No matches found")
	return"لا توجد مباريات";
	if(message=="Please enter")
	return"تفضل";
	if(message==" or more character")
	return"أو أكثر شخصية";
	if(message=="Loading failed")
	return"فشل التحميل";
return"";
}