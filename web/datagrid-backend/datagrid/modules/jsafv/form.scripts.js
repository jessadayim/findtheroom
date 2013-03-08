//################################################################################
//##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
//## --------------------------------------------------------------------------- #
//##  JS Auto Form Validator version 2.0.2 for DataGrid ONLY                     #
//##  Developed by:  ApPhp <info@apphp.com>                                      #
//##  License:       GNU LGPL v.3                                                #
//##  Site:          http://www.apphp.com/js-formvalidator/                      #
//##  Copyright:     JS Auto Form Validator (c) 2006-2009. All rights reserved.  #
//##                                                                             #
//##  Last modified: 19.09.2011                                                  #
//##                                                                             #
//################################################################################
//
// DONE:
// -----
// 1. [10.06.2011] fixed bug in IE with putting focus on field
// 2. [19.09.2011] added afv_ prefixes for all functions
//
// Usage:
// -----
// *** copy & paste these lines between <head> and </head> tags
// Supported languages:
//     en - english, es - Espanol, fr - Francais, ja - Japanese
// <script type='text/javascript' src='lang/jsafv-en.js'></script>";
// <script type='text/javascript' src='chars/diactric_chars_utf8.js'></script>";
// <script type='text/javascript' src='form.scripts.js'></script> 
//
// //*** copy & paste these lines before your </form> tag
// <!--
//  first parameter  - (required) form name
//  second parameter - (optional, default - false) handle all fields or handle each field separately
//  third parameter  - (optional, default - false) handle hidden fields or not 
// -->
// <input type="submit" name="button" value="Submit"
//        onClick="return onSubmitCheck(document.forms['form_name'], false, false);"> 
//
////////////////////////////////////////////////////////////////////////////////


var digits="0123456789";
var digits1="0123456789.";
var digits2="0123456789,";
var digits3="0123456789.,";
var textchars="/'\"[]{}()*&^%$#@!~?<>-_+=|\\ \r\t\n.,:;`";
var lwr="abcdefghijklmnopqrstuvwxyz";
var upr="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
var loginchars="_";

// r - required, s - simple
var rtypes="rs";
// n - numeric,     i - integer,    f - float,
// a - alphabetic,  t - text,       e - email,
// p - password,    l - login,      y - any, (generally used for non-english symbols)       
// z - zipcode,     v - verified,   c - checked (for checkboxes),
// u - url,         s - SSN number, m - telephone
// x - template     b - alphanumeric, r -radiobuttons
// (for example - name="rxTemplate1" template="(ddd)-ddd-dd-dd", where d - digit, c - character)
var vtypes="nifabtepylzvcusmxr";
// for numbers:   s - signed, u - unsigned,   p - positive,   n - negative
// for strings:   u - upper,  l - lower,      n - normal,     y - any
// for telephone: m - mobile, f - fixed (stationary), i - international, y - any
var svtypes="supnlymfi";       

function makeArray(n){for(var i=1; i<=n;i++){this[i]=0;}return this;};
var dInM=makeArray(12);dInM[1]=31;dInM[2]=29;dInM[3]=31;dInM[4]=30;dInM[5]=31;dInM[6]=30;dInM[7]=31;dInM[8]=31;dInM[9]=30;dInM[10]=31;dInM[11]=30;dInM[12]=31;
var PassLength=6;
var LoginLength=6;

var bgcolor_error = "#ff9922";
var bgcolor_normal_1 = "#ffffff";
var bgcolor_normal_2 = "#fcfaf6";
var MaxInt=13
var MaxString=30;
var MaxAdress=200;
var MaxCP=15;
var whitespace=" \t\n\r";                     
var decimalPointDelimiter=".";                  
var phoneNumberDelimiters="()- ";  
var validPhoneChars=digits + phoneNumberDelimiters;
var validWorldPhoneChars=digits + phoneNumberDelimiters + "+"; 
var digitsInSocialSecurityNumber=9;
var digitsInPhoneNumber=12;
var digitsInMinPhoneNumber=5;
var digitsInZIPCode1=5;
var digitsInZIPCode2=9;
var ZIPCodeDelimiters="-";
var validZIPCodeChars=digits + ZIPCodeDelimiters;
var creditCardDelimiters=" "
var USStateCodeDelimiter="|";
var DEOK=false;

