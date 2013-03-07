<?php

################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP DataGrid Helper Class 0.1.2 (29.02.2012)                             #
##  Developed by:  ApPhp <info@apphp.com>                                      # 
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-datagrid/                          #
##  Copyright:     ApPHP DataGrid (c) 2006-2012. All rights reserved.          #
##                                                                             #
##  This class contains auxiliary methods for DataGrid class                   #
##                                                                             #
################################################################################

class Helper
{
    
    // PUBLIC STATIC METHODS:
    // ------------------------
    // GetRandomString
    // SetBrowserDefinitions
    // GetLangVocabulary
	// ConvertCase
	// GetColorsByName
	// GetColorNameByValue
	// SubString
	// FileUploadErrorMessage
	// GetFileMimetype
	// GetLangAbbrForJSAFV
	// GetLangAbbrForCalendar
	// ConvertFileSize
	// EncodeParameter
	// DecodeParameter
	// EncodeText
	// DecodeText
	// StripQuotes
	// MakeSafeFileName
    
    //--------------------------------------------------------------------------
    // Default class constructor 
    //--------------------------------------------------------------------------
    function __construct()
    {
        
    }

    //--------------------------------------------------------------------------
    // Class destructor
    //--------------------------------------------------------------------------    
    function __destruct()
    {
		// echo 'this object has been destroyed';
    }

    /**
     * Get random string
     * 		@param $length
     */
    public static function GetRandomString($length = 20)
	{
        $template_alpha = 'abcdefghijklmnopqrstuvwxyz';
        $template_alphanumeric = '1234567890abcdefghijklmnopqrstuvwxyz';
        settype($template, 'string');
        settype($length, 'integer');
        settype($rndstring, 'string');
        settype($a, 'integer');
        settype($b, 'integer');
        $b = rand(0, strlen($template_alpha) - 1);
        $rndstring .= $template_alpha[$b];        
        for ($a = 0; $a < $length-1; $a++) {
            $b = rand(0, strlen($template_alphanumeric) - 1);
            $rndstring .= $template_alphanumeric[$b];
        }       
        return $rndstring;       
    }

