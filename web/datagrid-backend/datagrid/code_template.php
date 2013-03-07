<?php
    ## Last Changed: 27.02.2012

    ## wee need this if we want to prevent FF sending double request
    header('content-type: text/html; charset=utf-8');
    
    ## uncomment, if your want to prevent 'Web Page exired' message when use $submission_method = 'post';
    ## (don't uncomment, if your export feature is active)
    // session_cache_limiter ('private, must-revalidate');    
    ## uncomment, if your export feature (or movable rows) is active
    // session_start();    

        
    /***
     * Uncomment all needed lines of the code
     * ---------------------
     * NOTE: We use
     *   ## as comments
     *   // as lines, that must be uncommented
     *   /// as lines, that may be uncommented (optional)
     *   
    */

    /***
     * Common notes
     * ---------------------
     *  1. Please, use a $debug_mode = true; before you say 'Why Nothing Works ?!'
     *  2. Do not put DataGrid code into another HTML form: <form>...</form>
     *  3. Be careful when using the names of fields they may be case sensitive!
     *  4. For the best performance uncomment ob_start(); and ob_end_flush(); functions.
     *  
    */


    ################################################################################
    ## --------------------------------------------------------------------------- #
    ##  ApPHP DataGrid Pro (AJAX enabled) version 7.4.9                            #
    ##  Developed by:  ApPhp <info@apphp.com>                                      # 
    ##  License:       GNU LGPL v.3                                                #
    ##  Site:          http://www.apphp.com/php-datagrid/                          #
    ##  Copyright:     ApPHP DataGrid (c) 2006-2012. All rights reserved.          #
    ##                                                                             # 
    ################################################################################
    ## +---------------------------------------------------------------------------+
    ## | 1. Creating & Calling:                                                    | 
    ## +---------------------------------------------------------------------------+
    ##  *** define a relative (virtual) path to datagrid.class.php file
    ##  *** (relatively to the current file)
    ##  *** RELATIVE PATH ONLY ***
    //  define ('DATAGRID_DIR', '');                     /* Ex.: 'datagrid/' */ 
    //  require_once(DATAGRID_DIR.'datagrid.class.php');
    ##
    ##  *** creating variables that we need for database connection 
    //  $DB_USER='name';            /* usually like this: prefix_name             */
    //  $DB_PASS='';                /* don't use empty passwords (recommended)    */
    //  $DB_HOST='localhost';       /* usually localhost                          */
    //  $DB_NAME='dbName';          /* usually like this: prefix_dbName           */
    //
    //  ob_start();
    ##
    ##  *** set needed options and create a new class instance 
    //  $debug_mode = false;        /* display SQL statements while processing */    
    //  $messaging = true;          /* display system messages on a screen */ 
    //  $unique_prefix = 'abc_';    /* prevent overlays - must be started with a letter */
    //  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix);
    ##  *** set encoding and collation (default: utf8/utf8_unicode_ci)
    /// $dg_encoding = 'utf8';
    /// $dg_collation = 'utf8_unicode_ci';
    /// $dgrid->SetEncoding($dg_encoding, $dg_collation);
    ##  *** set data source with required settings
    ##  *** 1. write all fields separated by commas(,) like: field1, field2 etc.. DON'T USE table.*
    ##  *** 2. write the primary key in the first place (MUST BE AUTO-INCREMENT NUMERIC!)
    //  $sql = 'SELECT primary_key, field_1, field_2 ... FROM tableName ;';
    //  $default_order = array();   /* Ex.: array('field_1'=>'ASC', 'field_2'=>'DESC') */
    ##  *** first parameter 'PEAR' or 'PDO' (experimental)
    //  $dgrid->DataSource('PEAR', 'mysql', $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 2. General Settings:                                                      | 
    ## +---------------------------------------------------------------------------+
    ## +-- PostBack Submission Method ---------------------------------------------+
    ##  *** defines postback submission method for DataGrid: AJAX, POST(default) or GET
    /// $postback_method = 'post';
    /// $dgrid->SetPostBackMethod($postback_method);
    ##
    ## +-- Cache Settings ---------------------------------------------------------+
    ## *** make sure your tmp/cache/ dir has 755 (write) permissions
    ## *** define caching parameters: 1st - allow caching or not, 2nd - caching lifetime in minutes
    /// $dgrid->SetCachingParameters(true, 5);
    ## *** delete all caching pages (only if needed)
    /// $dgrid->DeleteCache();
    ##
    ## +-- Languages --------------------------------------------------------------+
    ##  *** set interface language (default - English)
    ##  *** (ar) - Arabic     (bg) - Bulgarian        (ca) - Catala    (ch) - Chinese
    ##  *** (cz) - Czech      (da) - Danish           (de) - German    (en) - English
    ##  *** (es) - Espanol    (fi) - Finnish, Suomi   (fr) - Francais  (gk) - Greek     
    ##  *** (he) - Hebrew     (hr) - Bosnian/Croatian (hu) - Hungarian (it) - Italian
    ##  *** (ja) - Japanese   (lt) - Lithuanian       (nl) - Netherlands/'Vlaams'(Flemish)
    ##  *** (pl) - Polish     (pb) - Br.Portuguese    (ro) - Romanian  (ko) - Korean
    ##  *** (ru) - Russian    (se) - Swedish          (sr) - Serbian   (tr) - Turkish                 
    /// $dg_language = 'en';  
    /// $dgrid->SetInterfaceLang($dg_language);
    ##  *** set direction: 'ltr' or 'rtr' (default - 'ltr')
    /// $direction = 'ltr';
    /// $dgrid->SetDirection($direction);
    ##
    ## +-- Layouts, Templates & CSS -----------------------------------------------+
    ##  *** datagrid layouts: '0' - tabular(horizontal) - default, '1' - columnar(vertical), '2' - customized
    ##  *** use 'view'=>'0' and 'edit'=>'0' only if you work on the same tables
    ##  *** filter layouts: '0' - tabular(horizontal) - default, '1' - columnar(vertical), '2' - advanced(inline)
    /// $layouts = array('view'=>'0', 'edit'=>'1', 'details'=>'1', 'filter'=>'1'); 
    /// $dgrid->SetLayouts($layouts);
    /// *** $mode_template = array('header'=>'', 'body'=>'', 'footer'=>'');
    /// @field_name_1@ - field header 
    /// {field_name_1} - field value
    /// [ADD][CREATE][EDIT][DELETE][BACK][CANCEL][UPDATE][MULTIROW_CHECKBOX][ROWS_NUMERATION] - allowed elements and operations (must be placed in $template['body'] only)
    /// $view_template = '';
    /// $add_edit_template = '';
    /// $details_template = array('header'=>'', 'body'=>'', 'footer'=>'');
    /// $details_template['header'] = '';
    /// $details_template['body'] = '<table><tr><td>{field_name_1}</td><td>{field_name_2}</td></tr><tr><td>[BACK]</td></tr></table>';
    /// $details_template['footer'] = '';
    /// $dgrid->SetTemplates($view_template, $add_edit_template, $details_template);
    ##  *** set modes operations ('type' => 'link|button|image')
    ##  *** 'view' - view mode, 'edit' - add/edit/details modes, 
    ##  *** 'byFieldValue'=>'fieldName' - make the field to be a link to edit mode page
    /// $modes = array(
    ///     'add'	  =>array('view'=>true, 'edit'=>false, 'type'=>'link',  'show_button'=>true, 'show_add_button'=>'inside|outside'),
    ///     'edit'	  =>array('view'=>true, 'edit'=>true,  'type'=>'link',  'show_button'=>true, 'byFieldValue'=>''),
    ///     'details' =>array('view'=>true, 'edit'=>false, 'type'=>'link',  'show_button'=>true),
    ///     'delete'  =>array('view'=>true, 'edit'=>true,  'type'=>'image', 'show_button'=>true)
    /// );
    /// $dgrid->SetModes($modes);
    ##  *** set CSS class for datagrid
    ##  *** 'default|blue|gray|green|pink|empty|x-blue|x-gray|x-green' or your own css style
    /// $css_class = 'default';
    /// $dgrid->SetCssClass($css_class);
    ##  *** set DataGrid caption
    /// $dg_caption = 'My Favorite Lovely ApPHP DataGrid';
    /// $dgrid->SetCaption($dg_caption);
    ##
    ## +-- Scrolling --------------------------------------------------------------+
    ##  *** allow scrolling on datagrid
    /// $scrolling_option = false;
    /// $dgrid->AllowScrollingSettings($scrolling_option);  
    ##  *** set scrolling settings (optional) 
    /// $scrolling_height = '100px'; /* ex.: '190px' or '190' */
    /// $dgrid->SetScrollingSettings($scrolling_height);
    ##
    ## +-- Multirow Operations ----------------------------------------------------+
    ##  *** allow multirow operations
    /// $multirow_option = true;
    /// $dgrid->AllowMultirowOperations($multirow_option);
    /// $multirow_operations = array(
    ///     'edit'    => array('view'=>true),
    ///     'details' => array('view'=>true),
    ///     'clone'   => array('view'=>false),
    ///     'delete'  => array('view'=>true),
    ///     'my_operation_name' => array('view'=>true, 'flag_name'=>'my_flag_name', 'flag_value'=>'my_flag_value', 'tooltip'=>'Do something with selected', 'image'=>'image.gif')
    /// );
    /// $dgrid->SetMultirowOperations($multirow_operations);  
    ##
    ## +-- Passing parameters & setting up other DataGrids ------------------------+
    ##  *** set variables that used to get access to the page (like: my_page.php?act=34&id=56 etc.) 
    /// $http_get_vars = array('act', 'id');
    /// $dgrid->SetHttpGetVars($http_get_vars);
    ##  *** set other datagrid/s unique prefixes (if you use few datagrids on one page)
    ##  *** format (in which mode to allow processing of another datagrids)
    ##  *** array('unique_prefix'=>array('view'=>true|false, 'edit'=>true|false, 'details'=>true|false));
    /// $anotherDatagrids = array('abcd_'=>array('view'=>true, 'edit'=>true, 'details'=>true));
    /// $dgrid->SetAnotherDatagrids($anotherDatagrids);  
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 3. Printing & Exporting Settings:                                         | 
    ## +---------------------------------------------------------------------------+
    ## +-- Printing ---------------------------------------------------------------+
    ##  *** set printing option: true(default) or false 
    /// $printing_option = true;
    /// $dgrid->AllowPrinting($printing_option);
    ##
    ## +-- Exporting --------------------------------------------------------------+
    ##  *** initialize the session with session_start();
    ##  *** default exporting directory: tmp/export/
    /// $exporting_option = true;
    /// $export_all = false;
    /// $dgrid->AllowExporting($exporting_option, $export_all);
    /// $exporting_types = array('csv'=>'true', 'xls'=>'true', 'pdf'=>'true', 'xml'=>'true');
    /// $dgrid->AllowExportingTypes($exporting_types);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 4. Sorting & Paging Settings:                                             | 
    ## +---------------------------------------------------------------------------+
    ##  *** set sorting option: true(default) or false 
    /// $sorting_option = true;
    /// $dgrid->AllowSorting($sorting_option);               
    ##  *** set paging option: true(default) or false 
    /// $paging_option = true;
    /// $rows_numeration = false;
    /// $numeration_sign = 'N #';
    /// $dropdown_paging = false;
    /// $dgrid->AllowPaging($paging_option, $rows_numeration, $numeration_sign, $dropdown_paging);
    ##  *** set paging settings
    /// $bottom_paging = array('results'=>true, 'results_align'=>'left', 'pages'=>true, 'pages_align'=>'center', 'page_size'=>true, 'page_size_align'=>'right');
    /// $top_paging = array('results'=>true, 'results_align'=>'left', 'pages'=>true, 'pages_align'=>'center', 'page_size'=>true, 'page_size_align'=>'right');
    /// $pages_array = array('10'=>'10', '25'=>'25', '50'=>'50', '100'=>'100', '250'=>'250', '500'=>'500', '1000'=>'1000');
    /// $default_page_size = 10;
    /// $paging_arrows = array('first'=>'|&lt;&lt;', 'previous'=>'&lt;&lt;', 'next'=>'&gt;&gt;', 'last'=>'&gt;&gt;|');
    /// $dgrid->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size, $paging_arrows);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 5. Filter Settings:                                                       | 
    ## +---------------------------------------------------------------------------+
    ##  *** set filtering option: true or false(default)
    /// $filtering_option = true;
    /// $show_search_type = true;
    /// $dgrid->AllowFiltering($filtering_option, $show_search_type);
    ##  *** set additional filtering settings
    ##  *** use ',' (comma) if you want to make search by some words, for ex.: hello, bye, hi
    ##  *** you have to change search type to OR when you search multi-fields, for ex.: 'first_name, last_name'
    ##  *** 'field_type' (optional, for range search) may be 'from' or 'to'
    ##  *** 'date_format' may be 'date|datedmy|datemdy|datetime|time'
    ##  *** 'default_operator' may be =|<|>|like|%like|like%|%like%|not like
    ##  *** 'handler'=>'' - write here path relatively to DATAGRID_DIR (where datagrid.class.php is found)
    ##  *** 'field_view'=>'fieldName_2' or 'field_view'=>'CONCAT(first_name, ' ', last_name) as full_name' 
    /// $fill_from_array = array('0'=>'No', '1'=>'Yes');  /* as 'value'=>'option' */
    /// $filtering_fields = array(
    ///     'Caption_1'=>array('type'=>'textbox',  'table'=>'tableName_1', 'field'=>'fieldName_1|,fieldName_2', 'filter_condition'=>'', 'show_operator'=>'false', 'default_operator'=>'=', 'case_sensitive'=>'false', 'comparison_type'=>'string|numeric|binary', 'width'=>'', 'on_js_event'=>'', 'default'=>''),
    ///     'Caption_2'=>array('type'=>'textbox',  'table'=>'tableName_2', 'field'=>'fieldName_1|,fieldName_2', 'filter_condition'=>'', 'show_operator'=>'false', 'default_operator'=>'=', 'case_sensitive'=>'false', 'comparison_type'=>'string|numeric|binary', 'width'=>'', 'on_js_event'=>'', 'default'=>'', 'autocomplete'=>'false', 'handler'=>'modules/autosuggest/test.php', 'maxresults'=>'12', 'shownoresults'=>'false'),
    ///     'Caption_3'=>array('type'=>'enum',     'table'=>'tableName_3', 'field'=>'fieldName_1',              'filter_condition'=>'', 'show_operator'=>'false', 'default_operator'=>'=', 'case_sensitive'=>'false', 'comparison_type'=>'string|numeric|binary', 'width'=>'', 'on_js_event'=>'', 'default'=>'', 'source'=>'self'|$fill_from_array, 'view_type'=>'dropdownlist(default)|radiobutton', 'field_view'=>'fieldName_2', 'order_by_field'=>'', 'order_type'=>'ASC|DESC', 'condition'=>'', 'show_count'=>false, 'multiple'=>'false', 'multiple_size'=>'4'),
    ///     'Caption_4'=>array('type'=>'calendar', 'table'=>'tableName_4', 'field'=>'fieldName_1',              'filter_condition'=>'', 'show_operator'=>'false', 'default_operator'=>'=', 'case_sensitive'=>'false', 'comparison_type'=>'string|numeric|binary', 'width'=>'', 'on_js_event'=>'', 'default'=>'', 'calendar_type'=>'popup|floating', 'date_format'=>'date', 'field_type'=>''),
    /// );
    /// $dgrid->SetFieldsFiltering($filtering_fields);
    ##  *** allow default filtering: default - false
    /// $default_filtering_option = true;
    /// $dgrid->AllowDefaultFiltering($default_filtering_option);
    ##
    ## 
    ## +---------------------------------------------------------------------------+
    ## | 6. View Mode Settings:                                                    | 
    ## +---------------------------------------------------------------------------+
    ##  *** set view mode table properties
    /// $vm_table_properties = array('width'=>'90%');
    /// $dgrid->SetViewModeTableProperties($vm_table_properties);  
    ##  *** set columns in view mode
    ##  *** Ex.: 'on_js_event'=>'onclick="alert(\'Yes!!!\');"'
    ##  ***      'barchart' : number format in SELECT SQL must be equal with number format of max_value
    /// $fill_from_array = array('0'=>'Banned', '1'=>'Active', '2'=>'Closed', '3'=>'Removed'); /* as 'value'=>'option' */
    /// $vm_columns = array(
    ///     'FieldName_1'=>array('header'=>'Name_A', 'type'=>'label',      'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_2'=>array('header'=>'Name_B', 'type'=>'image',      'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'target_path'=>'uploads/', 'default'=>'', 'image_width'=>'50px', 'image_height'=>'30px', 'linkto'=>'', 'magnify'=>'false', 'magnify_type'=>'popup|magnifier|lightbox', 'magnify_power'=>'2'),
    ///     'FieldName_3'=>array('header'=>'Name_C', 'type'=>'linktoview', 'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_4'=>array('header'=>'Name_D', 'type'=>'linktoedit', 'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_5'=>array('header'=>'Name_E', 'type'=>'linktodelete', 'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_6'=>array('header'=>'Name_F', 'type'=>'link',       'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field_key'=>'field_name_0', 'field_key_1'=>'field_name_1', 'field_data'=>'field_name_2', 'rel'=>'', 'title'=>'', 'target'=>'_self', 'href'=>'{0}'),
    ///     'FieldName_7'=>array('header'=>'Name_G', 'type'=>'link',       'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field_key'=>'field_name_0', 'field_key_1'=>'field_name_1', 'field_data'=>'field_name_2', 'rel'=>'', 'title'=>'', 'target'=>'_self', 'href'=>'mailto:{0}'),
    ///     'FieldName_8'=>array('header'=>'Name_H', 'type'=>'link',       'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field_key'=>'field_name_0', 'field_key_1'=>'field_name_1', 'field_data'=>'field_name_2', 'rel'=>'', 'title'=>'', 'target'=>'_self', 'href'=>'http://mydomain.com?act={0}&act={1}&code=ABC'),
    ///     'FieldName_9'=>array('header'=>'Name_I', 'type'=>'linkbutton', 'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field_key'=>'field_name_0', 'field_key_1'=>'field_name_1', 'field_data'=>'field_name_2', 'href'=>'{0}'),
    ///     'FieldName_10'=>array('header'=>'Name_G', 'type'=>'money',     'align'=>'right','width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'sign'=>'$', 'sign_place'=>'before|after', 'decimal_places'=>'2', 'dec_separator'=>'.', 'thousands_separator'=>','),
    ///     'FieldName_11'=>array('header'=>'Name_K', 'type'=>'password',  'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'hide'=>'false'),
    ///     'FieldName_12'=>array('header'=>'Name_L', 'type'=>'percent',   'align'=>'right','width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'decimal_places'=>'2', 'dec_separator'=>'.'),
    ///     'FieldName_13'=>array('header'=>'Name_M', 'type'=>'barchart',  'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field'=>'', 'value_sign'=>'', 'minimum_color'=>'', 'minimum_value'=>'', 'middle_color'=>'', 'middle_value'=>'', 'maximum_color'=>'', 'maximum_value'=>'100', 'display_type'=>'vertical|horizontal'),
    ///     'FieldName_14'=>array('header'=>'Name_N', 'type'=>'enum',      'align'=>'left', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'summarize'=>'false', 'summarize_sign'=>'', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'source'=>$fill_from_array, 'multiple'=>'false'),
    ///     'FieldName_15'=>array('header'=>'Name_O', 'type'=>'color',     'align'=>'center', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'text_length'=>'-1', 'tooltip'=>'false', 'tooltip_type'=>'floating|simple', 'case'=>'normal|upper|lower|camel', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'view_type'=>'text|image'),
    ///     'FieldName_16'=>array('header'=>'Name_P', 'type'=>'checkbox',  'align'=>'center', 'width'=>'X%|Xpx', 'wrap'=>'wrap|nowrap', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>'', 'true_value'=>1, 'false_value'=>0),
    ///     'FieldName_17'=>array('header'=>'Name_Q', 'type'=>'object',    'align'=>'center', 'width'=>'X%|Xpx', 'height'=>'X%|Xpx', 'sort_type'=>'string|numeric', 'sort_by'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_18'=>array('header'=>'Name_R', 'type'=>'blob'),
    /// );
    /// $dgrid->SetColumnsInViewMode($vm_columns);
    ##  *** set auto-generated columns in view mode
    //  $auto_column_in_view_mode = false;
    //  $dgrid->SetAutoColumnsInViewMode($auto_column_in_view_mode);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 7. Add/Edit/Details Mode Settings:                                        |
    ## +---------------------------------------------------------------------------+
    ##  *** set add/edit mode table properties
    /// $em_table_properties = array('width'=>'70%');
    /// $dgrid->SetEditModeTableProperties($em_table_properties);
    ##  *** set details mode table properties
    /// $dm_table_properties = array('width'=>'70%');
    /// $dgrid->SetDetailsModeTableProperties($dm_table_properties);
    ##  ***  define settings for add/edit/details modes
    //  $table_name  = 'table_name';
    //  $primary_key = 'primary_key';
    ##  for ex.: 'table_name.field = '.$_REQUEST['abc_rid'];
    //  $condition   = '';
    //  $dgrid->SetTableEdit($table_name, $primary_key, $condition);
    ##  *** set columns in edit mode   
    ##  *** first letter:  r - required, s - simple (not required)
    ##  *** second letter: t - text(including datetime), n - numeric, a - alphabetic, e - email, f - float, 
    ##                     y - any(generally used for foreign languages), l - login name, z - zipcode,
    ##                     p - password, i - integer, v - verified, c - checked (for checkboxes), u - URL
    ##                     s - SSN number, m - telephone, b - alphanumeric, r - checked (for radiobuttons)
    ##                     x - template  (for example - 'req_type'='rx', 'template'=>'(ddd)-ddd-dd-dd', where d - digit, c - character)     
    ##  *** third letter (optional): 
    ##          for numbers: s - signed, u - unsigned, p - positive, n - negative
    ##          for strings: u - upper,  l - lower,    n - normal,   y - any
    ##          for telephone: m - mobile, f - fixed (stationary), i - international, y - any
    ##  *** Ex.: 'on_js_event'=>'onclick='alert(\'Yes!!!\');''
    ##  *** Ex.: type = textbox|textarea|label|date|datedmy|datemdy|datetime|datetimedmy|datetimemdy|time|image|password|enum|print|checkbox|blob|hidden|validator
    ##  *** Format for date: yyyy-mm-dd, datedmy: dd-mm-yyyy, datemdy: mm-dd-yyyy, time: hh:mm:ss etc. 
    ##  *** make sure your WYSIWYG directory has 755 access permissions
    ##  *** make sure uploading directories for files/images have 755 access permissions
    ##  *** to set up uploading directory for textarea, open modules\wysiwyg\addons\imagelibrary\config.inc.php and change $imagebasedir = 'images';
    ##  *** if you allows user upload files via WYSIWYG - make sure the area this script is already password protected!!!
    /// $fill_from_array = array('0'=>'No', '1'=>'Yes', '2'=>'Don\'t know', '3'=>'My be'); /* as 'value'=>'option' */
    /// $em_columns = array(
    ///     'FieldName_1'  =>array('header'=>'Name_A', 'type'=>'textbox',    'req_type'=>'rt', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_2'  =>array('header'=>'Name_B', 'type'=>'textarea',   'req_type'=>'rt', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'edit_type'=>'simple|wysiwyg', 'resizable'=>'false', 'upload_images'=>'false', 'rows'=>'7', 'cols'=>'50'),
    ///     'FieldName_3'  =>array('header'=>'Name_C', 'type'=>'label',      'title'=>'', 'default'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_4'  =>array('header'=>'Name_D', 'type'=>'date',       'req_type'=>'rt', 'width'=>'187px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'calendar_type'=>'popup|floating|dropdownlist'),
    ///     'FieldName_5'  =>array('header'=>'Name_E', 'type'=>'datetime',   'req_type'=>'st', 'width'=>'187px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'calendar_type'=>'popup|floating|dropdownlist', 'show_seconds'=>'true'),
    ///     'FieldName_6'  =>array('header'=>'Name_F', 'type'=>'time',       'req_type'=>'st', 'width'=>'90px',  'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'calendar_type'=>'popup|dropdownlist', 'show_seconds'=>'true'),
    ///     'FieldName_7'  =>array('header'=>'Name_G', 'type'=>'image',      'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'target_path'=>'uploads/', 'allow_image_updating'=>'false', 'max_file_size'=>'100000|100K|10M|1G', 'image_width'=>'120px', 'image_height'=>'90px', 'resize_dir'=>'down|up|both', 'resize_image'=>'false', 'resize_width'=>'', 'resize_height'=>'', 'magnify'=>'false', 'magnify_type'=>'popup|magnifier|lightbox', 'magnify_power'=>'2', 'file_name'=>'', 'host'=>'local|remote', 'allow_downloading'=>'false', 'allowed_extensions'=>''),
    ///     'FieldName_8'  =>array('header'=>'Name_H', 'type'=>'password',   'req_type'=>'rp', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'hide'=>'false', 'generate'=>'true', 'cryptography'=>'false', 'cryptography_type'=>'aes|md5', 'aes_password'=>'aes_password'),
    ///     'FieldName_9'  =>array('header'=>'Name_I', 'type'=>'money',      'req_type'=>'rn', 'width'=>'80px',  'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'sign'=>'$', 'sign_place'=>'before|after', 'decimal_places'=>'2', 'dec_separator'=>'.', 'thousands_separator'=>','),
    ///     'FieldName_10' =>array('header'=>'Name_J', 'type'=>'enum',       'req_type'=>'st', 'width'=>'',      'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'source'=>'self'|$fill_from_array, 'view_type'=>'dropdownlist(default)|radiobutton|checkbox', 'radiobuttons_alignment'=>'horizontal|vertical', 'multiple'=>'false', 'multiple_size'=>'4'),
    ///     'FieldName_11' =>array('header'=>'Name_K', 'type'=>'print',      'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', ''unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_12' =>array('header'=>'Name_L', 'type'=>'checkbox',   'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'true_value'=>1, 'false_value'=>0),
    ///     'FieldName_13' =>array('header'=>'Name_M', 'type'=>'file',       'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'target_path'=>'uploads/', 'max_file_size'=>'100000|100K|10M|1G', 'file_name'=>'', 'host'=>'local|remote', 'allow_downloading'=>'false', 'allowed_extensions'=>''),
    ///     'FieldName_14_a' =>array('header'=>'Name_N (for add/edit mode)', 'type'=>'link',   'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>''),
    ///     'FieldName_14_b' =>array('header'=>'Name_N (for details mode)',  'type'=>'link',   'req_type'=>'st', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'field_key'=>'', 'field_key_1'=>'', 'field_data'=>'', 'rel'=>'', 'title'=>'', 'target'=>'_self', 'href'=>'{0}'),
    ///     'FieldName_15' =>array('header'=>'Name_O', 'type'=>'foreign_key','req_type'=>'ri', 'width'=>'', 'title'=>'', 'readonly'=>'false', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true'),
    ///     'FieldName_16' =>array('header'=>'Name_P', 'type'=>'blob',       'req_type'=>'st', 'readonly'=>'false'),
    ///     'FieldName_17' =>array('header'=>'Name_Q', 'type'=>'hidden',     'req_type'=>'st', 'default'=>'', 'value'=>'', 'unique'=>'false', 'visible'=>'true'),
    ///     'FieldName_18' =>array('header'=>'Name_R', 'type'=>'percent',    'req_type'=>'rt', 'width'=>'80px',  'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'decimal_places'=>'2', 'dec_separator'=>'.'),
    ///     'FieldName_19' =>array('header'=>'Name_S', 'type'=>'color',      'req_type'=>'rt', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'unique'=>'false', 'unique_condition'=>'', 'visible'=>'true', 'on_js_event'=>'', 'view_type'=>'dropdownlist|picker', 'save_format'=>'hexcodes'),
    ///     'validator'    =>array('header'=>'Name_T', 'type'=>'validator',  'req_type'=>'rv', 'width'=>'210px', 'title'=>'', 'readonly'=>'false', 'maxlength'=>'-1', 'default'=>'', 'visible'=>'true', 'on_js_event'=>'', 'for_field'=>'', 'validation_type'=>'password|email'),
    ///     'delimiter_1|2|3...'    =>array('inner_html'=>'<br />'),
    /// );
    /// $dgrid->SetColumnsInEditMode($em_columns);
    ##  *** set auto-generated columns in edit mode
    //  $auto_column_in_edit_mode = false;
    //  $dgrid->SetAutoColumnsInEditMode($auto_column_in_edit_mode);
    ##
    ##
    ## +---------------------------------------------------------------------------+
    ## | 8. Foreign Keys Settings:                                                 |
    ## +---------------------------------------------------------------------------+
    ##  *** set foreign keys for add/edit/details modes (if there are linked tables)
    ##  *** Ex.: 'field_name'=>'CONCAT(field1,' ',field2) as field3' 
    ##  *** Ex.: 'condition'=>'TableName_1.FieldName > "a" AND TableName_1.FieldName < "c"'
    ##  *** Ex.: 'on_js_event'=>'onclick="alert(\'Yes!!!\');"'
    /// $foreign_keys = array(
    ///     'ForeignKey_1'=>array('table'=>'TableName_1', 'field_key'=>'FieldKey_1', 'field_name'=>'FieldName_1', 'view_type'=>'dropdownlist(default)|radiobutton|textbox|label', 'radiobuttons_alignment'=>'horizontal|vertical', 'condition'=>'', 'order_by_field'=>'', 'order_type'=>'ASC|DESC', 'show_count'=>'', 'on_js_event'=>''),
    ///     'ForeignKey_2'=>array('table'=>'TableName_2', 'field_key'=>'FieldKey_2', 'field_name'=>'FieldName_2', 'view_type'=>'dropdownlist(default)|radiobutton|textbox|label', 'radiobuttons_alignment'=>'horizontal|vertical', 'condition'=>'', 'order_by_field'=>'', 'order_type'=>'ASC|DESC', 'show_count'=>'', 'on_js_event'=>'')
    /// ); 
    /// $dgrid->SetForeignKeysEdit($foreign_keys);
    ##
    ################################################################################   
    
    ################################################################################   
    ##
    ## Non-documented:
    ## -----------------------------------------------------------------------------
    ## PROPERTY  : firstFieldFocusAllowed      = true|false;
    ##  --//--   : documentEnterKeyAllowed     = true|false;
    ##  --//--   : hideGridBeforeSearch        = true|false;  /* put it before Bind() method */
    ##  --//--   : modeAfterUpdate             = ''|'edit'|'details';
    ##  --//--   : noDataFoundText             = ''; displays a text on empty dataset
    ##  --//--   : isDemo                      = ''; blockd all operations with DataGrid
    ##  --//--   : navigationBar               = ''; allows to display additional links etc. at the top of DataGrid
    ##  --//--   : summarizeFunction           = 'SUM|AVG|MAX|MIN'; defines global summarize function: SUM or AVG
    ##  --//--   : controlsDisplayingType      = ''; defines displaying alignment of controls ('' or 'grouped')
    ##  --//--   : allowRealEscape             = true|false;  defines using of escaping special characters in a string
    ##  --//--   : weekStartingDay             = 1|2...7;  defines week first day (0 - sunday, default) for floating calendar
    ##  --//--   : initFilteringState          = ''; defines initial state of filtering block - 'closed' or 'opened'
    ##  --//--   : dtSeparator                 = '-'; defines a separator for datetime fields (private, allowed values: -,/,- or :)
    ##  --//--   : maximumAllowedRecords       = '100'; defines a maximum number of allowed records
    ##  --//--   : uploadType                  = 'by_one'; // all|by_one (default) - defines whether to upload files before form submission ('by_one') or with submission ('all')
    ## 
    ## METHOD    : ExecuteSQL() 
    ##            use it after DataSource() method only (using this method before bind() requires redefinition of DataSource())
    ##    		  $dSet = $dgrid->ExecuteSQL('SELECT * FROM tblPresidents WHERE tblPresidents.CountryID = '.$_GET['f_rid']);
    ##    		  while($row = $dSet->fetchRow()){
    ##        	    for($c = 0; ($c < $dSet->numCols()); $c++){ echo $row[$c].' '; }
    ##        	    echo '<br />';
    ##    		  }
    ##  --//--   : SelectSqlItem()
    ##             use it after DataSource() method only (using this method before bind() requires redefinition of DataSource())
    ##             $presidents = $dgrid->SelectSqlItem('SELECT COUNT(tblPresidents.presidentID) FROM tblPresidents WHERE tblPresidents.CountryID = '.$_GET['f_rid']);
    ##  --//--   : AllowHighlighting(true|false);
    ##  --//--   : SetJsErrorsDisplayStyle('all'|'each');
    ##  --//--   : GetNextId();
    ##  --//--   : GetCurrentId();
    ##  --//--   : SetHeadersInColumnarLayout('Field Name', 'Field Value');
    ##  --//--   : SetDgMessages(array('add_success'=>'', 'add_error'=>'', 'update_success'=>'', 'update_error'=>'', 'delete_success'=>'', 'delete_error'=>''));
    ##  --//--   : IsOperationCompleted();
    ##  --//--   : IsDataFound();
    ##  --//--   : IgnoreBaseTag();
    ##  --//--   : DisplayLoadingImage();
    ##  --//--   : SetSummarizeNumberFormat('2', '.', ',', '&euro;');
    ##  --//--   : SetFilteringTabularLayoutColumns('2');
    ##  --//--   : SetDefaultTimezone('America/Los_Angeles'); // (list of supported Timezones - http://us3.php.net/manual/en/timezones.php)
    ##  --//--   : SetCacheDirectory();
    ##  --//--   : ForceDatabaseEncoding(true);
    ##  --//--   : AllowTopAnchor(true);
    ##  --//--   : UseAbsolutePath(true|false);
    ##  --//--   : SetAutocommit(true|false); - 'autocommit' option for IBM db driver (must be placed after before DataSource())
    ##  --//--   : SetDbSchema('schema_name'); - database 'schema' option for IBM db driver (must be placed after before DataSource())
    ##             
    ## FIELD ATTRIBUTES
    ##  --//--   : 'header_tooltip'   => 'false|true' - displays header tooltip in View/Add/Edit/Details modes
    ##  --//--   : 'header_tooltip_type' => 'simple|floating' - displays header tooltip in View/Add/Edit/Details modes
    ##  --//--   : 'header_align'     => 'left|center|right' attribute for field headers in all modes
    ##  --//--   : 'sortable'         => 'false|true' in View mode
    ##  --//--   : 'type'             => 'data' in view mode - displays field data without HTML formatting
    ##  --//--   : 'autocomplete'     => 'on|off' attribute for textboxes in Add/Edit modes (default - 'on')
    ##  --//--   : 'align'            => 'left|center|right' attribute for fields in Add/Edit modes
    ##  --//--   : 'pre_addition'     => '' and 'post_addition'=>'' attributes in View/Add/Edit/Details modes
    ##  --//--   : 'on_item_created'  => 'function_name' attributes in View/Add/Edit/Details modes for customized work with field value.
    ##                                    This function must be defined with 1 parameter, that will get fild's data.
    ##                                    Ex.: function function_name($field_value){ ... return $new_field_value;}
    ##  --//--   : 'summarize_function' => 'SUM|AVG|MAX|MIN' defines aggregate function for certain field
    ##  --//--   : ('req_type'='rx', 'template'=>'(ddd)-ddd-dd-dd', where d - digit, c - character) - template(mask) check type for fields in Add/Edit Mode
    ##  --//--   : 'show_on_print'  => 'true|false' (default - 'true') defines whether to show field on printing  
    ##  --//--   : 'show_on_export' => 'true|false' (default - 'true') defines whether to show field on exporting
    ##  --//--   : 'movable'        => 'true|false' adds to column up/down arrows and allows to change row's order
    ##  --//--   : 'table_alias'    => '' defines table alias for filtering fields to prevent name overlapping
    ##  --//--   : 'default_null'   => 'true' defines whether to allow using of NULLs for empty fields as default value
    ##  --//--   : 'save_as'        => 'standard|blob' (default - standard) defines a type of file storage - standard (link) or blob (for 'file' types)
    ##                                  additional parameters: 'blob_filetype'=>'', 'blob_filename'=>'', 'blob_filesize'=>'' - specifies additionasl fields (must be defined in database table)
    ##
    ## FEATURE   : onSubmitMyCheck
    ##      	   <script type='text/javascript'>
    ##                function unique_prefix_onSubmitMyCheck(){
    ##                  if(document.getElementById('ryyfirst_name').value =='x'){
    ##                     alert('Please check ...  X is invalid!!!');
    ##                     return false;
    ##                  }  
    ##                  return true;
    ##      	      }	
    ##      	   </script>
    ##  --//--   : 'on_js_event'=>'onchange="_dgFormAction(\'\', \'\', \''.$dgrid->uniquePrefix.'\', \''.$dgrid->HTTP_URL.'\', \''.$_SERVER['QUERY_STRING'].'\', \'post\', \''.$_REQUEST[$dgrid->uniquePrefix.'mode'].'\')"' - Allows reloading form in Add/Edit mode
    ##  --//--   : Bind(true|false) - draw DataGrid on the screen on not
    ##
    ################################################################################
    
    ################################################################################
    ##
    ## Tricks:
    ## -----------------------------------------------------------------------------
    ## 1. Set default value, that disappears on focus:
    ##      'default'=>'http://www.website.com', 'on_js_event'=>'onBlur="if(this.value == \'\') this.value=\'http://www.website.com\'; this.style.color=\'#f68d6f\';" onClick="if(this.value==\'http://www.website.com\') this.value=\'\'; this.style.color=\'#000000\';"',
    ##
    ## 2. Set unique value for uploaded image:
    ##     a) 'file_name'=>'img_'.((isset($_GET[$unique_prefix.'mode']) && ($_GET[$unique_prefix.'mode'] == 'add')) ? $dgrid->GetNextId() : $dgrid->GetCurrentId())
    ##     b) 'file_name'=>'img_'.((isset($_GET[$unique_prefix.'mode']) && ($_GET[$unique_prefix.'mode'] == 'add')) ? $dgrid->GetRandomString('10') : $dgrid->GetRandomString('10'))
    ##
    ## 3. Make auto-refresh for filtering fields:
    ##      'on_js_event'=>'onchange="document.getElementById(\'...prefix..._ff_onSUBMIT_FILTER\').click();"'
    ##
    ## 4. Make a field text colored according to condition (in SQL statement):
    ##      if(product='flooring', CONCAT('<SPAN style=\"background-color:yellow\">',product,'</SPAN>'),product) as ProductColored,
    ##
    ## 5. Change the field's data on fly (for 'on_item_created'=>'setColor' field's attribute):
    ##      function setColor($field_value){
    ##        if(strlen($field_value) > 5){
    ##            return '<font color="red">'.$field_value.'</font>';
    ##        }else{
    ##            return '<font color="blue">'.$field_value.'</font>';        
    ##        }
    ##      }
    ##
    ## 6. Change the field's type on fly (for 'on_item_created' field's attribute):
    ##    To do this, you need to change this line of code $field_value = $fp_on_item_created($field_value);
    ##    On this one: $field_value = $fp_on_item_created($field_value, &$fp_type);
    ##      function setColor($field_value, $fp_type){
    ##        if(strlen($field_value) > 5){
    ##            return '<font color="red">'.$field_value.'</font>';
    ##        }else{
    ##            $fp_type = 'linktoview';
    ##            return '<font color="blue'>'.$field_value.'</font>';        
    ##        }
    ##      }
    ##
    ## 8. Customized filtering: write filter field with empty table name and field: (...'table'=>'', 'field'=>'xxx',...)
    ##    Then use $my_field = isset($_GET['prefix__ff__xxx']) ? $_GET['prefix__ff__xxx'] : '';
    ##    Use $my_field in SQL SELECT for your own filtering
    ##
    ## 9. Passing parameters to Javascript function on 'on_js_event'=>'' for 'link' and 'label' fields 
    ##    'field_key'=>'', 'field_key_1'=>'', 'on_js_event'=>'my_finction({0},{1})' 
    ##
    ################################################################################

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Site :: Home</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
        ## put call of this method between HTML <HEAD> tags (recommended)
        // $dgrid->WriteCssClass();
    ?>
</head>

<body>
<?php
    ################################################################################   
    ## +---------------------------------------------------------------------------+
    ## | 9. Bind the DataGrid:                                                     | 
    ## +---------------------------------------------------------------------------+
    ##  *** bind the DataGrid and draw it on the screen
    ##  *** you may use $dgrid->Bind(false) and then $dgrid->Show() to separate
    ##  *** binding and displaying id datagrid
    //  $dgrid->Bind();
    //  ob_end_flush();
    ################################################################################   
?>
</body>
</html>