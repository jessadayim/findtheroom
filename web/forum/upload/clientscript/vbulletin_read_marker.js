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
var vB_ReadMarker={forum_statusicon_prefix:"forum_statusicon_",thread_statusicon_prefix:"thread_statusicon_",thread_gotonew_prefix:"thread_gotonew_",thread_title_prefix:"thread_title_"};function vB_AJAX_ReadMarker(A){this.forumid=A}vB_AJAX_ReadMarker.prototype.mark_read=function(){YAHOO.util.Connect.asyncRequest("POST","ajax.php?do=markread&f="+this.forumid,{success:this.handle_ajax_request,failure:this.handle_ajax_error,timeout:vB_Default_Timeout,scope:this},SESSIONURL+"securitytoken="+SECURITYTOKEN+"&do=markread&forumid="+this.forumid)};vB_AJAX_ReadMarker.prototype.handle_ajax_error=function(A){vBulletin_AJAX_Error_Handler(A)};vB_AJAX_ReadMarker.prototype.handle_ajax_request=function(C){var B=fetch_tags(C.responseXML,"forum");for(var A=0;A<B.length;A++){var D=B[A].firstChild.nodeValue;this.update_forum_status(D);var E=fetch_object("threadbits_forum_"+D);if(E){this.handle_threadbits(E)}}};vB_AJAX_ReadMarker.prototype.update_forum_status=function(B){var A=fetch_object(vB_ReadMarker.forum_statusicon_prefix+B);if(A){A.style.cursor="default";A.title=A.otitle;A.src=this.fetch_old_src(A.src,"forum")}};vB_AJAX_ReadMarker.prototype.handle_threadbits=function(C){var A=fetch_tags(C,"a");for(var B=0;B<A.length;B++){if(A[B].id&&A[B].id.substr(0,vB_ReadMarker.thread_gotonew_prefix.length)==vB_ReadMarker.thread_gotonew_prefix){this.update_thread_status(A[B].id.substr(vB_ReadMarker.thread_gotonew_prefix.length))}}};vB_AJAX_ReadMarker.prototype.update_thread_status=function(D){var C=fetch_object(vB_ReadMarker.thread_statusicon_prefix+D);if(C){C.src=this.fetch_old_src(C.src,"thread")}var B=fetch_object(vB_ReadMarker.thread_gotonew_prefix+D);if(B){B.parentNode.removeChild(B)}var A=fetch_object(vB_ReadMarker.thread_title_prefix+D);if(A){A.style.fontWeight="normal"}};vB_AJAX_ReadMarker.prototype.fetch_old_src=function(B,A){var C=B.replace(/_(new)([-_])(.+)$/i,(A=="thread"?"$2$3":"_old$2$3"));return C};function mark_forum_read(A){if(AJAX_Compatible){vB_ReadMarker[A]=new vB_AJAX_ReadMarker(A);vB_ReadMarker[A].mark_read()}else{window.location="forumdisplay.php?"+SESSIONURL+"do=markread&forumid="+A+"&markreadhash="+SECURITYTOKEN}return false}function init_forum_readmarker_icon(A){mark_forum_read(this.id.substr(vB_ReadMarker.forum_statusicon_prefix.length))}function init_forum_readmarker_system(){var A=fetch_tags(document,"img");for(var B=0;B<A.length;B++){if(A[B].id&&A[B].id.substr(0,vB_ReadMarker.forum_statusicon_prefix.length)==vB_ReadMarker.forum_statusicon_prefix){if(A[B].src.search(/\/([^\/]+)(new)(_lock)?-48\.([a-z0-9]+)$/i)!=-1){img_alt_2_title(A[B]);A[B].otitle=A[B].title;A[B].title=vbphrase.doubleclick_forum_markread;A[B].style.cursor=pointer_cursor;A[B].ondblclick=init_forum_readmarker_icon}}}};