    /**
     * Set browser definitions
     */
    public static function SetBrowserDefinitions()
    {
        $bd = array();
        
        $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        // initialize properties
        $bd['platform'] = 'Windows';
        $bd['browser'] = 'MSIE';
        $bd['version'] = '6.0';    
          
        // find operating system
        if (preg_match('/win/i', $agent))       $bd['platform'] = 'Windows';
        elseif (preg_match('/mac/i', $agent))   $bd['platform'] = 'MacIntosh';
        elseif (preg_match('/linux/i', $agent)) $bd['platform'] = 'Linux';
        elseif (preg_match('/OS\/2/i', $agent)) $bd['platform'] = 'OS/2';
        elseif (preg_match('/BeOS/i', $agent))  $bd['platform'] = 'BeOS';
        
        // test for Opera
        if (preg_match('/opera/i',$agent)){
            $val = stristr($agent, 'opera');
            if (preg_match('/\//', $val)){
                $val = explode('/',$val); $bd['browser'] = $val[0]; $val = explode(' ',$val[1]); $bd['version'] = $val[0];
            }else{
                $val = explode(' ',stristr($val,'opera')); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
            }
        // test for MS Internet Explorer version 1
        }elseif(preg_match('/microsoft internet explorer/i', $agent)){
            $bd['browser'] = 'MSIE'; $bd['version'] = '1.0'; $var = stristr($agent, '/');
            if (preg_match('/308|425|426|474|0b1/', $var)) $bd['version'] = '1.5';
        // test for MS Internet Explorer
        }elseif(preg_match('/msie/i',$agent) && !preg_match('/opera/i',$agent)){
            $val = explode(' ',stristr($agent,'msie')); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
        // test for MS Pocket Internet Explorer
        }elseif(preg_match('/mspie/i',$agent) || preg_match('/pocket/i', $agent)){
            $val = explode(' ',stristr($agent,'mspie')); $bd['browser'] = 'MSPIE'; $bd['platform'] = 'WindowsCE';
            if (preg_match('/mspie/i', $agent)){
                $bd['version'] = $val[1];
            }else{
                $val = explode('/',$agent);     $bd['version'] = $val[1];
            }
        // test for Firebird
        }elseif(preg_match('/firebird/i', $agent)){
            $bd['browser']='Firebird'; $val = stristr($agent, 'Firebird'); $val = explode('/',$val); $bd['version'] = $val[1];
        // test for Firefox
        }elseif(preg_match('/Firefox/i', $agent)){
            $bd['browser']='Firefox'; $val = stristr($agent, 'Firefox'); $val = explode('/',$val); $bd['version'] = $val[1];
        // test for Mozilla Alpha/Beta Versions
        }elseif(preg_match('/mozilla/i',$agent) && preg_match('/rv:[0-9].[0-9][a-b]/i',$agent) && !preg_match('/netscape/i',$agent)){
            $bd['browser'] = 'Mozilla'; $val = explode(' ',stristr($agent,'rv:')); preg_match('/rv:[0-9].[0-9][a-b]/i',$agent,$val); $bd['version'] = str_replace('rv:','',$val[0]);
        // test for Mozilla Stable Versions
        }elseif(preg_match('/mozilla/i',$agent) && preg_match('/rv:[0-9]\.[0-9]/i',$agent) && !preg_match('/netscape/i',$agent)){
            $bd['browser'] = 'Mozilla'; $val = explode(' ',stristr($agent,'rv:')); preg_match('/rv:[0-9]\.[0-9]\.[0-9]/i',$agent,$val); $bd['version'] = str_replace('rv:','',$val[0]);
        // remaining two tests are for Netscape
        }elseif(preg_match('/netscape/i',$agent)){
            $val = explode(' ',stristr($agent,'netscape')); $val = explode('/',$val[0]); $bd['browser'] = $val[0]; $bd['version'] = $val[1];
        }elseif(preg_match('/mozilla/i',$agent) && !preg_match('/rv:[0-9]\.[0-9]\.[0-9]/i',$agent)){
            $val = explode(' ',stristr($agent,'mozilla')); $val = explode('/',$val[0]); $bd['browser'] = 'Netscape'; $bd['version'] = $val[1];
        }
        // clean up extraneous garbage that may be in the name
        $bd['browser'] = preg_replace('/[^a-z,A-Z]/', '', $bd['browser']);
        $bd['version'] = preg_replace('/[^0-9,.,a-z,A-Z]/', '', $bd['version']);
        
        return $bd;
    }