function afv_isEmpty(s){return((s==null)||(s.length==0))}
function afv_isShorter(str_text, str_length){s_length=(str_length==null) ? "1" : str_length;if(str_text.length < s_length) return true;else return false;}
function afv_isValid(parm,val){if(parm=="")return true;for(i=0;i<parm.length;i++){if(val.indexOf(parm.charAt(i),0)==-1)return false;}return true;}
function afv_isSubmitReqType(parm){return afv_isLower(parm) && afv_isValid(parm,rtypes);}
function afv_isSubmitVarType(parm){return afv_isLower(parm) && afv_isValid(parm,vtypes);}
function afv_isSubmitSubVarType(parm){return afv_isLower(parm) && afv_isValid(parm,svtypes);}
function afv_isNumeric(parm,type){ptype=(type==null)?"0":type; pdigits=-1;switch(ptype){case 0:pdigits=digits;break;case1:pdigits=digits1;break;case 2:pdigits=digits2;break;case 3:pdigits=digits3;break;default:pdigits=digits;break;}return afv_isValid(parm,pdigits);}
function afv_isLower(parm){return afv_isValid(parm,lwr + textchars + digits);}
function afv_isUpper(parm){return afv_isValid(parm,upr + textchars + digits);}
function afv_isAlpha(parm){return afv_isValid(parm,lwr + upr);}

function afv_isText(parm){return afv_isValid(parm,lwr + upr + digits3 + textchars + diac_lwr + diac_upr);}
function afv_isAny(parm){return true;}
function afv_isLetter(c){return (((c>="a")&&(c<="z"))||((c>="A")&&(c<="Z")))}
function afv_isDigit(c){return ((c>="0")&&(c<="9"))}
function afv_isLetterOrDigit(c){return (afv_isLetter(c)||afv_isDigit(c))}

// integer checking
function afv_isInteger(s){ i; if(afv_isEmpty(s)) if(afv_isInteger.arguments.length==1) return DEOK; else return (afv_isInteger.arguments[1]==true); for(i=0;i< s.length;i++){ c=s.charAt(i); if(!afv_isDigit(c)) return false; } return true;}
function afv_isSignedInteger(s){ if(afv_isEmpty(s)){ if(afv_isSignedInteger.arguments.length==1) return DEOK; else return (afv_isSignedInteger.arguments[1]==true); }else{ startPos=0; secondArg=DEOK; if(afv_isSignedInteger.arguments.length>1) secondArg=afv_isSignedInteger.arguments[1]; if((s.charAt(0)=="-") || (s.charAt(0)=="+")) startPos=1; return (afv_isInteger(s.substring(startPos,s.length),secondArg));}}
function afv_isPositiveInteger(s){secondArg=DEOK;if(afv_isPositiveInteger.arguments.length > 1) secondArg=afv_isPositiveInteger.arguments[1];return (afv_isSignedInteger(s,secondArg) && ((afv_isEmpty(s) && secondArg) || (parseInt(s) > 0)));}
function afv_isNegativeInteger(s){secondArg=DEOK;if(afv_isNegativeInteger.arguments.length > 1) secondArg=afv_isNegativeInteger.arguments[1]; return (afv_isSignedInteger(s,secondArg) && ((afv_isEmpty(s) && secondArg) || (parseInt(s) < 0)));}
function afv_isIntegerInRange(s,a,b){if(afv_isEmpty(s))if(afv_isIntegerInRange.arguments.length==1) return DEOK;else return (afv_isIntegerInRange.arguments[1]==true);if(!afv_isInteger(s, false)) return false;num=parseInt(s);return ((num >=a) && (num <=b));}
// float checking
function afv_isFloat(s){i=0; seenDecimalPoint=false; if(afv_isEmpty(s)){ if (afv_isFloat.arguments.length==1) return DEOK; else return (afv_isFloat.arguments[1]==true); } if(s==decimalPointDelimiter) return false; for(i=0; i < s.length; i++){ c=s.charAt(i); if((c==decimalPointDelimiter) && !seenDecimalPoint) seenDecimalPoint=true; else if(!afv_isDigit(c)) return false; } return true;}
function afv_isSignedFloat(s){if(afv_isEmpty(s)) if(afv_isSignedFloat.arguments.length==1) return DEOK; else return (afv_isSignedFloat.arguments[1]==true); else{ startPos=0;secondArg=!DEOK; if(afv_isSignedFloat.arguments.length > 1) secondArg=afv_isSignedFloat.arguments[1]; if((s.charAt(0)=="-") || (s.charAt(0)=="+")) startPos=1; return (afv_isFloat(s.substring(startPos, s.length), secondArg))}}
function afv_isPositiveFloat(s){secondArg=DEOK;if(afv_isPositiveFloat.arguments.length > 1) secondArg=afv_isPositiveFloat.arguments[1];return (afv_isSignedFloat(s,secondArg) && ((afv_isEmpty(s) && secondArg) || (parseInt(s) > 0)));}
function afv_isNegativeFloat(s){secondArg=DEOK;if(afv_isNegativeFloat.arguments.length > 1) secondArg=afv_isNegativeFloat.arguments[1];return (afv_isSignedFloat(s,secondArg) && ((afv_isEmpty(s) && secondArg) || (parseInt(s) < 0)));}

