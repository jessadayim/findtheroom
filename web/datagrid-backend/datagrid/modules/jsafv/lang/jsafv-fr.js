FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "<_TITLE_OF_FIELD_> est requis!\n";
FormValidator._MSG["MSG_2"] = "<_TITLE_OF_FIELD_> est requis! Entrez une valeur cohйrente.\n";
FormValidator._MSG["MSG_3"] = "Vous devez être identifié en tant que boîte de <_TITLE_OF_FIELD_> vérifié!\n";
FormValidator._MSG["MSG_4"] = "<_TITLE_OF_FIELD_> champ doit _TYPE_OF_FIELD_! Ressaisissez, SVP.\n";
FormValidator._MSG["MSG_5"] = "<_TITLE_OF_FIELD_> champ doit rempli par _TYPE_OF_FIELD_! Ressaisissez, SVP.\n";
FormValidator._MSG["MSG_6"] = "Vous devez vérifier au moins un bouton radio <_TITLE_OF_FIELD_>!";

FormValidator._MSG["SNT_1"] = "valeur";
FormValidator._MSG["SNT_2"] = "positive ";
FormValidator._MSG["SNT_3"] = "positive ou nйgative ";
FormValidator._MSG["SNT_4"] = "MAJUSCULE";
FormValidator._MSG["SNT_5"] = "positive ";
FormValidator._MSG["SNT_6"] = "negative ";
FormValidator._MSG["SNT_7"] = "Casse normale";
FormValidator._MSG["SNT_8"] = "minuscule";
FormValidator._MSG["SNT_9"] = "un ";
FormValidator._MSG["SNT_10"] = "_SUB_TYPE_OF_FIELD_ est un nombre";
FormValidator._MSG["SNT_11"] = "_SUB_TYPE_OF_FIELD_ est un entier";
FormValidator._MSG["SNT_12"] = "_SUB_TYPE_OF_FIELD_ float(réel) de valeur";
FormValidator._MSG["SNT_13"] = "_SUB_TYPE_OF_FIELD_ est valeur alphabétique";
FormValidator._MSG["SNT_14"] = "_SUB_TYPE_OF_FIELD_ est constituй d'un texte";
FormValidator._MSG["SNT_15"] = "_PASS_LENGTH_ doit contenir des lettres et de chiffres";
FormValidator._MSG["SNT_16"] = "_LOGIN_LENGTH_ doit commencer par une lettre ou un chiffre";
FormValidator._MSG["SNT_17"] = "est un code postale (5 chiffres au moins)";
FormValidator._MSG['SNT_18'] = "est une adresse e-mail";
FormValidator._MSG['SNT_19'] = "_PASS_LENGTH_ trop court";
FormValidator._MSG['SNT_20'] = "type requis";
FormValidator._MSG['SNT_21'] = "est une URL valide";
FormValidator._MSG['SNT_22'] = "кtre un numйro SSN valide (9 chiffres ou dans la forme XXX-XX-XXXX)";
FormValidator._MSG['SNT_23'] = "doit correspondre а pattern _TEMPLATE_";
FormValidator._MSG['SNT_24'] = "être un numéro de téléphone valide";
FormValidator._MSG['SNT_25'] = "être une valeur valide alphanumérique";