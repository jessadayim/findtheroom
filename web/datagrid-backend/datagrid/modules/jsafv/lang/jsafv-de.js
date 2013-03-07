FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "Der <_TITLE_OF_FIELD_> ist ein Pflichtfeld!\n";
FormValidator._MSG["MSG_2"] = "Der <_TITLE_OF_FIELD_> ist ein Pflichtfeld! Bitte geben Sie eine gьltige <_TITLE_OF_FIELD_>.\n";
FormValidator._MSG["MSG_3"] = "Sie mьssen sich anmelden <_TITLE_OF_FIELD_> Box als aufgegebenes!\n";
FormValidator._MSG["MSG_4"] = "Der <_TITLE_OF_FIELD_> Feld muss _TYPE_OF_FIELD_! Bitte erneut eingeben.\n";
FormValidator._MSG["MSG_5"] = "Der <_TITLE_OF_FIELD_> Feld muss ьbereinstimmen mit _TYPE_OF_FIELD_! Bitte erneut eingeben.\n";        
FormValidator._MSG["MSG_6"] = "Sie müssen mindestens ein <_TITLE_OF_FIELD_> Optionsfeld überprüfen!";
        
FormValidator._MSG["SNT_1"] = "wert ";
FormValidator._MSG["SNT_2"] = "ein signiertes";
FormValidator._MSG["SNT_3"] = "vorzeichenlose";
FormValidator._MSG["SNT_4"] = "ein GroЯ";
FormValidator._MSG["SNT_5"] = "eine positive";
FormValidator._MSG["SNT_6"] = "eine negative";
FormValidator._MSG["SNT_7"] = "normalfall";
FormValidator._MSG["SNT_8"] = "einen kleinbuchstaben";
FormValidator._MSG["SNT_9"] = "ein";
FormValidator._MSG["SNT_10"] = "werden _SUB_TYPE_OF_FIELD_ numerischen wert";
FormValidator._MSG["SNT_11"] = "werden _SUB_TYPE_OF_FIELD_ Integer-Wert";
FormValidator._MSG["SNT_12"] = "werden _SUB_TYPE_OF_FIELD_ float (real) wert";
FormValidator._MSG["SNT_13"] = "werden _SUB_TYPE_OF_FIELD_ alphabetische wert";
FormValidator._MSG["SNT_14"] = "werden _SUB_TYPE_OF_FIELD_ Text";
FormValidator._MSG["SNT_15"] = "werden _PASS_LENGTH_ Zeichen mindestens \ nund aus Buchstaben und Ziffern";
FormValidator._MSG["SNT_16"] = "werden _LOGIN_LENGTH_ Zeichen zumindest \ nsStart aus dem Schreiben und bestehen aus Buchstaben oder Ziffern";
FormValidator._MSG["SNT_17"] = "eine zip (Post-) Code-Wert (5-stellig mindestens)";
FormValidator._MSG['SNT_18'] = "werden in E-Mail-Format";
FormValidator._MSG['SNT_19'] = "werden _PASS_LENGTH_ zeichen mindestens";
FormValidator._MSG['SNT_20'] = "eine erforderliche typ";
FormValidator._MSG['SNT_21'] = "eine gьltige URL";
FormValidator._MSG['SNT_22'] = "eine gьltige SSN Nummer (9 Ziffern oder in Form XXX-XX-XXXX)";
FormValidator._MSG['SNT_23'] = "muss mit muster _TEMPLATE_";
FormValidator._MSG['SNT_24'] = "eine gültige Telefonnummer";
FormValidator._MSG['SNT_25'] = "ein gültiger alphanumerischen Wert";