    /**
     * Get language vocabulary
     */
    public static function GetLangVocabulary()
    {    
        $lang = array();
        
        $lang['='] = '=';  // 'equal'; 
        $lang['>'] = '>';  // 'bigger'; 
        $lang['<'] = '<';  // 'smaller';            
        $lang['add'] = 'Add';
        $lang['add_new'] = '+ Add New';
        $lang['add_new_record'] = 'Add new record'; 
        $lang['add_new_record_blocked'] = 'Security check: attempt of adding a new record! Check your settings, the operation is not allowed!';
        $lang['adding_operation_completed'] = 'The adding operation completed successfully!';
        $lang['adding_operation_uncompleted'] = 'The adding operation uncompleted!';
		$lang['alert_perform_operation'] = 'Are you sure you want to carry out this operation?';
        $lang['alert_select_row'] = 'You need to select one or more rows to carry out this operation!';		
        $lang['and'] = 'and';
        $lang['any'] = 'any';                         
        $lang['ascending'] = 'Ascending'; 
        $lang['back'] = 'Back';
        $lang['cancel'] = 'Cancel';
        $lang['cancel_creating_new_record'] = 'Are you sure you want to cancel creating new record?';
        $lang['check_all'] = 'Check All';
        $lang['clear'] = 'Clear';
		$lang['click_to_download'] = 'Click to Download';
		$lang['clone_selected'] = 'Clone selected';
		$lang['cloning_record_blocked'] = 'Security check: attempt of cloning a record! Check your settings, the operation is not allowed!';
		$lang['cloning_operation_completed'] = 'The cloning operation completed successfully!';
		$lang['cloning_operation_uncompleted'] = 'The cloning operation uncompleted!';
        $lang['create'] = 'Create';
        $lang['create_new_record'] = 'Create new record';            
        $lang['current'] = 'current';
        $lang['delete'] = 'Delete';
        $lang['delete_record'] = 'Delete record';
        $lang['delete_record_blocked'] = 'Security check: attempt of deleting a record! Check your settings, the operation is not allowed!';
        $lang['delete_selected'] = 'Delete selected';
        $lang['delete_selected_records'] = 'Are you sure you want to delete the selected records?';
        $lang['delete_this_record'] = 'Are you sure you want to delete this record?';                             
        $lang['deleting_operation_completed'] = 'The deleting operation completed successfully!';
        $lang['deleting_operation_uncompleted'] = 'The deleting operation uncompleted!';                                    
        $lang['descending'] = 'Descending';
        $lang['details'] = 'Details';
        $lang['details_selected'] = 'View selected';
		$lang['download'] = 'Download';
        $lang['edit'] = 'Edit';                
        $lang['edit_selected'] = 'Edit selected';
        $lang['edit_record'] = 'Edit record'; 
        $lang['edit_selected_records'] = 'Are you sure you want to edit the selected records?';               
        $lang['errors'] = 'Errors';            
        $lang['export_to_excel'] = 'Export to Excel';
        $lang['export_to_pdf'] = 'Export to PDF';
        $lang['export_to_xml'] = 'Export to XML';
        $lang['field'] = 'Field';
        $lang['field_value'] = 'Field Value';
        $lang['file_find_error'] = 'Cannot find file: <b>_FILE_</b>. <br>Check if this file exists and you use a correct path!';                                                
        $lang['file_opening_error'] = 'Cannot open a file. Check your permissions.';
		$lang['file_extension_error'] = 'File upload error: file extension not allowed for upload. Please choose another file.';
        $lang['file_writing_error'] = 'Cannot write to file. Check writing permissions.';
        $lang['file_invalid_file_size'] = 'Invalid file size: ';
        $lang['file_uploading_error'] = 'There was an error while uploading, please try again!';
        $lang['file_deleting_error'] = 'There was an error while deleting!';
        $lang['first'] = 'first';
		$lang['format'] = 'Format';
        $lang['generate'] = 'generate';
        $lang['handle_selected_records'] = 'Are you sure you want to handle the selected records?';
        $lang['hide_search'] = 'Hide Search';            
		$lang['item'] = 'item';
		$lang['items'] = 'items';
        $lang['last'] = 'last';
        $lang['like'] = 'like';
        $lang['like%'] = 'like%';  // 'begins with'; 
        $lang['%like'] = '%like';  // 'ends with';
        $lang['%like%'] = '%like%';  // 'ends with';
        $lang['loading_data'] = 'loading data...';            
        $lang['max'] = 'max';
		$lang['max_number_of_records'] = 'You have exceeded the maximum number of allowed records!';
		$lang['move_down'] = 'Move Down';
		$lang['move_up'] = 'Move Up';
		$lang['move_operation_completed'] = 'The moving row operation completed successfully!';
		$lang['move_operation_uncompleted'] = 'The moving row operation uncompleted!';
        $lang['next'] = 'next';
        $lang['no'] = 'No';
        $lang['no_data_found'] = 'No data found';
        $lang['no_data_found_error'] = 'No data found! Please, check carefully your code syntax!<br>It may be case sensitive or there are some unexpected symbols.';                                
        $lang['no_image'] = 'No Image';
        $lang['not_like'] = 'not like';
        $lang['of'] = 'of';
        $lang['operation_was_already_done'] = 'The operation was already completed! You cannot retry it again.';            
        $lang['or'] = 'or';            
        $lang['pages'] = 'Pages';                    
        $lang['page_size'] = 'Page size';
        $lang['previous'] = 'previous';
        $lang['printable_view'] = 'Printable View';
        $lang['print_now'] = 'Print Now';            
        $lang['print_now_title'] = 'Click here to print this page';
        $lang['record_n'] = 'Record # ';
        $lang['refresh_page'] = 'Refresh Page';
        $lang['remove'] = 'Remove';
        $lang['reset'] = 'Reset';                        
        $lang['results'] = 'Results';
        $lang['required_fields_msg'] = '<font color="#cd0000">*</font> Items marked with an asterisk are required';            
        $lang['search'] = 'Search';
        $lang['search_d'] = 'Search'; // (description)
        $lang['search_type'] = 'Search type';
        $lang['select'] = 'select';
        $lang['set_date'] = 'Set date';
        $lang['sort'] = 'Sort';
        $lang['test'] = 'Test';
        $lang['total'] = 'Total';
        $lang['turn_on_debug_mode'] = 'For more information, turn on debug mode.';
        $lang['uncheck_all'] = 'Uncheck All';
        $lang['unhide_search'] = 'Unhide Search';
        $lang['unique_field_error'] = 'The field _FIELD_ allows only unique values - please reenter!';
        $lang['update'] = 'Update';
        $lang['update_record'] = 'Update record';
        $lang['update_record_blocked'] = 'Security check: attempt of updating a record! Check your settings, the operation is not allowed!';
        $lang['updating_operation_completed'] = 'The updating operation completed successfully!';
        $lang['updating_operation_uncompleted'] = 'The updating operation uncompleted!';                                    
        $lang['upload'] = 'Upload';
		$lang['uploaded_file_not_image'] = 'The uploaded file doesn\'t seem to be an image.';
        $lang['view'] = 'View';
        $lang['view_details'] = 'View details';
        $lang['warnings'] = 'Warnings';
        $lang['with_selected'] = 'With selected';
        $lang['wrong_field_name'] = 'Wrong field name';
        $lang['wrong_parameter_error'] = 'Wrong parameter in [<b>_FIELD_</b>]: _VALUE_';
        $lang['yes'] = 'Yes';
        // date-time
        $lang['day']    = 'day';
        $lang['month']  = 'month';
        $lang['year']   = 'year';
        $lang['hour']   = 'hour';
        $lang['min']    = 'min';
        $lang['sec']    = 'sec';
        $lang['months'][1] = 'January';
        $lang['months'][2] = 'February';
        $lang['months'][3] = 'March';
        $lang['months'][4] = 'April';
        $lang['months'][5] = 'May';
        $lang['months'][6] = 'June';
        $lang['months'][7] = 'July';
        $lang['months'][8] = 'August';
        $lang['months'][9] = 'September';
        $lang['months'][10] = 'October';
        $lang['months'][11] = 'November';
        $lang['months'][12] = 'December';
        
        return $lang;
    }

