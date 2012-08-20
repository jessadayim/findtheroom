$(function() {// get more knowledge at http://www.uploadify.com/documentation/
		var ownername = document.getElementById('hdnownername').value
		var buildid = document.getElementById('hdnbuildid').value
		$('#file_upload').uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : 'head'},
			'swf'      : 'js/uploadify/uploadify.swf',
			'uploader' : 'js/uploadify/uploadify.php',
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilename').value = data;
        	}
			// Your options here
		});
	});
	
$(function() {// get more knowledge at http://www.uploadify.com/documentation/
		var ownername = document.getElementById('hdnownername').value
		var buildid = document.getElementById('hdnbuildid').value
		$('#room1').uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : 'room'},
			'swf'      : 'js/uploadify/uploadify.swf',
			'uploader' : 'js/uploadify/uploadify.php',
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	document.getElementById('hdnfilename2').value = data;
        	}
			// Your options here
		});
	});