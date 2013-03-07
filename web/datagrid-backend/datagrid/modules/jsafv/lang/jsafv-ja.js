FormValidator = function () {

};

// tooltips
FormValidator._MSG = {};
FormValidator._MSG["MSG_1"] = "項目 <_TITLE_OF_FIELD_> は必須です。\n";
FormValidator._MSG["MSG_2"] = "項目 <_TITLE_OF_FIELD_> は必須です。\n再度 <_TITLE_OF_FIELD_> に入力してください。";
FormValidator._MSG["MSG_3"] = "項目 <_TITLE_OF_FIELD_> ボックスをチックしてください。\n";
FormValidator._MSG["MSG_4"] = "項目 <_TITLE_OF_FIELD_> は _TYPE_OF_FIELD_ でなければなりません。\n再入力してください。";
FormValidator._MSG["MSG_5"] = "項目 <_TITLE_OF_FIELD_> は _TYPE_OF_FIELD_ と一致していなければなりません。\n再入力してください。";        
FormValidator._MSG["MSG_6"] = "あなたは、少なくとも1つの<_TITLE_OF_FIELD_>ラジオボタンをチェックする必要があります！を";

FormValidator._MSG["SNT_1"] = "値";
FormValidator._MSG["SNT_2"] = "a signed ";
FormValidator._MSG["SNT_3"] = "an unsigned ";
FormValidator._MSG["SNT_4"] = "大文字";
FormValidator._MSG["SNT_5"] = "正の値 ";
FormValidator._MSG["SNT_6"] = "負の値 ";
FormValidator._MSG["SNT_7"] = "通常 ";
FormValidator._MSG["SNT_8"] = "小文字 ";
FormValidator._MSG["SNT_9"] = "a ";
FormValidator._MSG["SNT_10"] = "_SUB_TYPE_OF_FIELD_ は数値でなければなりません";
FormValidator._MSG["SNT_11"] = "_SUB_TYPE_OF_FIELD_ は整数値でなければなりません";
FormValidator._MSG["SNT_12"] = "_SUB_TYPE_OF_FIELD_ はフロート値(real)でなければなりません";
FormValidator._MSG["SNT_13"] = "_SUB_TYPE_OF_FIELD_ は半角英文字でなければなりません";
FormValidator._MSG["SNT_14"] = "_SUB_TYPE_OF_FIELD_ はテキストでなければなりません";
FormValidator._MSG["SNT_15"] = "_PASS_LENGTH_ は\n半角英文字と数字が含まれていなければなりません";
FormValidator._MSG["SNT_16"] = "_LOGIN_LENGTH_ は\n半角英文字で始まり、数字が含まれていなければなりません";
FormValidator._MSG["SNT_17"] = "は郵便番号でなければなりません （5桁以上）で";
FormValidator._MSG['SNT_18'] = "は email形式でなければなりません";
FormValidator._MSG['SNT_19'] = "_PASS_LENGTH_ は文字数でなければなりません";
FormValidator._MSG['SNT_20'] = "は必須タイプでなければなりません";
FormValidator._MSG['SNT_21'] = "は有効な URLでなければなりません";
FormValidator._MSG['SNT_22'] = "有効なSSNの番号を指定（9桁またはフォームXXXの-イグゼクス- XXXXの形式）";
FormValidator._MSG['SNT_23'] = "パターンと一致する必要があります _TEMPLATE_";
FormValidator._MSG['SNT_24'] = "有効な電話番号を指定";
FormValidator._MSG['SNT_25'] = "有効な英数字の値である";