    /**
     * Convert case for strings lower/upper/camel
     * 		@param $str
     * 		@param $case
     * 		@param $lang_name
     */
    public static function ConvertCase($str, $case = '', $lang_name = 'en')
	{
		if(is_array($str)) return $str;
		$detect_encoding = function_exists('mb_detect_encoding') ? mb_detect_encoding($str) : 'ASCII';
        if($lang_name == 'en' && $detect_encoding == 'ASCII'){
			if($case == 'lower') return strtolower($str);
			else if($case == 'upper') return strtoupper($str);
            else if($case == 'camel') return mb_convert_case($str, MB_CASE_TITLE, mb_detect_encoding($str));
        }else if(!empty($detect_encoding)){
			if($case == 'lower' && function_exists('mb_strtolower')) return mb_strtolower($str, $detect_encoding);
			else if($case == 'upper' && function_exists('mb_strtoupper')) return mb_strtoupper($str, $detect_encoding);
            else if($case == 'camel' && function_exists('mb_strtoupper')) return mb_convert_case($str, MB_CASE_TITLE, $detect_encoding);
        }
		return $str;
    }

    /**
     * Return colors
     */
    public static function GetColorsByName()
    {
		$colors = array(
			'Reds' => array(
				'#CD5C5C' => 'Indian Red',
				'#F08080' => 'Light Coral',
				'#FA8072' => 'Salmon',
				'#E9967A' => 'Dark Salmon',
				'#FFA07A' => 'Light Salmon',
				'#DC143C' => 'Crimson',
				'#FF0000' => 'Red',
				'#B22222' => 'Fire Brick',
				'#8B0000' => 'Dark Red'		
			),
			
			'Pinks' => array(
				'#FFC0CB' => 'Pink',
				'#FFB6C1' => 'Light Pink',
				'#FF69B4' => 'Hot Pink',
				'#FF1493' => 'Deep Pink',
				'#C71585' => 'Medium Violet Red',
				'#DB7093' => 'Pale Violet Red'
			),

			'Oranges' => array(
				'#FFA07A' => 'Light Salmon',
				'#FF7F50' => 'Coral',
				'#FF6347' => 'Tomato',
				'#FF4500' => 'Orange Red',
				'#FF8C00' => 'Dark Orange',
				'#FFA500' => 'Orange'			
			),
			
			'Yellows' => array(
				'#FFD700' => 'Gold',
				'#FFFF00' => 'Yellow',
				'#FFFFE0' => 'Light Yellow',
				'#FFFACD' => 'Lemon Chiffon',
				'#FAFAD2' => 'Light Goldenrod Yellow',
				'#FFEFD5' => 'Papaya Whip',
				'#FFE4B5' => 'Moccasin',
				'#FFDAB9' => 'Peach Puff',
				'#EEE8AA' => 'Pale Goldenrod',
				'#F0E68C' => 'Khaki',
				'#BDB76B' => 'Dark Khaki'			
			),
			
			'Purples' => array(
				'#E6E6FA' => 'Lavender',
				'#D8BFD8' => 'Thistle',
				'#DDA0DD' => 'Plum',
				'#EE82EE' => 'Violet',
				'#DA70D6' => 'Orchid',
				'#FF00FF' => 'Fuchsia',
				'#FF00FF' => 'Magenta',
				'#BA55D3' => 'Medium Orchid',
				'#9370DB' => 'Medium Purple',
				'#8A2BE2' => 'Blue Violet',
				'#9400D3' => 'Dark Violet',
				'#9932CC' => 'Dark Orchid',
				'#8B008B' => 'Dark Magenta',
				'#800080' => 'Purple',
				'#4B0082' => 'Indigo',
				'#6A5ACD' => 'Slate Blue',
				'#483D8B' => 'Dark Slate Blue'			
			),
			
			'Greens' => array(			
				'#ADFF2F' => 'Green Yellow',
				'#7FFF00' => 'Chartreuse',
				'#7CFC00' => 'Lawn Green',
				'#00FF00' => 'Lime',
				'#32CD32' => 'Lime Green',
				'#98FB98' => 'Pale Green',
				'#90EE90' => 'Light	Green',
				'#00FA9A' => 'Medium Spring Green',
				'#00FF7F' => 'Spring Green',
				'#3CB371' => 'Medium Sea Green',
				'#2E8B57' => 'Sea Green',
				'#228B22' => 'Forest Green',
				'#008000' => 'Green',
				'#006400' => 'Dark Green',
				'#9ACD32' => 'Yellow Green',
				'#6B8E23' => 'Olive Drab',
				'#808000' => 'Olive',
				'#556B2F' => 'Dark Olive Green',
				'#66CDAA' => 'Medium Aquamarine',
				'#8FBC8F' => 'Dark Sea Green',
				'#20B2AA' => 'Light Sea Green',
				'#008B8B' => 'Dark Cyan',
				'#008080' => 'Teal'
			),
			
			'Blues' => array(
				'#00FFFF' => 'Aqua',
				'#00FFFF' => 'Cyan',
				'#E0FFFF' => 'Light Cyan',
				'#AFEEEE' => 'Pale Turquoise',
				'#7FFFD4' => 'Aquamarine',
				'#40E0D0' => 'Turquoise',
				'#48D1CC' => 'Medium Turquoise',
				'#00CED1' => 'Dark Turquoise',
				'#5F9EA0' => 'Cadet Blue',
				'#4682B4' => 'Steel Blue',
				'#B0C4DE' => 'Light Steel Blue',
				'#B0E0E6' => 'Powder Blue',
				'#ADD8E6' => 'Light Blue',
				'#87CEEB' => 'Sky Blue',
				'#87CEFA' => 'Light Sky Blue',
				'#00BFFF' => 'Deep Sky Blue',
				'#1E90FF' => 'Dodger Blue',
				'#6495ED' => 'Cornflower Blue',
				'#7B68EE' => 'Medium Slate Blue',
				'#4169E1' => 'Royal Blue',
				'#0000FF' => 'Blue',
				'#0000CD' => 'Medium Blue',
				'#00008B' => 'Dark Blue',
				'#000080' => 'Navy',
				'#191970' => 'Midnight Blue'			
			),			
			
			'Browns' => array(
				'#FFF8DC' => 'Cornsilk',
				'#FFEBCD' => 'Blanched Almond',
				'#FFE4C4' => 'Bisque',
				'#FFDEAD' => 'Navajo White',
				'#F5DEB3' => 'Wheat',
				'#DEB887' => 'Burly Wood',
				'#D2B48C' => 'Tan',
				'#BC8F8F' => 'Rosy Brown',
				'#F4A460' => 'Sandy Brown',
				'#DAA520' => 'Goldenrod',
				'#B8860B' => 'Dark Goldenrod',
				'#CD853F' => 'Peru',
				'#D2691E' => 'Chocolate',
				'#8B4513' => 'Saddle Brown',
				'#A0522D' => 'Sienna',
				'#A52A2A' => 'Brown',
				'#800000' => 'Maroon'			
			),

			'Whites' => array(
				'#FFFFFF' => 'White',
				'#FFFAFA' => 'Snow',
				'#F0FFF0' => 'Honeydew',
				'#F5FFFA' => 'Mint Cream',
				'#F0FFFF' => 'Azure',
				'#F0F8FF' => 'Alice Blue',
				'#F8F8FF' => 'Ghost White',
				'#F5F5F5' => 'White Smoke',
				'#FFF5EE' => 'Seashell',
				'#F5F5DC' => 'Beige',
				'#FDF5E6' => 'Old Lace',
				'#FFFAF0' => 'Floral White',
				'#FFFFF0' => 'Ivory',
				'#FAEBD7' => 'Antique White',
				'#FAF0E6' => 'Linen',
				'#FFF0F5' => 'Lavender Blush',
				'#FFE4E1' => 'Misty Rose'			
			),
			
			'Greys' => array(
				'#DCDCDC' => 'Gainsboro',
				'#D3D3D3' => 'Light Grey',
				'#C0C0C0' => 'Silver',
				'#A9A9A9' => 'Dark Gray',
				'#808080' => 'Gray',
				'#696969' => 'Dim Gray',
				'#778899' => 'Light Slate Gray',
				'#708090' => 'Slate Gray',
				'#2F4F4F' => 'Dark Slate Gray',
				'#000000' => 'Black'			
			)
		);
		return $colors;
	}
	
