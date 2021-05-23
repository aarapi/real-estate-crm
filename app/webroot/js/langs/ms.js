// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Adakah anda mahu memadamkan rekod dipilih";
    if(message=="Please Select Any Record")
    return"Sila Pilih Sebarang Rekod";
    if(message=="Do You Want To Delete")
    return"Adakah Anda Mahu Padam";
    if(message=="Record")
    return"rekod";
    if(message=="All Selected")
    return"semua Dipilih";
    if(message=="Search")
    return"carian";
    if(message=="None selected")
    return"Tiada dipilih";
    if(message==" 0 character (1 sms)")
    return"0 watak (1 sms)";
    if(message==" characters ")
    return"watak";
    if(message==" sms)")
    return"sms)";
if(message=="Searching\u2026")
	return"Mencari...";
	if(message=="No matches found")
	return"Tiada padanan ditemui";
	if(message=="Please enter")
	return"Sila masukkan";
	if(message==" or more character")
	return"atau watak lebih";
	if(message=="Loading failed")
	return"Loading gagal";
return"";
}