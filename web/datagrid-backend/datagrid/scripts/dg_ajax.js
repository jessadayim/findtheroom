xmlHttpObject = false;
try{
    // Firefox, Opera 8.0+, Safari
    xmlHttpObject = new XMLHttpRequest();
    if(xmlHttpObject.overrideMimeType) { xmlHttpObject.overrideMimeType('text/xml'); }
    if(!xmlHttpObject) { 
        alert('Your browser does not support AJAX!');
        //return false;
    }
}catch (e){
    // Internet Explorer
    try{
        xmlHttpObject = new ActiveXObject('Msxml2.XMLHTTP');
    }catch (e){
        try{
            xmlHttpObject = new ActiveXObject('Microsoft.XMLHTTP');
        }catch (e){
            alert('Your browser does not support AJAX!');
            //return false;
        }
    }
}
// To remove the error uncaught exception: Permission denied to call method XMLHttpRequest.open
try {
    netscape.security.PrivilegeManager.enablePrivilege('UniversalBrowserRead');
} catch (e) {
    //alert('Permission UniversalBrowserRead denied.');
}        

function dg_doAjaxRequest(query_string, uniquePrefix, HTTP_URL, is_debug, run_scrolling, scrolling_height){
    var query_string_ = (query_string != null) ? query_string : '';
    var is_debug     = (is_debug != null) ? is_debug : false;
    var request_url  = HTTP_URL+query_string_.replace('undefined', '');
    var run_scrolling  = (run_scrolling != null) ? run_scrolling : false;
    var scrolling_height = (scrolling_height != null) ? scrolling_height : '300px';
    
    xmlHttpObject.open('GET', request_url);
    xmlHttpObject.onreadystatechange=function() {
        if(xmlHttpObject.readyState == 4) {                    
          
            var responseText = xmlHttpObject.responseText;
            
            var start_tag = '<div id="'+uniquePrefix+'dg_ajax_container">';
            var end_tag = '<div id="'+uniquePrefix+'dg_ajax_container_end">';
            var start_tag_length = start_tag.length;
            var end_tag_length = '</div>'.length;
            var start_index = responseText.indexOf(start_tag);
            var end_index = responseText.indexOf(end_tag);
            var responseTextSelected = responseText.substring(start_index+start_tag_length,end_index-end_tag_length);                    
            
            document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.opacity = 1;
            document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.filter='progid:DXImageTransform.Microsoft.Alpha(opacity=100);';
            document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.filter='alpha(opacity=100);'; 
            document.getElementById(uniquePrefix+'ajax_loading_image').style.display = 'none';

            if(start_index == '-1' || end_index == '-1'){
                if(responseText.length > 0){
                    // returns answer if error or click on regilar link was occured 
                    if(is_debug) alert('Wrong response from the server! Please try again later.');
                }else{
                    // returns empty answer when double click occured
                    if(is_debug) alert('Empty response from the server! Please try again later.');
                }
            }else{
                document.getElementById(uniquePrefix+'dg_ajax_container').innerHTML = responseTextSelected;
                if(run_scrolling != false){
                    var t = new ScrollableTable(document.getElementById(uniquePrefix+'_contentTable'), scrolling_height);
                }
            }                       
        }
    }
    xmlHttpObject.send(null);

    document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.opacity = 0.77;
    document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.filter='progid:DXImageTransform.Microsoft.Alpha(opacity=77);';
    document.getElementById(uniquePrefix+'dg_ajax_container_opacity').style.filter='alpha(opacity=77);';
    document.getElementById(uniquePrefix+'ajax_loading_image').style.display = ''; 
    
    dg_disableLinksByElement(uniquePrefix+'dg_ajax_container_opacity');
}

function dg_disableLinksByElement(el) {
    if(false){
        obj = document.getElementById(el);
        y = obj.getElementsByTagName('*');

        for (var i = 0; i < y.length; i++){ // loop for buttons in child div.
            y[i].disabled = true;
        }
    
        if (document.getElementById && document.getElementsByTagName) {
            if (typeof(el) == 'string') {
                el = document.getElementById(el);
            }
            var anchors = el.getElementsByTagName('a');
            for (var i=0, end=anchors.length; i<end; i++) {
                anchors[i].href='javascript:void(0);';
            }
        }
    }
}