    /**
     * Return color name
     * 		@param $color_value
     */
    public static function GetColorNameByValue($color_value)
    {
		$arr_colors = Helper::GetColorsByName();
        foreach($arr_colors as $key => $val){
			if(isset($val[$color_value])) return $val[$color_value];
		}		
		return '';
	}	
	
    /**
     * Return part of a string
     * 		@param $text
     * 		@param $length
     * 		@param $lang_name
     * 		@param $three_dots
     */
    public static function SubString($text, $length = '0', $lang_name = 'en', $three_dots = false)
	{
		if($lang_name == 'en' && mb_detect_encoding($lang_name) == 'ASCII'){	
            $output = substr($text, 0, $length);
        }else{
			$output = mb_substr($text, 0, $length, 'UTF-8');
        }
		if($three_dots) $output .= '...';
		return $output;
    }
	
    /**
     * Return a description of file uploading error
     * 		@param $error_code
     */
	public static function FileUploadErrorMessage($error_code)
	{
		switch($error_code){ 
			case UPLOAD_ERR_INI_SIZE: 
				return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
			case UPLOAD_ERR_FORM_SIZE: 
				return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 
			case UPLOAD_ERR_PARTIAL: 
				return 'The uploaded file was only partially uploaded'; 
			case UPLOAD_ERR_NO_FILE: 
				return 'No file was uploaded'; 
			case UPLOAD_ERR_NO_TMP_DIR: 
				return 'Missing a temporary folder'; 
			case UPLOAD_ERR_CANT_WRITE: 
				return 'Failed to write file to disk'; 
			case UPLOAD_ERR_EXTENSION: 
				return 'File upload stopped by extension'; 
			default: 
				return 'Unknown upload error'; 
		} 
	}	

