

$(function() {// get more knowledge at http://www.uploadify.com/documentation/
		var ownername = document.getElementById('hdnownername').value
		var buildid = document.getElementById('hdnbuildid').value
		
		$('#file_upload').uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : 'head'},
			//'debug'    : true,
			'swf'      : swfpath,
			'uploader' : uploaderpath,
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilename').value = data;
            	postData('image');
            	//alert("{{asset('images/building/1/2012-08-31head.jpg')}}");
            	//$(document).ready(function(){
			$('#headimage').fadeOut('slow').html('<img src="'+imagepath+'" class="nopad thumb"/>').fadeIn("slow");
		
	//});
        	}
			// Your options here
		});
		
		$('#upload_map').uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : 'map'},
			//'debug'    : true,
			'swf'      : swfpath,
			'uploader' : uploaderpath,
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilemap').value = data;
            	postData('image');
        	}
			// Your options here
		});
	});
$(function() {// get more knowledge at http://www.uploadify.com/documentation/
		loopbutton();
		loopbuttongallery();
		//test();
	});

function uploadpicroom()
{
	var ownername = document.getElementById('hdnownername').value;
	var buildid = document.getElementById('hdnbuildid').value;
	var numberline = intLine;//parseInt(document.addform.hdnMaxLine.value);
	for(i=0;i<=numberline;i++){
	var name = '#room'+i
	$(name).uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : name ,'typefield' : 'room'},
			//'debug'    : true,
			'swf'      : swfpath,
			'uploader' : uploaderpath,
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	var mySplitResult = data.split("_");
            	var textroomname = 'hdnfilename'+mySplitResult[1];
            	//alert(textroomname)
            	document.getElementById(textroomname).value = mySplitResult[0];
            	postData('image');
        	}
			// Your options here
		});
	}
}

function uploadpicgallery()
{
	var ownername = document.getElementById('hdnownername').value;
	var buildid = document.getElementById('hdnbuildid').value;
	var numberline = intLineGal;//parseInt(document.addform.hdnMaxLine.value);
	for(i=0;i<=numberline;i++){
	var name = '#gallery'+i
	$(name).uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : name ,'typefield' : 'gallery'},
			//'debug'    : true,
			'swf'      : swfpath,
			'uploader' : uploaderpath,
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	var mySplitResult = data.split("_");
            	var textgalleryname = 'hdngalleryname'+mySplitResult[1];
            	
            	document.getElementById(textgalleryname).value = mySplitResult[0];
            	postData('image');
        	}
			// Your options here
		});
	}
}
