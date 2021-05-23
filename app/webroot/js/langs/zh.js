// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"你要删除所选的记录";
    if(message=="Please Select Any Record")
    return"请选择任何记录";
    if(message=="Do You Want To Delete")
    return"你想删除";
    if(message=="Record")
    return"记录";
    if(message=="All Selected")
    return"所有选定";
    if(message=="Search")
    return"搜索";
    if(message=="None selected")
    return"未选择";
    if(message==" 0 character (1 sms)")
    return"0字（1 短信）";
    if(message==" characters ")
    return"人物";
    if(message==" sms)")
    return"短信）";
if(message=="Searching\u2026")
	return"搜索...";
	if(message=="No matches found")
	return"没有找到匹配";
	if(message=="Please enter")
	return"请输入";
	if(message==" or more character")
	return"或多个字符";
	if(message=="Loading failed")
	return"加载失败";
return"";
}