    /**
     * Get file mimetype
     * 		@param $file_name
     */
    public static function GetFileMimetype($file_name)
	{
        $file_mimetype = strtolower(strchr(basename($file_name), '.'));
        switch($file_mimetype){
            case '.doc':
            case '.rtf': $file_mimetype = 'doc'; break;
            case '.txt': $file_mimetype = 'txt'; break;
            case '.html':
            case '.htm': $file_mimetype = 'binary'; break;
            case '.xml': $file_mimetype = 'xml'; break;
            case '.csv':
            case '.xls': $file_mimetype = 'xls'; break;
            case '.pdf': $file_mimetype = 'pdf'; break;
            case '.jpg':
            case '.jpeg':
            case '.png':
            case '.gif':
            case '.bmp': $file_mimetype = 'image'; break;
            case '.exe':
            case '.com': $file_mimetype = 'binary'; break;
            case '.tar':
            case '.gz':
            case '.zip': $file_mimetype = 'archive'; break;
            default:
                $file_mimetype = 'file'; break;
        }
        return $file_mimetype;
    }

    /**
     * Get language abbreviation for JS AFV
     * 		@param $lang_name
     */
    public static function GetLangAbbrForJSAFV($lang_name)
	{
        $return_abbrv = 'en';
        switch($lang_name){
            case 'de': $return_abbrv = 'de'; break;                            
            case 'es': $return_abbrv = 'es'; break;
            case 'fr': $return_abbrv = 'fr'; break;
            case 'it': $return_abbrv = 'it'; break;
            case 'ja': $return_abbrv = 'ja'; break;
            case 'tr': $return_abbrv = 'tr'; break;
            case 'en':
            default:
                $return_abbrv = 'en'; break;
        }
        return $return_abbrv;
    }    
    
