// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Seçilen kaydı silmek istiyor musunuz";
    if(message=="Please Select Any Record")
    return"Herhangi Record Seçiniz";
    if(message=="Do You Want To Delete")
    return"Sil İstermisiniz";
    if(message=="Record")
    return"Kayıt";
    if(message=="All Selected")
    return"Tüm Seçili";
    if(message=="Search")
    return"Arama";
    if(message=="None selected")
    return"Hiçbiri seçilmedi";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karakterler";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Aramak...";
	if(message=="No matches found")
	return"Hiçbir sonuç bulunamadı";
	if(message=="Please enter")
	return"Girin lütfen";
	if(message==" or more character")
	return"veya daha fazla karakter";
	if(message=="Loading failed")
	return"yükleme başarısız oldu";
return"";
}