/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.5
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/
function vB_AJAX_SearchPrefs_Init(A){if(AJAX_Compatible&&(typeof vb_disable_ajax=="undefined"||vb_disable_ajax<2)&&fetch_object(A)){var B=fetch_object(A);B.onclick=vB_AJAX_SearchPrefs.prototype.form_click}}function vB_AJAX_SearchPrefs(A){this.pseudoform=new vB_Hidden_Form("search.php");this.pseudoform.add_variable("ajax",1);this.pseudoform.add_variable("doprefs",1);this.pseudoform.add_variables_from_object(A)}vB_AJAX_SearchPrefs.prototype.handle_ajax_response=function(C){if(C.responseXML){var A=C.responseXML.getElementsByTagName("error");if(A.length){alert(A[0].firstChild.nodeValue)}else{var B=C.responseXML.getElementsByTagName("message");if(B.length){alert(B[0].firstChild.nodeValue)}}}};vB_AJAX_SearchPrefs.prototype.submit=function(){YAHOO.util.Connect.asyncRequest("POST","search.php",{success:this.handle_ajax_response,failure:this.handle_ajax_error,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&"+this.pseudoform.build_query_string())};vB_AJAX_SearchPrefs.prototype.handle_ajax_error=function(A){vBulletin_AJAX_Error_Handler(A);this.pseudoform.submit_form()};vB_AJAX_SearchPrefs.prototype.form_click=function(){var A=new vB_AJAX_SearchPrefs(this.form);A.submit();return false};vB_XHTML_Ready.subscribe(init_vB_SearchTypes);function init_vB_SearchTypes(){new vB_SearchTypes()}function vB_SearchTypes(){this.selectall=YAHOO.util.Dom.get("searchtype_all");this.list=YAHOO.util.Dom.get("searchtypelist");this.inputs={};var B=this.list.getElementsByTagName("input");var C=0;for(var A=0;A<B.length;A++){if(YAHOO.util.Dom.hasClass(B[A],"searchtype")){this.inputs[C++]=B[A]}}YAHOO.util.Event.on(this.list,"click",this.clickaction,this,true)}vB_SearchTypes.prototype.clickaction=function(B){var A=YAHOO.util.Event.getTarget(B);if(A&&A.type=="checkbox"){if(A==this.selectall){for(x in this.inputs){this.inputs[x].checked=A.checked}}else{var C=true;for(x in this.inputs){if(this.inputs[x].checked==false){C=false;break}}this.selectall.checked=C}}};