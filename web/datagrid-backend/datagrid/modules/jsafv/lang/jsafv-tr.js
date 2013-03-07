FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "<_TITLE_OF_FIELD_> alanı zorunludur!\n";
FormValidator._MSG["MSG_2"] = "<_TITLE_OF_FIELD_> alanı zorunludur! Lütfen geçerli bir <_TITLE_OF_FIELD_> giriniz.\n";
FormValidator._MSG["MSG_3"] = "<_TITLE_OF_FIELD_> seçim kutusunu seçmelisiniz!\n";
FormValidator._MSG["MSG_4"] = "<_TITLE_OF_FIELD_> alanı _TYPE_OF_FIELD_ olmalıdır! Lütfen tekrar giriniz.\n";
FormValidator._MSG["MSG_5"] = "<_TITLE_OF_FIELD_> alanı _TYPE_OF_FIELD_ alanı ile aynı olmalıdır! Lütfen tekrar giriniz.\n";        
FormValidator._MSG["MSG_6"] = "<_TITLE_OF_FIELD_> seçim listesinden en az bir tane seçmelisiniz!";

FormValidator._MSG["SNT_1"] = "değer ";
FormValidator._MSG["SNT_2"] = "imzalanmış bir";
FormValidator._MSG["SNT_3"] = "imzalanmamış bir";
FormValidator._MSG["SNT_4"] = "büyük harf";
FormValidator._MSG["SNT_5"] = "pozitif";
FormValidator._MSG["SNT_6"] = "negatif";
FormValidator._MSG["SNT_7"] = "normal harf";
FormValidator._MSG["SNT_8"] = "küçük harf";
FormValidator._MSG["SNT_9"] = "";
FormValidator._MSG["SNT_10"] = "_SUB_TYPE_OF_FIELD_ sayısal değer";
FormValidator._MSG["SNT_11"] = "_SUB_TYPE_OF_FIELD_ tamsayı değer";
FormValidator._MSG["SNT_12"] = "_SUB_TYPE_OF_FIELD_ reel sayı";
FormValidator._MSG["SNT_13"] = "_SUB_TYPE_OF_FIELD_ alfasayısal değer";
FormValidator._MSG["SNT_14"] = "_SUB_TYPE_OF_FIELD_ dizgi";
FormValidator._MSG["SNT_15"] = "harf ve sayılardan oluşan en az _PASS_LENGTH_ karakter";
FormValidator._MSG["SNT_16"] = "harf ile başlayan ve harf ve sayılardan oluşan en az _LOGIN_LENGTH_ karakter";
FormValidator._MSG["SNT_17"] = "posta kodu (en az 5 basamak)";
FormValidator._MSG['SNT_18'] = "e-mail formatında";
FormValidator._MSG['SNT_19'] = "en az _PASS_LENGTH_ karakter";
FormValidator._MSG['SNT_20'] = "gerekli tür";
FormValidator._MSG['SNT_21'] = "geçerli adres";
FormValidator._MSG['SNT_22'] = "geçerli SSN numarası (XXX-XX-XXXX formatında 9 basamaklı)";
FormValidator._MSG['SNT_23'] = "_TEMPLATE_ şablonu ile uyumlu";
FormValidator._MSG['SNT_24'] = "geçerli bir telefon numarası";
FormValidator._MSG['SNT_25'] = "geçerli bir alfasayısal numara";