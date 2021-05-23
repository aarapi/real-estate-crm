// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Ցանկանում եք ջնջել ընտրված ռեկորդ";
    if(message=="Please Select Any Record")
    return"Խնդրում ենք ընտրել ցանկացած գրառում";
    if(message=="Do You Want To Delete")
    return"Դուք ցանկանում եք ջնջել";
    if(message=="Record")
    return"Գրառում";
    if(message=="All Selected")
    return"Բոլորը Ընտրված";
    if(message=="Search")
    return"որոնում";
    if(message=="None selected")
    return"ոչ ոք ընտրված";
    if(message==" 0 character (1 sms)")
    return"0 բնավորությունը (1 SMS)";
    if(message==" characters ")
    return"նիշ";
    if(message==" sms)")
    return"SMS)";
if(message=="Searching\u2026")
	return"Որոնվում ...";
	if(message=="No matches found")
	return"Ոչ նորություն է գտնվել";
	if(message=="Please enter")
	return"Խնդրում ենք մուտք գործել";
	if(message==" or more character")
	return"կամ ավելի բնավորությունը";
	if(message=="Loading failed")
	return"Բեռնվում ձախողվեց";
return"";
}