function afv_isAlphabetic(s){i=0;if(afv_isEmpty(s))if(afv_isAlphabetic.arguments.length==1) return DEOK;else return (afv_isAlphabetic.arguments[1]==true);for(i=0;i<s.length;i++){c=s.charAt(i);if(!afv_isLetter(c)) return false;}return true;}
function afv_isAlphanumeric(s){i=0;if(afv_isEmpty(s))if(afv_isAlphanumeric.arguments.length==1) return DEOK;else return (afv_isAlphanumeric.arguments[1]==true);for(i=0;i<s.length;i++){c=s.charAt(i);if(!(afv_isLetter(c) || afv_isDigit(c))) return false;}return true;}
function afv_isZipCode(s){return (!afv_isShorter(s,digitsInZIPCode1) && afv_isValid(s,validZIPCodeChars));}

function afv_isEmail(s){ if(afv_isEmpty(s)) if(afv_isEmail.arguments.length==1) return DEOK; else return(afv_isEmail.arguments[1]==true); regexp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; if(regexp.test(s)){ return true; }else{ return false; } }

function afv_isPassword(s){return !afv_isShorter(s,PassLength) && afv_isValid(s,lwr+upr + digits + textchars);};
function afv_isLogin(s){return (!afv_isShorter(s,LoginLength) && afv_isValid(s.charAt(0),lwr + upr) && afv_isValid(s,lwr + upr + digits + loginchars));};

function afv_isPhoneNumber(s){ return (afv_isValid(s,validPhoneChars) && (s.length >= digitsInMinPhoneNumber && s.length <= digitsInPhoneNumber));} 
function afv_isMobPhoneNumber(s){ return (afv_isValid(s,validPhoneChars) && (s.length >= digitsInMinPhoneNumber && s.length <= digitsInPhoneNumber));} 
function afv_isFixPhoneNumber(s){ return (afv_isInteger(s) && (s.length >= digitsInMinPhoneNumber && s.length <= digitsInPhoneNumber));}
function afv_isInternationalPhoneNumber(s){ return (afv_isPositiveInteger(s)); }

function afv_isYear(s){if(afv_isEmpty(s))if(afv_isYear.arguments.length==1)return DEOK; else return (afv_isYear.arguments[1]==true); if (!isNonnegativeInteger(s)) return false; return (s.length==4);}
function afv_isMonth(s){if(afv_isEmpty(s))if(afv_isMonth.arguments.length==1)return DEOK;else return (afv_isMonth.arguments[1]==true);return afv_isIntegerInRange(s,1,12);}
function afv_isDay(s){if(afv_isEmpty(s))if(afv_isDay.arguments.length==1)return DEOK;else return (afv_isDay.arguments[1]==true);return afv_isIntegerInRange(s, 1, 31);}
function afv_daysInFebruary(year){return(((year % 4==0) && ((!(year % 100==0)) || (year % 400==0) ) ) ? 29 : 28 );}

function afv_isChecked(frm,ind){ return frm.elements[ind].checked; };
function afv_isURL(url){ regexp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/; if(regexp.test(url)){ return true; } return false; }

function afv_isSSN(s){ var match_num = s.match(/^(\d{3})-?\d{2}-?\d{4}$/); var dashes = s.split('-').length - 1; if(match_num == null || dashes == 1) { return false; } return true; }

