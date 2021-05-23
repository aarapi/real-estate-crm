// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Apakah Anda ingin menghapus catatan yang dipilih";
    if(message=="Please Select Any Record")
    return"Silakan Pilih saja Rekam";
    if(message=="Do You Want To Delete")
    return"Apakah Anda Ingin Hapus";
    if(message=="Record")
    return"Merekam";
    if(message=="All Selected")
    return"semua Dipilih";
    if(message=="Search")
    return"Pencarian";
    if(message=="None selected")
    return"Tidak ada yang di pilih";
    if(message==" 0 character (1 sms)")
    return"0 karakter (1 sms)";
    if(message==" characters ")
    return"karakter";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Mencari ...";
	if(message=="No matches found")
	return"Tidak ada yang cocok";
	if(message=="Please enter")
	return"masukkan";
	if(message==" or more character")
	return"atau karakter yang lebih";
	if(message=="Loading failed")
	return"Memuat gagal";
return"";
}