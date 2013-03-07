FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "The <_TITLE_OF_FIELD_> is a required field!\n";
FormValidator._MSG["MSG_2"] = "The <_TITLE_OF_FIELD_> is a required field! Please, enter a valid <_TITLE_OF_FIELD_>.\n";
FormValidator._MSG["MSG_3"] = "You have to sign <_TITLE_OF_FIELD_> box as checked!\n";
FormValidator._MSG["MSG_4"] = "The <_TITLE_OF_FIELD_> field must _TYPE_OF_FIELD_! Please, re-enter.\n";
FormValidator._MSG["MSG_5"] = "The <_TITLE_OF_FIELD_> field must be match with _TYPE_OF_FIELD_! Please, re-enter.\n";        
FormValidator._MSG["MSG_6"] = "You have to check at least one <_TITLE_OF_FIELD_> radio button!";

FormValidator._MSG["SNT_1"] = "value ";
FormValidator._MSG["SNT_2"] = "a signed";
FormValidator._MSG["SNT_3"] = "an unsigned";
FormValidator._MSG["SNT_4"] = "an upper case";
FormValidator._MSG["SNT_5"] = "a positive";
FormValidator._MSG["SNT_6"] = "a negative";
FormValidator._MSG["SNT_7"] = "a normal case";
FormValidator._MSG["SNT_8"] = "a lower case";
FormValidator._MSG["SNT_9"] = "a";
FormValidator._MSG["SNT_10"] = "be _SUB_TYPE_OF_FIELD_ numeric value";
FormValidator._MSG["SNT_11"] = "be _SUB_TYPE_OF_FIELD_ integer value";
FormValidator._MSG["SNT_12"] = "be _SUB_TYPE_OF_FIELD_ float(real) value";
FormValidator._MSG["SNT_13"] = "be _SUB_TYPE_OF_FIELD_ alphabetic value";
FormValidator._MSG["SNT_14"] = "be _SUB_TYPE_OF_FIELD_ text (English characters)";
FormValidator._MSG["SNT_15"] = "be _PASS_LENGTH_ characters at least\nand consist of letters and digits";
FormValidator._MSG["SNT_16"] = "be _LOGIN_LENGTH_ characters at least,\nstart from letter and consist of letters or digits";
FormValidator._MSG["SNT_17"] = "be a zip(post) code value (5 digits at least)";
FormValidator._MSG['SNT_18'] = "be in email format";
FormValidator._MSG['SNT_19'] = "be _PASS_LENGTH_ characters at least";
FormValidator._MSG['SNT_20'] = "be a required type";
FormValidator._MSG['SNT_21'] = "be a valid URL";
FormValidator._MSG['SNT_22'] = "be a valid SSN number (9 digits or in the form XXX-XX-XXXX)";
FormValidator._MSG['SNT_23'] = "match a pattern _TEMPLATE_";
FormValidator._MSG['SNT_24'] = "be a valid telephone number";
FormValidator._MSG['SNT_25'] = "be a valid alphanumeric value";