function afv_isTemplate(t, s){ if(t){ if(t.length != s.length) return false; for(var i=0; i < t.length; i++){ if((t.charAt(i) == "d" || t.charAt(i) == "D") && afv_isDigit(s.charAt(i))){ }else if((t.charAt(i) == "c" || t.charAt(i) == "C") && afv_isAlpha(s.charAt(i))){ }else if(t.charAt(i) == s.charAt(i)){ }else{ return false; } } return true; } return true; }

function afv_getProValidateFieldValue(frm,p_ind){cur_field_name=frm.elements[p_ind].name.substring(2,frm.elements[p_ind].name.length);cur_field_prefics = frm.elements[p_ind].name.substring(0,2);found_field_ind=-1;for(gvind=0;((gvind<frm.elements.length) && (found_field_ind==-1));gvind++){if((frm.elements[gvind].name != undefined) && (cur_field_name==frm.elements[gvind].name.substring(2, frm.elements[gvind].name.length)) && (cur_field_prefics != frm.elements[gvind].name.substring(0,2))){found_field_ind=gvind; break;}}if(found_field_ind !=-1) return frm.elements[found_field_ind].value;else return -1;}
function afv_getValidateField(frm,p_ind,ret_type){cur_field_name=frm.elements[p_ind].name.substring(2,frm.elements[p_ind].name.length);found_field_ind=-1;for(gvind=0;((gvind<frm.elements.length) && (found_field_ind==-1));gvind++){if((frm.elements[gvind].name != undefined) && cur_field_name==frm.elements[gvind].name.substring(2, frm.elements[gvind].name.length))found_field_ind=gvind;}if(found_field_ind !=-1){if(ret_type=="type") return frm.elements[found_field_ind].name.charAt(1);else return frm.elements[found_field_ind].title;}else{return 0;}}
function afv_isValidateField(frm,p_ind){validation_result=false;cur_field_name=frm.elements[p_ind].name.substring(2,frm.elements[p_ind].name.length);cur_field_type=frm.elements[p_ind].name.charAt(1);found_field_ind=-1;for(vind=0;((vind<frm.elements.length)&&(found_field_ind==-1));vind++){if((frm.elements[vind].name != undefined) && (cur_field_type != frm.elements[vind].name.charAt(1)) && (cur_field_name==frm.elements[vind].name.substring(2, frm.elements[vind].name.length)))found_field_ind=vind;}if(found_field_ind !=-1){if(frm.elements[found_field_ind].name.charAt(1)=="e"){validation_result=afv_isEmail(frm.elements[p_ind].value);}else if(frm.elements[found_field_ind].name.charAt(1)=="p"){validation_result=afv_isPassword(frm.elements[p_ind].value);}else{validation_result=false;}}else{validation_result=false;}return validation_result;}
function afv_equalValidateField(frm,p_ind){validation_result=false;cur_field_name=frm.elements[p_ind].name.substring(2,frm.elements[p_ind].name.length);cur_field_type=frm.elements[p_ind].name.charAt(0);found_field_ind=-1;for(evind=0;((evind<frm.elements.length) && (found_field_ind==-1)); evind++){ if((frm.elements[evind].name != undefined) && (cur_field_type != frm.elements[evind].name.charAt(1)) && (cur_field_name==frm.elements[evind].name.substring(2, frm.elements[evind].name.length))) found_field_ind=evind; }if(found_field_ind !=-1){validation_result=(frm.elements[p_ind].value==frm.elements[found_field_ind].value);}else{validation_result=false;}return validation_result;}

function afv_setNormalBackground(frm, ind){ if((frm.elements[ind].type) && frm.elements[ind].type.substring(0,6) != "select"){ frm.elements[ind].style.background = bgcolor_normal_1; }else{ frm.elements[ind].style.background = bgcolor_normal_2; }}
function afv_setErrorBackground(frm, ind){ frm.elements[ind].style.background = bgcolor_error; }
    
function afv_getFieldTitle(frm,ind){title_field=frm.elements[ind].title;if(title_field=="")title_field=frm.elements[ind].name.substring(3,frm.elements[ind].name.length);return title_field;}

