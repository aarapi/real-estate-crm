// JavaScript Document
function getLocale(message)
{
    if(message=="Do you want to delete selected record")
    return"Voulez-vous supprimer l'enregistrement sélectionné";
    if(message=="Please Select Any Record")
    return"S'il vous plaît Sélectionnez Toute la fiche";
    if(message=="Do You Want To Delete")
    return"Êtes-vous le souhaitez supprimer";
    if(message=="Record")
    return"Record";
    if(message=="All Selected")
    return"tous les éléments sélectionnés";
    if(message=="Search")
    return"Chercher";
    if(message=="None selected")
    return"Aucune sélection";
    if(message==" 0 character (1 sms)")
    return"0 caractère (1 sms)";
    if(message==" characters ")
    return"personnages";
    if(message==" sms)")
    return"SMS)";
	if(message=="Searching\u2026")
	return"Recherche...";
	if(message=="No matches found")
	return"Aucun résultat";
	if(message=="Please enter")
	return"Entrez s'il vous plait";
	if(message==" or more character")
	return"ou plus de caractère";
	if(message=="Loading failed")
	return"Échec du chargement";
return"";
}