    /**
     * Get language abbreviation for calendar
     * 		@param $lang_name
     */
    public static function GetLangAbbrForCalendar($lang_name)
	{
        $return_abbrv = 'en';
        switch($lang_name){
            case 'ar': $return_abbrv = 'en'; break; // Arabic
            case 'hr': $return_abbrv = 'hr'; break; // Bosnian/Croatian            
            case 'bg': $return_abbrv = 'bg'; break; // Bulgarian
            case 'pb': $return_abbrv = 'pt'; break; // Brazilian Portuguese    
            case 'ca': $return_abbrv = 'ca'; break; // Catala
            case 'ch': $return_abbrv = 'cn'; break; // Chinese
            case 'cz': $return_abbrv = 'cs'; break; // Czech
            case 'de': $return_abbrv = 'de'; break; // German                
            case 'es': $return_abbrv = 'es'; break; // Espanol
			case 'fi': $return_abbrv = 'fi'; break; // Finnish, Suomi
            case 'fr': $return_abbrv = 'fr'; break; // Francais
            case 'gk': $return_abbrv = 'en'; break; // Greek
            case 'he': $return_abbrv = 'he'; break; // Hebrew
            case 'hu': $return_abbrv = 'hu'; break; // Hungarian
            case 'it': $return_abbrv = 'it'; break; // Italiano
            case 'ja': $return_abbrv = 'ja'; break; // Japanese
			case 'ko': $return_abbrv = 'ko'; break; // Korean
            case 'lt': $return_abbrv = 'lt'; break; // Lithuanian
            case 'lt': $return_abbrv = 'lt'; break; // Lithuanian
            case 'nl': $return_abbrv = 'nl'; break; // Netherlands/'Vlaams'(Flemish)
            case 'pl': $return_abbrv = 'pl'; break; // Polish
            case 'ro': $return_abbrv = 'ro'; break; // Romanian            
            case 'ru': $return_abbrv = 'ru'; break; // Russian
            case 'sr': $return_abbrv = 'en'; break; // Serbian
            case 'se': $return_abbrv = 'sv'; break; // Swedish
            case 'tr': $return_abbrv = 'tr'; break; // Turkish
            case 'en':
            default:
                $return_abbrv = 'en'; break;
        }
        return $return_abbrv;
    }
	