function afv_onReqAlert(frm,ind,all_fields){
    check_all_fields = (all_fields==null) ? false : true;
    is_first_found = (is_found==null) ? false : is_found;
    title_of_field=afv_getFieldTitle(frm,ind);
    afv_setErrorBackground(frm, ind);
    if((!is_first_found) && frm.elements[ind] && (frm.elements[ind].style.display != "none") && !frm.elements[ind].disabled){
        try{
            frm.elements[ind].focus();
        }catch(e){
            // cannot put focus
        }
    }
    if(check_all_fields){
        /// return "The <" + title_of_field + "> is a required field!\n";
        return FormValidator._MSG['MSG_1'].replace(/_TITLE_OF_FIELD_/g, title_of_field);
    }else{
        // "The <" + title_of_field + "> is a required field!\nPlease, enter a valid " + title_of_field + "."
        alert(FormValidator._MSG['MSG_2'].replace(/_TITLE_OF_FIELD_/g, title_of_field));
        if((frm.elements[ind].type) && (frm.elements[ind].type.substring(0,6) !="select")){ frm.elements[ind].select(); }
        return false;        
    }
}

function afv_onInvalidAlert(frm,ind,ftype,fstype,all_fields){
    check_all_fields = (all_fields==null) ? false : true;
    is_first_found = (is_found==null) ? false : is_found;
    type_of_field=FormValidator._MSG["SNT_1"];
    title_of_field=afv_getFieldTitle(frm,ind);
    var field_template = "";
    if(window.all){
        field_template = (frm.elements[ind].attributes.item('template')) ? frm.elements[ind].attributes.item('template').value : "";
    }else{
        field_template = frm.elements[ind].getAttribute('template');
    }

    switch (fstype){ //supnly
        case 's': sub_type_of_field=FormValidator._MSG["SNT_2"]; break;
        case 'u': sub_type_of_field=FormValidator._MSG["SNT_3"]; sub_type_of_field2=FormValidator._MSG["SNT_4"]; break;
        case 'p': sub_type_of_field=FormValidator._MSG["SNT_5"]; break;
        case 'n': sub_type_of_field=FormValidator._MSG["SNT_6"]; sub_type_of_field2=FormValidator._MSG["SNT_7"]; break;
        case 'l': sub_type_of_field=FormValidator._MSG["SNT_8"]; sub_type_of_field2=FormValidator._MSG["SNT_8"]; break;
        default: sub_type_of_field=FormValidator._MSG["SNT_9"]; sub_type_of_field2=FormValidator._MSG["SNT_9"]; break; 
    }

    switch (ftype){
        case 'n': type_of_field=FormValidator._MSG['SNT_10'].replace("_SUB_TYPE_OF_FIELD_", sub_type_of_field); break;
        case 'i': type_of_field=FormValidator._MSG['SNT_11'].replace("_SUB_TYPE_OF_FIELD_", sub_type_of_field); break;
        case 'f': type_of_field=FormValidator._MSG['SNT_12'].replace("_SUB_TYPE_OF_FIELD_", sub_type_of_field); break;
        case 'a': type_of_field=FormValidator._MSG['SNT_13'].replace("_SUB_TYPE_OF_FIELD_", sub_type_of_field); break;
        case 'b': type_of_field=FormValidator._MSG['SNT_25']; break;
        case 't': type_of_field=FormValidator._MSG['SNT_14'].replace("_SUB_TYPE_OF_FIELD_", sub_type_of_field2); break;
        case 'p': type_of_field=FormValidator._MSG['SNT_15'].replace("_PASS_LENGTH_", PassLength); break;
        case 'l': type_of_field=FormValidator._MSG['SNT_16'].replace("_LOGIN_LENGTH_", LoginLength); break;
        case 'z': type_of_field=FormValidator._MSG['SNT_17']; break;
        case 'e': type_of_field=FormValidator._MSG['SNT_18']; break;
        case 'v': if(afv_getValidateField(frm, ind, "type")=="e")
                    type_of_field=FormValidator._MSG['SNT_18']; 
                  else if(afv_getValidateField(frm, ind, "type")=="p")
                    type_of_field=FormValidator._MSG['SNT_19'].replace("_PASS_LENGTH_", PassLength); 
                  else
                    type_of_field=FormValidator._MSG['SNT_20'];
                  break;
        case 'c': type_of_field=""; break;
        case 'u': type_of_field=FormValidator._MSG['SNT_21']; break;
        case 's': type_of_field=FormValidator._MSG['SNT_22']; break;
        case 'x': type_of_field=FormValidator._MSG['SNT_23'].replace("_TEMPLATE_", field_template); break;
        case 'm': type_of_field=FormValidator._MSG['SNT_24']; break;
        case 'r': type_of_field=""; break;
        default: break; 
    }
    afv_setErrorBackground(frm, ind);
    if(!is_first_found && frm.elements[ind] && !frm.elements[ind].disabled) frm.elements[ind].focus();
    if(check_all_fields){
        // "You have to sign <" + title_of_field + "> box as checked!\n";
        if(ftype == "c") return FormValidator._MSG['MSG_3'].replace("_TITLE_OF_FIELD_", title_of_field) + "\n";
        // You have to check at least one <_TITLE_OF_FIELD_> radio button!
        else if(ftype == "r") return FormValidator._MSG['MSG_6'].replace("_TITLE_OF_FIELD_", title_of_field)+"\n";
        // "The <" + title_of_field + "> field must " + type_of_field + "!\n";        
        else return FormValidator._MSG['MSG_4'].replace("_TITLE_OF_FIELD_", title_of_field).replace("_TYPE_OF_FIELD_", type_of_field);        
    }else{
        // "You have to sign <" + title_of_field + "> box as checked!\n"
        if(ftype == "c") alert(FormValidator._MSG['MSG_3'].replace("_TITLE_OF_FIELD_", title_of_field));
        // You have to check at least one <_TITLE_OF_FIELD_> radio button!
        else if(ftype == "r") alert(FormValidator._MSG['MSG_6'].replace("_TITLE_OF_FIELD_", title_of_field));
        // "The <" + title_of_field + "> field must " + type_of_field + "!\n";        
        else alert(FormValidator._MSG['MSG_4'].replace("_TITLE_OF_FIELD_", title_of_field).replace("_TYPE_OF_FIELD_", type_of_field));
        if((frm.elements[ind].type) && (frm.elements[ind].type.substring(0,6) !="select")) frm.elements[ind].select();
        return false;            
    }
}

