// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"あなたが選択したレコードを削除しますか";
    if(message=="Please Select Any Record")
    return"任意のレコードを選択してください";
    if(message=="Do You Want To Delete")
    return"あなたが削除しますか";
    if(message=="Record")
    return"記録";
    if(message=="All Selected")
    return"すべて選択";
    if(message=="Search")
    return"サーチ";
    if(message=="None selected")
    return"選択されていません";
    if(message==" 0 character (1 sms)")
    return"0文字（1 SMS）";
    if(message==" characters ")
    return"文字";
    if(message==" sms)")
    return"SMS）";
if(message=="Searching\u2026")
	return"検索中...";
	if(message=="No matches found")
	return"一致が見つかりませんでした";
	if(message=="Please enter")
	return"入ってください";
	if(message==" or more character")
	return"以上の文字";
	if(message=="Loading failed")
	return"読み込み中に失敗しました";
return"";
}