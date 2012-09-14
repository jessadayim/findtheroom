

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
			'fileSizeLimit' : '120KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {/*alert('Flash was not detected.');*/},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilename').value = data;
            	postData('image');
				$('#headimage').fadeOut().html('<img src="'+imagepath+'/'+buildid+'/'+data+'" class="nopad thumb"/>').fadeIn("slow");
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
			'fileSizeLimit' : '120KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {/*alert('Flash was not detected.');*/},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilemap').value = data;
            	postData('image');
            	$('#headimage2').fadeOut().html('<img src="'+imagepath+'/'+buildid+'/'+data+'" class="nopad thumb"/>').fadeIn("slow");
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
			'fileSizeLimit' : '120KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {/*alert('Flash was not detected.');*/},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	var mySplitResult = data.split("_");
            	var textRoomName = 'hdnfilename'+mySplitResult[1];
            	var trId = mySplitResult[1];
            	document.getElementById(textRoomName).value = mySplitResult[0];
            	postData('image');
            	//$('#roomtrid'+trId).fadeOut('slow').html('<img src="'+imagepath+'/'+buildid+'/'+mySplitResult[0]+'" class="nopad thumb"/>').fadeIn("slow");
                $('#roompic'+trId).fadeOut('slow').html('<img src="'+imagepath+'/'+buildid+'/'+mySplitResult[0]+'" class="nopad thumb4img"/>').fadeIn("slow");
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
        //alert(name)
	$(name).uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : name ,'typefield' : 'gallery'},
			//'debug'    : true,
			'swf'      : swfpath,
			'uploader' : uploaderpath,
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '120KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {/*alert('Flash was not detected.');*/},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	var mySplitResult = data.split("_");
            	var textGalleryName = 'hdngalleryname'+mySplitResult[1];
                var trId = mySplitResult[1];
            	document.getElementById(textGalleryName).value = mySplitResult[0];
                //alert(imagepath);
            	postData('image');
                $('#gallerypic'+trId).fadeOut('slow').html('<img src="'+imagepath+'/'+buildid+'/'+mySplitResult[0]+'" class="nopad thumb4img"/>').fadeIn("slow");
        	}
			// Your options here
		});
	}
}
