// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Bạn có muốn xóa hồ sơ được lựa chọn";
    if(message=="Please Select Any Record")
    return"Vui lòng chọn Bất kỳ Ghi";
    if(message=="Do You Want To Delete")
    return"Bạn có muốn Xóa";
    if(message=="Record")
    return"Ghi lại";
    if(message=="All Selected")
    return"Tất cả các lựa chọn";
    if(message=="Search")
    return"Tìm kiếm";
    if(message=="None selected")
    return"Không có lựa chọn";
    if(message==" 0 character (1 sms)")
    return"0 ký tự (1 sms)";
    if(message==" characters ")
    return"nhân vật";
    if(message==" sms)")
    return"tin nhắn)";
if(message=="Searching\u2026")
	return"Đang tìm kiếm...";
	if(message=="No matches found")
	return"Lọc kết quả tìm thấy";
	if(message=="Please enter")
	return"Vui lòng nhập";
	if(message==" or more character")
	return"hoặc có nhiều ký tự";
	if(message=="Loading failed")
	return"tải không thành công";
return"";
}