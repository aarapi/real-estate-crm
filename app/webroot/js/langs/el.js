// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Θέλετε να διαγράψετε το επιλεγμένο αρχείο";
    if(message=="Please Select Any Record")
    return"Επιλέξτε οποιαδήποτε εγγραφή";
    if(message=="Do You Want To Delete")
    return"Μήπως θέλετε να διαγράψετε";
    if(message=="Record")
    return"Ρεκόρ";
    if(message=="All Selected")
    return"όλα τα επιλεγμένα";
    if(message=="Search")
    return"Έρευνα";
    if(message=="None selected")
    return"κανένα επιλεγμένο";
    if(message==" 0 character (1 sms)")
    return"0 χαρακτήρα (1 sms)";
    if(message==" characters ")
    return"χαρακτήρες";
    if(message==" sms)")
    return"γραπτό μήνυμα)";
if(message=="Searching\u2026")
	return"Ερευνητικός";
	if(message=="No matches found")
	return"Δεν βρέθηκαν αντιστοιχίες";
	if(message=="Please enter")
	return"Παρακαλώ περάστε";
	if(message==" or more character")
	return"ή περισσότερο χαρακτήρα";
	if(message=="Loading failed")
	return"Αποτυχία φόρτωσης";
return"";
}