function afv_onNotEqualAlert(frm,ind,all_fields,is_found){
    check_all_fields = (all_fields==null) ? false : true;
    is_first_found = (is_found==null) ? false : is_found;
    type_of_field = afv_getValidateField(frm, ind, "name");
    title_of_field = afv_getFieldTitle(frm,ind);
    if(type_of_field == 0) type_of_field="required field";
    afv_setErrorBackground(frm, ind);
    if(!is_first_found && frm.elements[ind] && !frm.elements[ind].disabled) frm.elements[ind].focus();
    if(check_all_fields){
        // "The <" + title_of_field + "> field must be match with " + type_of_field + "!\n";        
        return FormValidator._MSG['MSG_5'].replace("_TITLE_OF_FIELD_", title_of_field).replace("_TYPE_OF_FIELD_", type_of_field);
    }else{
        // "The <" + title_of_field + "> field must be match with " + type_of_field + "!\n";        
        alert(FormValidator._MSG['MSG_5'].replace("_TITLE_OF_FIELD_", title_of_field).replace("_TYPE_OF_FIELD_", type_of_field));        
        if((frm.elements[ind].type) && (frm.elements[ind].type.substring(0,6) != "select")) frm.elements[ind].select();
        return false;
    }
}

// parametr - check hidden fields+check display.none fileds 
function onSubmitCheck(frm, handle_all_fields, handle_hidden_fields){
    check_all_fields = (handle_all_fields == null) ? false : handle_all_fields;
    check_hidden_fields = (handle_hidden_fields == null) ? false : handle_hidden_fields;
    is_required="";
    a_type="";
    b_type="";
    msg = "";
    is_found = false;
    var field_template;
    var arrRaduoButtoms = new Array();
    
    for(ind=0;ind<frm.elements.length;ind++){
        if(frm.elements[ind].type == undefined){ continue; }
        if((frm.elements[ind].type) &&
           (frm.elements[ind].type.substring(0,6) != "submit") && (frm.elements[ind].type.substring(0,6) != "button") && (frm.elements[ind].type.substring(0,5) != "reset"))
            afv_setNormalBackground(frm,ind);
    }        
    for(ind=0;ind<frm.elements.length;ind++){        
        if((frm.elements[ind].type == undefined) ||
           (frm.elements[ind].type.substring(0,6) == "submit") ||
           (frm.elements[ind].type.substring(0,5) == "reset") ||
           (frm.elements[ind].type.substring(0,6) == "button"))
        {
            continue;
        }
        if(!check_hidden_fields){            
           if((frm.elements[ind].type) && (frm.elements[ind].type.substring(0,6) == "hidden")) continue;
        }
        is_required=frm.elements[ind].name.charAt(0);
        a_type=frm.elements[ind].name.charAt(1);
        b_type=frm.elements[ind].name.charAt(2);       
       
        if(!afv_isSubmitSubVarType(b_type)) b_type = "";        
        true_value=true;
        if(afv_isSubmitReqType(is_required)
           && afv_isSubmitVarType(a_type)
           && (((frm.elements[ind].style.display !="none") && (frm.elements[ind].type != 'textarea')) || (frm.elements[ind].type == 'textarea'))
          )
        {
            field_value=frm.elements[ind].value; //trim
            if(is_required=='r'){
                if(afv_isEmpty(field_value)){
                    if(check_all_fields){
                        msg += afv_onReqAlert(frm,ind,check_all_fields,is_found);
                        is_found = true;                                                
                        continue;
                    }else{
                        return afv_onReqAlert(frm,ind);
                    }
                }else{
                    afv_setNormalBackground(frm,ind);
                }
            };
            if(((is_required=='r') || ((is_required=='s') && (!afv_isEmpty(field_value)))) ||
                ((a_type=='v') && (!afv_isEmpty(afv_getProValidateFieldValue(frm,ind)))) 
              ){
                switch (a_type){
                    case 'r':
                        // Radio buttons 
                        if(is_required=='r'){
                            true_value=false; 
                            for(jnd=0; jnd < frm.elements.length; jnd++){
                                if(frm.elements[jnd].name == frm.elements[ind].name){
                                    if(frm.elements[jnd].checked){
                                        true_value=true;
                                        break; 
                                    }
                                }
                            }                                
                        }
                        break;                        
                    case 'n': if(!afv_isNumeric(field_value, 3))    { true_value=false; } break;
                    case 'i':
                        switch (b_type){                   
                            case 's': if(!afv_isSignedInteger(field_value))   { true_value=false; } break;
                            case 'u': if(!afv_isInteger(field_value))         { true_value=false; } break;
                            case 'p': if(!afv_isPositiveInteger(field_value)) { true_value=false; } break;
                            case 'n': if(!afv_isNegativeInteger(field_value)) { true_value=false; } break;
                            default:  if(!afv_isSignedInteger(field_value))   { true_value=false; } break;
                        }
                        break;
                    case 'f':
                        switch (b_type){                   
                            case 's': if(!afv_isSignedFloat(field_value))     { true_value=false; } break;
                            case 'u': if(!afv_isFloat(field_value))           { true_value=false; } break;
                            case 'p': if(!afv_isPositiveFloat(field_value))   { true_value=false; } break;
                            case 'n': if(!afv_isNegativeFloat(field_value))   { true_value=false; } break;
                            default: if(!afv_isSignedFloat(field_value))      { true_value=false; } break;
                        }
                        break;                        
                    case 'a': 
                        switch (b_type){                   
                            case 'u': if(!afv_isAlphabetic(field_value) || !afv_isUpper(field_value)) { true_value=false; } break;
                            case 'l': if(!afv_isAlphabetic(field_value) || !afv_isLower(field_value)) { true_value=false; } break;
                            case 'n': if(!afv_isAlphabetic(field_value)) { true_value=false; } break;
                            case 'y': if(!afv_isAlphabetic(field_value)) { true_value=false; } break;
                            default: if(!afv_isAlphabetic(field_value))  { true_value=false; } break;
                        }
                        break;                        
                    case 'b':
                        if(!afv_isAlphanumeric(field_value))  { true_value=false; }
                        break;
                    case 't': 
                        switch (b_type){                   
                            case 'u': if(!afv_isText(field_value) || !afv_isUpper(field_value)) { true_value=false; } break;
                            case 'l': if(!afv_isText(field_value) || !afv_isLower(field_value)) { true_value=false; } break;
                            case 'n': if(!afv_isText(field_value)) { true_value=false; } break;
                            case 'y': if(!afv_isText(field_value)) { true_value=false; } break;
                            default: if(!afv_isText(field_value))  { true_value=false; } break;
                        }
                        break;                        
                    case 'e':
                        switch (b_type){                   
                            case 'u': if(!afv_isEmail(field_value) || !afv_isUpper(field_value)) { true_value=false; } break;
                            case 'l': if(!afv_isEmail(field_value) || !afv_isLower(field_value)) { true_value=false; } break;
                            case 'n': if(!afv_isEmail(field_value)) { true_value=false; } break;
                            case 'y': if(!afv_isEmail(field_value)) { true_value=false; } break;
                            default: if(!afv_isEmail(field_value))  { true_value=false; } break;
                        }
                        break;                        
                    case 'p': if(!afv_isPassword(field_value))      { true_value=false; } break;
                    case 'y': if(!afv_isAny(field_value))           { true_value=false; } break;
                    case 'l': if(!afv_isLogin(field_value))         { true_value=false; } break;
                    case 'z': if(!afv_isZipCode(field_value))       { true_value=false; } break;
                    case 'v': if(!afv_isValidateField(frm, ind))    { true_value=false; }
                              else if(!afv_equalValidateField(frm, ind)){
                                    if(check_all_fields){
                                        msg += afv_onNotEqualAlert(frm, ind, check_all_fields, is_found);
                                    }else{
                                        return afv_onNotEqualAlert(frm, ind);
                                    }
                                    is_found = true;
                                }                              
                              break;
                    case 'c':
                            if(is_required=='r'){
                                if(!afv_isChecked(frm,ind))         { true_value=false; }
                            }
                            break;
                    case 'u': if(!afv_isURL(field_value))           { true_value=false; } break;
                    case 's': if(!afv_isSSN(field_value))           { true_value=false; } break;                            
                    case 'm':
                        switch (b_type){                   
                            case 'm': if(!afv_isMobPhoneNumber(field_value)) { true_value=false; } break;
                            case 'f': if(!afv_isFixPhoneNumber(field_value)) { true_value=false; } break;
                            case 'i': if(!afv_isInternationalPhoneNumber(field_value)) { true_value=false; } break;
                            case 'y': if(!afv_isPhoneNumber(field_value))  { true_value=false; } break;
                            default:  if(!afv_isPhoneNumber(field_value))  { true_value=false; } break;
                        }
                        break;                        
                    case 'x':
                        if(window.all){
                            field_template = (frm.elements[ind].attributes.item('template')) ? frm.elements[ind].attributes.item('template').value : "";
                        }else{
                            field_template = frm.elements[ind].getAttribute('template');
                        }
                        if(!afv_isTemplate(field_template, field_value))  { true_value=false; } break;                            
                    default: break; 
                }
                if(!true_value){
                    if(a_type != "r"){
                        if(check_all_fields){
                            msg += afv_onInvalidAlert(frm, ind, a_type, b_type, check_all_fields, is_found, field_template);    
                        }else{
                            return afv_onInvalidAlert(frm, ind, a_type, b_type);    
                        }
                    }else if(a_type == "r"){
                        // handle radiobuttons
                        if(!arrRaduoButtoms.has(frm.elements[ind].name)){
                            if(check_all_fields){
                                msg += afv_onInvalidAlert(frm, ind, a_type, b_type, check_all_fields, is_found, field_template);    
                            }else{
                                return afv_onInvalidAlert(frm, ind, a_type, b_type);    
                            }
                            arrRaduoButtoms.push(frm.elements[ind].name);    
                        }else{
                            afv_setErrorBackground(frm,ind); 
                        }                        
                    }
                    is_found = true;
                }
            }                            
        }
    }
    if(check_all_fields){
        if(msg != ""){
            alert(msg);
            return false;
        }            
    }    
    return true;
}

/* extend array functionality */
Array.prototype.has = function(value)
{    
    var i;
    for(var i = 0, loopCnt = this.length; i < loopCnt; i++){
        if(this[i].toLowerCase() == value.toLowerCase()){
            return true;
        }
    }    
    return false;    
};