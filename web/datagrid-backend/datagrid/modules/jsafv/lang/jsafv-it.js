FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "Il <_TITLE_OF_FIELD_> è un campo obbligatorio!\n";
FormValidator._MSG["MSG_2"] = "Il <_TITLE_OF_FIELD_> è un campo obbligatorio! Per favore, inserisci un <_TITLE_OF_FIELD_> valido.\n";
FormValidator._MSG["MSG_3"] = "Devi firmare box <_TITLE_OF_FIELD_> come bagaglio!\n";
FormValidator._MSG["MSG_4"] = "Il campo deve <_TITLE_OF_FIELD_> _TYPE_OF_FIELD_! Si prega di inserire nuovamente.\n"
FormValidator._MSG["MSG_5"] = "Il campo <_TITLE_OF_FIELD_> deve essere partita con _TYPE_OF_FIELD_! Si prega di inserire nuovamente.\n";        
FormValidator._MSG["MSG_6"] = "Devi controllare almeno uno dei tasti <_TITLE_OF_FIELD_> radio!";
        
FormValidator._MSG["SNT_1"] = "valore ";
FormValidator._MSG["SNT_2"] = "uno firmato";
FormValidator._MSG["SNT_3"] = "un unsigned";
FormValidator._MSG["SNT_4"] = "un caso superiore";
FormValidator._MSG["SNT_5"] = "un positivo";
FormValidator._MSG["SNT_6"] = "un negativo";
FormValidator._MSG["SNT_7"] = "un caso di normale";
FormValidator._MSG["SNT_8"] = "un minuscolo";
FormValidator._MSG["SNT_9"] = "un";
FormValidator._MSG["SNT_10"] = "da valore intero _SUB_TYPE_OF_FIELD_";
FormValidator._MSG["SNT_11"] = "da valore intero _SUB_TYPE_OF_FIELD_";
FormValidator._MSG["SNT_12"] = "da _SUB_TYPE_OF_FIELD_ galleggiante (reale) del valore";
FormValidator._MSG["SNT_13"] = "da _SUB_TYPE_OF_FIELD_ valore alfabetico";
FormValidator._MSG["SNT_14"] = "da testo _SUB_TYPE_OF_FIELD_";
FormValidator._MSG["SNT_15"] = "di essere personaggi _PASS_LENGTH_ almeno\ne sono costituiti da lettere e cifre";
FormValidator._MSG["SNT_16"] = "di essere personaggi _LOGIN_LENGTH_ almeno,\na partire da lettera e sono composti da lettere o cifre";
FormValidator._MSG["SNT_17"] = "per essere un (post) valore di codice di avviamento postale (5 cifre almeno)";
FormValidator._MSG['SNT_18'] = "essere in formato e-mail";
FormValidator._MSG['SNT_19'] = "di essere personaggi _PASS_LENGTH_ almeno";
FormValidator._MSG['SNT_20'] = "per essere un tipo richiesto";
FormValidator._MSG['SNT_21'] = "essere un URL valido";
FormValidator._MSG['SNT_22'] = "per essere un numero valido SSN (9 cifre o in forma XXX-XX-XXXX)";
FormValidator._MSG['SNT_23'] = "corrispondono a un modello _TEMPLATE_";
FormValidator._MSG['SNT_24'] = "essere un numero di telefono valido";
FormValidator._MSG['SNT_25'] = "essere un valore alfanumerico valido";