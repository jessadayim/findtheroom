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
		loopbutton();
		
		test();
	});

function test()
{
	var ownername = document.getElementById('hdnownername').value;
	var buildid = document.getElementById('hdnbuildid').value;
	var numberline = parseInt(document.addform.hdnMaxLine.value);
	alert(numverline)
	for(i=0;i<numberline;i++){
	var name = '#room'+i
	alert(name);
	$(name).uploadify({
			'formData'      : {'ownername' : ownername, 'buildid' : buildid ,'fieldname' : 'room'},
			'debug'    : true,
			'swf'      : 'js/uploadify/uploadify.swf',
			'uploader' : 'js/uploadify/uploadify.php',
			//'uploadLimit' : 1,
			//'queueSizeLimit' : 1,
			'fileSizeLimit' : '200KB',
			'fileTypeExts' : '*.gif; *.jpg; *.png',
			'onFallback' : function() {alert('Flash was not detected.');},// detect flash compatible
			'onUploadSuccess' : function(file, data, response) {
            	//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            	alert(myID)
            	document.getElementById('hdnfilename0').value = data;
        	}
			// Your options here
		});
	}
}