    /**
     * Convert file size
     * 		@param $file_size
     */
    public static function ConvertFileSize($file_size)
	{
		$return_size = $file_size;
		if(!is_numeric($file_size)){ 
			if(strpos($file_size, 'm') !== false){ 
				$return_size = intval($file_size)*1024*1024; 
			}else if(strpos($file_size, 'k') !== false){ 
				$return_size = intval($file_size)*1024; 
			}else if(strpos($file_size, 'g') !== false){ 
				$return_size = intval($file_size)*1024*1024*1024;
			}
		}
		return $return_size;
	}
	
    /**
     * Encode parameter
     *      @param $param
     *      @param $return_string
     */
    public static function EncodeParameter($param, $safe_mode = true, $return_string = true)
	{
        if($safe_mode){
            $base64 = base64_encode($param);
            $base64url = strtr($base64, '+/=', '-_,');
            if($return_string) return $base64url; 
            else return $base64url;                     
        }
        return $param;
    }

    /**
     * Decode parameter
     *      @param $param
     */
    public static function DecodeParameter($param, $safe_mode = true)
	{
        if($safe_mode){
            $base64url = strtr($param, '-_,', '+/=');
            $base64 = base64_decode($base64url);
            return $base64;          
        }
        return $param;        
    }

    /**
     *	Get encoded text
     *		@param $string
     */
    public static function EncodeText($string = '')
    {
        $search	 = array("\\","\0","\n","\r","\x1a","'",'"',"\'",'\"');
        $replace = array("\\\\","\\0","\\n","\\r","\Z","\'",'\"',"\\'",'\\"');
        return str_replace($search, $replace, $string);
    }
    
    /**
     *	Get decoded text
     *		@param $string
     *		@param $code_quotes
     *		@param $quotes_type
     */
    public static function DecodeText($string = '', $code_quotes = true, $quotes_type = '')
    {
        $single_quote = "'";
        $double_quote = '"';		
        if($code_quotes){
            if(!$quotes_type){
                $single_quote = '&#039;';
                $double_quote = '&#034;';
            }else if($quotes_type == 'single'){
                $single_quote = '&#039;';
            }else if($quotes_type == 'double'){
                $double_quote = '&#034;';
            }
        }
        
        $search  = array("\\\\","\\0","\\n","\\r","\Z","\\'",'\\"','"',"'");
        $replace = array("\\","\0","\n","\r","\x1a","\'",'\"',$double_quote,$single_quote);
        return str_replace($search, $replace, $string);
    }

    /**
     *	 Strip quotes
     *		@param $string
     */
    public static function StripQuotes($string = '')
    {
        $search	 = array("'",'"');        
        return str_replace($search, '', $string);
    }
	
    /**
     *	 Make safe file name
     *		@param $source
     */
    public static function MakeSafeFileName($source = '')
    {
        return strtolower(preg_replace('/([^\w\d\-_.]+)/', '-', $source));
    }


}// end class

?>