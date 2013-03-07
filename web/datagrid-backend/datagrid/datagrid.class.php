<?php
################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP DataGrid Pro (AJAX enabled) version 7.4.9                            #
##  Developed by:  ApPHP <info@apphp.com>                                      #
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-datagrid/                          #
##  Copyright:     ApPHP DataGrid (c) 2006-2012. All rights reserved.          #
##  Last changed:  07.03.2012 01:15                                            #
##                                                                             #
##  Additional modules (embedded):                                             #
##  -- openWYSIWYG v1.0.1 (WYSIWYG editor)              http://openWebWare.com #
##  -- PEAR::DB v1.7.14 (PHP Ext.&Application Repository)  http://pear.php.net #
##  -- JS AFV v2.0.1 (JS Auto From Validator)                 http://apphp.com #
##  -- overLIB v4.21 (JS library)           http://www.bosrup.com/web/overlib/ #
##  -- FPDF v1.53 (PDF files generator)                    http://www.fpdf.org #
##  -- JsCalendar v1.0 (DHTML/JavaScript Calendar)      http://www.dynarch.com #
##  -- AutoSuggest v2.1.3 (AJAX autocomplete)  http://www.brandspankingnew.net #
##  -- LyteBox v3.22                              http://www.dolem.com/lytebox #
##  -- jQuery v1.3.2 (JavaScript Library)                    http://jquery.com #
##  -- Scrollable HTML table                        http://www.webtoolkit.info #
##  -- Scrollable HTML table v1.1 (200WAGNER DOSANJOS)        wanjos@yahoo.com #
##  -- JSColor v1.3.9 (JavaScript Color Picker)             http://jscolor.com #
##  -- SqlParser v0.0.4 (SQL tokenizer/parser)               by Justin Carlson #
##                                                                             #
##  Additional modules (required):                                             #
##  -- PHP Data Objects (PDO) extension                    http://www.php.net/ #
##                                                                             #
################################################################################

// PUBLIC:              		    PROTECTED:                  PRIVATE:                    STATIC
// --------             		    -----------                 -----------                 --------
// __construct              	    GetHttpGetVars              SetFieldsFilteringInBind    Version (public)        
// __destruct                       SetUniquePrefix             IsDatePrepare 
// __call                           DefineCssClass              DrawColorPicker
// SetEncoding                      GetDataSet                  PrepareTimeStamp
// DataSource(old/new)              GetOrderByList              IsTimeStamp
// SetInterfaceLang                 RemoveBadChars              IsText
// SetDirection                     SecurityCheck               IsDate  
// SetLayouts                       SetEncodingOnDatabase       IsPasswordCrypted
// SetTemplates                     ShowCaption                 IsPassword
// SetModes                         TblOpen                     IsMoney
// AllowScrollingSettings           TblHeadOpen                 IsReadonly
// SetScrollingSettings             TblHeadClose                IsValidator 
// AllowMultirowOperations          TbodyOpen                   IsForeignKey 
// SetMultirowOperations            TbodyClose                  IsEnum 
// SetCssClass                      TblClose                    IsFieldRequired 
// SetHttpGetVars                   HideDataGrid                IsExceptedField 
// SetAnotherDatagrids              GetHttpGetVars              GetFieldTitle 
// SetCaption                       RowOpen                     GetFieldProperty 
// SetPostBackMethod                RowClose                    GetFieldPropertyBool
// AllowPrinting                    MainColOpen                 GetFieldName 
// AllowExporting(old/new)          MainColClose                GetFieldRequiredType
// AllowExportingTypes              ColOpen                     GetHeaderName
// AllowSorting                     ColClose                    GetFieldAlign
// AllowPaging                      EmptyRow                    GetHeaderAlign
// SetPagingSettings                ScriptOpen                  DrawControlButtons
// AllowFiltering                   ScriptClose                 DrawModeButton 
// AllowDefaultFiltering            DrawControlPanel            SetCommonJavaScriptAjax
// AllowTopAnchor                   ExportTo                    SetCommonJavaScript
// SetFilteringTabularLayoutColumns ExportToExcel               SetCommonJavaScriptEnd
// SetFieldsFiltering               ExportToPdf                 SetEditFieldsFormScript 
// SetViewModeTableProperties       ExportToXml                 MyDate 
// SetColumnsInViewMode             DrawFiltering               GetFormattedMicrotime
// SetAutoColumnsInViewMode         PrepareFiltering            CheckExistingFields  
// SetEditModeTableProperties       DrawCustomized              GetPort
// SetDetailsModeTableProperties    DrawTabular                 GetProtocol
// SetTableEdit                     DrawColumnar                GetServerName 
// SetColumnsInEditMode             DrawMultiRowBar             SubStrOccurence
// SetAutoColumnsInEditMode         DrawSummarizeRow            CheckCacheFiles 
// SetForeignKeysEdit               SortColumns                 StartCaching
// Show                             AddErrors                   FinishCaching
// Bind                             AddWarning                  PrepareLinks
// WriteCssClass                    DisplaySqlStatements        PrepareOnJSEventFields 
// IsDataFound                      DisplayWarnings             SetFilteringState
// GetRandomString                  CheckF5CaseValidation       UploadFileImage
// SetDefaultTimezone               GetEnumValues               CheckIsError
// SetCachingParameters             CanViewField                GetFieldTypeInfo 
// DeleteCache                      GetRecordID                 ShowColumns
// SetCacheDirectory                GetFieldValueByType         PrepareTextLength
//                                  SetMoneyFormat              SetBackQuotes
//                                  GetMoneyFormat              
//                                  GetForeignKeyInput          dgGetDbDriverType 
//                                  DisplayErrors               dgGetAffectedRows 
// non-documented                   DisplayDataSent             dgFetchRow    
// --------------                   DisplayMessages
// SetSummarizeNumberFormat         SaveHttpGetVars
// DisplayLoadingImage              CombineUrl
// IsOperationCompleted             SetSqlLimit
// IgnoreBaseTag                    SetSqlLimitByDbType
// ExecuteSQL                       SetRealEscapeStringByDbType
// SelectSqlItem                    SetSqlByDbType
// AllowHighlighting                GetLcaseFooByDbType
// SetJsErrorsDisplayStyle          PagingFirstPart
// GetCurrentId                     PagingSecondPart
// GetNextId                        SetTotalNumberRows
// SetDgMessages                    NumberRows
// ForceDatabaseEncoding            NumberCols
// SetHeadersInColumnarLayout       NoDataFound 
// SetAutocommit                    CloneRow
// SetDbSchema                      MoveRow
//                                  DeleteRow
//                                  UpdateRow
//                                  AddRow
//                                  CheckMaximumAllowedRecords
//                                  CheckSecurityCaseValidation
//                                  GetFieldOffset
//                                  GetFieldInfo
//                                  SetUrlString
//                                  SetUrlStringFiltering
//                                  SetUrlStringSorting
//                                  SetUrlStringPaging
//                                  AddCheckBoxesValues 
//                                  GetVariable
//                                  DrawRadioButtons
//                                  DrawCheckBoxes
//                                  DrawDropDownList
//                                  ModeAllowed
//                                  AddArrayParams
//                                  ChangeParameterInURL
//                                  RemoveParameterFromURL
//                                  PrepareTooltip
//                                  ReplaceWithAlias
//                                  PreparePasswordDecryption
//                                  PrepareFileFields
//                                  DeleteFileFields
//                                  DrawControlButtonsJS
//                                  GetDateFormatForFilteringCal
//                                  GetDateFormatForFloatingCal
//                                  DrawCalendarButton
//                                  ExportDownloadFile
//                                  HttpGetFile
//                                  ResizeImage
//                                  PrintHiddenFieldsFromUrl
//                                  IsFileExists
//                                   

if(!defined('DATAGRID_DIR')) define('DATAGRID_DIR', ''); 
require_once(DATAGRID_DIR . 'classes/helper.class.php');
require_once(DATAGRID_DIR . 'classes/sqlparser.class.php');

class DataGrid
{
    //==========================================================================
    // Data Members
    //==========================================================================
    static private $dgVersion = '7.4.9';
    
    // unique prefixes ---------------------------------------------------------
    public $uniquePrefix;
    public $uniqueRandomPrefix;
    
    // security ----------------------------------------------------------------
    public $safeMode;
    private $securityLevel;

    // directory ---------------------------------------------------------------
    public $directory;

    // language ----------------------------------------------------------------
    public $langName;
    public $lang;

    // caption -----------------------------------------------------------------
    public $caption;

    // rows and columns data members -------------------------------------------
    public $rows;
    public $rowLower;
    public $rowUpper;
    public $columns;            
    public $colLower;
    public $colUpper;

    // http get vars -----------------------------------------------------------    
    public $http;
    public $port;
    public $serverName;
    public $HTTP_URL;
    public $HTTP_HOST;
    private $QUERY_STRING;
    public $httpGetVars;
    public $anotherDatagrids;
    private $ignoreBaseTag;
    private $include_path;

    // data source -------------------------------------------------------------
    public $dbType;
    private $dbDriver;
    public $dbHandler;
    private $dbAutoCommit;
    private $dbSchema;
    public $sql;
    public $sqlView;
    public $sqlGroupBy;
    private $dataSet;
    private $forceEncodingOnDatabase;
    public $sqlSort;
    private $addBackQuotes;
    
    // signs -------------------------------------------------------------------
    public $amp;
    private $nbsp;
    private $nl;
    
    // encoding & direction ----------------------------------------------------
    public $encoding;
    public $collation;
    public $direction;

    // layout style ------------------------------------------------------------
    public $layouts;  
    public $layoutType;

    // templates ---------------------------------------------------------------
    public $templates;
    
    // paging variables --------------------------------------------------------
    public $pagesTotal;
    public $pageCurrent;
    public $defaultPageSize;
    public $dropdownPaging;
    public $reqPageSize;
    public $pagingAllowed;
    public $rowsNumeration;
    public $numerationSign;           
    public $arrLowerPaging;
    public $arrUpperPaging;
    public $arrPages;
    public $firstArrow;
    public $previousArrow;
    public $nextArrow;
    public $lastArrow;    
    public $limitStart;
    public $limitSize;
    public $rowsTotal;

    // sorting variables -------------------------------------------------------
    public $sortField;
    public $sortType;
    protected $sortFieldBy;
    protected $sortFieldType;
    public $defaultSortField;    
    public $defaultSortType;    
    public $defaultSortFieldHelp;
    public $defaultSortTypeHelp;    
    private $defaultSortClause;
    public $sortingAllowed;

    // filtering variables -----------------------------------------------------
    public $filteringAllowed;
    public $showSearchType;
    public $arrFilterFields;
    public $hideDisplay;
    public $initFilteringState;
    private $tabularColumns;
    private $defaultFilteringAllowed;
	private $filteringOutput;
    private $onSubmitFilter;

    // columns style parameters ------------------------------------------------            
    public $wrap;

    // css style ---------------------------------------------------------------            
    public $isRowHighlightingAllowed;
    public $cssClass;
    public $rowColor;
    protected $isCssClassWritten;

    // table style parameters --------------------------------------------------                        
    public $tblAlign;
    public $tblWidth;
    
    // datagrid modes ----------------------------------------------------------                        
    public $modes;
    public $modeAfterUpdate;
    public $mode;
    public $rid;
    public $rids;
    public $tblName;
    public $primaryKey;
    public $condition;
    public $arrForeignKeys;    
    public $columnsViewMode;
    public $columnsEditMode;
    public $sortedColumns;
    protected $sortedColumnsSize;
    private $accessKeys;

    // printing & exporting ----------------------------------------------------                        
    public $printingAllowed;
    public $exportingAllowed;
    public $exportingDirectory;
    public $exportAll;
    protected $arrExportingTypes;
    private $exportMethod;
    public $navigationBar;
    protected $isPrinting;    

    // debug mode --------------------------------------------------------------                        
    public $debug;
    public $startTime;
    public $endTime;
    public $isDemo;

    // message -----------------------------------------------------------------                        
    public $actMsg;
    public $messaging;
    public $isError;
    public $errors;
    public $isWarning;
    private $warningType;
    public $warnings;
    public $sqlStatements;
    public $arrDgMessages;
    public $noDataFoundText;
    private $isDataFound;
    private $isOperationCompleted;

    // browser & system types --------------------------------------------------
    public $platform;
    public $browserName;
    public $browserVersion;
    
    // scrolling ---------------------------------------------------------------
    public $scrollingOption;
    public $scrollingHeight;

    // header names ------------------------------------------------------------
    public $fieldHeader;
    public $fieldHeaderValue;

    // hide --------------------------------------------------------------------
    public $hideGridBeforeSearch;

    // summarize ---------------------------------------------------------------
    public $arrSummarizeColumns;
    public $summarizeNumberFormat;
    public $summarizeFunction;
    
    // multirow ----------------------------------------------------------------
    public $isMultirowAllowed;
    public $multiRows;
    public $arrMultirowOperations;

    // javascript errors display style -----------------------------------------
    protected $jsValidationErrors;
    protected $jsCode;

    // existing fields ---------------------------------------------------------
    public $existingFields;
    
    // loading image -----------------------------------------------------------
    private $isLoadingImageEnabled;

    // type of displaying control buttons --------------------------------------
    public $controlsDisplayingType;
    
    // using of escaping special characters in a string ------------------------
    public $allowRealEscape;
    
    // specifies which Postback method will be used to submit the forms -------- 
    protected $methodPostBack; 
    
    // calendar first week day 0: sunday (default), 1: monday... --------------- 
    public $weekStartingDay;
    
    // timezone ---------------------------------------------------------------- 
    public $timezone;
    private $dtSeparator;
    
    // cache ------------------------------------------------------------------- 
    private $isCachingAllowed;
    private $cacheDir;
    private $cacheLifetime;
    private $maxCacheFiles;
    
    // active keys and fields -------------------------------------------------- 
    public $firstFieldFocusAllowed;
    public $documentEnterKeyAllowed;
    public $maximumAllowedRecords;
    private $isAnchorAllowed;
    private $uploadType;
    
    private $urlString;
    private $bindPassed;    

    private $convertOutput;
    private $convertFrom;
    private $convertTo;
	
	// tom 2012-07-30
	// exportexcel ---------------------------------------------------------------
    public $arrExportToExcel;

    //==========================================================================
    // PUBLIC MEMBER FUNCTIONS 
    //==========================================================================
    //--------------------------------------------------------------------------
    // Default class constructor 
    //--------------------------------------------------------------------------
    function __construct($debug_mode = false, $messaging = true, $unique_prefix = ''){
    
        $this->methodPostBack = 'post';

        // set debug/demo state  -----------------------------------------------
        $this->debug = (($debug_mode == true) || ($debug_mode == 'true')) ? true : false ;
        $this->isDemo = false;

        // start calculating running time of a script
        $this->startTime = 0;
        $this->endTime = 0;
        if($this->debug){
            $this->startTime = $this->GetFormattedMicrotime();
        }        

        // [#0042] clean slashes from the input if there was page reloading
        if(get_magic_quotes_gpc()){
            if(!function_exists('stripslashes_gpc')){
                function stripslashes_gpc(&$value) {
                    $value = stripslashes($value);
                }
            }
            array_walk_recursive($_GET, 'stripslashes_gpc');
            array_walk_recursive($_POST, 'stripslashes_gpc');
            array_walk_recursive($_COOKIE, 'stripslashes_gpc');
            array_walk_recursive($_REQUEST, 'stripslashes_gpc');
        }

        // message -------------------------------------------------------------
        $this->actMsg = '';

        if($this->debug) error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        $this->messaging = (($messaging == true) || ($messaging == 'true')) ? true : false ;        
        $this->isError = false;
        $this->errors = array();
        $this->isWarning = false;
        $this->warnings = array();
        $this->warningType = 'common';
        $this->sqlStatements = array();
        $this->arrDgMessages = array('add_success'=>'', 'add_error'=>'', 'update_success'=>'', 'update_error'=>'', 'delete_success'=>'', 'delete_error'=>'', 'clone'=>'', 'move'=>'');
        $this->isOperationCompleted = false;
        $this->isDataFound = true;
        $this->noDataFoundText = '';

        // unique prefixes -----------------------------------------------------
        $this->SetUniquePrefix($unique_prefix);
        
        // security ------------------------------------------------------------
        $this->safeMode = false;
        $this->securityLevel = 'medium'; // low|medium/high
        
        // directory -----------------------------------------------------------
        $this->directory = DATAGRID_DIR;

        // language ------------------------------------------------------------
        $this->langName = 'en';
        $this->lang = array();
        $this->lang['total'] = 'Total';
        $this->lang['wrong_parameter_error'] = 'Wrong parameter in [<b>_FIELD_</b>]: _VALUE_';

        // caption -------------------------------------------------------------        
        $this->caption = '';

        // rows and columns data members ---------------------------------------
        $this->http = $this->GetProtocol();
        $this->port = $this->GetPort();
        $this->serverName = $this->GetServerName();
        $this->HTTP_URL = str_replace('///', '//', $this->http.$this->serverName.$this->port.$_SERVER['PHP_SELF']);
        $this->HTTP_HOST = str_replace('///', '//', $this->http.$this->serverName.$this->port.dirname($_SERVER['PHP_SELF']));
        $this->ignoreBaseTag = false;
        $this->include_path = $this->directory;

        // http get vars -------------------------------------------------------        
        $this->httpGetVars = '';
        $this->anotherDatagrids = '';

        // css style  ----------------------------------------------------------        
        $this->isRowHighlightingAllowed = true;
        $this->cssClass = 'default';
        $this->rowColor = array();
        $this->isCssClassWritten = false;

        // signs ---------------------------------------------------------------
        $this->amp = ($this->methodPostBack == 'ajax') ? '&' : '&amp;';
        $this->nbsp = ''; //&nbsp;
        $this->nl = "\n";
        
        $this->rows = 0;
        $this->rowLower = 0;
        $this->rowUpper = 0;
        $this->columns = 0;            
        $this->colLower = 0;
        $this->colUpper = 0;

        // encoding & direction ------------------------------------------------
        $this->encoding = 'utf8';
        $this->collation = 'utf8_unicode_ci';
        $this->direction = 'ltr';
        
        $this->layouts['view']   = '0';
        $this->layouts['edit']   = '1';
        $this->layouts['filter'] = '1';
        $this->layouts['show']   = '1';
        $this->layoutType = 'view';
        
        // templates -----------------------------------------------------------
        $this->templates['view'] = '';
        $this->templates['edit'] = '';
        $this->templates['show'] = '';
        
        // paging variables ----------------------------------------------------
        $this->pagesTotal = 0;
        $this->pageCurrent = 0;
        $this->arrPages = array('10'=>'10', '25'=>'25', '50'=>'50', '100'=>'100', '250'=>'250', '500'=>'500', '1000'=>'1000');
        $this->firstArrow    = '|&lt;&lt;';
        $this->previousArrow = '&lt;&lt;';
        $this->nextArrow     = '&gt;&gt;';
        $this->lastArrow     = '&gt;&gt;|';
        $this->defaultPageSize = 10;
        $this->dropdownPaging = false;
        $this->reqPageSize = 10;                
        $this->pagingAllowed = true;
        $this->rowsNumeration = false;
        $this->numerationSign = 'N #';       
        $this->arrLowerPaging['results'] = false;
        $this->arrLowerPaging['results_align'] = 'left';
        $this->arrLowerPaging['pages'] = false;        
        $this->arrLowerPaging['pages_align'] = 'center';
        $this->arrLowerPaging['page_size'] = false;
        $this->arrLowerPaging['page_size_align'] = 'right';
        $this->arrUpperPaging['results'] = false;
        $this->arrUpperPaging['results_align'] = 'left';
        $this->arrUpperPaging['pages'] = false;        
        $this->arrUpperPaging['pages_align'] = 'center';
        $this->arrUpperPaging['page_size'] = false;
        $this->arrUpperPaging['page_size_align'] = 'right';
        $this->limitStart = 0;
        $this->limitSize = $this->reqPageSize;
        $this->rowsTotal = 0;
        $bottom_paging = array('results'=>true, 'results_align'=>'left', 'pages'=>true, 'pages_align'=>'center', 'page_size'=>true, 'page_size_align'=>'right');
        $this->SetPagingSettings($bottom_paging);
        
        $this->sortField = '';
        $this->sortFieldBy = '';
        $this->sortFieldType = '';
        $this->sortType = '';
        $this->defaultSortField = array();
        $this->defaultSortType = array();
        $this->defaultSortFieldHelp = '';
        $this->defaultSortTypeHelp = '';
        $this->defaultSortClause = '';
        $this->sortingAllowed = true;
        $this->sqlView = '';
        $this->sqlGroupBy = '';
        $this->dataSet = '';
        $this->dbHandler = null;
        $this->dbType = 'PEAR';
        $this->dbDriver = 'mysql';
        $this->dbAutoCommit = true;
        $this->dbSchema = '';
        $this->sql = '';
        $this->forceEncodingOnDatabase = true;
        $this->addBackQuotes = false;
        $this->sqlSort = '';
        
        $this->filteringAllowed = false;
        $this->showSearchType = true;        
        $this->arrFilterFields = array();
        $this->hideDisplay = '';
        $this->initFilteringState = 'opened';
        $this->tabularColumns = '';
        $this->defaultFilteringAllowed = false;
		$this->filteringOutput = '';
        $this->onSubmitFilter = $this->GetVariable('_ff_onSUBMIT_FILTER');

        $this->tblAlign['view'] = 'center';  $this->tblAlign['edit'] = 'center';    $this->tblAlign['details'] = 'center';
        $this->tblWidth['view'] = '90%';     $this->tblWidth['edit'] = '70%';       $this->tblWidth['details'] = '60%';
        
        // datagrid modes ------------------------------------------------------
        $this->modes['add']     = array('view'=>true, 'edit'=>false, 'type'=>'link', 'show_button'=>true, 'show_add_button'=>'inside');
        $this->modes['edit']    = array('view'=>true, 'edit'=>true,  'type'=>'link', 'show_button'=>true, 'byFieldValue'=>'');
        $this->modes['cancel']  = array('view'=>true, 'edit'=>true,  'type'=>'link', 'show_button'=>true);
        $this->modes['details'] = array('view'=>true, 'edit'=>false, 'type'=>'link', 'show_button'=>true);
        $this->modes['delete']  = array('view'=>false, 'edit'=>false,  'type'=>'image', 'show_button'=>false);            

        $this->mode = 'view';
        $this->modeAfterUpdate = '';
        $this->rid = $this->GetVariable('rid');
        $this->rids = '';
        $this->tblName ='';
        $this->primaryKey = 0;
        $this->condition = '';

        $this->arrForeignKeys = array();
        
        $this->columnsViewMode = array();
        $this->columnsEditMode = array();
        $this->sortedColumns = array();
        $this->sortedColumnsSize = 0;
        $this->accessKeys = array(); // Ex.: array('add'=>'a', 'edit'=>'e', 'details'=>'v', 'update'=>'u', 'delete'=>'d');
              
        $this->printingAllowed = true;
        $this->exportingAllowed = false;
        $this->exportingDirectory = 'tmp/export/';
        $this->exportAll = false;
        $this->arrExportingTypes = array('csv'=>true, 'xls'=>true, 'pdf'=>true, 'xml'=>true);
        $this->exportMethod = 'session';
        $this->navigationBar = '';
        $this->isPrinting = $this->GetVariable('print');
        
        // @ - to prevent problems with IIS 5.1 (some of the _SERVER variables doesn't seem to exist)
        $this->QUERY_STRING = @isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
        // check if there is Print Mode from another DG
        if(preg_match('/print=true/i', $this->QUERY_STRING)) $this->isPrinting = true;
        $this->wrap = 'wrap';

        // scrolling -----------------------------------------------------------
        $this->scrollingOption = false;
        $this->scrollingHeight = '300px';

        // header names --------------------------------------------------------
        $this->fieldHeader = '';
        $this->fieldHeaderValue = '';

        // hide ----------------------------------------------------------------
        $this->hideGridBeforeSearch = false;
        
        // summarize -----------------------------------------------------------
        $this->arrSummarizeColumns = array();
        $this->summarizeNumberFormat = array();
        $this->summarizeNumberFormat['decimal_places'] = '2';
        $this->summarizeNumberFormat['decimal_separator'] = '.';
        $this->summarizeNumberFormat['thousands_separator'] = ',';
        $this->summarizeNumberFormat['sign'] = '';
        $this->summarizeFunction = 'SUM';
        
        $this->isMultirowAllowed = false;
        $this->multiRows = 0;
        $this->arrMultirowOperations = array();
        $this->arrMultirowOperations['edit']    = array('view'=>true);
        $this->arrMultirowOperations['details'] = array('view'=>true);
        $this->arrMultirowOperations['clone']   = array('view'=>true);
        $this->arrMultirowOperations['delete']  = array('view'=>true);
        
        // javascript errors display style -------------------------------------
        $this->jsValidationErrors = 'true';
        $this->jsCode = array();

        // set browser definitions  
        $bd = Helper::SetBrowserDefinitions();
        $this->browserName     = $bd['browser'];
        $this->browserVersion  = $bd['version'];
        $this->platform        = $bd['platform'];        

        // existing fields -----------------------------------------------------
        $this->existingFields = array();
        $this->existingFields['resizable_field'] = false;
        $this->existingFields['wysiwyg_field'] = false;
        $this->existingFields['calendar_type_popup'] = false;
        $this->existingFields['calendar_type_floating'] = false;
        $this->existingFields['autosuggestion_field'] = false;
        $this->existingFields['tooltip_type_floating'] = false; 
        $this->existingFields['magnify_field_view'] = false;
        $this->existingFields['magnify_field_edit'] = false;
        $this->existingFields['magnify_field_view_magnifier'] = false;
        $this->existingFields['magnify_field_view_lightbox'] = false;
        $this->existingFields['magnify_field_edit_magnifier'] = false;
        $this->existingFields['magnify_field_edit_lightbox'] = false;
        $this->existingFields['color_picker_field'] = false;

        // loading image -------------------------------------------------------
        $this->isLoadingImageEnabled = true;
        
        // type of displaying control buttons ----------------------------------
        $this->controlsDisplayingType = '';

        // using of escaping special characters in a string --------------------
        $this->allowRealEscape = true;
        
        // set first wee kday to sunday ----------------------------------------
        $this->weekStartingDay = 0;

        // define cache --------------------------------------------------------
        $this->isCachingAllowed = false;
        $this->cacheDir = $this->directory.'tmp/cache/';
		$this->cacheLifetime = 5; // in minutes
		$this->maxCacheFiles = 100;

        // active keys and fields ----------------------------------------------
        $this->firstFieldFocusAllowed = false;
        $this->documentEnterKeyAllowed = false;
        $this->maximumAllowedRecords = '';
        $this->isAnchorAllowed = false;
        $this->uploadType = 'by_one'; // all|by_one (default)
        
        $this->dtSeparator = '-'; // allowed values: .|/|-|:
        $this->urlString = '';
        $this->bindPassed = false;

        // used if we need to convert data before insertion/after retrieving form database        
        $this->convertOutput = false;
        $this->convertFrom = '';
        $this->convertTo = '';
        
        if(!isset($_SESSION)) $this->AddWarning('', '', 'To make sure all features of this component work properly you should start a session by calling session_start() at the begining of the file.');
    }

    //--------------------------------------------------------------------------
    // Class destructor
    //--------------------------------------------------------------------------    
    function __destruct()
    {
		// echo 'this object has been destroyed';
    }

    //--------------------------------------------------------------------------
    // Triggered when invoking inaccessible methods in an object context
    //--------------------------------------------------------------------------    
    function __call($method, $args)
    {
        if(strtolower($method) == 'datasource'){
            if(count($args) == 3 || count($args) == 4){
                $this->DataSourceOld($args[0], $args[1], $args[2]);
            }else{
                $this->DataSourceNew($args);
            }
        }else if(strtolower($method) == 'allowexporting'){
            if(count($args) == 3){
                $this->AllowExportingOld($args[0], $args[1], $args[2]);
            }else if(count($args) == 2){
                $this->AllowExportingNew($args[0], $args[1]);
            }else if(count($args) == 1){
                $this->AllowExportingNew($args[0]);
            }            
        }
    }

    /**
     * Set encoding
     *      @param $dg_encoding
     *      @param $dg_collation
     */
    public function SetEncoding($dg_encoding = '', $dg_collation = ''){
        $this->encoding = ($dg_encoding != '') ? $dg_encoding : $this->encoding;
        $this->collation = ($dg_collation != '') ? $dg_collation : $this->collation;
    }

    /**
     * Set data source (old syntax)
     *      @param $params
     */
    public function DataSourceNew($params = array()){
        $db_type   = isset($params[0]) ? $params[0] : 'PEAR';
        $db_driver = isset($params[1]) ? $params[1] : 'mysql';
        $DB_HOST   = isset($params[2]) ? $params[2] : '';
        $DB_NAME   = isset($params[3]) ? $params[3] : '';
        $DB_USER   = isset($params[4]) ? $params[4] : '';
        $DB_PASS   = isset($params[5]) ? $params[5] : '';
        $sql       = isset($params[6]) ? $params[6] : '';
        $default_order = isset($params[7]) ? $params[7] : '';
        
        $this->dbType = (strtolower($db_type) == 'pdo') ? 'PDO' : 'PEAR';
        $this->dbDriver = $db_driver;
        
        if($this->dbType == 'PEAR'){            
            ##  *** PEAR CONNECTION
            ##  ------------------
            ##  * (example of ODBC connection string) - odbc
            ##      $result_conn = $db_conn->connect(DB::parseDSN('odbc://root:12345@test_db'));
            ##  * (example of Oracle connection string) - oci8
            ##     1. $DB_NAME = 'localhost:1521/mydatabase';
            ##        $result_conn = $db_conn->connect(DB::parseDSN('oci8://root:12345@localhost/'.$DB_NAME)); 
            ##     2. $DB_DESCR = '(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = xx.xx.xx.xx)(PORT = 1521))) (CONNECT_DATA = (SERVICE_NAME = dev.domain.com)))';
            ##     3. $DB_DESCR = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = private-22269fa)(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = XE)))';
            ##        $result_conn = $db_conn->connect(DB::parseDSN('oci8://root:12345@'.$DB_DESCR)); 
            ##  * (example of PostgreSQL connection string) - pgsql
            ##        $result_conn = $db_conn->connect(DB::parseDSN('pgsql://root:12345@localhost/mydatabase')); 
            ##  * (example of Firebird connection string)
            ##        $DB_NAME='c:\\program\\firebird21\\data\\db_test.fdb';   
            ##        $db_conn->connect(DB::parseDSN('firebird://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));      
            ##  * (examples of connections to other db types see in 'docs/pear/' folder)

            /* Ex.: 'datagrid/pear/' */    
            if(!defined('PEAR_DIR')) define('PEAR_DIR', $this->directory.'modules/pear/');                   
            require_once(PEAR_DIR.'PEAR.php');
            require_once(PEAR_DIR.'DB.php');
            
            $db_conn = DB::factory($db_driver);  /* don't forget to change on appropriate db type */
            if($db_driver == 'oci8'){
                $DB_DESCR = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = '.$DB_HOST.')(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = '.$DB_NAME.')))';
                $result_conn = $db_conn->connect(DB::parseDSN($db_driver.'://'.$DB_USER.':'.$DB_PASS.'@'.$DB_DESCR));
            }else{
                $result_conn = $db_conn->connect(DB::parseDSN($db_driver.'://'.$DB_USER.':'.$DB_PASS.'@'.$DB_HOST.'/'.$DB_NAME));
            }
            if(DB::isError($result_conn)){ die($result_conn->getDebugInfo()); }  
            $this->dbHandler = $db_conn;
            //$this->dbHandler->setFetchMode(DB_FETCHMODE_ASSOC);
            $this->DataSourceOld($this->dbHandler, $sql, $default_order);
        }else{
            ##  *** PDO CONNECTION
            ##  ------------------
            ##      * (example of MS SQL Server and Sybase with PDO_DBLIB)  
            ##          $DBH = new PDO('mssql:host=$host;dbname='.$dbname, $user, $pass);  
            ##          $DBH = new PDO('sybase:host=$host;dbname='.$dbname, $user, $pass);
            ##      * (example of MySQL with PDO_MYSQL)  
            ##          $DBH = new PDO('mysql:host=$host;dbname='.$dbname, $user, $pass);  
            ##      * (example of SQLite)
            ##          $DBH = new PDO('sqlite:my/database/path/database.db');  

            if(($this->dbType == 'PDO' && version_compare(PHP_VERSION, '5.0.0', '<')) || !defined('PDO::ATTR_DRIVER_NAME')){
                die('You must have PHP 5 or newer installed to use PHP Data Objects (PDO) extension');
            }

            try{                
                if($db_driver == 'oci'){
                    $DB_DESCR = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = '.$DB_HOST.')(PORT = 1521)) (CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = '.$DB_NAME.')))';
					$db_conn = new PDO($db_driver.':dbname='.$DB_DESCR, $DB_USER, $DB_PASS);
                }else if($db_driver == 'ibm'){
                    if(defined('PDO::I5_ATTR_COMMIT') && defined('PDO::I5_TXN_NO_COMMIT')){
                        $arr_options_temp = array(PDO::I5_ATTR_COMMIT=>PDO::I5_TXN_NO_COMMIT);
                    }else{
                        $arr_options_temp = array(PDO::ATTR_AUTOCOMMIT=>false);
                    }
                    $arr_options = (!$this->dbAutoCommit) ? $arr_options_temp : array();
                    $db_conn = new PDO($db_driver.':'.$DB_NAME, $DB_USER, $DB_PASS, $arr_options);
				}else if($db_driver == 'pgsql'){
                    $host_parts = explode(':', $DB_HOST);
                    $DB_PORT = (isset($host_parts[1])) ? ';port='.$host_parts[1] : '';
                    $DB_HOST = (isset($host_parts[0])) ? $host_parts[0] : $DB_HOST;
					$db_conn = new PDO($db_driver.':host='.$DB_HOST.$DB_PORT.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
                }else{
                    $db_conn = new PDO($db_driver.':host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);                    
                }
                $this->dbHandler = $db_conn;
                $this->dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->DataSourceOld($this->dbHandler, $sql, $default_order);
            }catch(PDOException $e){
                $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
            }
        }        
    }

    /**
     * Set data source (old syntax)
     *      @param $db_handl
     *      @param $sql
     */
    public function DataSourceOld($db_handl, $sql = '', $default_order = array()){        
        $req_mode = $this->GetVariable('mode');
                
        // clear sql statement
        $sql = str_replace(array("\n", "\t", "  ", chr(13), chr(10)), ' ', $sql); // new row
        //[#0040] $sql = str_replace('`', '', $sql); // remove apostrophes(backquotes)
        $sql = rtrim(trim($sql), ';');
        
        // get preliminary Primary Key
        if(empty($this->primaryKey)){
            $p_key = explode(' ', $sql);
            $p_key = substr($p_key[1], 0, strpos($p_key[1], ','));
            $p_key = explode('.', $p_key);
            $this->primaryKey = $p_key[count($p_key)-1];            
        }
        
        $req_sort_field = $this->GetVariable('sort_field');
        $req_sort_field_by = $this->GetVariable('sort_field_by');
        $req_sort_field_type = $this->GetVariable('sort_field_type');
        $sort_field = ($req_sort_field_by != '') ? $req_sort_field_by : $req_sort_field ;
        $req_sort_type = $this->GetVariable('sort_type');
        $this->dbHandler = $db_handl;       
        if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ORDERED);
        $numeric_sort = false;

        // strips excess whitespace from a string.
        $sql = preg_replace('/\s\s+/', ' ', $sql);
        // handle SELECT SQL statement
        $this->sqlView = $sql;
        
        $group_by_ind = strpos(strtolower($this->sqlView), 'group by');
        if($group_by_ind){
            $this->sqlView = substr($sql, 0, $group_by_ind).' ';
            $this->sqlGroupBy = substr($sql, $group_by_ind);                
        }

        $pos_from  = $this->SubStrOccurence($this->sqlView, ' from ', true);
        $pos_where = $this->SubStrOccurence($this->sqlView, 'where ', true);
        if($pos_from < $pos_where){
            // handle SELECT statement with sub-SELECTs and SELECT without WHERE
            if(!$group_by_ind){
                // if there is a sub-SELECT in WHERE clause
                if(preg_match('/\bWHERE(.+)SELECT(.+)FROM/i', $this->sqlView)){
                    // add nothing 
                }else{
                    $this->sqlView .= ' WHERE 1=1 ';
                }
            }
        }else if(empty($pos_where)){
            if(!$group_by_ind) $this->sqlView .= ' WHERE 1=1 ';
        }
        $this->sql = $this->sqlView.$this->sqlGroupBy;
        
        // set default order
        if(is_array($default_order)){ 
            $ind = 0;
            foreach($default_order as $order_field => $order_type){
                $this->defaultSortField[$ind] = trim($order_field);
                $this->defaultSortType[$ind] = (in_array(strtolower($order_type), array('asc', 'desc'))) ? $order_type : 'ASC';
                if(!empty($this->defaultSortClause)) $this->defaultSortClause .= ', ';
                $this->defaultSortClause .= $this->defaultSortField[$ind];
                $this->defaultSortClause .= ' '.$this->defaultSortType[$ind];                
                $ind++;
            }            
            if(isset($this->defaultSortField[0])) $this->defaultSortFieldHelp = $this->defaultSortField[0];
            if(isset($this->defaultSortType[0])) $this->defaultSortTypeHelp = $this->defaultSortType[0];            
        }else{
            if($this->dgGetDbDriverType() != 'mssql'){
                $this->defaultSortField[0] = '1';
                $this->defaultSortType[0] = 'ASC';                
            }
        }

        // create ORDER BY part of sql statement
        if($req_sort_field){
            $add_order_by = false;
            
            if(!substr_count($this->sql, 'ORDER BY')){
                $add_order_by = true;
            }else{
                //[#0036] fixed bug 21.04.2010 (for ORDER BY, used in inner SELECTs)
                if(preg_match('/\bORDER BY(.+)FROM/i', $this->sql)) $add_order_by = true;                
            }
            if($add_order_by){
                if($req_sort_field_type == 'numeric'){
                    $this->sqlSort = ' ORDER BY ABS('.$sort_field.') '.$req_sort_type;     
                    $numeric_sort = true;
                }else{
                    $sort_field_name = $sort_field;
                    // [#0014-2] fixed bug 08.04.2010
                    if($this->dgGetDbDriverType() == 'mssql'){
                        $sql_parts = explode(' ', $this->sql);
                        if(isset($sql_parts[$sort_field-1])){
                            $sort_field_name = str_replace(',', '', $sql_parts[$sort_field-1]);
                            $this->sqlSort = ' ORDER BY '.$sort_field_name.' '.$req_sort_type;
                        }else{
                            $this->sqlSort = ' '.$this->GetOrderByList();
                        }
                    }else{
                        $this->sqlSort = ' ORDER BY '.$sort_field_name.' '.$req_sort_type;    
                    }
                }                
            }else{
                $this->sqlSort = ', '.$sort_field.' '.$req_sort_type;
            }            
        }else if(count($default_order) > 0){
			$this->sqlSort = ' ORDER BY '.$this->GetOrderByList();
        }else{   
            if($this->onSubmitFilter != '' && $this->defaultSortFieldHelp != '' && $this->defaultSortTypeHelp != ''){
                // if there we are in searching - save default ordering
                $this->sqlSort = ' ORDER BY '.$this->defaultSortClause;
                //[#0038] fixed bug 31.08.2011
                ///$this->sqlSort = ' ORDER BY '.$this->defaultSortFieldHelp.' '.$this->defaultSortTypeHelp;
            }else{
				if($this->defaultFilteringAllowed){
					//[#0041] fixed bug 05.09.2011
					if(!empty($this->defaultSortClause)) $this->sqlSort = ' ORDER BY '.$this->defaultSortClause;
				}else{
					$this->sqlSort = ' ORDER BY 1 ASC';
				}
            }
        }

        $this->GetDataSet($this->sqlSort, '', '', $sort_field, $numeric_sort, true);        

        // check if the preliminary key is a Primary Key
        $is_warning = false;
        $pk_type = $this->GetFieldInfo(0, 'type', 1);
        switch($this->dgGetDbDriverType()){ 
            case 'ibase':
            case 'firebird': 
                if(!preg_match('/integer/i', $pk_type)) $is_warning = true;
                break;
            case 'pgsql':
                if(!preg_match('/int/i', $pk_type)) $is_warning = true;
                break;             
            case 'mssql':
                if(!preg_match('/identity/i', $pk_type)) $is_warning = true;
                break;
            case 'ibm':
                if(!preg_match('/decimal/i', $pk_type)) $is_warning = true;
                break;
            default:
                if(!preg_match('/int/i', $pk_type) && !preg_match('/mediumint/i', $pk_type) && !preg_match('/long/i', $pk_type)) $is_warning = true;
                break;
        }
        if($is_warning) $this->AddWarning($this->primaryKey, 'Check this field carefully, it may be not a Primary Key!');
    }    

    /**
     * Set language
     *      @param $lang_name
     */
    public function SetInterfaceLang($lang_name = ''){
        $default_language = false;
        if(!empty($lang_name)) $this->langName = strtolower($lang_name); 
        if($this->IsFileExists($this->directory.'languages/'.$this->langName.'.php')){
            include_once($this->directory.'languages/'.$this->langName.'.php');                
            $func_name = 'setLanguage'.ucfirst($this->langName);
            if(function_exists($func_name)){
                $this->lang = $func_name();
                if($this->dgGetDbDriverType() == 'ibm' && $this->langName == 'he'){
                    // set conversion parameters
                    $this->convertOutput = true; 
                    $this->convertFrom = 'ISO-8859-8';
                    $this->convertTo = 'UTF-8';                    
                }
            }else{
                if($this->debug) $this->AddWarning('', '', '<label class="'.$this->cssClass.'_dg_error_message no_print">Your language interface option is turned on, but the system was failed to open correctly stream: <b>"'.$this->directory.'languages/lang.php"</b>. <br />The structure of the file is corrupted or invalid. Please check it or return the language option to default value: <b>"en"</b>!</label>', 'lang_error1');
                $default_language = true;
            }                
    	}else{
            if((strtolower($lang_name) != 'en') && ($this->debug)){
                if($this->debug) $this->AddWarning('', '', '<label class="'.$this->cssClass.'_dg_error_message no_print">Your language interface option is turned on, but the system was failed to open stream: <b>"'.$this->directory.'languages/'.$lang_name.'.php"</b>. <br />No such file or directory. Please check it or return the language option to default value: <b>"en"</b>!</label>', 'lang_error2');
            }
            $default_language = true;                    
    	}
               
        if($default_language){
            $this->lang = Helper::GetLangVocabulary();
        }
    }

    /**
     * Set direction
	 *      @param $direction
     */
    public function SetDirection($direction = 'ltr'){
        $this->direction = $direction;
    }

    /**
     * Set layouts
	 *      @param $layouts
     */
    public function SetLayouts($layouts = ''){
        $this->layouts['view']   = (isset($layouts['view'])) ? $layouts['view'] : '0';
        $this->layouts['edit']   = (isset($layouts['edit'])) ? $layouts['edit'] : '0';
        $this->layouts['show']   = (isset($layouts['details']) && $layouts['details'] == '2') ? '2' : '1';
        $this->layouts['filter'] = (isset($layouts['filter'])) ? $layouts['filter'] : '0';
    }

    /**
     * Set templates for customized layouts
	 *      @param $view
	 *      @param $add_edit
	 *      @param $details
     */
    public function SetTemplates($view = '', $add_edit = '', $details = ''){
        $this->templates['view'] = $view;
        $this->templates['edit'] = $add_edit;
        $this->templates['show'] = $details;
    }

    /**
     * Set mode add/edit/cancel/delete
	 *      @param $parameters
     */
    public function SetModes($parameters){
        $this->modes = array();
        if(is_array($parameters)){
            foreach($parameters as $modeName => $modeValue){
                $this->modes[$modeName] = $modeValue;
            }            
        }
        $this->mode = 'view';
    }  	    

    /**
     * Allow scrolling settings
	 *      @param $scrolling_option
     */
    public function AllowScrollingSettings($scrolling_option = false){
        $this->scrollingOption = (($scrolling_option == true) || ($scrolling_option == 'true')) ? true : false ;        
    }

    /**
     * Set scrolling settings
	 *      @param $height
     */
    public function SetScrollingSettings($height = ''){
        if($height != '') $this->scrollingHeight = $height;
    }

    /**
     * Allow multirow operations
	 *      @param $multirow_option
     */
    public function AllowMultirowOperations($multirow_option = false){
        $this->isMultirowAllowed = (($multirow_option == true) || ($multirow_option == 'true')) ? true : false ;
    }

    /**
     * Set multirow operations
	 *      @param $multirow_operations
     */
    public function SetMultirowOperations($multirow_operations = ''){
        if(is_array($multirow_operations)){                
            foreach($multirow_operations as $fldName => $fldValue){
                $this->arrMultirowOperations[$fldName] = $fldValue;
            }
        }        
    }

    /**
     * Set css class
	 *      @param $class
     */
    public function SetCssClass($class = 'default'){        
        $this->cssClass = strtolower($class);
    }
    
    /**
     * Set Http Get Vars
	 *      @param $http_get_vars
     */
    public function SetHttpGetVars($http_get_vars = ''){
        $this->httpGetVars = $http_get_vars;
    }

    /**
     * Set Other DataGrids
	 *      @param $another_datagrids
     */
    public function SetAnotherDatagrids($another_datagrids = ''){
        $this->anotherDatagrids = $another_datagrids;
    }

    /**
     * Set title for datagrid
	 *      @param $dg_caption
     */
    public function SetCaption($dg_caption = ''){
        $this->caption = $dg_caption;
    }

    /**
     * Set Postback method
	 *      @param $option
     */
    public function SetPostBackMethod($option = 'get'){
        switch(strtolower($option)){
            case 'ajax': $this->methodPostBack = 'ajax'; break;
            case 'post': $this->methodPostBack = 'post'; break;
            default: $this->methodPostBack = 'get'; break;
        }
    }    
 
    /**
     * Allow printing functions
	 *      @param $option
     */
    public function AllowPrinting($option = true) { 
		$this->printingAllowed = (($option == true) || ($option == 'true')) ? true : false ; 
	}
	
    /**
     * Allow exporting functions OLD
	 *      @param $option
	 *      @param $exporting_directory
	 *      @param $export_all
     */
    public function AllowExportingOld($option = true, $exporting_directory = '', $export_all = false){
        $this->exportingAllowed = (($option === true) || ($option == 'true')) ? true : false ;
        if($exporting_directory != '') $this->exportingDirectory = $exporting_directory;
        $this->exportAll = ($export_all === true || $export_all == 'true') ? true : false;
    }

    /**
     * Allow exporting functions NEW
	 *      @param $option
	 *      @param $export_all
     */
    public function AllowExportingNew($option = true, $export_all = false){
        $this->exportingAllowed = (($option === true) || ($option == 'true')) ? true : false ;
        $this->exportAll = ($export_all === true || $export_all == 'true') ? true : false;
    }

    /**
     * Allow exporting types
	 *      @param $exporting_types
     */
    public function AllowExportingTypes($exporting_types = ''){
        if(is_array($exporting_types)){
            $this->arrExportingTypes['csv']   = (isset($exporting_types['csv']) && (($exporting_types['csv'] === true) || ($exporting_types['csv'] === 'true'))) ?  true : false;
            $this->arrExportingTypes['xls']   = (isset($exporting_types['xls']) && (($exporting_types['xls'] === true) || ($exporting_types['xls'] === 'true'))) ?  true : false;
            $this->arrExportingTypes['pdf']   = (isset($exporting_types['pdf']) && (($exporting_types['pdf'] === true) || ($exporting_types['pdf'] === 'true'))) ?  true : false;
            $this->arrExportingTypes['xml']   = (isset($exporting_types['xml']) && (($exporting_types['xml'] === true) || ($exporting_types['xml'] === 'true'))) ?  true : false;
        }
    }

    /**
     * Set sorting settings
     *      @param $option
     */
    public function AllowSorting($option = true){
        $this->sortingAllowed = (($option === true) || (strtolower($option) == 'true')) ? true : false ;
    }    

    /**
     * Allow paging
     *      @param $option
     *      @param $rows_numeration
     *      @param $numeration_sign
     *      @param $dropdown_paging
     */
    public function AllowPaging($option = true, $rows_numeration = false, $numeration_sign = 'N #', $dropdown_paging = false){
        $this->pagingAllowed = (($option === true) || ($option == 'true')) ? true : false ;
        $this->rowsNumeration = $rows_numeration;
        $this->numerationSign = $numeration_sign;
        $this->dropdownPaging = (($dropdown_paging === true) || ($dropdown_paging == 'true')) ? true : false ;
    }

    /**
     * Set paging settings
     *      @param $lower
     *      @param $upper
     *      @param $pages_array
     *      @param $default_page_size
     *      @param $paging_arrows
     */
    public function SetPagingSettings($lower = false, $upper = false, $pages_array = false, $default_page_size = '', $paging_arrows = ''){
        if(is_array($lower)){
            if(isset($lower['results'])) $this->arrLowerPaging['results'] = $lower['results'];
            if(isset($lower['results_align'])) $this->arrLowerPaging['results_align'] = $lower['results_align'];
            if(isset($lower['pages'])) $this->arrLowerPaging['pages'] = $lower['pages'];           
            if(isset($lower['pages_align'])) $this->arrLowerPaging['pages_align'] = $lower['pages_align'];
            if(isset($lower['page_size'])) $this->arrLowerPaging['page_size'] = $lower['page_size'];
            if(isset($lower['page_size_align'])) $this->arrLowerPaging['page_size_align'] = $lower['page_size_align'];
        }
        if(is_array($upper) && (count($upper) > 0)){
            if(isset($upper['results'])) $this->arrUpperPaging['results'] = $upper['results'];
            if(isset($upper['results_align'])) $this->arrUpperPaging['results_align'] = $upper['results_align'];
            if(isset($upper['pages'])) $this->arrUpperPaging['pages'] = $upper['pages'];           
            if(isset($upper['pages_align'])) $this->arrUpperPaging['pages_align'] = $upper['pages_align'];
            if(isset($upper['page_size'])) $this->arrUpperPaging['page_size'] = $upper['page_size'];
            if(isset($upper['page_size_align'])) $this->arrUpperPaging['page_size_align'] = $upper['page_size_align'];
        }
        if($pages_array){
            if(is_array($pages_array) && (count($pages_array) > 0)){
                $first_key = '';
                foreach($pages_array as $key => $val){
                    if(empty($first_key)) $first_key = $key;
                    if(intval($pages_array[$key]) == 0) $pages_array[$key] = 1;
                }
                $this->arrPages = $pages_array;
                $this->reqPageSize = ($pages_array[$first_key] > 0) ? $pages_array[$first_key] : $this->reqPageSize;               
            }
        }
        if(($default_page_size != '') && ($default_page_size > 0)) { $this->defaultPageSize = $this->reqPageSize = $default_page_size; }
   
        if($paging_arrows != ''){
            if(is_array($paging_arrows) && (count($paging_arrows) > 0)){
                $this->firstArrow    = (isset($paging_arrows['first'])) ? $paging_arrows['first'] : $this->firstArrow;
                $this->previousArrow = (isset($paging_arrows['previous'])) ? $paging_arrows['previous'] : $this->previousArrow;
                $this->nextArrow     = (isset($paging_arrows['next'])) ? $paging_arrows['next'] : $this->nextArrow;
                $this->lastArrow     = (isset($paging_arrows['last'])) ? $paging_arrows['last'] : $this->lastArrow;
            }
        }       
    }

    /**
     * Allow filtering
     *      @param $option
     *      @param $show_search_type
     */
    public function AllowFiltering($option = false, $show_search_type = 'true'){
        $this->filteringAllowed = (($option == true) || ($option == 'true')) ? true : false ;
        $this->showSearchType  = (($show_search_type == true) || ($show_search_type == 'true')) ? true : false;
    }
    
    /**
     * Allow default filtering
     *      @param $filtering_option
     */
    public function AllowDefaultFiltering($filtering_option = false){
        $this->defaultFilteringAllowed = (($filtering_option == true) || ($filtering_option == 'true')) ? true : false;        
    }
    
    /**
     * Allow auto skip to top anchor
     *      @param $filtering_option
     */
    public function AllowTopAnchor($anchor_option = false){
        $this->isAnchorAllowed = (($anchor_option == true) || ($anchor_option == 'true')) ? true : false;        
    }   

    /**
     * Set filtering tabular layout columns
     *      @param $tabular_columns
     */
    public function SetFilteringTabularLayoutColumns($tabular_columns = ''){
        $this->tabularColumns = ($tabular_columns != '' && (int)$tabular_columns > 0) ? (int)$tabular_columns : '';
    }
    
    /**
     * Set filtering fields
     *      @param $filter_fields_array
     */
    public function SetFieldsFiltering($filter_fields_array = ''){
        if(is_array($filter_fields_array)){
            foreach($filter_fields_array as $fldName => $fldValue){
                $this->arrFilterFields[$fldName] = $fldValue;
            }
        }
    }    
    
    /**
     * Set view mode table properties
     *      @param $vmt_properties
     */
    public function SetViewModeTableProperties($vmt_properties = ''){        
        if(is_array($vmt_properties) && (count($vmt_properties) > 0)){
            if(isset($vmt_properties['width'])) $this->tblWidth['view'] = $vmt_properties['width'];    
        }
    }

    /**
     * Set columns in view mode
     *      @param $columns
     */
    public function SetColumnsInViewMode($columns = ''){
        unset($this->columnsViewMode);
        $this->columnsViewMode = array();
        if(is_array($columns)){        
            foreach($columns as $fldName => $fldValue){
                $this->columnsViewMode[$fldName] = $fldValue;
            }
        }
    }

    /**
     * Set auto-generated columns in view mode
     *      @param $auto_columns
     */
    public function SetAutoColumnsInViewMode($auto_columns = ''){
        if(($auto_columns == true) || ($auto_columns == 'true')){            
            if($this->CheckIsError()){                
                $this->AddErrors();
            }else{
                unset($this->columnsViewMode);
                if($this->dbType == 'PDO'){
                    $fields = $this->dataSet->fetch(PDO::FETCH_ASSOC);
                    foreach($fields as $key => $val){
                        $this->columnsViewMode[$key] =
                        array('header'  => str_replace('_', ' ', $key),
                            'type'      => 'label',
                            'align'     => 'left',
                            'width'     => '',
                            'wrap'      => 'wrap',
                            'tooltip'   => false,
                            'text_length'=> '-1',
                            'case'      => 'normal',
                            'summarize' => false,
                            'visible'   => 'true'
                        );            
                    }                    
                }else{
                    $fields = $this->dataSet->tableInfo();
                    for($ind=0; $ind < $this->NumberCols(); $ind++){                
                        $this->columnsViewMode[$fields[$ind]['name']] =
                        array('header'  => str_replace('_', ' ', $fields[$ind]['name']),
                            'type'      => 'label',
                            'align'     => 'left',
                            'width'     => '',
                            'wrap'      => 'wrap',
                            'tooltip'   => false,
                            'text_length'=> '-1',
                            'case'      => 'normal',
                            'summarize' => false,
                            'visible'   => 'true'
                        );
                    }                    
                }                
            }
        }
    }

    /**
     * Set add/edit/details mode table properties
     *      @param $emt_properties
     */
    public function SetEditModeTableProperties($emt_properties = ''){        
        if(is_array($emt_properties) && (count($emt_properties) > 0)){
            if(isset($emt_properties['width'])) $this->tblWidth['edit'] = $emt_properties['width'];    
        }
    }

    /**
     * Set details mode table properties
     *      @param $dmt_properties
     */
    public function SetDetailsModeTableProperties($dmt_properties = ''){        
        if(is_array($dmt_properties) && (count($dmt_properties) > 0)){
            if(isset($dmt_properties['width'])) $this->tblWidth['details'] = $dmt_properties['width'];    
        }
    }
    
    /**
     * Set editing table & primary key id
     *      @param $tbl_name
     *      @param $field_name
     *      @param $condition
     */
    public function SetTableEdit($tbl_name, $field_name, $condition = ''){
        $this->tblName = $tbl_name;
        $field_name_split = explode('.', $field_name);
        if(isset($field_name_split[1]) && $this->tblName == $field_name_split[0]) $this->primaryKey = $field_name_split[1];
        else $this->primaryKey = $field_name_split[0];
        $this->condition = $condition;
    }

    /**
     * Set columns in add/edit/details mode
     *      @param $columns
     */
    public function SetColumnsInEditMode($columns = ''){
        unset($this->columnsEditMode);
        $this->columnsEditMode = array();
        if(is_array($columns)){
            foreach($columns as $fldName => $fldValue){
                $this->columnsEditMode[$fldName] = $fldValue;
            }
        }
    }

    /**
     * Set auto-generated columns in add/edit/details mode
     *      @param $auto_columns
     */
    public function SetAutoColumnsInEditMode($auto_columns = ''){
        $req_mode = $this->GetVariable('mode');
        if($req_mode == '' || $req_mode == 'view') return false;
        
        if(($auto_columns == true) || ($auto_columns == 'true')){
            unset($this->columnsEditMode);
            if($this->dbType == 'PDO'){
                $sql  = $this->ShowColumns($this->tblName);
                if($this->dgGetDbDriverType() == 'ibm') $sql = str_replace($this->dbSchema.'.', '', $sql);
                $dSet = $this->dbHandler->query($sql);
                $fields = $dSet->fetchAll(PDO::FETCH_ASSOC);
                foreach($fields as $key => $val){
                    $field_info = $this->GetFieldTypeInfo($val['Type']);
                    //$field_maxlength = ($fields[$ind]['len'] <= 0) ? '' : $fields[$ind]['len'];
                    $field = (($this->dbDriver == 'ibm') ? $val['COLUMN_NAME'] : $val['Field']);
                    $this->columnsEditMode[$field] =
                    array('header'  => str_replace('_', ' ', $field),
                        'type'      => $field_info['type'],
                        'req_type'  => 'r'.$field_info['symbol'],
                        'width'     => '210px',
                        'maxlength' => '',
                        'title'     => str_replace('_', ' ', $field),
                        'readonly'  => false,
                        'visible'   => 'true',
                        'default'   => '',
                    );            
                }
                
            }else{
                $sql  = 'SELECT * FROM '.$this->tblName;
                $sql_limit = $this->SetSqlLimitByDbType('0', '1');    
                $sql = $this->SetSqlByDbType($sql, '', $sql_limit);
                $dSet = $this->dbHandler->query($sql);
                if($this->debug) $this->sqlStatements[] = '<div class="'.$this->cssClass.'_dg_sql_message"><i>Retrieve data for table info:</i><br><b>select sql ('.Helper::ConvertCase($this->lang['total'],'lower',$this->langName).': 1) </b>'.$sql.'</div>';
                if($this->CheckIsError($dSet)){
                    $this->AddErrors($dSet);
                    $this->AddWarning('', '', 'Check settings of auto-generated columns property (must be defined after SetTableEdit() method).');
                }else{
                    $fields = $dSet->tableInfo();                
                    // try to get default value from field in database for MySQL
                    if($this->dgGetDbDriverType() == 'mysql') $sql_result = mysql_query(' DESCRIBE '.$this->tblName.' '); 
                   
                    for($ind=0; $ind < $dSet->numCols(); $ind++){                    
                        // for MySQL    
                        $default_value = '';
                        if($this->dgGetDbDriverType() == 'mysql'){
                            $meta = mysql_fetch_assoc($sql_result);
                            if(isset($meta['Default'])) $default_value = $meta['Default'];
                        }
    
                        if($fields[$ind]['name'] != $this->primaryKey){
                            // get required symbol
                            $required_symbol = ($this->IsFieldRequired($fields[$ind]['name'])) ? 'r' : 's';
                            $field_info = $this->GetFieldTypeInfo($fields[$ind]['type']);
                            $type_view = 'texbox';
                            $req_type_symbols = $required_symbol.$field_info['symbol'];
                            $field_maxlength = ($fields[$ind]['len'] <= 0) ? '' : $fields[$ind]['len'];
                            $this->columnsEditMode[$fields[$ind]['name']] =
                            array('header'  => str_replace('_', ' ', $fields[$ind]['name']),
                                'type'      => $field_info['type'],
                                'req_type'  => $req_type_symbols,
                                'width'     => '210px',
                                'maxlength' => $field_maxlength,
                                'title'     => str_replace('_', ' ', $fields[$ind]['name']),
                                'readonly'  => false,
                                'visible'   => 'true',
                                'default'   => $default_value,
                            );                    
                        }
                    }                        
                }                            
            }
        }
    }

    /**
     * Set set foreign keys editing
     *      @param $foreign_keys_array
     */
    public function SetForeignKeysEdit($foreign_keys_array = ''){
        if(is_array($foreign_keys_array)){                
            foreach($foreign_keys_array as $fldName => $fldValue){
                $this->arrForeignKeys[$fldName] = $fldValue;
            }
        }
    }

    /**
     * Show(draw) DataGrid
     */
    public function Show(){
        if($this->bindPassed){
            $this->WriteCssClass();
            if($this->isAnchorAllowed) echo '<a name="'.$this->uniquePrefix.'top"></a>'.$this->nl;
            if($this->layouts[$this->layoutType] == '0'){
                $this->DrawTabular();
            }else if($this->layouts[$this->layoutType] == '1'){
                $this->DrawColumnar();
            }else if($this->layouts[$this->layoutType] == '2'){
                $this->DrawCustomized();                
            }else{
                $this->DrawTabular();
            }
        }else if($this->debug){
            $this->AddWarning('Show() method', 'This method must be called after Bind() method only!');
        }
        // [#0027 under check - 12.10.10] - Bind(false), Show() problem
        $this->SetCommonJavaScriptAjax();
    }

    /**
     * Bind data and draw DG
     *      @param $show
     */
    public function Bind($show = true){
        // run all needed methods to prevent overlapping
        $this->SetFieldsFilteringInBind();		
		
		$this->SetInterfaceLang();        
		$this->PrepareFiltering();         
        $this->SetCommonJavaScript();
        
        // for the case when safeMode == true
        $this->rids = explode('-', $this->rid);
        if(count($this->rids) > 1){
            $this->multiRows = count($this->rids);            
        }
        if(count($this->rids) <= 1) $this->rid = Helper::DecodeParameter($this->GetVariable('rid'), $this->safeMode); 
        $req_mode       = $this->GetVariable('mode');
        $req_mode_parameters = $this->GetVariable('mode_parameters');
        $req_new        = $this->GetVariable('new');
        $req_p          = $this->GetVariable('p');
        $req_page_size  = $this->GetVariable('page_size');
        $req_sort_field = $this->GetVariable('sort_field');
        $req_sort_field_by   = $this->GetVariable('sort_field_by');
        $req_sort_field_type = $this->GetVariable('sort_field_type');
        $sort_field     = ($req_sort_field_by != '') ? $req_sort_field_by : $req_sort_field ;
        $req_sort_type  = $this->GetVariable('sort_type');
        
        // CACHING - start
        $script_name = isset($_SERVER['SCRIPT_NAME']) ? basename($_SERVER['SCRIPT_NAME']) : '';
        $script_name = substr($script_name, 0, strrpos($script_name, '.')); 

        // dir / script name / prefix / mode / rid / page / page size / sort field / sort type
        $http_get_vars = '';
        // save http get variables
        if(is_array($this->httpGetVars)){
            foreach($this->httpGetVars as $key){
                if($this->GetVariable($key, false) != '') $http_get_vars .= $this->GetVariable($key, false);
            }
            if($http_get_vars != '') $http_get_vars = '-'.$http_get_vars;
        }
        $cachefile = $this->cacheDir.md5($script_name.'-'.$this->uniquePrefix.'-'.$req_mode.'-'.$this->rid.'-'.$req_p.'-'.$req_page_size.'-'.$sort_field.'-'.$req_sort_type.$http_get_vars).'.cch';
        if($this->onSubmitFilter == '' && (($req_mode == '') || ($req_mode == 'view') || ($req_mode == 'details'))){
            if($this->isCachingAllowed){
                if($this->StartCaching($cachefile)) return true;
            }
        }

        // protect datagrid from a Hack Attacks
        if($this->SecurityCheck())
        {
            //[#0016] - start
            if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ORDERED);
            //[#0016] - end
            
            // CLONE mode processing
            if($req_mode == 'clone'){
                if(!$this->isPrinting) $this->CloneRow($this->rid);
                $this->sql = $this->sqlView.' '.$this->sqlGroupBy;
                $this->GetDataSet($this->sqlSort);
                $this->mode = 'view';          
            }
            // MOVE mode processing
            if($req_mode == 'move'){
                if(!$this->isPrinting) $this->MoveRow($this->rid, $req_mode_parameters);
                $this->sql = $this->sqlView.' '.$this->sqlGroupBy;
                $this->GetDataSet($this->sqlSort);
                $this->mode = 'view';          
            }            
            // VIEW mode processing
            // we need this (($req_mode == 'view') && $this->exportAll) for 'Export All'
            if(($req_mode == '') || (($req_mode == 'view') && ($req_sort_field_type == 'numeric')) || (($req_mode == 'view') && $this->exportAll)){
                if($req_sort_field_type == 'numeric') $numeric_sort = true; else $numeric_sort = false;
                $this->GetDataSet($this->sqlSort, '', '', $req_sort_field_type, $numeric_sort);
                $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);
            }            
            // DELETE mode processing 
            if(($req_mode == 'delete') && ($this->rid != '')){          
                if(!$this->isPrinting) $this->DeleteRow($this->rid);
                $this->sql = $this->sqlView.' '.$this->sqlGroupBy;
                $this->GetDataSet($this->sqlSort);
                $this->mode = 'view';          
            }
            // UPDATE mode processing 
            if($req_mode == 'update'){
                if(!$this->isPrinting){
                    if($req_new != 1){                        
                        $this->UpdateRow($this->rid);                         
                        if($this->isWarning){
                            if($this->warningType == 'f5'){
                                $req_mode = 'view'; 
                            }else{
                                // [#0033-1] fix for unique fields check                        
                                $req_mode = 'edit'; 
                                $this->modeAfterUpdate = 'edit';                                
                            }
                        }
                    }else{
                        $this->AddRow();
                        if($this->isWarning){  
                            if($this->warningType == 'f5'){
                                $req_mode = 'view'; 
                            }else{
                                // [#0032-1] fix for unique fields check
                                $req_mode = 'add';
                                ///$this->modeAfterUpdate = 'edit';                                
                            }
                        }
                        $this->modeAfterUpdate = '';                        
                    }                
                }                
                if(($req_new != 1) && ($this->modeAfterUpdate == 'edit')){
                    $req_mode = 'edit'; 
                    $this->mode = 'edit';
                }else if($this->modeAfterUpdate == 'details'){
                    $req_mode = 'details';
                    $this->mode = 'details';                    
                }else{
                    $this->sql = $this->sqlView.' '.$this->sqlGroupBy;
                    $this->GetDataSet($this->sqlSort);
                    $this->mode = 'view';
                }
            }            
    
            // EDIT & DETAILS modes processing 
            if(($req_mode == 'edit' || $req_mode == 'details') && ($this->rid != '')){
                if($req_new == 1){
                    $this->dataSet = $this->dbHandler->query($this->sql);            
                }
                $this->AllowSorting(false);
                $this->AllowPaging(false);            
                $this->sqlSort = ' ORDER BY '.$this->primaryKey.' DESC';
                if(($this->layouts['view'] == '0' || $this->layouts['view'] == '2') && ($this->layouts['edit'] == '1') && ($req_mode == 'details')){
                    // if we have more that 1 row selected
                    if(count($this->rids) > 1){ 
                        $where = 'WHERE '.$this->primaryKey.' IN (\'-1\' ';
                        foreach ($this->rids as $key){ if($key != '') $where .= ', \''.Helper::DecodeParameter($key, $this->safeMode).'\' '; }
                        $where .= ') ';
                        // Issue [#123] - start
                        if($sort_field != '') $this->sqlSort = ' ORDER BY '.(($req_sort_field_type == 'numeric') ? ' ABS ('.$sort_field.')' : $sort_field).' '.$req_sort_type;
                        // Issue [#123] - end
                    }else{
                        $where = 'WHERE '.$this->primaryKey.' = \''.$this->rid.'\' ';    
                    }
                    if($this->condition != ''){ $where .= ' AND '. $this->condition; }
                    $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);
                    $fields_list = $this->PreparePasswordDecryption().$this->tblName.'.*';
                    $this->sql = 'SELECT '.$fields_list.' FROM '.$this->tblName.' '.$where; 
                }else if(($this->layouts['view'] == '0' || $this->layouts['view'] == '2') && ($this->layouts['edit'] == '1') && ($req_mode == 'edit')){
                    // sort from higest to lowest
                    rsort($this->rids);
                    // if we have more that 1 row selected
                    // mr_1
                    if(count($this->rids) > 1){ 
                        $where = 'WHERE '.$this->primaryKey.' IN (\'-1\' ';
                        foreach ($this->rids as $key){ if($key != '') $where .= ', \''.Helper::DecodeParameter($key, $this->safeMode).'\' '; }
                        $where .= ') ';
                    }else{
                        $where = 'WHERE '.$this->primaryKey.' = \''.$this->rid.'\' ';    
                    }
                    if($this->condition != '') $where .= ' AND '.$this->condition;                      
                    $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);
                    $fields_list = $this->PreparePasswordDecryption().$this->tblName.'.*';
                    $this->sql = 'SELECT '.$fields_list.' FROM '.$this->tblName.' '.$where; 
                }else if(($this->layouts['view'] == '0' || $this->layouts['view'] == '2') && ($this->layouts['show'] == '1') && ($this->layouts['edit'] == '0') && ($req_mode == 'details')){
                    // if we have more that 1 row selected
                    if(count($this->rids) > 1){ 
                        $where = 'WHERE '.$this->primaryKey.' IN (\'-1\' ';
                        foreach ($this->rids as $key){ if($key != '') $where .= ', \''.Helper::DecodeParameter($key, $this->safeMode).'\' '; }
                        $where .= ') ';
                    }else{
                        $where = 'WHERE '.$this->primaryKey.' = \''.$this->rid.'\' ';    
                    }
                    $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);
                    $this->sqlSort = '';
                    $this->sql = 'SELECT * FROM '.$this->tblName.' '.$where;                    
                }else if(($this->layouts['view'] == '0') && ($this->layouts['edit'] == '0') && ($req_mode == 'edit')){                                        
                    $view_limit = '';                
                    if($this->condition != ''){ 
                        $where = 'WHERE '.$this->condition; 
                    }else{ 
                        $view_limit = $this->SetSqlLimitByDbType();
                        $where = '';
                    }

                    // check if there is no virtial field used for sorting
                    if($this->debug){
                        $sort_field_name = '';
                        if($this->dbType == 'PDO'){
                            $field_offset = $this->GetFieldOffset($field);
                            if($field_offset != -1){
                                $fields = $this->dataSet->getColumnMeta($this->GetFieldOffset($sort_field));
                                $sort_field_name = isset($fields['name']) ? $fields['name'] : '';
                            }
                        }else{
                            $fields = $this->dataSet->tableInfo();
                            $sort_field_name = isset($fields[$sort_field-1]['name']) ? $fields[$sort_field-1]['name'] : '';
                        }
                        if(!isset($this->columnsEditMode[$sort_field_name])){
                            $this->AddWarning('', '', 'Field ['.$sort_field_name.'] used for sorting in View Mode was not found in the list of Edit Mode fields. Using such field may cause for unexpected behavior of DataGrid. Please fix this or use another field for sorting.');
                            $this->isWarning = true;
                        }                        
                    }

                    // prepare sorting, but prevent unexpected cases
                    if(!is_numeric($sort_field) || (is_numeric($sort_field) && $sort_field <= $this->NumberCols())){
                        if($req_sort_field != '') $this->sqlSort = ' ORDER BY '.(($req_sort_field_type == 'numeric') ? ' ABS ('.$sort_field.')' : $sort_field).' '.$req_sort_type;   
                    }
                    $fields_list = $this->PreparePasswordDecryption().$this->tblName.'.*';
                    //[#0044 under check - 28.09.11]
                    if(empty($where)) $this->sql = $this->sqlView;
                    else $this->sql = 'SELECT '.$fields_list.' FROM '.$this->tblName.' '.$where;
                }else{
                    //[#0047 under check - 07.12.11]
                    $fields_list = $this->PreparePasswordDecryption().$this->tblName.'.*';
                    $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);                
                    $where = 'WHERE '.$this->primaryKey.' = \''.$this->rid.'\' ';
                    $this->sql = 'SELECT '.$fields_list.' FROM '.$this->tblName.' '.$where;                 
                }            
                $this->GetDataSet($this->sqlSort, $view_limit, $this->modeAfterUpdate);
                if($req_mode == 'edit') $this->mode = 'edit';
                else $this->mode = 'details';               
            }
                    
            // CANCEL mode processing 
            if($req_mode == 'cancel'){
                $this->rid = '';
                $this->sql = $this->sqlView.' '.$this->sqlGroupBy;
                $this->GetDataSet($this->sqlSort);            
                $this->mode = 'view';
            }    

            // ADD mode processing 
            if($req_mode == 'add'){
                $this->modeAfterUpdate = '';
                // we don't need multirow option allowed when we add new record
                $this->isMultirowAllowed = false;
                if(($this->layouts['view'] == '0') && ($this->layouts['edit'] == '0')){
                    // we need
                    $view_limit = '';
                    $where = ($this->condition != '') ? ' WHERE '.$this->condition : '';
                    $this->sql = 'SELECT '.$this->tblName.'.* FROM '.$this->tblName.' '.$where;
                }else{
                    $view_limit = '';
                    $this->sql = 'SELECT '.$this->tblName.'.* FROM '.$this->tblName;
                    $this->sqlSort = ' ORDER BY '.$this->primaryKey.' DESC';
                }
                $this->GetDataSet($this->sqlSort, $view_limit);
                $this->rid = -1;
                $this->AllowSorting(false);
                $this->AllowPaging(false);
                $this->mode = 'edit';
            }            
        }else{           
            // VIEW mode processing 
            if($req_mode == ''){
                if($req_sort_field_type == 'numeric') $numeric_sort = true; else $numeric_sort = false;
                $this->GetDataSet($this->sqlSort, '', '', $req_sort_field_type, $numeric_sort);
                $view_limit = $this->SetSqlLimitByDbType('0', $req_page_size);    
            }
            // block possibility to add new record on security alert
            $this->modes['add']['view'] = false; 
            if($this->debug){
                echo '<br /><center><label class="default_dg_error_message">Wrong parameters were passed! Possible Hack attack!</label></center><br />';
            }else{
                echo '<br /><center><label class="default_dg_error_message">Wrong parameters were passed!</label></center><br />';                
            }
        }

        // clear session variables for blob downloading
        if($req_mode != 'details'){
            if(isset($_SESSION['datagrid_df_content'])) unset($_SESSION['datagrid_df_content']);
            if(isset($_SESSION['datagrid_df_blob_type'])) unset($_SESSION['datagrid_df_blob_type']);
            if(isset($_SESSION['datagrid_df_blob_name'])) unset($_SESSION['datagrid_df_blob_name']);
            if(isset($_SESSION['datagrid_df_blob_size'])) unset($_SESSION['datagrid_df_blob_size']);
        }
        
        $this->SetCommonJavaScriptEnd();        
        
        if($this->methodPostBack == 'ajax'){
            echo '<div id="'.$this->uniquePrefix.'dg_ajax_container">'.$this->nl;
            echo '<div id="'.$this->uniquePrefix.'dg_ajax_container_opacity" style="width:100%;position:relative;">'.$this->nl;
            if($this->methodPostBack == 'ajax') echo '<div id="'.$this->uniquePrefix.'ajax_loading_image" style="position:absolute;display:none;margin:0 auto;left:50%;right:50%;top:20px;width:32px;height:32px;"><img src="'.$this->include_path.'images/ajax_loading.gif" alt="'.$this->lang['loading_data'].'" border="0" /></div>'.$this->nl;
        }
                
        // prepare links for all modes
        $this->PrepareLinks();
        
        if($this->dataSet){
            if(($this->mode === 'edit') || ($this->mode === 'add')){
                $this->layoutType = 'edit';
                $this->AllowHighlighting(false);
            }else if($this->mode === 'details'){
                $this->layoutType = 'show';
                $this->AllowHighlighting(false);
            }else {
                $this->layoutType = 'view';
            }
            
            // sort columns by mode order
            $this->SortColumns($this->mode);
            
            $this->bindPassed = true;
            if($show == true){
                $this->Show();
                $this->bindPassed = false;
            }
        }
        
        $this->DisplaySqlStatements();                
        $this->DisplayDataSent();                
        $this->DisplayErrors();
        $this->DisplayWarnings();
        
        // finish calculating running time of a script
        if($this->debug){
            $this->endTime = $this->GetFormattedMicrotime();
            echo '<br /><center><label class="default_dg_label">DataGrid v'.self::$dgVersion.' | Extension: '.$this->dbType.' | Database: '.$this->dbDriver.' | Total running time: '.round((float)$this->endTime - (float)$this->startTime, 6).' sec.</label></center>';
        }        

        if($this->methodPostBack == 'ajax') echo '</div></div><div id="'.$this->uniquePrefix.'dg_ajax_container_end"></div>';

        echo $this->nl.'<!-- END This script was generated by datagrid.class.php v'.self::$dgVersion.' (http://www.apphp.com/php-datagrid/index.php) END -->'.$this->nl;
        
		// CACHING - finish 
        if($this->onSubmitFilter == '' && (($req_mode == '') || ($req_mode == 'view') || ($req_mode == 'details'))){
            if($this->isCachingAllowed) $this->FinishCaching($cachefile);
        }        
    }

    /**
     * Write css class
     */
    public function WriteCssClass(){
        if(!$this->isCssClassWritten){
            echo $this->nl.'<!-- DataGrid CSS definitions - START -->';
            echo $this->nl.'<link href="'.$this->include_path.'styles/print.css" type="text/css" rel="stylesheet" media="print" />';
            $this->DefineCssClass();
            // if we in Print Mode
            if($this->isPrinting){
                $this->rowColor[0] = '';
                $this->rowColor[1] = '';            
                $this->rowColor[2] = ''; // dark
                $this->rowColor[3] = ''; // light
                $this->rowColor[4] = ''; // row mouse over lighting
                $this->rowColor[5] = ''; // on mouse click
                $this->rowColor[6] = ''; // header (th main) column
                $this->rowColor[7] = ''; // selected row mouse over lighting
                $this->rowColor[8] = '';
                $this->rowColor[9] = '';
                echo $this->nl.'<!--[if IE]><link rel="stylesheet" type="text/css" href="'.$this->include_path.'styles/print/style_IE.css" /><![endif]-->';            
                echo $this->nl.'<link rel="stylesheet" type="text/css" href="'.$this->include_path.'styles/print/style.css" />';
                $this->cssClass = 'print';
            }else{
                if(!$this->IsFileExists($this->directory.'styles/'.$this->cssClass.'/style.css')){
                    $this->cssClass = 'default';
                    if($this->debug) $this->warnings[] = 'Cannot find file: <b>'.$this->include_path.'styles/'.$this->cssClass.'/style.css</b>. Check if this file exists and you use a correct path!';
                }
                echo $this->nl.'<!--[if IE]><link rel="stylesheet" type="text/css" href="'.$this->include_path.'styles/'.$this->cssClass.'/style_IE.css" /><![endif]-->';            
                echo $this->nl.'<link rel="stylesheet" type="text/css" href="'.$this->include_path.'styles/'.$this->cssClass.'/style.css" />';            
            }
            echo $this->nl.'<!-- DataGrid CSS definitions - END -->'.$this->nl.$this->nl;            
            $this->isCssClassWritten = true;            
        }
    }
    
    /**
     * Returns data found result 
     */
    public function IsDataFound(){
        return $this->isDataFound;
    }    

    
    ////////////////////////////////////////////////////////////////////////////
    // Non documented
    ////////////////////////////////////////////////////////////////////////////
    /**
     * Set summarize number format
     *      @param $decimal_places
     *      @param decimal_separator
     *      @param $thousands_separator
     *      @param $sign
     */
    public function SetSummarizeNumberFormat($decimal_places = '2', $decimal_separator = '.', $thousands_separator = ',', $sign = '='){
        $this->summarizeNumberFormat['decimal_places'] = (int)$decimal_places;
        $this->summarizeNumberFormat['decimal_separator'] = $decimal_separator;
        $this->summarizeNumberFormat['thousands_separator'] = $thousands_separator;
        $this->summarizeNumberFormat['sign'] = $sign;
    }

    /**
     * Enable/Unable loading image
     *      @param $display
     */
    public function DisplayLoadingImage($display = true){
        $this->isLoadingImageEnabled = ($display == 'true' || $display === true) ? true : false;
    }    

    /**
     * Returns status of current operation
     */
    public function IsOperationCompleted(){
        return $this->isOperationCompleted;    
    }
    
    /**
     * Sets using of <BASE> tag
     *      @param $ignore
     */
    public function IgnoreBaseTag($ignore = 'false'){
        $this->ignoreBaseTag = (($ignore == 'true') || ($ignore === true)) ? true : false;    
    }

    /**
     * Sets using of absolute path for JavaScript and CSS files
     *      @param $abs_path
     */
    public function UseAbsolutePath($abs_path = 'false'){
        $this->include_path = (($abs_path == 'true') || ($abs_path === true)) ? $this->HTTP_HOST.'/'.$this->directory : $this->directory;
    }
    
    /**
     * ExecuteSQL - returns dataSet after executing custom SQL statement
     *      @param $sql
     */
    public function ExecuteSQL($sql = ''){
        $dSet = '';
        if($this->dbHandler){
            if($sql != ''){
                $this->SetEncodingOnDatabase();
                $dSet = $this->dbHandler->query($sql);
            }
            if($this->debug){
                if($this->CheckIsError($dSet)) $debugInfo = '<tr><td>'.$dSet->getDebugInfo().'</td></tr>'; else $debugInfo = ''; 
                echo '<table width="'.$this->tblWidth[$this->mode].'"><tr><td align="left"><label class="'.$this->cssClass.'_dg_label"><b>sql: </b>'.$sql.'</label></td></tr>'.$debugInfo.'</table><br />';
            }               
        }else{
            $this->AddWarning('ExecuteSQL() method', 'This method must be called after DataSource() method only!');
        }
        return $dSet;               
    }

    /**
     * SelectSqlItem - returns the first field after executing custom SELECT SQL statement
     *      @param $sql
     */
    public function SelectSqlItem($sql = ''){
        $dataField = '';
        $num_cols = '0';
        if($this->dbHandler){       
            if($sql != ''){
                $this->SetEncodingOnDatabase();
                if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ORDERED); 
                $dSet = $this->dbHandler->query($sql);
                if($num_cols = $this->NumberCols($dSet)){
                   $row = $this->dgFetchRow($dSet);                         
                   $dataField = $row[0];
                }
                if($this->debug){
                    if($this->CheckIsError($dSet)) $debugInfo = '<br>'.$dSet->getDebugInfo(); else $debugInfo = '';
                    $this->sqlStatements[] = '<div class="'.$this->cssClass.'_dg_sql_message"><i>Retrieve data for SELECT SQL:</i><br><b>select sql ('.Helper::ConvertCase($this->lang['total'],'lower',$this->langName).': '.$num_cols.') </b>'.$sql.'</div>'.$debugInfo;
                }              
            }
        }else{
            $this->AddWarning('SelectSqlItem() method', 'This method must be called after DataSource() method only!');
        }
        return $dataField;               
    }
    
    /**
     * Specify where to allow rows highlighting
     *      @param $option
     */
    public function AllowHighlighting($option = true){
        $this->isRowHighlightingAllowed = (($option === true) || ($option == 'true')) ? true : false;
    }    

    /**
     * Set javascript errors display style
     *      @param $display_style
     */
    public function SetJsErrorsDisplayStyle($display_style = 'all'){        
        $this->jsValidationErrors = ($display_style == 'all') ? 'true' : 'false';
    }    

    /**
     * Get current record ID
     */
    public function GetCurrentId(){
        return ($this->rid != '') ? $this->rid : '';
    }

    /**
     * Get next record ID
     */
    public function GetNextId(){
        if(isset($this->dbHandler)){
            // need to be declined if creating new row was cancelied
            // return $this->dbHandler->nextId('\''.$this->tblName.'\'');            
            $sql  = ' SELECT MAX('.$this->primaryKey.') as max_id FROM '.$this->tblName.' ';
            $dSet = $this->dbHandler->query($sql);
            if($row = $this->dgFetchRow($dSet)){
                return $row[0]+1;
            }
        }else{
            return ;        
        }        
    }

    /**
     * Execute database
     */
    public function Execute($sql){
        if(isset($this->dbHandler)){
            // need to be declined if creating new row was cancelied
            // return $this->dbHandler->nextId('\''.$this->tblName.'\'');
            //$sql  = ' SELECT MAX('.$this->primaryKey.') as max_id FROM '.$this->tblName.' ';
            $rs = $this->dbHandler->query($sql);
            if($rs){
                return true;
            }
            else {
                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * Set messages
     *      @param $messages
     */
    public function SetDgMessages($messages = array()){
        $this->arrDgMessages['add_success'] = (isset($messages['add_success'])) ? $messages['add_success'] : '';        
        $this->arrDgMessages['add_error'] = (isset($messages['add_error'])) ? $messages['add_error'] : '';
        $this->arrDgMessages['update_success'] = (isset($messages['update_success'])) ? $messages['update_success'] : '';
        $this->arrDgMessages['update_error'] = (isset($messages['update_error'])) ? $messages['update_error'] : '';
        $this->arrDgMessages['delete_success'] = (isset($messages['delete_success'])) ? $messages['delete_success'] : '';
        $this->arrDgMessages['delete_error'] = (isset($messages['delete_error'])) ? $messages['delete_error'] : '';
    }

    /**
     * Force database encoding on each connection
     *      @param $force_encoding
     */
    public function ForceDatabaseEncoding($force_encoding = true){
        if($force_encoding == 'false' || $force_encoding === false){
            $this->forceEncodingOnDatabase = false;
        }
    }

    /**
     * Set header names in columnar layout
     *      @param $field_header
     *      @param $field_value_header
     */
    public function SetHeadersInColumnarLayout($field_header = '', $field_value_header = ''){
        $this->fieldHeader = $field_header;
        $this->fieldHeaderValue = $field_value_header;
    }

    /**
     * Set auto-commit
     *      @param $mode
     */
    public function SetAutocommit($mode = true){
        $this->dbAutoCommit = (($mode === true) || ($mode == 'true')) ? true : false;
    }

    /**
     * Set database schema
     *      @param $schema
     */
    public function SetDbSchema($schema = true){
        $this->dbSchema = $schema;
    }

    /**
     * Gets random string
     *      @param $length
     */
    public function GetRandomString($length = 20) {
        return Helper::GetRandomString($length);
    }    

    /**
     * Set Default Timezone
     *      @param $timezone
     */
    public function SetDefaultTimezone($timezone){        
        if($timezone != ''){
            $this->timezone = $timezone;            
            date_default_timezone_set($this->timezone);
        }
    }    

    /**
     * Set Caching Parameters
     *     @param $allowed
     *     @param $lifetime
     */
	function SetCachingParameters($allowed, $lifetime = '5'){		
		if(strtolower($allowed) === 'true' || $allowed == true) $this->isCachingAllowed = true;
		else $this->isCachingAllowed = false;
		// timeout in minutes
		if(is_numeric($lifetime) && $lifetime < 24*60){			
			$this->cacheLifetime = $lifetime;
		}else{
			$this->cacheLifetime = 5; 
		}
	}	

    /**
     * Delete all cache files
     */
	public function DeleteCache(){
		if($hdl = @opendir($this->cacheDir)){
			while(false !== ($obj = @readdir($hdl))){
				if($obj == '.' || $obj == '..' || $obj == '.htaccess') continue; 
				@unlink($this->cacheDir.$obj);
			}
		}
	}    

    /**
     * Set cache directory
     *      @param $dir
     */
    public function SetCacheDirectory($dir){
        $this->cacheDir = $this->directory.$dir;      
    }

    /**
     * Returns a number od current version of DataGrid
     */
    public static function Version(){
        return self::$dgVersion;
    }

    //==========================================================================
    // PROTECTED MEMBER FUNCTIONS 
    //==========================================================================
    /**
     * Set unique names
     *      @param $unique_prefix
     */
    protected function SetUniquePrefix($unique_prefix = ''){
        $this->uniquePrefix = trim($unique_prefix);
        if($this->uniquePrefix == '') $this->AddWarning('', '', 'No prefix was defined for datagrid! For a stable work of this component please define any unique prefix, like: "abc_"');
        else if(!preg_match('/^([a-zA-Z0-9_-]+)$/', $this->uniquePrefix)) $this->AddWarning('', '', 'Illegal Unique Prefix supplied, only alphanumeric characters are permitted!');
        else if(substr($this->uniquePrefix, 0, 3) == 'reg') $this->AddWarning('', '', 'Prefix that starts from "reg" may lead to unstable work of datagrid! Please define another prefix.');
        $this->uniqueRandomPrefix = $this->GetRandomString('5');
    }

    /**
     * Defines CSS class
     */
    protected function DefineCssClass(){
        $nl = "\n";
        echo $nl.'<style type="text/css">.resizable-textarea .grippie { BACKGROUND: url('.$this->directory.'images/grippie.png) #eee no-repeat center 2px; }</style>';
        // read style color definitions
        $file_name = $this->directory.'styles/'.$this->cssClass.'/colors.inc.php';
        if($this->IsFileExists($file_name)){ 
            include($file_name);
            if(isset($rowColor)){
                $this->rowColor[0] = $rowColor[0]; // odd row color 
                $this->rowColor[1] = $rowColor[1]; // even row color
                $this->rowColor[2] = $rowColor[2]; // odd row color in main colomn
                $this->rowColor[3] = $rowColor[3]; // even row color in main colomn
                $this->rowColor[4] = $rowColor[4]; // row mouse over lighting 
                $this->rowColor[5] = $rowColor[5]; // on mouse click 
                $this->rowColor[6] = $rowColor[6]; // header (th main) column
                $this->rowColor[7] = $rowColor[7]; // selected row mouse over lighting
                $this->rowColor[8] = $rowColor[8];
                $this->rowColor[9] = $rowColor[9];
                return true;                
            }
        }
        
        $this->rowColor[0] = '#fcfaf6'; // odd row color 
        $this->rowColor[1] = '#ffffff'; // even row color
        $this->rowColor[2] = '#ebeadb'; // odd row color in main colomn
        $this->rowColor[3] = '#ebeadb'; // even row color in main colomn
        $this->rowColor[4] = '#e2f3fc'; // row mouse over lighting 
        $this->rowColor[5] = '#fdfde7'; // on mouse click 
        $this->rowColor[6] = '#e2e0cb'; // header (th main) column 
        $this->rowColor[7] = '#f9f9e3'; // selected row mouse over lighting
        $this->rowColor[8] = '#fcfaf6';
        $this->rowColor[9] = '#fcfaf6';
    }

    /**
     * Get DataSet
     *      @param $fsort
     *      @param $limit
     *      @param $mode
     *      @param $sort_field
     *      @param $numeric_sort
     *      @param $first_time
     */
    protected function GetDataSet($fsort = '', $limit = '', $mode = '', $sort_field = '', $numeric_sort = false, $first_time = false){
        $this->SetEncodingOnDatabase();
        $sql = '';

        // we need this stupid operation to get a total number of rows in our query
        $this->SetTotalNumberRows($fsort, $limit, $mode, $first_time);

        // we need this stupid operation to change field's offset on field's name
        if(($numeric_sort == true) && ($sort_field != '')){
            $sql = $this->SetSqlByDbType($this->sql, $fsort, ' LIMIT 0, 1');
            $this->dataSet = $this->dbHandler->query($sql);
            $this->sqlSort = str_replace('ABS('.$sort_field.')', 'ABS('.$this->GetFieldName($sort_field-1).')', $this->sqlSort);
        }

        if($limit == ''){
            $sql = $this->SetSqlByDbType($this->sql, $fsort, $this->SetSqlLimitByDbType());
            if($this->dbType == 'PDO'){
                try{
                    $this->dataSet = $this->dbHandler->query($sql);
                }catch(PDOException $e){
                    $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                }
            }else{
                $this->dataSet = $this->dbHandler->query($sql);
            }                
        }

        if($sql == '' && $this->dgGetDbDriverType() == 'ibm'){
            $sql = $this->SetSqlByDbType($this->sql, $fsort, $this->SetSqlLimitByDbType());
            $this->dataSet = $this->dbHandler->query($sql);            
        }
        if($this->CheckIsError()) $this->AddErrors(); 
        
        $this->rows = $this->NumberRows($sql); 
        $this->columns = $this->NumberCols();
        if($this->debug){
            $this->sqlStatements[] = '<div class="'.$this->cssClass.'_dg_sql_message"><i>Retrieve data for current mode:</i><br><b>select sql ('.Helper::ConvertCase($this->lang['total'],'lower',$this->langName).': '.$this->rows.') </b>'.(($sql != '') ? $sql : $this->sql).'</div>';
        }
        $this->rowLower = 0;
        if($this->dgGetDbDriverType() == 'odbc'){
            $this->rowUpper = $this->rowsTotal;            
        }else{
            $this->rowUpper = $this->rows;
        }

        $this->colLower = 0;
        $this->colUpper = $this->columns;        
    }

    /**
     * Get ORDER BY fields list
     */
    protected function GetOrderByList(){
        $orderByList = '';
        for($ind=0; $ind < count($this->defaultSortField); $ind++){
            if($ind != 0) $orderByList .= ',';
            $orderByList .= ' '.$this->defaultSortField[$ind].' '.$this->defaultSortType[$ind];
        }
        return $orderByList;
    }

	/**
	 *	Remove bad chars from input
	 *	  	@param $str - input
	 **/
    protected function RemoveBadChars($str){
        if(!$str) return $str;
        $bad_string = array('%00', '%01', '%20union%20', '/*', '*/union/*', '+union+', 'acustart', 'acuend', 'select', 'drop', 'insert+', 'update+', 'delete+', 'load_file', 'outfile', 'document.cooki', 'onmouse', '%3Cscrip', 'javascript:', '<script', 'script>', 'expression(', '<frame', '<iframe', '<applet', '<meta', '<style', '<form', '<img', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'https://', 'ftp://', 'smb://');

        $str_ = '';
        if(is_array($str)){
            foreach($str as $key => $val) $str_ .= strtolower($val); 
        }else{
            $str_ .= strtolower($str);
        }
        foreach($bad_string as $string_value){
            if(strstr($str_, $string_value)){
                return '';
            }
        }
        return $str;            
    }

    /**
     * Perform security check for possible hack attacks
     */
    protected function SecurityCheck(){
        // check rid variable
        if(preg_match("/'/", $this->rid) || preg_match('/"/', $this->rid) || preg_match('/%27/', $this->rid) || preg_match('/%22/', $this->rid)){
            return false;
        }
        $query_string = strtolower(rawurldecode($this->QUERY_STRING));
        
        if($this->securityLevel == 'low'){
            // check query string
            $bad_string = array('%00', '%01', 'document.cooki', '<script', 'script>', 'expression(', '<frame');
            foreach($bad_string as $string_value){
                if(strstr($query_string, $string_value)){
                    return false;
                }
            }                        
        }
        if($this->securityLevel == 'medium'){
            // check query string
            $bad_string = array('%00', '%01', '%20union%20', '/*', '*/union/*', '+union+', 'document.cooki', '%3Cscrip', 'javascript:', '<script', 'script>', 'expression(', '<frame', '<iframe', '<applet', '<form', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'https://', 'ftp://', 'smb://');
            foreach($bad_string as $string_value){
                if(strstr($query_string, $string_value)){
                    return false;
                }
            }            
        }
        if($this->securityLevel == 'high'){
            // check query string
            $bad_string = array('%00', '%01', '%20union%20', '/*', '*/union/*', '+union+', 'insert+', 'update+', 'delete+', 'load_file', 'outfile', 'document.cooki', 'onmouse', '%3Cscrip', 'javascript:', '<script', 'script>', 'expression(', '<frame', '<iframe', '<applet', '<meta', '<style', '<form', '<img', '<body', '<link', '_GLOBALS', '_REQUEST', '_GET', '_POST', 'include_path', 'prefix', 'http://', 'https://', 'ftp://', 'smb://');
            foreach($bad_string as $string_value){
                if(strstr($query_string, $string_value)){
                    return false;
                }
            }
            if((preg_match('/<[^>]*script*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*object*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*iframe*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*applet*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*meta*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*style*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*form*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*img*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*onmouseover*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/<[^>]*body*\"?[^>]*>/i', $query_string)) ||
                (preg_match('/\([^>]*\"?[^)]*\)/i', $query_string)) || 
                (preg_match('/ftp:\/\//i', $query_string)) || 
                (preg_match('/https:\/\//i', $query_string)) || 
                (preg_match('/http:\/\//i', $query_string)) )
            {
                return false;
            }
        }
        return true;
    }    

    /**
     * Set encoding and collation on database
     */
    protected function SetEncodingOnDatabase(){
        if(!$this->forceEncodingOnDatabase || defined('_DG_DB_ENCODED')) return false;
        
        switch($this->dgGetDbDriverType()){
            case 'ibase':
            case 'firebird': 
            case 'oci8':
            case 'ibm': break;            
            default:
                $sql_variables = array(
                    'character_set_client'  =>$this->encoding,
                    'character_set_server'  =>$this->encoding,
                    'character_set_results' =>$this->encoding,
                    'character_set_database'=>$this->encoding,
                    'character_set_connection'=>$this->encoding,
                    'collation_server'      =>$this->collation,
                    'collation_database'    =>$this->collation,
                    'collation_connection'  =>$this->collation
                );
                foreach($sql_variables as $var => $value){
                    $sql = 'SET '.$var.'='.$value.';';
                    $this->dbHandler->query($sql);
                }
                define('_DG_DB_ENCODED', true);
            break;
        }
    }

    /**
     * Table drawing functions 
     */
    protected function ShowCaption(){
        $print_css_start = ($this->isPrinting) ? '<center>' : '';
        $print_css_end = ($this->isPrinting) ? '</center>' : '';
        echo ($this->caption != '') ? $print_css_start.'<div class="'.$this->cssClass.'_dg_caption">'.$this->caption.'</div>'.$print_css_end.'<p></p>'.chr(13) : '';
    }

    /**
     * Table open tag
     *      @param $style
     *      @param $id_postfix
     */
    protected function TblOpen($style='', $id_postfix=''){
        if($this->scrollingOption == true) {
            $width = ($this->mode == 'view') ?  '100%' : $this->tblWidth[$this->mode];
        }else{
            $width = $this->tblWidth[$this->mode];
        }
        $horizontal_align = ($this->tblAlign[$this->mode] == 'center') ? 'margin-left:auto;margin-right:auto;' : '';
        echo '<table dir="'.$this->direction.'" align="center" id="'.$this->uniquePrefix.'_contentTable'.$id_postfix.'" class="'.$this->cssClass.'_dg_table" style="'.$horizontal_align.$style.'" width="'.$width.'">'.chr(13);        
    }
    
    protected function TblHeadOpen() { echo '<thead>'.chr(13); }
    protected function TblHeadClose() { echo '</thead>'.chr(13); }
    protected function TbodyOpen() { echo '<tbody>'.chr(13);  }    
    protected function TbodyClose(){ echo '</tbody>'.chr(13); }
    protected function TblClose($draw = true) { $output = '</table>'.chr(13); if($draw) echo $output; else return $output; }

    protected function HideDataGrid(){
        if(($this->hideGridBeforeSearch == true) && $this->onSubmitFilter == ''){
            if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo $this->ScriptOpen()."document.getElementById('".$this->uniqueRandomPrefix."loading_image').style.display='none';".$this->ScriptClose();
            return true;
        }
        return false;
    }

    /**
     * TR open tag
     *      @param $id
     *      @param $row_color
     *      @param $height
     */
    protected function RowOpen($id, $row_color='', $height=''){
        $text = '<tr class="dg_tr" style="'.(($row_color != '') ? 'background-color:'.$row_color.';' : '').'" id="'.$this->uniquePrefix.'row_'.$id.'" ';       
        if($height != '') $text .= 'height="'.$height.'" ';
        if(!$this->isPrinting){
            if($this->isRowHighlightingAllowed){
                $text .= ' onclick="onMouseClickRow(\''.$this->uniquePrefix.'\',\''.$id.'\',\''.$this->rowColor[5].'\',\''.$this->rowColor[1].'\',\''.$this->rowColor[0].'\');" ';
                $text .= ' onmouseover="onMouseOverRow(\''.$this->uniquePrefix.'\',\''.$id.'\',\''.$this->rowColor[4].'\',\''.$this->rowColor[7].'\');" ';
                $text .= ' onmouseout="onMouseOutRow(\''.$this->uniquePrefix.'\',\''.$id.'\',\''.$row_color.'\',\''.$this->rowColor[5].'\');" ';
            }            
        }else{
            $text .= ' ';
        }
        $text .= '>'.chr(13);
        echo $text;        
    }
    protected function RowClose() { echo '</tr>'.chr(13); }
    
    /**
     * Main column open tag
     *      @param $align
     *      @param $colSpan
     *      @param $wrap
     *      @param $width
     *      @param $class
     *      @param $style
     */
    protected function MainColOpen($align='left', $colSpan=0, $wrap='', $width='', $class='', $style=''){
        if($class == '') $class = $this->cssClass.'_dg_th';
        $class_align = ($align == '') ? '' : ' dg_'.$align;
        $wrap = ($wrap == '') ? $this->wrap : $wrap;        
        $text = '<th class="'.$class.$class_align.(($wrap == 'nowrap') ? ' dg_nowrap" ' : '" ');
        $text .= 'style="';
        if($this->rowColor[6] != '') $text .= 'background-color:'.$this->rowColor[6].';';
        $text .= ($width !== '') ? 'width:'.$width.';' : '';
        $text .= ($style != '') ? $style : '';
        $text .= '"';
        $text .= ($this->mode != 'edit') ? ' onmouseover="bgColor=\''.$this->rowColor[3].'\';" onmouseout="bgColor=\''.$this->rowColor[6].'\';"' : '';
        $text .= ($colSpan != 0) ? ' colspan="'.$colSpan.'"' : '';                
        $text .= '>';
        echo $text;                
    }    
    protected function MainColClose(){ echo '</th>'.chr(13); }   
    
    /**
     * Main column open tag
     *      @param $align
     *      @param $colSpan
     *      @param $wrap
     *      @param $bgcolor
     *      @param $class_td
     *      @param $width
     *      @param $style
     */
    protected function ColOpen($align='left', $colSpan=0, $wrap='', $bgcolor='', $class_td='', $width='', $style=''){
        if($class_td == '') $class_td = $this->cssClass.'_dg_td';
        $wrap = ($wrap == '') ? $this->wrap : $wrap;
        $class_align = ($align == '') ? '' : ' dg_'.$align;
        $text = '<td class="'.$class_td.$class_align;
        $text .= ($wrap == 'nowrap') ? ' dg_nowrap" ' : '" ';
        $text .= 'style="';
        $text .= ($width !== '')? ' width:'.$width.';' : '';
        $text .= ($bgcolor !== '')? " background-color:".$bgcolor.';" ' : '"';        
        $text .= ($colSpan != 0) ? ' colspan="'.$colSpan.'"' : '';
        $text .= ($style != '') ? ' '.$style : '';
        $text .= '>';
        echo $text;                
    }    
    protected function ColClose() { echo '</td>'.chr(13); }
    
    /**
     * Empty row
     */
    protected function EmptyRow(){
        $this->RowOpen('','');
        $this->ColOpen();$this->ColClose();
        $this->RowClose();                              
    }

    /**
     * Script open tag
     *      @param $br
     *      @param $src
     */
    protected function ScriptOpen($br = '', $src = ''){
        return $br.'<script type="text/javascript"'.(($src != '') ? ' '.$src.'>' : '>'.chr(13).'<!--'.chr(13));
    }

    /**
     * Script close tag
     *      @param $br
     */
    protected function ScriptClose($br = '//-->'){
        $br = (empty($br)) ? '' : chr(13).'//-->'.chr(13);
        return $br.'</script>'.chr(13);
    }

    /**
     * Draw control panel
     */
    protected function DrawControlPanel(){       
        $req_export = $this->GetVariable('export');
        $req_mode   = $this->GetVariable('mode');        
        $myRef_window = $this->uniquePrefix.'myRef';
        $nl = chr(13);
        
        if($this->filteringAllowed || $this->exportingAllowed || $this->printingAllowed || !empty($this->navigationBar)){
            $margin_bottom = 'margin-bottom:'.(($this->layoutType == 'edit') ? '7px;' : '5px;');
            echo '<table border="0" id="printTbl" align="center" style="margin-left:auto;margin-right:auto;'.$margin_bottom.'" width="'.$this->tblWidth[$this->mode].'" cellspacing="1" cellpadding="1">';
            echo '<tr><td align="left">';
            if($this->navigationBar != '') echo $this->navigationBar.' ';
            if($this->mode == 'edit') echo '<label class="'.$this->cssClass.'_dg_label">'.$this->lang['required_fields_msg'].'</label>';
            echo '</td>';        
            if($this->filteringAllowed && (($this->mode != 'edit') && ($this->mode != 'details'))){
                echo '<td align="right" class="dg_nowrap" style="width:20px">';
				$hide_display = ''; 
				$unhide_display = 'display:none;';
				$this->SetFilteringState('not empty', $hide_display, $unhide_display);
                if(!$this->isPrinting){
                    echo '<a id="'.$this->uniquePrefix.'a_hide" style="cursor:pointer;'.$hide_display.'" onclick="return _dgHideUnHideFiltering(\'hide\', \''.$this->uniquePrefix.'\');"><img align="center" src="'.$this->directory.'styles/'.$this->cssClass.'/images/search_hide_b.gif" onmouseover="this.src=\''.$this->directory.'styles/'.$this->cssClass.'/images/search_hide_r.gif\'" onmouseout="this.src=\''.$this->directory.'styles/'.$this->cssClass.'/images/search_hide_b.gif\'" alt="'.$this->lang['hide_search'].'" title="'.$this->lang['hide_search'].'" /></a>';
                    echo '<a id="'.$this->uniquePrefix.'a_unhide" style="cursor:pointer;'.$unhide_display.'" onclick="return _dgHideUnHideFiltering(\'unhide\', \''.$this->uniquePrefix.'\');"><img align="center" src="'.$this->directory.'styles/'.$this->cssClass.'/images/search_unhide_b.gif" onmouseover="this.src=\''.$this->directory.'styles/'.$this->cssClass.'/images/search_unhide_r.gif\'" onmouseout="this.src=\''.$this->directory.'styles/'.$this->cssClass.'/images/search_unhide_b.gif\'" alt="'.$this->lang['unhide_search'].'" title="'.$this->lang['unhide_search'].'" /></a>';
                }
                echo '</td>'.$nl;
            }
            if(!$this->hideGridBeforeSearch || ($this->hideGridBeforeSearch && $this->onSubmitFilter != '')){
                if($this->exportingAllowed && $req_mode != 'add'){
                    if((($req_export == '') || !$this->isPrinting) && ($this->isPrinting == '')){
                        if($this->arrExportingTypes['csv'] == true){
                            echo '<td align="right" style="width:20px;">'.$nl;
                            echo '<a style="cursor:pointer;" onclick="javascript:'.((!$this->isDemo) ? $this->uniquePrefix.'_doPostBack(\'export\',\'\',\''.$this->urlString.'&amp;'.$this->uniquePrefix.'export_type=csv\');' : '_dgBlockedInDemo();').'" class="'.$this->cssClass.'_dg_a">';
                            echo "<img align='center' src='".$this->directory."styles/".$this->cssClass."/images/csv_b.gif'  onmouseover='this.src=\"".$this->directory."styles/".$this->cssClass."/images/csv_r.gif\"' onmouseout='this.src=\"".$this->directory."styles/".$this->cssClass."/images/csv_b.gif\"' alt='".$this->lang['export_to_excel']."' title='".$this->lang['export_to_excel']." (csv)' />";
                            echo '</a></td>'.$nl;
                        }
                        if($this->arrExportingTypes["xls"] == true){
                            echo "<td align='right' style='width: 20px;'>\n";
                            echo "<a style='cursor:pointer;' onclick='javascript:".((!$this->isDemo) ? $this->uniquePrefix."_doPostBack(\"export\",\"\",\"".$this->urlString.'&amp;'.$this->uniquePrefix."export_type=xls\");" : "_dgBlockedInDemo();")."' class='".$this->cssClass."_dg_a'>";
                            echo "<img align='center' src='".$this->directory."styles/".$this->cssClass."/images/xls_b.gif'  onmouseover='this.src=\"".$this->directory."styles/".$this->cssClass."/images/xls_r.gif\"' onmouseout='this.src=\"".$this->directory."styles/".$this->cssClass."/images/xls_b.gif\"' alt='".$this->lang['export_to_excel']."' title='".$this->lang['export_to_excel']." (xls)' />";
                            echo '</a></td>'.$nl;                          
                        }
                        if($this->arrExportingTypes['pdf'] == true){
                            echo "<td align='right' style='width: 20px;'>\n";
                            echo "<a style='cursor:pointer;' onclick='javascript:".((!$this->isDemo) ? $this->uniquePrefix."_doPostBack(\"export\",\"\",\"".$this->urlString.'&amp;'.$this->uniquePrefix."export_type=pdf\");" : "_dgBlockedInDemo();")."' class='".$this->cssClass."_dg_a'>";
                            echo "<img align='center' src='".$this->directory."styles/".$this->cssClass."/images/pdf_b.gif'  onmouseover='this.src=\"".$this->directory."styles/".$this->cssClass."/images/pdf_r.gif\"' onmouseout='this.src=\"".$this->directory."styles/".$this->cssClass."/images/pdf_b.gif\"' alt='".$this->lang['export_to_pdf']."' title='".$this->lang['export_to_pdf']."' />";
                            echo '</a></td>'.$nl;
                        }
                        if($this->arrExportingTypes["xml"] == true){
                            echo "<td align='right' style='width: 20px;'>\n";
                            echo "<a style='cursor:pointer;' onclick='javascript:".((!$this->isDemo) ? $this->uniquePrefix."_doPostBack(\"export\",\"\",\"".$this->urlString.'&amp;'.$this->uniquePrefix."export_type=xml\");" : "_dgBlockedInDemo();")."' class='".$this->cssClass."_dg_a'>";
                            echo "<img align='center' src='".$this->directory."styles/".$this->cssClass."/images/xml_b.gif'  onmouseover='this.src=\"".$this->directory."styles/".$this->cssClass."/images/xml_r.gif\"' onmouseout='this.src=\"".$this->directory."styles/".$this->cssClass."/images/xml_b.gif\"' alt='".$this->lang['export_to_xml']."' title='".$this->lang['export_to_xml']."' />";
                            echo '</a></td>'.$nl;                                                      
                        }
                    }else{
                        echo "<td align='right' style='width:20px;'></td>\n";
                    }                
                }
                if($this->printingAllowed && $req_mode != 'add' && $this->rowsTotal > 0){
                    if(($req_export == '') && !$this->isPrinting){
                        if($this->methodPostBack == 'ajax'){
                            $print_curr_url = $this->CombineUrl($this->GetVariable('mode'), $this->GetVariable('rid'));
                            $this->SetUrlString($print_curr_url, 'filtering', 'sorting', 'paging');
                        }else $print_curr_url = $this->urlString;
                        if($this->methodPostBack == 'ajax') $print_curr_url = str_replace('&', '&amp;', $print_curr_url);
                        echo "<td align='right' style='width:20px;'><a style='cursor:pointer;' onclick='javascript:".$this->uniquePrefix."_doPostBack(\"print\",\"\",\"".$print_curr_url."\");' class='".$this->cssClass."_dg_a'><img align='center' src='".$this->directory."styles/".$this->cssClass."/images/print_b.gif' onmouseover='this.src=\"".$this->directory."styles/".$this->cssClass."/images/print_r.gif\"' onmouseout='this.src=\"".$this->directory."styles/".$this->cssClass."/images/print_b.gif\"' alt='".$this->lang['printable_view']."' title='".$this->lang['printable_view']."' /></a></td>\n";
                    }else{
                        echo "<td align='right'><a style='cursor:pointer;' onclick='window:print();' class='".$this->cssClass."_dg_a no_print' title='".$this->lang['print_now_title']."'>".$this->lang['print_now']."</a></td>\n";
                    }
                }
            }
            if($this->filteringAllowed && ($this->mode == 'view') && ($req_mode != 'update') && ($req_mode != 'delete') && ($req_mode != 'clone')){
                if(!$this->isPrinting){
                    $href_string = ($this->methodPostBack == 'ajax') ? "javascript:".$this->uniquePrefix."_doAjaxRequest(\"".(($this->QUERY_STRING!='') ? '?'.$this->QUERY_STRING : '')."\");" : "document.location.href=self.location;";
                    echo "<td align='right' style='width: 20px;'><a style='cursor:pointer;' onclick='".str_replace('&', '&amp;', $href_string)."' class='".$this->cssClass."_dg_a'><img align='center' src='".$this->directory."styles/".$this->cssClass."/images/recycle.gif' alt='".$this->lang['refresh_page']."' title='".$this->lang['refresh_page']."' /></a></td>";
                }
            }        
            echo '</tr>';
            echo '</table>';
        }else{
            if($this->mode == 'edit'){
                $margin_bottom = ($this->layoutType == 'edit') ? 'margin-bottom:7px;' : 'margin-bottom:5px;';
                echo '<table border="0" id="printTbl" style="margin-left:auto;margin-right:auto;'.$margin_bottom.'" width="'.$this->tblWidth[$this->mode].'" cellspacing="1" cellpadding="1">';
                echo '<tr><td align="left"><label class="'.$this->cssClass.'_dg_label">'.$this->lang['required_fields_msg'].'</label></td></tr>';
                echo '</table>'; 
            }
        }
    }

    /**
     * Export dispatcher 
     */
    protected function ExportTo(){        
        if($this->isDemo) return false;        
        $req_export  = $this->GetVariable('export');
        $export_type = $this->GetVariable('export_type');
        $req_page_size = (isset($_REQUEST[$this->uniquePrefix.'page_size'])) ? $_REQUEST[$this->uniquePrefix.'page_size'] : $this->reqPageSize;
        if($this->exportAll){
            $page_size = $this->rowUpper;
        }else{
            $page_size = ($this->rowLower + $req_page_size);
        }
        
        if($req_export == true){
            if($export_type == 'pdf'){
                $this->ExportToPdf($page_size);
            }else if($export_type == 'xml'){
                $this->ExportToXml($page_size);    
            }else if($export_type == 'xls'){
                $this->ExportToExcel($page_size, 'xls');                
            }else{ 
                $this->ExportToExcel($page_size, 'csv');                
            }
        }
    }

	// gaizers 2012-07-19 
	//will use for export to excel
	
	protected function utf2tis( $string )
	{
		$str = $string;
	 	$res = "";
	 	for ( $i = 0 ; $i < strlen( $str ) ; $i++ )
	 	{
	  		if ( ord( $str[$i] ) == 224 )
	  		{
	   			$unicode = ord( $str[$i+2] ) & 0x3F;
	   			$unicode |= ( ord( $str[$i+1] ) & 0x3F) << 6;
	   			$unicode |= ( ord( $str[$i] ) & 0x0F ) << 12;
	   			$res .= chr( $unicode - 0x0E00 + 0xA0 );
	   			$i += 2;
	  		}
	  		else
	  		{
	   			$res .= $str[$i];
	  		}
	 	}
	 	return $res;
	}


    /**
     * Export to Excel (if you change export file name - change file name length in download.php)
     *      @param $page_size
     *      @param $export_type
     */    
    protected function ExportToExcel($page_size = 0, $export_type = 'csv'){
        // we create the file first
        @chmod($this->directory.$this->exportingDirectory, 0777);
        if($this->debug) $fe = fopen($this->directory.$this->exportingDirectory.'export.'.$export_type, 'w+');
        else $fe = @fopen($this->directory.$this->exportingDirectory.'export.'.$export_type, 'w+');        
        if($fe){
            if($export_type == 'xls'){
            	$content = "\xEF\xBB\xBF";
				//$content .= "<table border='1px'><tr>";
				$content .= "<table border='1px'><tr>";
                //$content .= pack('vvvvvv', 0x809, 0x08, 0x00,0x10, 0x0, 0x0);                
            }else{
                // write BOM to the opened file
                
                if(fwrite($fe, "\xEF\xBB\xBF") == FALSE){ /** leave double quotes, don't use single! **/ 
                    echo $this->lang['file_writing_error'].' (export.csv)';
                    exit;
                }
            }
            
            if($this->layouts[$this->layoutType] == '0'){
                $type = 'tabular';
            }else if($this->layouts[$this->layoutType] == '1'){
                $type = 'columnar';
            }           
            if($type == 'tabular'){
                // fields headers
                $arr_line = array();
                $cell_ind = 0;
                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    // get current column's index (offset)
                    $c = $this->sortedColumns[$c_sorted];
                    $field_name = $this->GetFieldName($c);
                    if($this->CanViewField($field_name)){
                        $value = ucfirst($this->GetHeaderName($field_name, true));
                        if($export_type == 'xls'){
                            $size = strlen($value);
							$content .= "<td>";
                            //$content .= pack('v*', 0x0204, 8 + $size, 0, $cell_ind, 0x00, $size);
                            $content .= $value;
							$content .= "</td>";
                            $cell_ind++;                            
                        }else{
                            $arr_line[] = $value;
                        }                        
                    }
                }
				
					$content .= "</tr>";
                if($export_type == 'csv') fputcsv($fe, $arr_line);
                // fields data
                $row_ind = 1;
				$content .=  "<tr>";
                for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < $page_size)); $r++){
                    $arr_line = array();
                    $cell_ind = 0;
                    $row = $this->dgFetchRow($this->dataSet);               
                    for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                        // get current column's index (offset)
                        $c = $this->sortedColumns[$c_sorted];
                        $field_name = $this->GetFieldName($c);
                        if($this->CanViewField($field_name)){
                            $value = str_replace(',', '', strip_tags($this->GetFieldValueByType($row[$c], $c, $row)));
                            if($export_type == 'xls'){
                                $size = strlen($value);
                                //$content .= pack('v*', 0x0204, 8 + $size, $row_ind, $cell_ind, 0x00, $size);
                                $content .= "<td>";
                                //$content .= "&nbsp;".$value;
								$content .= $value;
								$content .= "</td>";
                                $cell_ind++;                            
                            }else{
                                $arr_line[] = str_replace(',', '', strip_tags($this->GetFieldValueByType($row[$c], $c, $row)));
                            }                            
                        }                        
                    }
					$content .= "</tr>";
                    $row_ind++;
                    if($export_type == 'csv') fputcsv($fe, $arr_line);
                }
				// tom 2012-07-30 modified export excel
				// code sum export to excel
				$checkSessionForExportToExcel = $_SESSION['exportToExcel'];
				if (isset($checkSessionForExportToExcel))
				{
					session_start();
					//var_dump($_SESSION['exportToExcel']);
					$exportToExcel = $_SESSION['exportToExcel'];
					$content .= "<tr>";
					foreach ($exportToExcel as $key => $value) {
						$content .= "<td>";
						// tom แก้ไข เรื่อง export xlc 05/10/55
						if (!is_numeric($value)) {
							//$content .= str_replace(",", "", $value) ;
							$content .= $value;
						}
						else {
							$content .= $value;
						}
						$content .= "</td>";
					}
					$content .= "</tr>";
				}
				// end
				
            }else{
                $row_ind = 1;
                for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < $page_size)); $r++){                   
                    $row = $this->dgFetchRow($this->dataSet);                    
                    for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                        $arr_line = array();
                        // get current column's index (offset)
                        $c = $this->sortedColumns[$c_sorted];
                        $field_name = $this->GetFieldName($c);
                        if($this->CanViewField($field_name)){
                            $field_header = ucfirst($this->GetHeaderName($field_name, true));
                            $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit', 'normal');
                            $fp_save_as = $this->GetFieldProperty($field_name, 'save_as', 'edit', 'normal');
                            if($export_type == 'xls'){
                                $size = strlen($field_header);
                                //$content .= pack('v*', 0x0204, 8 + $size, $row_ind, 0, 0x00, $size);
                                $content .= $field_header;
                                $row_c = ($fp_type == 'file' && $fp_save_as = 'blob') ? '' : $row[$c];
                                $size = strlen($row_c);
                                //$content .= pack('v*', 0x0204, 8 + $size, $row_ind, 1, 0x00, $size);
                                $content .= $row_c;
                            }else{                                
                                $arr_line[] = $field_header;
                                if($this->IsForeignKey($field_name)){
                                    $arr_line[] = str_replace(',', '', $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $field_name, $row[$c], 'view'));
                                }else{
                                    if($this->IsDate($field_name)){                                        
                                        $arr_line[] = str_replace(',', '', $this->MyDate($row[$c], $fp_type));
                                    }else{
                                        $arr_line[] = ($fp_type == 'file' && $fp_save_as = 'blob') ? '' : str_replace(',', '', strip_tags($row[$c]));                                        
                                    }
                                }
                            }
                            $row_ind++;
                        }                        
                        if($export_type == 'csv') fputcsv($fe, $arr_line);
                    }
                    if($export_type == 'xls'){
                        $content .= pack('v*', 0x0204, 8, $row_ind, 0, 0x00, 0);
                        $content .= '';
                        $content .= pack('v*', 0x0204, 8, $row_ind, 1, 0x00, 0);
                        $content .= '';
                        $row_ind++;
                    }
                }    
            }
            if($export_type == 'xls'){
            	$content .= "</table>";
                //echo $content .= pack('vv', 0x0A, 0x00);
				//echo $this->utf2tis($content);
                if(fwrite($fe, $content) == FALSE){ 
                    echo $this->lang['file_writing_error'].' (export.xls)';
                    exit;
                }
            }

            @fclose($fe);
            @chmod($this->directory.$this->exportingDirectory, 0744);    
            echo $this->ExportDownloadFile('export.'.$export_type);
        }else{
            echo '<label class="'.$this->cssClass.'_dg_error_message no_print">'.$this->lang['file_opening_error'];
            if($this->debug) echo ' <strong>'.$this->directory.$this->exportingDirectory.'export.xml</strong>';
            else echo '<br />'.$this->lang['turn_on_debug_mode'];
            echo '</lable>';
            exit;
        }       
    }
    
    /**
     * Export to PDF (if you change export file name - change file name length in download.php)
     *      @param $page_size
     */
    protected function ExportToPdf($page_size = 0) {
        $header = array();
        $data = array();        
       
        if($this->layouts[$this->layoutType] == '0'){
            $type = 'tabular';
        }else if($this->layouts[$this->layoutType] == '1'){
            $type = 'columnar';
        }else{
            $type = 'tabular';
        }
        if($type == 'tabular'){
            // fields headers
            for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                // get current column's index (offset)
                $c = $this->sortedColumns[$c_sorted];
                $field_name = $this->GetFieldName($c);
                if($this->CanViewField($field_name)){
                    $header[] =iconv('UTF-8','TIS-620',ucfirst($this->GetHeaderName($field_name, true))); 
                }
            }
            // fields data
            for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < $page_size)); $r++){                   
                $row = $this->dgFetchRow($this->dataSet);
                $data_content = '';
                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    // get current column's index (offset)
                    $c = $this->sortedColumns[$c_sorted];
                    $field_name = $this->GetFieldName($c);
                    if($this->CanViewField($field_name)){
                        if($this->IsForeignKey($field_name)){
                            $data_content .= str_replace("\t", '', $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $field_name, $row[$c], 'view'));
                        }else{
                            $data_content .= str_replace("\t", '', strip_tags($this->GetFieldValueByType($row[$c], $c, $row)));
                        }                       
                        if($c_sorted < $this->sortedColumnsSize - 1) $data_content .= ';'; 
						
						$data_content = iconv('UTF-8', 'TIS-620', $data_content);
                    }
                }
                $data[]=explode(';',chop(strip_tags($data_content)));
            }            
        }else{
            // fields headers
            $header[] = $this->lang['field'];
            $header[] = $this->lang['field_value'];
            for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < $page_size)); $r++){
                $row = $this->dgFetchRow($this->dataSet);
                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    $data_content = '';
                    // get current column's index (offset)
                    $c = $this->sortedColumns[$c_sorted];
                    $field_name = $this->GetFieldName($c);
                    if($this->CanViewField($field_name)){
                        $data_content = ucfirst($this->GetHeaderName($field_name, true)).';';
                        if($this->IsForeignKey($field_name)){
                            $data_content .= str_replace("\t", '', $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $field_name, $row[$c], 'view'));
                        }else{
                            $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit', 'normal');
                            $fp_save_as = $this->GetFieldProperty($field_name, 'save_as', 'edit', 'normal');
                            if($this->IsDate($field_name)){
                                $data_content .= str_replace("\t", '', $this->MyDate($row[$c], $fp_type));    
                            }else{
                                $data_content .= ($fp_type == 'file' && $fp_save_as = 'blob') ? '' : str_replace("\t", '', $row[$c]);    
                            }
                        }
                        $data[]=explode(';',chop(strip_tags($data_content)));
                    }                    
                }
                $data[]= '';
            }
        }        
		
        // write some content to the opened file.
        define('FPDF_FONTPATH', $this->directory.'modules/fpdf/font/');
        include_once($this->directory.'modules/fpdf/fpdf.php');

        $pdf=new PDF();
        $pdf->SetFont('Arial','B', 8);
        $pdf->AddPage();
        $pdf->FancyTable($header,$data,$type);
        $pdf->Output($this->directory.$this->exportingDirectory.'export.pdf', '', $this->debug);        
        echo $this->ExportDownloadFile('export.pdf');
    }

    /**
     * Export to XML (if you change export file name - change file name length in download.php)
     *      @param $page_size
     */
    protected function ExportToXml($page_size = 0){
        // Let's make sure the we create the file first
        @chmod($this->directory.$this->exportingDirectory, 0777);
        if($this->debug) $fe = fopen($this->directory.$this->exportingDirectory.'export.xml', 'w+');
        else $fe = @fopen($this->directory.$this->exportingDirectory.'export.xml', 'w+');        
        if($fe){
            $somecontent = '<?xml version="1.0" encoding="UTF-8" ?>';                    
            // fields data
            $somecontent .= '<page>';
            for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < $page_size)); $r++){                   
                $row = $this->dgFetchRow($this->dataSet);               
                $somecontent .= '<row'.$r.'>';
                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    // get current column's index (offset)
                    $c = $this->sortedColumns[$c_sorted];
                    $field_name = $this->GetFieldName($c);
                    if($this->CanViewField($field_name)){
                        $header_name = $field_name;
                        $somecontent .= '<'.$header_name.'>';
                        if($this->IsForeignKey($field_name)){
                            $somecontent_temp = str_replace(',', '', $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $field_name, $row[$c], 'view'));
                        }else{
                            $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit', 'normal');
                            $fp_save_as = $this->GetFieldProperty($field_name, 'save_as', 'edit', 'normal');
                            if($this->IsDate($field_name)){
                                $somecontent_temp = $this->MyDate($row[$c], $fp_type);    
                            }else{
                                $somecontent_temp = ($fp_type == 'file' && $fp_save_as = 'blob') ? '' : strip_tags($row[$c]);    
                            }                            
                        }
                        #// [#0035 under check - 19.04.11] fix for encoding for non-english text
                        $somecontent .= htmlentities($somecontent_temp, ENT_COMPAT, 'UTF-8');
                        $somecontent .= '</'.$header_name.'>';
                    }
                }
                $somecontent .= '</row'.$r.'>';
            }
            $somecontent .= '</page>';                        
        
            // write somecontent to the opened file.
            if(fwrite($fe, $somecontent) == FALSE){
                echo $this->lang['file_writing_error'].' (export.xml)';
                exit;
            }                        
            @fclose($fe);
            @chmod($this->directory.$this->exportingDirectory, 0744);
            echo $this->ExportDownloadFile('export.xml');
        }else{
            echo '<label class="'.$this->cssClass.'_dg_error_message no_print">'.$this->lang['file_opening_error'];
            if($this->debug) echo ' <strong>'.$this->directory.$this->exportingDirectory.'export.xml</strong>';
            else echo '<br />'.$this->lang['turn_on_debug_mode'];
            echo '</lable>';
            exit;
        }
    }

    /**
     * Draw filtering
     */
    protected function DrawFiltering(){
		echo $this->filteringOutput;
	}
	
    /**
     * Prepare filtering
     */
    protected function PrepareFiltering(){
        $selSearchType = $this->GetVariable('_ff_selSearchType');
		$req_mode = $this->GetVariable('mode');
        $cols = 0;
		$output = '';

		if(($req_mode == 'add') || ($req_mode == 'edit') || ($req_mode == 'details')) return false;

        if($this->filteringAllowed){
			$this->SetFilteringState();
			$horizontal_align = ($this->tblAlign[$this->mode] == 'center') ? 'margin-left:auto;margin-right:auto;' : '';
            if($this->layouts['filter'] == '2'){                
                $searchset_width = ($this->isPrinting) ? '93%' : '100%';
            }else{
                $searchset_width = ($this->browserName == 'Firefox') ? '99%' : '100%';
            }
            $output .= "<table id='".$this->uniquePrefix."searchset' style='margin-bottom:7px;".$horizontal_align." ".$this->hideDisplay."' width='".$searchset_width."'><tr><td style='text-align:center;'>\n";
            if(!$this->isPrinting){
                if($this->layouts['filter'] == '2'){
                    $output .= "<div class='".$this->cssClass."_dg_fieldset' style='".$horizontal_align."width:".$this->tblWidth['view'].";padding:3px 0px 3px 2px;'>\n";                    
                }else{
                    $output .= "<fieldset class='".$this->cssClass."_dg_fieldset' dir='".$this->direction."' style='".$horizontal_align." width: ".$this->tblWidth['view'].";'>\n";
                    $output .= "<legend class='".$this->cssClass."_dg_legend'>".$this->lang['search_d']."</legend>\n";
                }
            }
            $internal_form_margin = ($this->layouts['filter'] == '2') ? 'margin:0px;padding:0px;' : 'margin:10px;'; 
            $internal_table_width = ($this->layouts['filter'] == '2') ? '100%' : $this->tblWidth[$this->mode];

            $output .= "<form name='frmFiltering".$this->uniquePrefix."' id='frmFiltering".$this->uniquePrefix."' action='' method='".(($this->methodPostBack == "get")?"get":"post")."' style='".$internal_form_margin."'>\n";
            $output .= $this->SaveHttpGetVars(false); 
            $output .= "<table dir='".$this->direction."' class='".$this->cssClass."_dg_filter_table' border='0' id='filterTbl".$this->uniquePrefix."' style='margin-left:auto; margin-right:auto;' width='".$internal_table_width."' cellspacing='1' cellpadding='1'>\n";
            if($this->layouts['filter'] == '0' || $this->layouts['filter'] == '2') $output .= "<tr>\n";
            
            foreach($this->arrFilterFields as $fldName => $fldValue){
                
                $fp_on_js_event     = $this->GetFieldProperty($fldName, 'on_js_event', 'filter', 'normal');
                $fp_calendar_type   = $this->GetFieldProperty($fldName, 'calendar_type', 'filter', 'normal');
                $fp_width           = $this->GetFieldProperty($fldName, 'width', 'filter', 'normal');
                $fp_autocomplete    = $this->GetFieldProperty($fldName, 'autocomplete', 'filter', 'normal');
                $fp_handler         = $this->GetFieldProperty($fldName, 'handler', 'filter', 'normal');
                $fp_maxresults      = $this->GetFieldProperty($fldName, 'maxresults', 'filter', 'normal');
                $fp_shownoresults   = $this->GetFieldProperty($fldName, 'shownoresults', 'filter', 'normal');
                $fp_multiple        = $this->GetFieldProperty($fldName, 'multiple', 'filter', 'normal');
                $fp_multiple_size   = $this->GetFieldProperty($fldName, 'multiple_size', 'filter', 'normal', '4');
                $fp_default         = $this->GetFieldProperty($fldName, 'default', 'filter', 'normal', '');
                $fp_table           = trim($this->GetFieldProperty($fldName, 'table', 'filter', 'normal', ''));
                
                $multiple_parameters = ($fp_multiple) ? $multiple_parameters = "multiple size='".$fp_multiple_size."'" : '';
                if($fp_shownoresults == '') $fp_shownoresults = 'false';
                $field_width = ($fp_width != '') ? "width:".$fp_width.';' : '';                
                // get extension for from/to fields                    
                $fp_field_type = $this->GetFieldProperty($fldName, 'field_type', 'filter', 'normal');
                if($fp_field_type != '') $fp_field_type = "_fo_".$fp_field_type;                    
                
                if($this->layouts['filter'] == '1') $output .= "<tr valign='middle'>\n";
                $fldValue_fields = explode(",", $fldValue['field']);
                // table-filed name with fixed "dot" issue
                $table_field_name = str_replace(".", "_d_", $fp_table)."_".$fldValue_fields[0];

                // full name of field in URL    
                $field_name_in_url = $this->uniquePrefix.'_ff_'.$table_field_name.$fp_field_type;

                if(isset($_REQUEST[$field_name_in_url]) AND ($_REQUEST[$field_name_in_url] != '')){
                    if(!is_array($_REQUEST[$field_name_in_url])) $filter_field_value = stripcslashes($this->GetVariable($field_name_in_url, false));
                    else $filter_field_value = $_REQUEST[$field_name_in_url];  
                }else{
                    $filter_field_value = '';  
                }
                
                $filter_field_value_html = str_replace('"', "&#034;", $filter_field_value); // double quotation mark
                $filter_field_value_html = str_replace("'", "&#039;", $filter_field_value_html); // single quotation mark
                if(!is_array($filter_field_value)) $filter_field_value_html = urldecode($filter_field_value_html);
                $filter_field_operator =  $table_field_name."_operator";
                
                // full opearator of field in URL    
                $operator_name_in_url = $this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type;                

                $output .= "<td ";                
                if($this->layouts['filter'] == '1'){
                    $output .= "align='".(($this->direction == 'rtl') ? 'left' : 'right')."' style='width:50%;'>".$fldName;
                    $output .= "</td><td>".$this->nbsp."</td><td>";
                    $cols +=3;
                }else if($this->layouts['filter'] == '0' || $this->layouts['filter'] == '2'){
                    if($this->tabularColumns != ''){
                        if($this->layouts['filter'] == '0'){
                            $output .= "align='".(($this->direction == 'rtl') ? 'right' : 'left')."'";
                        }else $output .= "align='".(($this->direction == 'rtl') ? 'left' : 'right')."'";
                    }else if($this->layouts['filter'] == '2'){
                        $output .= "align='".(($this->direction == 'rtl') ? 'right' : 'left')."' style='padding-left:2px; padding-right:3px;'";
                        $output .= " nowrap='nowrap'";
                    }else{
                        $output .= "align='center'";
                    }
                    $output .= "> ".$fldName.": ";
                    $cols +=1;
                }else {
                    $output .= "align='".(($this->direction == 'rtl') ? 'left' : 'right')."' style='width:50%;'>".$fldName;
                    $output .= '</td>'.$this->nl;
                    $output .= '<td>'.$this->nbsp.'</td>'.$this->nl;
                    $output .= '<td>';
                    $cols +=2;
                }                
                if(isset($fldValue['show_operator']) && $fldValue['show_operator'] != false && $fldValue['show_operator'] != 'false'){
                    if(!$this->isPrinting){
                        if(isset($_REQUEST[$operator_name_in_url]) && $_REQUEST[$operator_name_in_url] != ''){
                            $filter_operator = $_REQUEST[$operator_name_in_url];                            
                        }else if(isset($fldValue['default_operator']) && $fldValue['default_operator'] != ''){
                            $filter_operator = $fldValue['default_operator'];                            
                        }else{
                            $filter_operator = "=";
                        }
                        $output .= "<select class='".$this->cssClass."_dg_select' name='".$this->uniquePrefix."_ff_".$filter_field_operator."' id='".$this->uniquePrefix."_ff_".$filter_field_operator."'>";
                        $output .= "<option value='='".(($filter_operator == "=")? " selected='selected'" : '').'>'.$this->lang['=']."</option>";
                        $output .= "<option value='&gt;'".(($filter_operator == '>')? " selected='selected'" : '').'>'.$this->lang['>']."</option>";
                        $output .= "<option value='&lt;'".(($filter_operator == "<")? " selected='selected'" : '').'>'.$this->lang['<']."</option>";                        
                        $output .= "<option value='like'".(($filter_operator == "like")? " selected='selected'" : '').'>'.$this->lang['like']."</option>";
                        $output .= "<option value='".urlencode("like%")."'".((urldecode($filter_operator) == "like%")? " selected='selected'" : ''). '>'.$this->lang['like%']."</option>";
                        $output .= "<option value='".urlencode("%like")."'".((urldecode($filter_operator) == "%like")? " selected='selected'" : '').'>'.$this->lang['%like']."</option>";
                        $output .= "<option value='".urlencode("%like%")."'".((urldecode($filter_operator) == "%like%")? " selected='selected'" : '').'>'.$this->lang['%like%']."</option>";
                        $output .= "<option value='not like'".(($filter_operator == "not like")? " selected='selected'" : '').'>'.$this->lang['not_like']."</option>";
                        $output .= "</select>";
                    }else{
                        $output .= (isset($_REQUEST[$operator_name_in_url])) ? "[".$_REQUEST[$operator_name_in_url]."]" : '';                        
                    }
                }else{
                    // set default operator
                    if(isset($fldValue['default_operator']) && $fldValue['default_operator'] != ''){
                        $filter_operator = urlencode($fldValue['default_operator']);
                    }else{
                        $filter_operator = "=";
                    }
                    $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' id='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' value='".$filter_operator."' />";                    
                }
                if($this->layouts['filter'] == '1'){
                    $output .= "</td>\n<td>".$this->nbsp."</td>\n";                    
                    $output .= "<td style='width:50%;' align='".(($this->direction == 'rtl') ? 'right' : 'left')."'>";
                    $cols +=2;
                }else if($this->layouts['filter'] == '0'){    
                    $output .= '<br />';
                }else if($this->layouts['filter'] == '2'){
                    // nothing 
                }else {
                    $output .= "</td>\n<td>".$this->nbsp."</td>\n";
                    $output .= "<td style='width:50%;' align='".(($this->direction == 'rtl') ? 'right' : 'left')."'>";
                    $cols +=2;
                }
                $ff_type = (isset($fldValue['type'])) ? $fldValue['type'] : "" ;
                $ff_view_type = (isset($fldValue['view_type'])) ? $fldValue['view_type'] : "" ;
                if(!$this->isPrinting){
                    // table-filed name with fixed "dot" issue
                    $table_field_name = str_replace(".", "_d_", $fp_table);
                    switch($ff_type){
                        case 'textbox':
                            $fldValue_fields = str_replace(" ", '', $fldValue['field']);
                            $fldValue_fields = explode(",", $fldValue_fields);
                            $count = 0;
                            $onchange_filter_field = '';
                            foreach($fldValue_fields as $fldValue_field){
                                if($count++ > 0){ $onchange_filter_field .= "document.getElementById(\"".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."\").value=this.value;"; }
                            }
                            if(!empty($onchange_filter_field)) $onchange_filter_field = "onchange='".$onchange_filter_field."'";
                            $count = 0;
                            foreach($fldValue_fields as $fldValue_field){
                                if($count++ == 0){
                                    $dgAutoSuggest_function = $dgAutoSuggest_function_text = '';
                                    if($fp_autocomplete == 'true' || $fp_autocomplete === true){
                                        $dgAutoSuggest_function = "_dgAutoSuggest('".$this->directory.$fp_handler."', '".intval($fp_maxresults)."', '".$fp_shownoresults."', '".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."');";
                                        $dgAutoSuggest_function_text = "onfocus=\"".$dgAutoSuggest_function."\"";
                                    }
                                    if($this->onSubmitFilter == '' && $fp_default != '') $filter_field_value_html = $fp_default;
                                    $output .= "<input class='".$this->cssClass."_dg_textbox' style='".$field_width."' type='text' value='".$filter_field_value_html."' name='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type."' id='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type."' ".$dgAutoSuggest_function_text." ".$onchange_filter_field." ".$fp_on_js_event." />";
                                    if($fp_autocomplete == 'true' || $fp_autocomplete === true){
                                        $this->jsCode[] = $dgAutoSuggest_function;
                                        //callback: function (obj) { document.getElementById('testid').value = obj.id; }
                                    }
                                }else{
                                    $filter_field_operator =  $table_field_name."_".$fldValue_field."_operator";
                                    $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."' id='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."' value='".$filter_field_value_html."' />";
                                    $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' id='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' value='".$filter_operator."' />";
                                }
                            }                        
                            break;
                        case "enum":
                        case "dropdownlist":
                            $field_ddl_name = $this->uniquePrefix."_ff_".$table_field_name."_".$fldValue['field'];
                            $field_ddl_name .= ($fp_multiple) ? "[]" : '';
                            $tag_id = $this->uniquePrefix."_ff_".$table_field_name."_".$fldValue['field'].$fp_field_type;
                            $radio_count = '0';

                            if($ff_view_type != 'radiobutton') $output .= " <select class='".$this->cssClass."_dg_select' style='".$field_width."' name='".$field_ddl_name.$fp_field_type."' id='".$tag_id."' ".$fp_on_js_event." ".$multiple_parameters.'>';    
                            if($ff_view_type != 'radiobutton' && !$fp_multiple) $output .= "<option value=''>-- ".$this->lang['any']." --</option>";
                            
                            if(isset($fldValue['source']) && is_array($fldValue['source'])){                                
                                foreach($fldValue['source'] as $val => $opt){                                    
                                    $output .= ($ff_view_type != 'radiobutton') ? "<option value=\"".$val."\" " : "<input class='".$this->cssClass."_dg_radiobutton' type='radio' name='".$field_ddl_name.$fp_field_type."' id='".$tag_id.$radio_count."' value='".$val."' ";
                                    if($filter_field_value != ''){
                                        if($filter_field_value == $val) $output .= ($ff_view_type != 'radiobutton') ? "selected='selected'" : "checked='checked'";
                                    }else if($this->onSubmitFilter == '' && $fp_default != ''){
                                        if($val == $fp_default) $output .= ($ff_view_type != 'radiobutton') ? "selected='selected'" : "checked='checked'";
                                    }
                                    $output .= ($ff_view_type != 'radiobutton') ? '>'.$opt."</option>" : "/><label for='".$tag_id.$radio_count."' class='".$this->cssClass."_dg_label'>".$opt."</label>";
                                    $radio_count++;
                                }
                            }else{
                                if(isset($fldValue['condition']) && trim($fldValue['condition']) !== '') {
                                    $where = $fldValue['condition'];        
                                }else{
                                    $where = " 1=1 ";
                                }                                
                                $fp_field_view = $this->GetFieldProperty($fldName, "field_view", 'filter', 'normal');
                                $fp_show_count = $this->GetFieldPropertyBool($fldName, "show_count", 'filter', false, false);
                                $order_by_field = (isset($fldValue['order_by_field']) && $fldValue['order_by_field'] != '') ? $fldValue['order_by_field'] : $fldValue['field'];
                                $order_type     = ((Helper::ConvertCase((isset($fldValue['order_type']) ? $fldValue['order_type'] : ''),'lower',$this->langName) == "desc")?"DESC":"ASC");
                                if($fp_field_view !== ''){
                                    if($fp_show_count){
                                        $sql = "SELECT ".$fldValue['field'].", ".$fp_field_view.", COUNT(".$fldValue['field'].") as cnt FROM ".$fp_table." WHERE ".$where." GROUP BY ".$fldValue['field']." ORDER BY ".$order_by_field." ".$order_type." ";                                        
                                    }else{
                                        $sql = "SELECT DISTINCT ".$fldValue['field']." ".(($fldValue['field'] != $fp_field_view) ? ", ".$fp_field_view : '')." FROM ".$fp_table." WHERE ".$where." ORDER BY ".$order_by_field." ".$order_type." ";
                                    }
                                    if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ASSOC);
                                    $dSet = $this->dbHandler->query($sql);
                                    if($this->CheckIsError($dSet)){
                                        $this->AddErrors($dSet);
                                    }else{
                                        while($row = $this->dgFetchRow($dSet)){
                                            $selected = '';
                                            $ff_name = $fp_field_view;
                                            if(preg_match("/ as /i", strtolower($ff_name))) $ff_name = substr($ff_name, strpos(strtolower($ff_name), " as ")+4);
                                            if((is_array($filter_field_value) && in_array($row[$fldValue['field']], $filter_field_value)) ||
                                              (!is_array($filter_field_value) && ($row[$fldValue['field']] === $filter_field_value))){
                                                if($filter_field_value != '') $selected = ($ff_view_type != 'radiobutton') ? " selected='selected'" : " checked='checked'";
                                            }else if($this->onSubmitFilter == '' && $fp_default != ''){
                                                if($fp_default == $row[$fldValue['field']]) $selected = ($ff_view_type != 'radiobutton') ? " selected='selected'" : " checked='checked'";
                                            }                                            
                                            if($fp_show_count){
                                                $option_text = $row[$ff_name]." (".$row['cnt'].")";
                                            }else{
                                                $option_text = $row[$ff_name];
                                            }                                            
                                            if($ff_view_type != 'radiobutton') $output .= '<option'.$selected.' value="'.$row[$fldValue['field']].'">'.$option_text.'</option>';
                                            else $output .= "<input".$selected." class='".$this->cssClass."_dg_radiobutton' type='radio' name='".$field_ddl_name.$fp_field_type."' id='".$tag_id.$radio_count."' value=\"".$row[$fldValue['field']]."\" /><label for='".$tag_id.$radio_count."' class='".$this->cssClass."_dg_label'>".$option_text."</label>";
                                            $radio_count++;
                                        }                                        
                                    }
                                }else{
                                    if($fp_show_count){
                                        $sql = "SELECT ".$fldValue['field'].", COUNT(".$fldValue['field'].") as cnt FROM ".$fp_table." WHERE ".$where." GROUP BY ".$fldValue['field']." ORDER BY ".$order_by_field." ".$order_type." ";
                                    }else{
                                        $sql = "SELECT DISTINCT ".$fldValue['field']." FROM ".$fp_table." WHERE ".$where." ORDER BY ".$order_by_field." ".$order_type." ";
                                    }
                                    if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ASSOC); 
                                    $dSet = $this->dbHandler->query($sql);
                                    if($this->CheckIsError($dSet)){
                                        $this->AddErrors($dSet);
                                    }else{
                                        while($row = $this->dgFetchRow($dSet)){
                                            $selected = '';
                                            if(!is_array($filter_field_value)) $filter_field_value = urldecode($filter_field_value); 
                                            if((is_array($filter_field_value) && in_array($row[$fldValue['field']], $filter_field_value)) ||
                                              (!is_array($filter_field_value) && ($row[$fldValue['field']] === $filter_field_value))){
                                                if($filter_field_value != '') $selected = ($ff_view_type != 'radiobutton') ? " selected='selected'" : " checked='checked'";
                                            }else if($this->onSubmitFilter == '' && $fp_default != ''){
                                                if($fp_default == $row[$fldValue['field']]) $selected = ($ff_view_type != 'radiobutton') ? " selected='selected'" : " checked='checked'";
                                            }
                                            if($fp_show_count){
                                                $option_text = $row[$fldValue['field']]." (".$row['cnt'].")";
                                            }else{
                                                $option_text = $row[$fldValue['field']];
                                            }
                                            if($ff_view_type != 'radiobutton') $output .= "<option".$selected." value=\"".$row[$fldValue['field']]."\">".$option_text."</option>";
                                            else $output .= "<input".$selected." class='".$this->cssClass."_dg_radiobutton' type='radio' name='".$field_ddl_name.$fp_field_type."' id='".$tag_id.$radio_count."' value=\"".$row[$fldValue['field']]."\" /><label for='".$tag_id.$radio_count."' class='".$this->cssClass."_dg_label'>".$option_text."</label>";
                                            $radio_count++;
                                        }                                        
                                    }
                                }
                                //[#0039] - without this line datagrid doesn't work with ddl in filtering fields for oci8
                                if($this->dgGetDbDriverType() == "oci8") $this->DataSourceOld($this->dbHandler, $this->sqlView); 
                            }   
                            if($ff_view_type != 'radiobutton') $output .= "</select>";
                            break;
                        case "calendar":
                            $fldValue_fields = str_replace(" ", '', $fldValue['field']);
                            $fldValue_fields = explode(",", $fldValue_fields);
                            // get date format
                            $date_format = isset($fldValue['date_format']) ? $fldValue['date_format'] : '';
                            if(!in_array($date_format, array('date', "datedmy", "datemdy", "datetime", 'time'))) $date_format = 'date'; 
                            $onchange_filter_field = '';
                            
                            if(preg_match("/datetime/i", $date_format)) $maxlength = "19";
                            else if(preg_match("/time/i", $date_format)) $maxlength = "8";
                            else $maxlength = "10";
                            
                            $count = 0;                            
                            foreach($fldValue_fields as $fldValue_field){
                                if($count++ > 0){ $onchange_filter_field .= "onchange='document.getElementById(\"".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."\").value=this.value;'"; }
                            }
                            $count = 0;
                            foreach($fldValue_fields as $fldValue_field){
                                if($count++ == 0){
                                    $title_format = $this->GetDateFormatForFilteringCal($date_format);
                                    if($this->onSubmitFilter == '' && $fp_default != '') $filter_field_value = $fp_default;
                                    $output .= "<input title='".$this->lang['format'].": ".$title_format."' type='text' class='".$this->cssClass."_dg_textbox' style='".$field_width."' value='".Helper::StripQuotes($filter_field_value)."' name='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type."' id='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type."' maxlength='".$maxlength."' ".$onchange_filter_field." ".$fp_on_js_event." />";
                                }else{
                                    $filter_field_operator = $table_field_name."_".$fldValue_field."_operator";
                                    $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."' id='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field."' value='".$filter_field_value."' />";                                    
                                    $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' id='".$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type."' value='".$filter_operator."' />";
                                }
                            }
                            if($fp_calendar_type == 'floating'){
                                $if_format = $this->GetDateFormatForFloatingCal($date_format);
                                $show_time = ($date_format == "datetime" || $date_format == 'time') ? 'true' : 'false';
                                $textbox_id = $this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type;                                
                                $this->jsCode[] = "Calendar.setup({firstDay : ".$this->weekStartingDay.", inputField : '".$textbox_id."', ifFormat : '".$if_format."', showsTime : ".$show_time.", button : 'img_".$textbox_id."'});";
                                $output .= "<img id='img_".$textbox_id."' src='".$this->directory."styles/".$this->cssClass."/images/cal.gif' alt='".$this->lang['set_date']."' title='".$this->lang['set_date']."' align='top' style='cursor:pointer;margin:3px;margin-left:6px;margin-right:6px;border:0px;' ";
                                if($this->methodPostBack == 'ajax') $output .= "onmouseover='javascript:".$this->uniquePrefix."_doOpenFloatingCalendar(\"".$textbox_id."\", \"".$if_format."\", ".$show_time.");'";
                                $output .= " />\n";                                
                            }else{
                                $output .= "<a class='".$this->cssClass."_dg_a2' href=\"javascript:_dgOpenCalendar('".(($this->ignoreBaseTag) ? $this->HTTP_HOST."/" : '').$this->directory."','separator=".$this->dtSeparator."','frmFiltering".$this->uniquePrefix."','','".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue_field.$fp_field_type."','".$date_format."')\"><img src='".$this->directory."styles/".$this->cssClass."/images/cal.gif' alt='".$this->lang['set_date']."' title='".$this->lang['set_date']."' align='top' style='border:0px; MARGIN:3px;margin-left:6px;margin-right:6px;' /></a>".$this->nbsp;
                            }
                            break;
                        default:
                            $output .= "<input class='".$this->cssClass."_dg_textbox' type='text' value='".$filter_field_value_html."' name='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue['field']."' id='".$this->uniquePrefix."_ff_".$table_field_name."_".$fldValue['field']."' />";                                        
                            break;                                       
                    }                                    
                }else{
                    $output .= $filter_field_value;                    
                }
                $output .= "</td>\n";
                if($this->layouts['filter'] == '1') $output .= "</tr>\n";
                else if(($this->layouts['filter'] == '0' || $this->layouts['filter'] == '2') && $this->tabularColumns != '' && $this->tabularColumns > 0){
                    if ($cols % $this->tabularColumns == 0) $output .= "</tr><tr>\n";
                }
            }
            if($this->layouts['filter'] == '2') $cols++; 
            if($this->layouts['filter'] == '0') $output .= "</tr>\n";
            if($this->layouts['filter'] != '2') $output .= "<tr><td ".(($cols > 0) ? "colspan='".$cols."'" : '')." style='height:6px;' align='center'></td></tr>\n";
            if($this->layouts['filter'] != '2') $output .= "<tr>";
            $output .= "<td ".(($this->layouts['filter'] != '2' && $cols > 0) ? "colspan='".$cols."'" : '')." align='".(($this->layouts['filter'] == '2') ? (($this->direction == 'rtl') ? 'left' : 'right') : 'center')."' ".(($this->layouts['filter'] == '2') ? "width='55%'" : '').'>';
            if(count($this->arrFilterFields) > 1){
                if($this->showSearchType){ $output .= $this->lang['search_type'].": "; }
                if(!$this->isPrinting){
                    if($this->showSearchType){
                        $output .= "<select class='".$this->cssClass."_dg_select' name='".$this->uniquePrefix."_ff_"."selSearchType' id='".$this->uniquePrefix."_ff_"."selSearchType'>";
                        $output .= "<option value='0' ".((($selSearchType != '') && ($selSearchType == 0)) ? "selected='selected'" : '').'>'.$this->lang['and']."</option>";
                        $output .= "<option value='1' ".(($selSearchType == 1) ? "selected='selected'" : '').'>'.$this->lang['or']."</option>";            
                        $output .= "</select>";                        
                    }else{
                        $output .= "<input type='hidden' name='".$this->uniquePrefix."_ff_"."selSearchType' id='".$this->uniquePrefix."_ff_"."selSearchType' value='0' />";
                    }                    
                }else{
                    if(($selSearchType != '') && ($selSearchType == 0)){
                        $output .= "[and]";
                    }else if($selSearchType == 1){
                        $output .= "[or]"; 
                    }else{
                        $output .= "[none]";
                    }
                }
            }
            if(!$this->isPrinting){
                if($this->onSubmitFilter != ''){
                    $output .= " <input class='".$this->cssClass."_dg_button' type='button' value='".$this->lang['reset']."' onclick='javascript:".$this->uniquePrefix."_doPostBack(\"reset\");' /> ";
                }
                $output .= " <input class='".$this->cssClass."_dg_button' style='margin-left:5px;margin-right:5px;' type='submit' name='".$this->uniquePrefix."_ff_"."onSUBMIT_FILTER' id='".$this->uniquePrefix."_ff_"."onSUBMIT_FILTER' value='".$this->lang['search']."' /> ";
            }
            $output .= "</td>\n</tr>\n";
            if($this->layouts['filter'] != '2') $output .= "<tr><td ".(($cols > 0) ? "colspan='".$cols."'" : '')." style='height:5px;' align='center'></td></tr>\n";
            $output .= $this->TblClose(false);  
            $output .= "</form>\n";
            if(!$this->isPrinting){
                if($this->layouts['filter'] == '2'){
                    $output .= "</div>\n";    
                }else{
                    $output .= "</fieldset>\n";    
                }                
            }
            $output .= "</td></tr></table>\n";
        }             
        $this->filteringOutput = $output;
    }    
    
	/**
	 * Convert time format 00:00:00 to sec
	 * by tom 
	 */
	 protected function convertTimeToSec($time){
	 	//echo $time;
		//exit();
	 	$seconds = 0;
		list($hour,$minute,$second) = explode(':', (string)$time);
		$seconds += $hour*3600;
		$seconds += $minute*60;
		$seconds += $second;
		return $seconds;
	 }
	 
	/**
	 * Convert sec to time format 60 to 00:01:00
	 * by tom 
	 */
	 protected function convertSecToTime($secs){
	 	$times = array(3600, 60, 1);
		$time = '';
		$tmp = '';
		for($i = 0; $i < 3; $i++) {
			$tmp = floor($secs / $times[$i]);
			if($tmp < 1) {
				$tmp = '00';
			}
			elseif($tmp < 10) {
				$tmp = '0' . $tmp;
			}
  			$time .= $tmp;
  			if($i < 2) {
     			$time .= ':';
      		}
      		$secs = $secs % $times[$i];
   		}
   		return $time;
	 }
	
    /**
     * Draw customized layout - last modifyed 03.07.09
     */
    protected function DrawCustomized(){
        $req_mode = $this->GetVariable('mode');
        $r = '-1';  
       
        $this->ExportTo();
        $this->ShowCaption($this->caption);
        $this->DrawControlPanel();        
        
        if(($this->mode != 'edit') && ($this->mode != 'details')) $this->DrawFiltering();   
        if(($req_mode !== 'add') || ($req_mode == '')) $this->PagingFirstPart();  
        $this->DisplayMessages();
        if($this->pagingAllowed) $this->PagingSecondPart($this->arrUpperPaging, false, true, "Upper");
        if($this->rowLower == $this->rowUpper) echo '<br />';        

        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo "<div id='".$this->uniqueRandomPrefix."loading_image'><table style='margin-left: auto; margin-right: auto;'><tr><td valign='middle'>".$this->lang['loading_data']."</td><td valign='middle'><img src='".$this->directory."images/loading.gif' alt='".$this->lang['loading_data']."'></td></tr></table></div>\n";                
        // hide grid before search
        if($this->HideDataGrid()) return true;
        $this->DrawControlButtonsJS();
        
        if(isset($this->templates[$this->layoutType]['header'])){
            // Add button
            $mode_button = $this->DrawModeButton('add', "javascript:".$this->uniquePrefix."_doPostBack(\"add\",\"".Helper::EncodeParameter('-1', $this->safeMode)."\", \"".$this->urlString."\");", $this->lang['add_new'], $this->lang['add_new_record'], "add.gif", "''", false, '', '', true);
            $template_header = str_replace("[ADD]", $mode_button, $this->templates[$this->layoutType]['header']);            

            // draw sortable headers
            if($this->sortingAllowed){
                $req_sort_field = $this->GetVariable('sort_field');
                $sort_type      = $this->GetVariable('sort_type');
                $page_size      = $this->GetVariable('page_size');
                $req_p          = $this->GetVariable('p');
                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    $c = $this->sortedColumns[$c_sorted];
                    $c_field_name = $this->GetFieldName($c);
                    if($req_sort_field && ($c == ($req_sort_field -1))){
                        if($sort_type == "desc") $sort_type = "asc";
                        else $sort_type = "desc";
                    }else if($sort_type == ''){
                        $sort_type = "asc";    
                    }                    
                    $href_string = $this->amp.$this->uniquePrefix."sort_field=".($c+1).$this->amp.$this->uniquePrefix."sort_type=".$sort_type.$this->amp.$this->uniquePrefix."page_size=".$page_size.$this->amp.$this->uniquePrefix."p=".$req_p;
                    $href_string = "javascript:".$this->uniquePrefix."_doPostBack(\"sort\",\"\",\"".$href_string."\");";
                    $field_titile_tooltip = $this->lang['sort'];                    
                    $header_link = "<a class='".$this->cssClass."_dg_a_header' href='javascript:void(\"sort\");' onclick='".$href_string."' title='".$field_titile_tooltip."'><b>".ucfirst($this->GetHeaderName($c_field_name))."</b>";
                    $header_link .= $this->PrepareTooltip($c_field_name, 'view');
                    $template_header = str_replace("@".$c_field_name."@", $header_link, $template_header);                
                }                            
            }
            echo $template_header;
        }
        
        if($req_mode == 'add' || $req_mode == 'edit' || ($req_mode == 'update' && $this->rid == '-1')){
            $this->SetEditFieldsFormScript();
            //prepare action url for the form
            $combine_url_rid = ($this->multiRows > 1) ? $this->rid : Helper::EncodeParameter($this->rid, $this->safeMode, false);
            $curr_url = $this->CombineUrl('update', $combine_url_rid, $this->amp); 
            $this->SetUrlString($c_curr_url, "filtering", 'sorting', 'paging', $this->amp);
            $curr_url .= $c_curr_url;
            if(($req_mode == 'add') || ($req_mode == 'update' && $this->rid == '-1')){
                $curr_url .= $this->amp.$this->uniquePrefix."new=1";
            }                                
            echo "<form name='".$this->uniquePrefix."frmEditRow' id='".$this->uniquePrefix."frmEditRow' method='post' action='".(($this->methodPostBack == "get") ? $curr_url : '')."'>".chr(13);
            echo "<input type='hidden' name='".$this->uniquePrefix."_operation_randomize_code' value='".$this->GetRandomString(20)."' />".chr(13);
            $this->PrintHiddenFieldsFromUrl($curr_url);
        }
        
        if($req_mode == 'add' || ($req_mode == 'update' && $this->rid == '-1')){  
            if(isset($this->templates[$this->layoutType]['body'])) $template = $this->templates[$this->layoutType]['body'];
            else $template = $this->templates[$this->layoutType];
            foreach($this->columnsEditMode as $key => $val){
                if($this->IsForeignKey($key)){
                    $template = str_replace("{".$key."}", $this->GetForeignKeyInput(-1, $key, '-1', 'edit'), $template);
                }else if(preg_match("/delimiter/i", $key)){
                    $template = str_replace("{".$key."}", $this->GetFieldProperty($key, "inner_html"), $template); 
                }else{
                    $template = str_replace("{".$key."}", $this->GetFieldValueByType('', 0, '', $key), $template);
                }                                
            }            
            // Add button
            $mode_button = $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['create'], $this->lang['create_new_record'], "update.gif", "''", false, $this->nbsp, '', true);
            $template = str_replace("[CREATE]", $mode_button, $template);

            $param = $this->amp.$this->uniquePrefix."new=1";
            $mode_button = $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."verifyCancel(\"-1\", \"".$param."\")", "".$this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, '', true);
            $template = str_replace("[CANCEL]", $mode_button, $template);            
            $template = str_replace("[UPDATE]", '', $template);
            
            echo $template;
        }else{

            for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < ($this->rowLower + $this->reqPageSize))); $r++){                

                // draw column data
                $row = $this->dgFetchRow($this->dataSet);                
                
                if(isset($this->templates[$this->layoutType]['body'])) $template = $this->templates[$this->layoutType]['body'];
                else $template = $this->templates[$this->layoutType];
                
                $ind = ($this->GetFieldOffset($this->primaryKey) != -1) ? $this->GetFieldOffset($this->primaryKey) : 0;                
    
                // Rows numeration
                if($this->rowsNumeration){
                    $page_num = (($this->GetVariable('p') != '') ? $this->GetVariable('p') : '1');        
                    $rows_numeration = (($page_num - 1)* $this->reqPageSize) +  ($r + 1);
                    $template = str_replace("[ROWS_NUMERATION]", $rows_numeration, $template);
                }

                // Multi-row checkboxes
                if($this->isMultirowAllowed){
                    $disable = $this->isPrinting ? "disabled" : '';
                    $checkbox_value = ($row[$this->GetFieldOffset($this->primaryKey)] != -1) ? $row[$this->GetFieldOffset($this->primaryKey)] : '0';
                    $multirow_checkbox = "<input type='checkbox' name='".$this->uniquePrefix."checkbox_".$r."' id='".$this->uniquePrefix."checkbox_".$r."' value='".Helper::EncodeParameter($checkbox_value, $this->safeMode, false)."' ".$disable." />";
                    $template = str_replace("[MULTIROW_CHECKBOX]", $multirow_checkbox, $template);
                }                
    
                // Add button
                $mode_button = $this->DrawModeButton('add', "javascript:".$this->uniquePrefix."_doPostBack(\"add\",\"".Helper::EncodeParameter('-1', $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['add_new'], $this->lang['add_new_record'], "add.gif", "''", false, '', '', true);
                $template = str_replace("[ADD]", $mode_button, $template);
                $template = str_replace("[CREATE]", '', $template);
                
                // Edit button            
                $mode_button = $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."_doPostBack(\"edit\",\"".Helper::EncodeParameter($row[$ind], $this->safeMode)."\");", $this->lang['edit'], $this->lang['edit_record'], "edit.gif", "''", false, $this->nbsp, '', true);
                $template = str_replace("[EDIT]", $mode_button, $template);
                
                // Details button            
                $mode_button = $this->DrawModeButton('details', "javascript:".$this->uniquePrefix."_doPostBack(\"details\",\"".Helper::EncodeParameter($row[$ind], $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['details'], $this->lang['view_details'], "details.gif", "''", false, $this->nbsp, '', true);                        
                $template = str_replace("[DETAILS]", $mode_button, $template);
                
                // Back button            
                // [#0021-1] - ajax for details mode
                $href_string = '';
                if($this->methodPostBack == 'ajax'){
                    $this->SetUrlString($href_string, '', 'sorting', 'paging');
                    $href_string = $this->AddArrayParams($href_string);
                }
                $mode_button = $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"back\",\"".Helper::EncodeParameter($row[$this->GetFieldOffset($this->primaryKey)], $this->safeMode)."\",\"".$href_string."\");", $this->lang['back'], $this->lang['back'], "cancel.gif", "''", false, $this->nbsp, '', true, false);
                $template = str_replace("[BACK]", $mode_button, $template);
    
                // Delete button
                $mode_button = $this->DrawModeButton('delete', "javascript:".$this->uniquePrefix."verifyDelete(\"".Helper::EncodeParameter($row[$ind], $this->safeMode)."\",\"\");", $this->lang['delete'], $this->lang['delete_record'], "delete.gif", "''", false, '', '', true);                        
                $template = str_replace("[DELETE]", $mode_button, $template);

                // Cancel button            
                $mode_button = $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"cancel\",\"".Helper::EncodeParameter($row[$this->GetFieldOffset($this->primaryKey)], $this->safeMode)."\");", $this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, '', true);
                $template = str_replace("[CANCEL]", $mode_button, $template);

                // Update button            
                $mode_button = $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['update'], $this->lang['update_record'], "update.gif", "''", false, $this->nbsp, '', true);
                $template = str_replace("[UPDATE]", $mode_button, $template);

                for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                    // get current column's index (offset)
                    $c = $this->sortedColumns[$c_sorted];
                    $c_field_name = $this->GetFieldName($c);
                    
                    if($c_field_name != '-1'){
                        if($this->IsForeignKey($c_field_name)){
                            $template = str_replace("{".$c_field_name."}", $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $c_field_name, $row[$c], (($req_mode == 'add' || $req_mode == 'edit') ? 'edit' : 'view')), $template);
                        }else{
                            $template = str_replace("{".$c_field_name."}", $this->GetFieldValueByType($row[$c], $c, $row), $template);
                        }                                                        
                    }
                }
                // additional loop for finding "delimiter" fields
                if($req_mode == 'edit' || $req_mode == 'details'){
                    foreach($this->columnsEditMode as $key => $val){
                        if(preg_match("/delimiter/i", $key)) $template = str_replace("{".$key."}", $this->GetFieldProperty($key, "inner_html"), $template); 
                    }
                }
                echo $template;
            } // for           
        }
        
        if($req_mode == 'add' || $req_mode == 'edit'|| ($req_mode == 'update' && $this->rid == '-1')){
            echo "</form>";
        }
        
        if(isset($this->templates[$this->layoutType]['footer'])) echo $this->templates[$this->layoutType]['footer'];            

        // draw empty table       
        if($r == $this->rowLower){ $this->NoDataFound(); }
        if($this->pagingAllowed) $this->PagingSecondPart($this->arrLowerPaging, true, true, 'Lower');

        if($this->mode == 'view' || $req_mode == ''){
            $this->DrawMultiRowBar($r);  // draw multi-row footer cell            
        }
        
        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo $this->ScriptOpen()."document.getElementById('".$this->uniqueRandomPrefix."loading_image').style.display='none';".$this->ScriptClose();       
    }
    
    /**
     * Draw tabular layout
     */
    protected function DrawTabular(){
    	// tom 
    	//$fp_arrayTmpForCheckDataString = array();
		
        $req_mode         = $this->GetVariable('mode');
        $horizontal_align = ($this->tblAlign[$this->mode] == 'center') ? "margin-left: auto; margin-right: auto;" : '';
        $table_align      = ($this->tblAlign[$this->mode] == 'center') ? "align='center'" : '';
       
        $this->ExportTo();
        $this->ShowCaption($this->caption);
        $this->DisplayMessages();
        $this->DrawControlPanel();
        
        if($this->mode != 'edit') $this->DrawFiltering();   
        if(($req_mode !== 'add') || ($req_mode == '')) $this->PagingFirstPart();  
        if($this->pagingAllowed) $this->PagingSecondPart($this->arrUpperPaging, false, true, "Upper");

        // clear array of move row info
        if(isset($_SESSION)) unset($_SESSION[$this->uniquePrefix.'-move']);
        
        //prepare summarize columns array
        // tom modify  30/07/12
        // edit $this->arrSummarizeColumns --  add distinct for Display sum , add dataforsum for export excel 
        foreach($this->columnsViewMode as $key => $val){        
            $fp_summarize = $this->GetFieldPropertyBool($key, "summarize", 'view', false, false);
            if($fp_summarize){ $this->arrSummarizeColumns[$key] = array('sum'=>0, 'count'=>0, 'max'=>0, 'min'=>'', 'distinct' => array(), 'dataforsum' => array()) ; $this->arrExportToExcel = array(); }
        }

        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo "<div id='".$this->uniqueRandomPrefix."loading_image'><table style='margin-left: auto; margin-right: auto;'><tr><td valign='middle'>".$this->lang['loading_data']."</td><td valign='middle'><img src='".$this->include_path."images/loading.gif' alt='".$this->lang['loading_data']."'></td></tr></table></div>\n";                
        // hide grid before search
        if($this->HideDataGrid()) return true;
        $this->DrawControlButtonsJS();    

        // draw add link-button cell        
        if($this->ModeAllowed('add', $this->mode, 'show_button') && isset($this->modes['add']['show_add_button']) && ($this->modes['add']['show_add_button'] == "outside")){
            echo "<table dir='".$this->direction."' border='0' ".$table_align." style='".$horizontal_align."' width='".$this->tblWidth[$this->mode]."'>";
            echo "<tr>";
            echo "<td align='".(($this->direction == "ltr") ? 'left' : 'right')."'><b>";
            $this->DrawModeButton('add', "javascript:".$this->uniquePrefix."_doPostBack(\"add\",\"".Helper::EncodeParameter('-1', $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['add_new'], $this->lang['add_new_record'], "add.gif", "''", false, '', '', false, false);
            echo "</b></td>";
            echo '</tr>';
            echo '</table>';
            $this->modes['add'][$this->mode] = false;
        }

        if($this->scrollingOption && $this->mode == 'view'){
            if($this->browserName == "Firefox") echo "<div class='dg_scroll_outer' style='width:".$this->tblWidth[$this->mode]."'><div class='dg_scroll_inner' style='height:".$this->scrollingHeight."'>";
            else echo "<table cellpadding='0' cellspacing='0' border='0' width='".$this->tblWidth[$this->mode]."' align='".$this->tblAlign[$this->mode]."'><tr><td>\n";
        }        
        $this->TblOpen();        
        
        // *** START DRAWING HEADERS -------------------------------------------
        $this->TblHeadOpen();
        $this->RowOpen('');

            // draw multi-row checkboxes header
            if(($this->isMultirowAllowed) && ($this->rowsTotal > 0)){                
                $this->ColOpen('center',0,'nowrap',$this->rowColor[0], $this->cssClass."_dg_td", "26px");
                echo $this->nbsp;
                $this->ColClose();
            }            
           
            $button_mode = (($this->isWarning && $req_mode == 'update') ? 'view' : $this->mode); /* to prevent error on unique field warnings */
            if($this->ModeAllowed('add', $button_mode, 'show_button')){
                $this->MainColOpen('center', 0, 'nowrap', "8%", $this->cssClass."_dg_th_normal");
                $this->DrawModeButton('add', "javascript:".$this->uniquePrefix."_doPostBack(\"add\",\"".Helper::EncodeParameter('-1', $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['add_new'], $this->lang['add_new_record'], "add.gif", "''", false, '', '', false, false);                        
                $this->MainColClose();
            }else{                
                if($this->ModeAllowed('edit')){
                    $this->MainColOpen('center',0,'nowrap', "2%", $this->cssClass."_dg_th_normal"); echo $this->nbsp; $this->MainColClose();                
                }
            }
            if(($this->rowsNumeration)){
                $this->MainColOpen('center',0,'nowrap', "4%"); echo $this->numerationSign; $this->MainColClose();                
            }

            // draw column headers in add mode
            if(($this->rid == -1) && ($req_mode == 'add')){
                foreach($this->columnsEditMode as $key => $val){                    
                    if($this->GetFieldProperty($key, 'type') != "hidden" && !preg_match("/delimiter/i", $key)){
                        $this->MainColOpen('center',0);
                        echo "<b>".ucfirst($this->GetHeaderName($key))."</b>";                        
                        $this->MainColClose();                        
                    }
                }
            }else{
                if(!$this->rowUpper) $this->sortingAllowed = false;
                $req_sort_field    = $this->GetVariable('sort_field');
                $req_sort_field_by = $this->GetVariable('sort_field_by');
                $req_sort_type     = $this->GetVariable('sort_type');    
                if($req_sort_field){
                    $sort_img = (strtolower($req_sort_type) == "desc") ? $this->directory."styles/".$this->cssClass."/images/s_desc.png" : $this->directory."styles/".$this->cssClass."/images/s_asc.png" ;
                    $sort_img_back = (strtolower($req_sort_type) == "desc") ? $this->directory."styles/".$this->cssClass."/images/s_asc.png" : $this->directory."styles/".$this->cssClass."/images/s_desc.png" ;
                    $sort_alt = (strtolower($req_sort_type) == "desc") ? $this->lang['descending'] : $this->lang['ascending'] ;
                }
                if($this->mode === 'view'){                
                    // draw column headers in view mode                    
                    for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                        // get current column's index (offset)
                        $c = $this->sortedColumns[$c_sorted];
                        $field_name = $this->GetFieldName($c);
                        
                        $fp_sort_by = $this->GetFieldProperty($field_name, "sort_by", 'view');
                        $fp_sort_type = $this->GetFieldProperty($field_name, "sort_type", 'view');
                        $fp_sort_by_offset = $this->GetFieldOffset($fp_sort_by);
                        if($fp_sort_by != '' && $fp_sort_by_offset >= 0){
                            $sort_field_by = $fp_sort_by_offset+1;                            
                        }else{
                            if($fp_sort_by != '' && $fp_sort_by_offset == '-1') $this->AddWarning('', '', "Check carefully 'sort_by' attribute for field '".$field_name."', it may has a wrong data!");
                            $sort_field_by = ''; 
                        }
                        
                        if($this->CanViewField($field_name)){
                            $fp_wrap  = $this->GetFieldProperty($field_name, 'wrap', 'view', 'lower', $this->wrap);
                            $fp_width = $this->GetFieldProperty($field_name, "width", 'view');
                            $field_titile_tooltip = $this->lang['sort'];
                            $fp_sortable = $this->GetFieldPropertyBool($field_name, "sortable", 'view', true, true);
                            $fp_header_align = $this->GetHeaderAlign($field_name);
                            if($this->sortingAllowed && !$this->isPrinting && $req_sort_field && ($c == ($req_sort_field -1))){ $th_css_class = $this->cssClass."_dg_th_selected"; } else { $th_css_class = $this->cssClass."_dg_th" ;};                
                            $this->MainColOpen($fp_header_align, 0, $fp_wrap, $fp_width, $th_css_class);
                            if($this->sortingAllowed && $fp_sortable){
                                $href_string = ''; 
                                $this->SetUrlString($href_string, '', '', 'paging'); // removed filtering for _doPostBack
                                if(isset($_REQUEST[$this->uniquePrefix.'sort_type']) && $_REQUEST[$this->uniquePrefix.'sort_type'] == "asc") $sort_type="desc";
                                else $sort_type="asc";
                                if(!$this->isPrinting){
                                    $href_string .= $this->amp.$this->uniquePrefix."sort_field=".($c+1).$this->amp.$this->uniquePrefix."sort_field_by=".$sort_field_by.$this->amp.$this->uniquePrefix."sort_field_type=".$fp_sort_type.$this->amp.$this->uniquePrefix."sort_type=";
                                    // prepare sorting order by field's type 
                                    if($req_sort_field && ($c == ($req_sort_field -1))){
                                        $href_string .= $sort_type;
                                    }else{
                                        if($this->IsDate($field_name, $this->mode)){ $href_string .= "desc"; }
                                        else{ $href_string .= "asc"; }                                        
                                    }
                                    
                                    //[#0012 - 1] - start
                                    /// old code: $href_string = str_replace('&', '&amp;', str_replace('&amp;', '&', $href_string));
                                    //[#0012 - 1] - end
                                    
                                    //[#0012 - 2] - start
                                    // new code: suggested by kalak
                                    $href_string = $this->AddArrayParams($href_string);
                                    //[#0012 - 2] - end

                                    $href_string = "javascript:".$this->uniquePrefix."_doPostBack(\"sort\",\"\",\"".$href_string."\");";
                                    echo "<a class='".$this->cssClass."_dg_a_header' href='javascript:void(\"sort\");' onclick='".$href_string."' title='".$field_titile_tooltip."' ";
                                    if($req_sort_field && ($c == ($req_sort_field -1))){
                                        echo "onmouseover=\"if(document.getElementById('soimg".$c."')){ document.getElementById('soimg".$c."').src='".$sort_img_back."';  }\" ";
                                        echo "onmouseout=\"if(document.getElementById('soimg".$c."')){ document.getElementById('soimg".$c."').src='".$sort_img."';  }\" ";                                
                                    }
                                    echo "><b>".ucfirst($this->GetHeaderName($field_name))."</b> ";
                                    if($req_sort_field && ($c == ($req_sort_field -1))){
                                        echo $this->nbsp."<img id='soimg".$c."' src='".$sort_img."' alt='".$sort_alt."' title='".$sort_alt."' style='border:0px;' />".$this->nbsp;
                                    }
                                    echo "</a>";
                                }else{
                                    echo "<b>".ucfirst($this->GetHeaderName($field_name))."</b>";                            
                                }
                            }else{                                
                                echo "<b>".ucfirst($this->GetHeaderName($field_name))."</b> ";                        
                            }
                            if(!preg_match("/selected/i", $th_css_class)) echo $this->PrepareTooltip($field_name, 'view');
                            $this->MainColClose();
                        }else{
                            // find problematic fields
                            $f_count = 0;
                            foreach($this->columnsViewMode as $f_key => $f_val){
                                if($c_sorted == $f_count++){
                                    $this->AddWarning('', '', "Field <b>".$f_key."</b>, used in the list of fields in View Mode was not found in SELECT SQL! Please, check carefully your code syntax and field name, it may be case sensitive!");
                                    break;
                                }
                            }                            
                        }
                    }//for
                }else if($this->mode === 'edit'){                    
                    foreach($this->columnsEditMode as $key => $val){
                        if($this->GetFieldProperty($key, 'type') != "hidden"){
                            if($this->CanViewField($key) && !preg_match("/delimiter/i", $key)){
                                $this->MainColOpen('center',0);
                                echo "<b>".ucfirst($this->GetHeaderName($key))."</b>";                        
                                $this->MainColClose();                                
                            }
                        }                        
                    }
                }            
            }
            // draw details/delete headers
            if($this->ModeAllowed('details', '', 'show_button') && $this->controlsDisplayingType != "grouped"){
                $this->MainColOpen('center',0,'nowrap', "6%", $this->cssClass."_dg_th_normal");echo $this->lang['view'];$this->MainColClose();
            }                        
            if($this->ModeAllowed('delete', '', 'show_button') && $this->controlsDisplayingType != "grouped"){
                $this->MainColOpen('center',0,'nowrap', "6%", $this->cssClass."_dg_th_normal");echo $this->lang['delete'];$this->MainColClose();
            }            
        $this->RowClose();
        $this->TblHeadClose();        
        // *** END HEADERS -----------------------------------------------------

        //if we add a new row on linked tabular view mode table (mode 0 <-> 0)
        $quick_exit = false;        
        if((isset($_REQUEST[$this->uniquePrefix.'mode']) && ($_REQUEST[$this->uniquePrefix.'mode'] == 'add')) && ($this->rowLower == 0) && ($this->rowUpper == 0)){
            $this->rowUpper = 1;
            $quick_exit = true;
        }        

        // *** START DRAWING ROWS ----------------------------------------------
        $first_field_name = '';
        $curr_url = '';
        $c_curr_url = '';

        $this->TbodyOpen();
        for($r = $this->rowLower; (($r >=0 && $this->rowUpper >=0) && ($r < $this->rowUpper) && ($r < ($this->rowLower + $this->reqPageSize))); $r++){            
            // add new row (ADD MODE)
            if(($r == $this->rowLower) && ($this->rid == -1) && ($req_mode == 'add')){
                $this->RowOpen($r, $this->rowColor[4]); /* highlight selected row */
                $main_td_color=$this->rowColor[3];
                $curr_url = $this->CombineUrl('update', Helper::EncodeParameter(-1, $this->safeMode, false), $this->amp);
                $this->SetUrlString($c_curr_url, "filtering", 'sorting', 'paging', $this->amp);                
                $curr_url .= $c_curr_url;
                $curr_url .= $this->amp.$this->uniquePrefix."new=1";
                echo "<form name='".$this->uniquePrefix."frmEditRow' id='".$this->uniquePrefix."frmEditRow' method='post' action='".(($this->methodPostBack == "get") ? $curr_url : '')."'>".chr(13);
                echo "<input type='hidden' name='".$this->uniquePrefix."_operation_randomize_code' value='".$this->GetRandomString(20)."' />".chr(13);
                $this->PrintHiddenFieldsFromUrl($curr_url);
                $this->SetEditFieldsFormScript($curr_url);
                // draw multi-row empty cell
                if(($this->isMultirowAllowed) && (!$this->isError)){$this->ColOpen('center',0,'nowrap',$this->rowColor[0], $this->cssClass."_dg_td");echo $this->nbsp;$this->ColClose();}                            
                $buttons  = $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['create'], $this->lang['create_new_record'], "update.gif", "''", false, "&nbsp", "", true);
                $buttons .= $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."verifyCancel(\"-1\", \"".$this->amp.$this->uniquePrefix."new=1\")", "".$this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, "", true);
                if($buttons){ $this->ColOpen('center',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main"); echo $buttons; $this->ColClose(); }                
                $hidden_fields = '';
                foreach($this->columnsEditMode as $key => $val){
                    if($this->GetFieldProperty($key, 'type') != "hidden" && !preg_match("/delimiter/i", $key)){
                        $this->ColOpen('left',0,'nowrap');
                        if($this->IsForeignKey($key)){
                            echo $this->nbsp.$this->GetForeignKeyInput(-1, $key, '-1', 'edit').$this->nbsp;
                        }else{
                            echo $this->GetFieldValueByType('', 0, '', $key);
                        }
                        $this->ColClose();                    
                    }else{
                        $hidden_fields .= $this->GetFieldValueByType('', 0, '', $key);
                    }
                }
                
                if($this->ModeAllowed('delete')) $this->ColOpen('center',0,'nowrap');echo '';$this->ColClose();                
                echo $hidden_fields;
                echo "</form>";                
                $this->RowClose();                
            }
                            
            //if we add a new row on linked tabular view mode table (mode 0 <-> 0) 
            if($quick_exit == true){
                $this->TblClose();
                if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo $this->ScriptOpen()."document.getElementById('".$this->uniqueRandomPrefix."loading_image').style.display='none';".$this->ScriptClose();                
                if(($this->firstFieldFocusAllowed) && ($first_field_name != '')) echo $this->ScriptOpen()."_dgSetFocus(document.forms['".$this->uniquePrefix."frmEditRow']".$this->GetFieldRequiredType($first_field_name).$first_field_name.");".$this->ScriptClose();                
                return;            
            }
            
            $row = $this->dgFetchRow($this->dataSet);
            if($this->dgGetDbDriverType() == 'ibm' && $row[0] == '') break;
            if(($this->mode == 'edit') && $this->GetFieldOffset($this->primaryKey) != '-1' && (intval($this->rid) == intval($row[$this->GetFieldOffset($this->primaryKey)]))){
                $this->RowOpen($r, $this->rowColor[4]); /* highlight selected row */
            }else{
                if($r % 2 == 0) $this->RowOpen($r, $this->rowColor[0]);
                else $this->RowOpen($r, $this->rowColor[1]);
            }
            if($r % 2 == 0) $main_td_color=$this->rowColor[2];
            else $main_td_color=$this->rowColor[3];
            
            // draw multi-row row checkboxes
            if($this->isMultirowAllowed){
                $this->ColOpen('center',0,'nowrap','','');                
                $disable = $this->isPrinting ? "disabled" : '';
                $checkbox_value = ($this->GetFieldOffset($this->primaryKey) != -1) ? $row[$this->GetFieldOffset($this->primaryKey)] : '0';
                echo "<input onclick=\"onMouseClickRow('".$this->uniquePrefix."','".$r."', '".$this->rowColor[5]."', '".$this->rowColor[1]."', '".$this->rowColor[0]."')\" type='checkbox' name='".$this->uniquePrefix."checkbox_".$r."' id='".$this->uniquePrefix."checkbox_".$r."' value='";
                echo Helper::EncodeParameter($checkbox_value, $this->safeMode, false);
                echo "' ".$disable." />";
                $this->ColClose();                
            }
            
            // draw mode buttons
            if($this->ModeAllowed('edit')){
                if(($this->mode == 'edit') && $this->GetFieldOffset($this->primaryKey) != '-1' && (intval($this->rid) == intval($row[$this->GetFieldOffset($this->primaryKey)]))){
                    $curr_url = $this->CombineUrl('update', Helper::EncodeParameter($row[$this->GetFieldOffset($this->primaryKey)], $this->safeMode, false), $this->amp);
                    $this->SetUrlString($c_curr_url, "filtering", 'sorting', 'paging', $this->amp);
                    $curr_url .= $c_curr_url;
                    echo "<form name='".$this->uniquePrefix."frmEditRow' id='".$this->uniquePrefix."frmEditRow' method='post' action='".(($this->methodPostBack == "get") ? $curr_url : '')."'>".chr(13);
                    echo "<input type='hidden' name='".$this->uniquePrefix."_operation_randomize_code' value='".$this->GetRandomString(20)."' />".chr(13);
                    $this->PrintHiddenFieldsFromUrl($curr_url);
                    $this->SetEditFieldsFormScript($curr_url);                    
                    $this->ColOpen('center',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main");
                    $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['update'], $this->lang['update_record'], "update.gif", "''", false, " ", '');
                    $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"cancel\",\"".Helper::EncodeParameter($row[$this->GetFieldOffset($this->primaryKey)], $this->safeMode)."\");", $this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, '');
                    $this->ColClose();
                }else{                    
                    if($this->dgGetDbDriverType() == "oci8" || $this->dgGetDbDriverType() == "odbc"){
                        $row_id = $row[0];
                    }else{
                        $row_id = ($this->GetFieldOffset($this->primaryKey) != '-1') ? $row[$this->GetFieldOffset($this->primaryKey)] : $this->GetFieldOffset($this->primaryKey);                        
                    }
                    $curr_url = $this->CombineUrl('edit', $row_id);
                    $this->SetUrlString($curr_url, "filtering", 'sorting', 'paging');                                            
                    if(isset($_REQUEST[$this->uniquePrefix.'new']) && (isset($_REQUEST[$this->uniquePrefix.'new']) == 1)){
                        $curr_url .= $this->amp.$this->uniquePrefix."new=1";
                    }
                    if($this->ModeAllowed('edit')){
                        // by field Value - link on Edit mode page
                        if(isset($this->modes['edit']['byFieldValue']) && ($this->modes['edit']['byFieldValue'] != '')){
                            if($this->GetFieldOffset($this->modes['edit']['byFieldValue']) == '-1'){
                                if($this->debug){
                                    $this->ColOpen(($this->direction == 'rtl')?'right':'left',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main");
                                    echo $this->nbsp.$this->lang['wrong_field_name']." - ".$this->modes['edit']['byFieldValue'].$this->nbsp;
                                }else{
                                    $this->ColOpen('center',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main");                                    
                                    $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."_doPostBack(\"edit\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\");", $this->lang['edit'], $this->lang['edit_record'], "edit.gif", "''", false, $this->nbsp, '');
                                }
                            }else{
                                $this->ColOpen(($this->direction == 'rtl')?'right':'left',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main");
                                echo $this->nbsp."<a class='".$this->cssClass."_dg_a_header' href='$curr_url'>".$row[$this->GetFieldOffset($this->modes['edit']['byFieldValue'])]."</a>".$this->nbsp;
                            }                            
                        }else{
                            $this->ColOpen('center',0,'nowrap',$main_td_color, $this->cssClass."_dg_td_main", "8%");
                            $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."_doPostBack(\"edit\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['edit'], $this->lang['edit_record'], "edit.gif", "''", false, $this->nbsp, ''); 
                        }
                    }                
                }
                $row_id = ($this->GetFieldOffset($this->primaryKey) != '-1') ? $row[$this->GetFieldOffset($this->primaryKey)] : $this->GetFieldOffset($this->primaryKey);
                if($this->controlsDisplayingType == "grouped") $this->DrawControlButtons($row_id, "grouped", (int)$this->ModeAllowed('edit', '', 'show_button'));
                if($this->ModeAllowed('edit') || ($this->controlsDisplayingType == "grouped")) $this->ColClose();                                            
            }else{
                if($this->ModeAllowed('add')){  
                    $this->ColOpen('center',0,'nowrap',$this->rowColor[2], $this->cssClass."_dg_td_main");$this->ColClose();                    
                }
            }
            
            if($this->rowsNumeration){
                $page_num = (($this->GetVariable('p') != '') ? $this->GetVariable('p') : '1');        
                $rows_numeration = (($page_num - 1)* $this->reqPageSize) +  ($r + 1);
                $this->ColOpen('center',0,'nowrap'); echo "<label class='".$this->cssClass."_dg_label'>".$rows_numeration."</label>"; $this->ColClose();
            }

            // draw column data
            $hidden_fields = '';
			//
            for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                // get current column's index (offset)
                $c = $this->sortedColumns[$c_sorted];
                $col_align = $this->GetFieldAlign($c, $row, $this->mode);
                $c_field_name = $this->GetFieldName($c);
                $fp_wrap = $this->GetFieldProperty($c_field_name, 'wrap', 'view', 'lower', $this->wrap);
                if(($this->mode === 'view') && ($this->CanViewField($c_field_name))){
                    if($req_sort_field == $c+1){
                        $this->ColOpen($col_align, 0, $fp_wrap, (($r % 2 == 0) ? $this->rowColor[8] : $this->rowColor[9]), $this->cssClass."_dg_td_selected"); 
                    }else{
                        $this->ColOpen($col_align, 0, $fp_wrap);
                    }
                    $field_value = $this->GetFieldValueByType($row[$c], $c, $row);
                    $fp_summarize = $this->GetFieldPropertyBool($c_field_name, "summarize", 'view', false, false);
                    $fp_on_item_created = $this->GetFieldProperty($c_field_name, "on_item_created", 'view');
                    if($fp_summarize){
                        // customized working with field value
                        if(function_exists($fp_on_item_created)){
                            //ini_set("allow_call_time_pass_reference", true); 
                            $curr_value = str_replace(",", '', $fp_on_item_created($row[$c]));
                        }else{
                            $curr_value = str_replace(",", '', $row[$c]);
                        }
                        //gaizers 2012-07-18 modified SUM
                        // tomtesttime
                        $fp_type = $this->GetFieldProperty($c_field_name, "type", 'view');
                        switch ($fp_type)
                        {
                        	case "time":
                        		$this->arrSummarizeColumns[$c_field_name]["sum"] += $this->convertTimeToSec($curr_value);
								//$this->arrSummarizeColumns[$c_field_name]["sum"] += $curr_value;
                        		break;
							case "distinct":
								
								if (!in_array($curr_value,$this->arrSummarizeColumns[$c_field_name]["distinct"])) {
									//var_dump($this->arrSummarizeColumns[$c_field_name]["distinct"]);
									array_push($this->arrSummarizeColumns[$c_field_name]["distinct"], $curr_value);
									$this->arrSummarizeColumns[$c_field_name]["sum"] = count($this->arrSummarizeColumns[$c_field_name]["distinct"]);
								}
								//!in_array($fp_summarize_function, array("SUM", "AVG", "MAX", "MIN"))
                        		//$this->arrSummarizeColumns[$c_field_name]["sum"] += count($fp_arrayTmpForCheckDataString);
								//$this->arrSummarizeColumns[$c_field_name]["sum"] += $curr_value;
                        		break;
                        	default:
                        		$this->arrSummarizeColumns[$c_field_name]["sum"] += $curr_value;
                        		break;
                        }
                        //$this->arrSummarizeColumns[$c_field_name]["sum"] += $curr_value;
                        if($curr_value > $this->arrSummarizeColumns[$c_field_name]["max"]) $this->arrSummarizeColumns[$c_field_name]["max"] = $curr_value;                        
                        if($this->arrSummarizeColumns[$c_field_name]["min"] == '') $this->arrSummarizeColumns[$c_field_name]["min"] = $curr_value;
                        else if($curr_value < $this->arrSummarizeColumns[$c_field_name]["min"]) $this->arrSummarizeColumns[$c_field_name]["min"] = $curr_value;
                        // [#0030 under check - 09.11.10] fix for summarize functions
                        ///if($curr_value != '' && intval($curr_value) != '0')....
                        $this->arrSummarizeColumns[$c_field_name]["count"]++;
                    }
                    echo $field_value;
                    $this->ColClose();                    
                }else if($this->mode === 'edit'){
                    if($this->CanViewField($c_field_name)){
                        if($this->GetFieldProperty($c_field_name, 'type') == "hidden"){
                            // don't show hidden fields, even if 'visible'=>'true'
                            $hidden_fields .= $this->GetFieldValueByType('', 0, '', $c_field_name);
                        }else{ 
                            if($first_field_name == '' && !preg_match("/delimiter/i", $c_field_name)) $first_field_name = $c_field_name;
                            if(intval($this->rid) === intval($row[$this->GetFieldOffset($this->primaryKey)])){
                                $this->ColOpen($col_align, 0, $fp_wrap);
                                if($this->IsForeignKey($c_field_name)){                                                
                                    echo $this->nbsp.$this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $c_field_name, $row[$c], 'edit').$this->nbsp;
                                }else{
                                    echo $this->GetFieldValueByType($row[$c], $c, $row); 
                                }
                                $this->ColClose();                                
                            }else{
                                if($this->GetFieldProperty($c_field_name, 'type') != "hidden"){
                                    $this->ColOpen($col_align, 0, $fp_wrap);
                                    if($this->IsForeignKey($c_field_name)){
                                        echo $this->nbsp.$this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $c_field_name, $row[$c],'view').$this->nbsp;
                                    }else if($this->IsEnum($c_field_name)){
                                        if(is_array($this->columnsEditMode[$c_field_name]["source"])){
                                           echo $this->nbsp.(isset($this->columnsEditMode[$c_field_name]["source"][$row[$c]]) ? $this->columnsEditMode[$c_field_name]["source"][$row[$c]] : $row[$c]).$this->nbsp;
                                        }else{
                                           echo $this->GetFieldValueByType($row[$c], $c, $row, '', '', 'view');
                                        }
                                    }else{
                                        if($this->GetFieldPropertyBool($c_field_name, "hide", 'view', false, false)){
                                            echo $this->nbsp."******".$this->nbsp;
                                        }else{
                                            echo $this->GetFieldValueByType($row[$c], $c, $row, '', '', 'view');
                                        }                                
                                    }                                                                 
                                    $this->ColClose();                                
                                }
                            }                            
                        }                        
                    }
                }
            }
            if($this->dgGetDbDriverType() == "oci8" || $this->dgGetDbDriverType() == "odbc"){
                $row_id = $row[0];
            } else{
                $row_id = ($this->GetFieldOffset($this->primaryKey) != '-1') ? $row[$this->GetFieldOffset($this->primaryKey)] : $this->GetFieldOffset($this->primaryKey);                        
            }
            if($this->controlsDisplayingType != "grouped") $this->DrawControlButtons($row_id);

            if(($this->mode == 'edit') && ($this->GetFieldOffset($this->primaryKey) != '-1') && (intval($this->rid) == intval($row[$this->GetFieldOffset($this->primaryKey)]))){ echo $hidden_fields."</form>"; }
            $this->RowClose();
        }
        // *** END ROWS --------------------------------------------------------        
        
        // draw summarizing row
        if($r != $this->rowLower){ $this->DrawSummarizeRow(); }
        $this->TbodyClose();
        $this->TblClose();              
        if($this->scrollingOption && $this->mode == 'view'){
            if($this->browserName == "Firefox") echo "</div></div>";    
            else echo "</td></tr></table>\n";
        }
        
        // draw empty table       
        if($r == $this->rowLower){ $this->NoDataFound(); }
        
        $this->DrawMultiRowBar($r);  // draw multi-row row footer cell

        if($this->pagingAllowed) $this->PagingSecondPart($this->arrLowerPaging, true, true, 'Lower');
        
        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo $this->ScriptOpen()."document.getElementById('".$this->uniqueRandomPrefix."loading_image').style.display='none';".$this->ScriptClose();        
        if(($this->firstFieldFocusAllowed) && ($first_field_name != '')) echo $this->ScriptOpen()."_dgSetFocus(document.".$this->uniquePrefix."frmEditRow.".$this->GetFieldRequiredType($first_field_name).$first_field_name.");".$this->ScriptClose();                
    }    
  
    /**
     * Draw columnar layout
     */
    protected function DrawColumnar(){
        $req_mode = ($this->modeAfterUpdate == '') ? $this->GetVariable('mode') : $this->modeAfterUpdate;
        $hidden_fields = '';
        $r = ''; // rows counter
        $row = array();
        
        $this->ExportTo();
        $this->ShowCaption($this->caption);        
        $this->DrawControlPanel();
        
        if(($this->mode != 'edit') && ($this->mode != 'details')) $this->DrawFiltering();   
        if((($req_mode !== 'add') && ($req_mode !== 'details')) || ($req_mode == '')) $this->PagingFirstPart();  
        $this->DisplayMessages();          
        $this->DrawControlButtonsJS();    
      
        if($this->ModeAllowed('add', $this->mode, 'show_button')){
            $this->TblOpen();
            $this->RowOpen($r, $this->rowColor[0]);            
                $this->MainColOpen('center',0,'nowrap', '', $this->cssClass."_dg_th_normal");
                $this->DrawModeButton('add', "javascript:".$this->uniquePrefix."_doPostBack(\"add\",\"".Helper::EncodeParameter('-1', $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['add_new'], $this->lang['add_new'], "add.gif", "''", true, '', '', false, false);                        
                $this->MainColClose();
            $this->RowClose();
            $this->TblClose();                
        }

        if($this->pagingAllowed) $this->PagingSecondPart($this->arrUpperPaging, false, true, "Upper");

        //prepare action url for the form
        $combine_url_rid = ($this->multiRows > 1) ? $this->rid : Helper::EncodeParameter($this->rid, $this->safeMode, false);
        $curr_url = $this->CombineUrl('update', $combine_url_rid, $this->amp);
        $this->SetUrlString($c_curr_url, "filtering", 'sorting', 'paging', $this->amp);
        $curr_url .= $c_curr_url;
        /// if($req_mode === 'add'){ [#0032-2] fix for unique fields check
        if(($req_mode == 'add') || ($req_mode == 'update' && $this->rid == '-1')){
            $curr_url .= $this->amp.$this->uniquePrefix."new=1";
        }

        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo "<div id='".$this->uniqueRandomPrefix."loading_image'><table align='center'><tr><td valign='middle'>".$this->lang['loading_data']."</td><td valign='middle'><img src='".$this->directory."images/loading.gif' alt='' /></td></tr></table></div>\n";                
        echo "<form style='margin:10px;padding:0px;' name='".$this->uniquePrefix."frmEditRow' id='".$this->uniquePrefix."frmEditRow' method='post' action='".(($this->methodPostBack == "get") ? $curr_url : '')."'>".chr(13);
        echo "<input type='hidden' name='".$this->uniquePrefix."_operation_randomize_code' value='".$this->GetRandomString(20)."' />".chr(13);
        $this->PrintHiddenFieldsFromUrl($curr_url);
        
        // draw hidden fields for Add Mode
        if($this->rid == -1){            
            foreach($this->columnsEditMode as $key => $val){
                if($this->GetFieldProperty($key, 'type') == "hidden" && !$this->GetFieldProperty($key, 'visible')){
                    $hidden_fields .= $this->GetFieldValueByType('', 0, '', $key).chr(13);
                }                
            }
        }
        $this->TblOpen();
        // draw header
        $this->RowOpen($r);
        if($this->mode == 'view' && $this->modes['edit'][$this->mode] == '1'){
            // columnar layout in view mode
            $this->MainColOpen('center',0,'nowrap','10%', (($this->isPrinting) ? $this->cssClass."_dg_td" : $this->cssClass."_dg_th")); $this->MainColClose(); 
        }        
        $this->MainColOpen('center',0,'nowrap','32%', (($this->isPrinting) ? $this->cssClass."_dg_td" : $this->cssClass."_dg_th")); echo "<b>".(($this->fieldHeader != '') ? $this->fieldHeader : $this->lang['field'])."</b>"; $this->MainColClose(); 
        $this->MainColOpen('center',0,'nowrap','68%', (($this->isPrinting) ? $this->cssClass."_dg_td" : $this->cssClass."_dg_th")); echo "<b>".(($this->fieldHeaderValue != '') ? $this->fieldHeaderValue : $this->lang['field_value'])."</b>"; $this->MainColClose(); 
        $this->RowClose();        

        // set number of showing rows on the page
        if(($this->layouts['view'] == '0' || $this->layouts['view'] == '2') && ($this->layouts['edit'] == '1') && ($this->mode == 'edit')){
            if($this->multiRows > 0){
                $this->reqPageSize = $this->multiRows;
            }else{
                $this->reqPageSize = 1;
            }
        }else if(($this->layouts['view'] == '0' || $this->layouts['view'] == '2') && ($this->layouts['edit'] == '1') && ($this->mode == 'details')){
            if($this->multiRows > 0){
                $this->reqPageSize = $this->multiRows;
            }else{
                $this->reqPageSize = 1;
            }            
        }else if(($this->layouts['view'] == '1') && ($this->layouts['edit'] == '1') && ($this->mode == 'edit')){
            $this->reqPageSize = 1;
        }else if(($this->layouts['edit'] == '1') && ($this->mode == 'details')){
            $this->reqPageSize = 1;
        }         

        $first_field_name = ''; /* we need it to set a focus on this field */
        // draw rows in ADD MODE
        if($this->rid == -1){            
            foreach($this->columnsEditMode as $key => $val){
                if($this->GetFieldProperty($key, 'type') == "hidden" && !$this->GetFieldProperty($key, 'visible')) { continue; } /* skip hidden fields */
                if(($first_field_name == '' && !preg_match("/delimiter/i", $key)) && (($this->mode === 'edit') || ($this->mode === 'add'))) $first_field_name = $key;
                if($r % 2 == 0) $this->RowOpen($r, $this->rowColor[0]);
                else $this->RowOpen($r, $this->rowColor[1]);
                
                // prepare alignment for header and data
                $fp_header_align = $this->GetHeaderAlign($key, 'edit');
                $col_header_align = (!empty($fp_header_align)) ? $fp_header_align : (($this->direction == 'rtl') ? 'right' : 'left');
                $fp_align   = $this->GetFieldProperty($key, 'align');
                if($fp_align != '') $col_data_align = $fp_align;
                else $col_data_align = ($this->direction == 'rtl')?'right':'left';                    
                    
                if(preg_match("/delimiter/i", $key)){
                    $this->ColOpen(($this->direction == 'rtl')?'right':'left',2,'wrap');
                        echo $this->GetFieldProperty($key, "inner_html");
                    $this->ColClose();
                }else if($key == "validator"){
                    $fp_for_field = $this->GetFieldProperty("validator", "for_field");
                    $fp_header    = $this->GetFieldProperty("validator", 'header');
                    $fp_req_type  = $this->GetFieldProperty("validator", "req_type");
                    // column's header
                    $this->ColOpen($col_header_align,0,'nowrap');                
                        echo $this->nbsp;echo "<b>".ucfirst($fp_header)."</b>";                        
                    $this->ColClose();
                    // column's data                    
                    $this->ColOpen($col_data_align,0,'nowrap');
                        echo $this->GetFieldValueByType('', 0, '', $fp_for_field, $fp_req_type);
                    $this->ColClose();
                }else{
                    if($this->CanViewField($key)){                    
                        // column's header
                        $this->ColOpen($col_header_align,0,'nowrap');                
                            echo $this->nbsp;echo "<b>".ucfirst($this->GetHeaderName($key))."</b>".$this->PrepareTooltip($key, $this->mode);                        
                        $this->ColClose();
                        // column's data
                        $this->ColOpen($col_data_align,0,'nowrap');
                        if($this->IsForeignKey($key)){
                            echo $this->nbsp.$this->GetForeignKeyInput(-1, $key, '-1', 'edit').$this->nbsp;
                        }else{
                            echo $this->GetFieldValueByType('', 0, '', $key);
                        }
                        $this->ColClose();
                    }
                }
                $this->RowClose();
            }
        }     
        // *** START DRAWING ROWS ----------------------------------------------
        for($r = $this->rowLower; (($this->rid != -1) && ($r < $this->rowUpper) && ($r < ($this->rowLower + $this->reqPageSize))); $r++){
            // draw space between rows
            if(($this->multiRows) > 0 && $r > $this->rowLower && $r > $this->rowLower){
                //$this->RowClose();
                $this->TblClose();
                $this->TblOpen("margin-top:12px;");
                // draw header
                $this->RowOpen($r); echo "<td height='0px' width='32%'></td><td height='0px' width='68%'></td>"; $this->RowClose();
            }
            $row = $this->dgFetchRow($this->dataSet);

            // draw column headers                     
            for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                // get current column's index (offset)
                $c = $this->sortedColumns[$c_sorted];
                
                // turn off highlighting if we use columnar layout in vew mode
                if($this->layoutType == 'view' && $this->layouts['view'] == '1'){
                    $this->isRowHighlightingAllowed = false;
                }            
                $c_field_name = $this->GetFieldName($c);                
                // draw hidden fields for Edit Mode
                if($this->GetFieldProperty($c_field_name, 'type') == "hidden" && !$this->GetFieldProperty($c_field_name, 'visible')){
                    if($this->multiRows > 0){
                        $rid_value = Helper::DecodeParameter($this->rids[$r], $this->safeMode);
                        $multirow_postfix = "_".$rid_value;
                    }else{
                        $rid_value = $this->rid;
                        $multirow_postfix = '';
                    }
                    $hidden_fields .= $this->GetFieldValueByType($row[$c], $c, $row, '', '', '', $multirow_postfix)."\n";                    
                    continue;
                }

                if($r % 2 == 0) $this->RowOpen($r.$c_sorted, $this->rowColor[0]);
                else $this->RowOpen($r.$c_sorted, $this->rowColor[1]);

                // prepare alignment for header and data
                $fp_header_align = $this->GetHeaderAlign($c_field_name, 'edit');
                $col_header_align = (!empty($fp_header_align)) ? $fp_header_align : (($this->direction == 'rtl') ? 'right' : 'left');
                $fp_align   = $this->GetFieldProperty($c_field_name, 'align');
                if($fp_align != '') $col_data_align = $fp_align;
                else $col_data_align = ($this->direction == 'rtl') ? 'right' : 'left';                    
                if($this->CanViewField($c_field_name)){
                    if(($first_field_name == '' && !preg_match("/delimiter/i", $c_field_name)) && (($this->mode === 'edit') || ($this->mode === 'add'))) $first_field_name = $c_field_name;
                    // column headers
                    if($this->mode === 'view'){
                        // columnar layout for view mode
                        if($this->modes['edit'][$this->mode] == '1'){
                            $this->ColOpen($col_header_align,0,'nowrap');
                                if($c_sorted == $this->colLower){
                                    echo $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."_doPostBack(\"edit\",\"".Helper::EncodeParameter($row[0], $this->safeMode)."\");", $this->lang['edit'], $this->lang['edit_record'], "edit.gif", "''", false, $this->nbsp, '', true);
                                }
                            $this->ColClose();                                                
                        }
                        $this->ColOpen($col_header_align,0,'nowrap');                   
                        echo $this->nbsp;echo "<b>".ucfirst($this->GetHeaderName($c_field_name))."</b>".$this->PrepareTooltip($c_field_name, $this->mode);                        
                        $this->ColClose();
                    }else if($this->mode === 'edit'){
                        $this->ColOpen($col_header_align,0,'nowrap', '', '', '', "style='padding-top:5px;' valign='top'");
                        echo $this->nbsp;echo "<b>".ucfirst($this->GetHeaderName($c_field_name))."</b>".$this->PrepareTooltip($c_field_name, $this->mode);                                                    
                        $this->ColClose();
                    }else if($this->mode === 'details'){
                        $this->ColOpen($col_header_align,0,'nowrap');                   
                        echo $this->nbsp;echo "<b>".ucfirst($this->GetHeaderName($c_field_name))."</b>".$this->PrepareTooltip($c_field_name, $this->mode);                        
                        $this->ColClose();
                    }
                    // column data 
                    if($this->mode === 'view'){
                        $fp_wrap = $this->GetFieldProperty($c_field_name, 'wrap', 'view');
                        $this->ColOpen($col_data_align, 0, $fp_wrap);
                            echo $this->GetFieldValueByType($row[$c], $c, $row);
                        $this->ColClose();                    
                    }else if($this->mode === 'details'){
                        $this->ColOpen($col_data_align,0);
                        if($this->IsForeignKey($c_field_name)){
                            echo $this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $c_field_name, $row[$c],'view');
                        }else{
                            echo $this->GetFieldValueByType($row[$c], $c, $row);
                        }
                        $this->ColClose();
                    }else if($this->mode === 'edit'){
                        // if we have multi-rows selected
                        // mr_2
                        if($this->multiRows > 0){
                            $rid_value = Helper::DecodeParameter($this->rids[$r], $this->safeMode);
                            $multirow_postfix = "_".$rid_value;
                        }else{
                            $rid_value = $this->rid;
                            $multirow_postfix = '';
                        }

                        $ind = ($this->GetFieldOffset($this->primaryKey) != -1) ? $this->GetFieldOffset($this->primaryKey) : 0;
                        if(intval($rid_value) === intval($row[$ind])){
                            $this->ColOpen($col_data_align,0,'nowrap');
                            if($this->IsForeignKey($c_field_name)){
                                echo $this->nbsp.$this->GetForeignKeyInput($row[$ind], $c_field_name, $row[$c], 'edit', $multirow_postfix).$this->nbsp;
                            }else{
                                /// mr_3
                                echo $this->GetFieldValueByType($row[$c], $c, $row, '', '', '', $multirow_postfix);
                            }
                            $this->ColClose();
                        }else{
                            $this->ColOpen($col_data_align,0,'nowrap');
                            if($this->rid == -1){
                                // add new row                                    
                                if($this->IsForeignKey($c_field_name)){
                                    echo $this->nbsp.$this->GetForeignKeyInput(-1, $c_field_name, '-1', 'edit').$this->nbsp;
                                }else{
                                    echo $this->GetFieldValueByType('', $c, $row);
                                }                                    
                            }else{
                                if($this->IsForeignKey($c_field_name)){
                                    echo $this->nbsp.$this->GetForeignKeyInput($row[$this->GetFieldOffset($this->primaryKey)], $c_field_name, $row[$c], 'view', $multirow_postfix).$this->nbsp;
                                }else{
                                    /// mr_4
                                    echo $this->GetFieldValueByType($row[$c], $c, $row, '', '', '', $multirow_postfix);                                        
                                }                                    
                            }
                            $this->ColClose();
                        }
                    }
                }else{
                    $ind = 0;                        
                    // if we have multi-rows selected
                    // mr_22
                    if($this->multiRows > 0){
                        $rid_value = Helper::DecodeParameter($this->rids[$r], $this->safeMode);
                        $multirow_postfix = "_".$rid_value;
                    }else{
                        $rid_value = $this->rid;
                        $multirow_postfix = '';
                    }
                    
                    foreach($this->columnsEditMode as $key => $val){
                        if($ind == $c_sorted){
                            if($this->mode != 'details'){
                                if($key == "validator" && $this->GetFieldProperty('validator', 'visible')){ // customized rows (validator)
                                    $fp_for_field = $this->GetFieldProperty($key, 'for_field');
                                    $fp_header    = $this->GetFieldProperty($key, 'header');
                                    $fp_req_type  = $this->GetFieldProperty($key, 'req_type');
                                    $this->ColOpen($col_header_align,0,'nowrap');                   
                                        echo $this->nbsp;echo '<b>'.ucfirst($fp_header).'</b>';                        
                                    $this->ColClose();
                                    $fp_wrap = $this->GetFieldProperty($c_field_name, 'wrap', 'view');
                                    $this->ColOpen($col_data_align, 0, $fp_wrap);
                                        $fp_for_field_offset = $this->GetFieldOffset($fp_for_field);
                                        if($fp_for_field_offset != '-1') echo $this->GetFieldValueByType($row[$fp_for_field_offset], $fp_for_field_offset, $row, '', $fp_req_type, '', $multirow_postfix);
                                    $this->ColClose();                    
                                }                                    
                            }
                            if(preg_match("/delimiter/i", $key)){ // customized rows (delimiter)                                
                                $this->ColOpen('',2,'wrap');
                                echo $this->GetFieldProperty($key, 'inner_html');
                                $this->ColClose();                                            
                            }
                        }
                        $ind++;
                    }
                }
                $this->RowClose();
            }// for            
        }
        // *** END DRAWING ROWS ------------------------------------------------
        
        $this->TblClose();
        echo '<br />';        
        if(($r == $this->rowLower) && ($this->rid != -1)){
            $this->NoDataFound();
            echo "<br /><center>";
            if($this->isPrinting){
                echo "<span class='".$this->cssClass."_dg_a'><b>".$this->lang['back']."</b></span>";                                        
            }else{
                echo "<a class='".$this->cssClass."_dg_a' href='javascript:history.go(-1);'><b>".$this->lang['back']."</b></a>";                    
            }                
            echo "</center>";        
        }else{            
            if($this->layoutType == 'view' && $this->layouts['view'] == '1'){
                // don't draw command buttons bar
            }else{
                if(($this->mode != 'details') && $this->ModeAllowed('edit')){
                    $this->SetEditFieldsFormScript();
                }
                $this->TblOpen('',"_bottom"); 
                $this->RowOpen($r, $this->rowColor[1]);
                $this->MainColOpen('left', 0, '', '', (($this->isPrinting) ? $this->cssClass."_dg_td_normal" : $this->cssClass."_dg_th"), "border-right:#d2d0bb 0px solid;");
                if($this->mode === 'details'){
                    echo "<div style='float:";
                    echo ($this->direction == 'rtl') ? 'left' : 'right';
                    if($this->isPrinting){
                        echo ";'><span class='".$this->cssClass."_dg_a'><b>".$this->lang['back']."</b></span></div>";                                        
                    }else{
                        echo ";'>";
                        // [#0021-2] - ajax for details mode
                        $href_string = '';
                        if($this->methodPostBack == 'ajax'){
                            $this->SetUrlString($href_string, '', 'sorting', 'paging');
                            $href_string = $this->AddArrayParams($href_string);
                        }                        
                        $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"back\",\"".Helper::EncodeParameter($row[$this->GetFieldOffset($this->primaryKey)], $this->safeMode)."\",\"".$href_string."\");", $this->lang['back'], $this->lang['back'], "cancel.gif", "''", false, '', '', false, false);
                        echo '</div>';
                    }
                }else{
                    $ind = ($this->GetFieldOffset($this->primaryKey) != -1) ? $this->GetFieldOffset($this->primaryKey) : 0;                
                    if(($this->rid != -1) && $this->ModeAllowed('delete')){
                        $this->DrawModeButton('delete', "javascript:".$this->uniquePrefix."verifyDelete(\"".Helper::EncodeParameter($row[$ind], $this->safeMode)."\",\"\");", $this->lang['delete'], $this->lang['delete_record'], "delete.gif", "''", true, '', '');                        
                    }
                    if($this->rid != -1){
                        $rid = $row[$ind];
                    }else{
                        $rid = -1;
                    }
                    $curr_url = $this->CombineUrl('update', $rid);
                    $curr_url .= $c_curr_url;
                    
                    if($this->ModeAllowed('edit')){
                        echo "<div style='float:"; echo ($this->direction == 'rtl')?'left':'right'; echo ";'>";    
                        if($this->ModeAllowed("cancel")){
                            /// if($req_mode === 'add'){ [#0032-3] fix for unique fields check
                            if($req_mode === 'add' || ($req_mode === 'update' && $rid == '-1')){ 
                                $param = $this->amp.$this->uniquePrefix."new=1";
                                $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."verifyCancel(\"-1\", \"".$param."\")", "".$this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, '');
                            }else{                            
                                $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"cancel\",\"".Helper::EncodeParameter($rid, $this->safeMode)."\");", $this->lang['cancel'], $this->lang['cancel'], "cancel.gif", "''", false, $this->nbsp, '');
                            }
                        }
                        echo "<img src='".$this->directory."images/spacer.gif' width='20px' height='1px' alt='' />";
                        if($this->rid == -1){ // new record
                            $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['create'], $this->lang['create_new_record'], "update.gif", "''", false, $this->nbsp, '');
                        }else{
                            $this->DrawModeButton('edit', "javascript:".$this->uniquePrefix."sendEditFields();", $this->lang['update'], $this->lang['update_record'], "update.gif", "''", false, $this->nbsp, '');
                        }
                        echo '</div>';
                    }else{
                        echo "<div style='float:"; echo ($this->direction == 'rtl')?'left':'right'; echo ";'>";   
                        $this->DrawModeButton("cancel", "javascript:".$this->uniquePrefix."_doPostBack(\"cancel\",\"".Helper::EncodeParameter($rid, $this->safeMode)."\");", $this->lang['back'], $this->lang['back'], "cancel.gif", "''", false, $this->nbsp, '');
                        echo '</div>';
                    }
                }
                $this->MainColClose();
                $this->RowClose();
                $this->TblClose();                              
            }
        }       
        echo $hidden_fields;        
        echo "</form>";
        if($this->isLoadingImageEnabled && $this->methodPostBack != 'ajax') echo $this->ScriptOpen()."document.getElementById('".$this->uniqueRandomPrefix."loading_image').style.display='none';".$this->ScriptClose();
        
        if($this->pagingAllowed) $this->PagingSecondPart($this->arrLowerPaging, true, true, 'Lower');               
        if(($this->firstFieldFocusAllowed) && ($first_field_name != '')) echo $this->ScriptOpen()."_dgSetFocus(document.".$this->uniquePrefix."frmEditRow.".$this->GetFieldRequiredType($first_field_name).$first_field_name.");".$this->ScriptClose();                
    } 

    /**
     * Draw multi-row bar
     *      @param $row
     */
    protected function DrawMultiRowBar($row){
        $horizontal_align = ($this->tblAlign[$this->mode] == 'center') ? "margin-left: auto; margin-right: auto;" : '';        
        if(($this->isMultirowAllowed) && ($row != $this->rowLower)){
            echo "\n<table dir='".$this->direction."' align='center' border='0' style='".$horizontal_align."' width='".$this->tblWidth[$this->mode]."'>";
            echo "\n<tr>";
            echo "\n<td align='".(($this->direction == "ltr") ? 'left' : 'right')."'>";
            echo "\n<table border='0'>
                  \n<tr>
                    <td align='".(($this->direction == "ltr") ? 'left' : 'right')."' valign='middle' class='dg_nowrap'>";
                        $count = 0;
                        foreach($this->arrMultirowOperations as $key => $val){
                            if($this->arrMultirowOperations[$key]['view']) $count++;
                        }                        
                        echo "<img style='padding:0px;margin:0px;border:0px;' src='".$this->directory."styles/".$this->cssClass."/images/arrow_ltr.png' width='38' height='22' alt='' title='' />";
                        if(!$this->isPrinting){
                            echo "<a class='".$this->cssClass."_dg_a' href='javascript:void(\"check=all\");' onclick='_dgSetCheckboxes(\"".$this->uniquePrefix."\", ".$this->rowLower.", ".$this->rowUpper.", \"".$this->rowColor[5]."\", \"".$this->rowColor[0]."\", \"".$this->rowColor[1]."\", true); return false;'>".$this->lang['check_all']."</a> / <a class='".$this->cssClass."_dg_a' href='javascript:void(\"uncheck=all\");' onclick='_dgSetCheckboxes(\"".$this->uniquePrefix."\", ".$this->rowLower.", ".$this->rowUpper.", \"".$this->rowColor[5]."\", \"".$this->rowColor[0]."\", \"".$this->rowColor[1]."\", false); return false;'>".$this->lang['uncheck_all']."</a>";
                        }else{
                            echo "<a class='".$this->cssClass."_dg_label'>".$this->lang['check_all']."</label> / <a class='".$this->cssClass."_dg_label'>".$this->lang['uncheck_all']."</label>";                                    
                        }
                        if($count > 0){
                            echo "<td align='".(($this->direction == "ltr") ? 'left' : 'right')."' valign='bottom'>
                                    <label class='".$this->cssClass."_dg_label' style='padding-left:10px;padding-right:0px;'><i>".$this->lang['with_selected'].":</i></label>
                                  </td>
                                  <td align='".(($this->direction == "ltr") ? 'left' : 'right')."' valign='bottom'".(($this->browserName != "MSIE")?" style='padding-bottom:3px;'":'').'>';
                            foreach($this->arrMultirowOperations as $key => $val){
                                if($this->arrMultirowOperations[$key]['view']){
                                    echo "<img src='".$this->directory."images/spacer.gif' width='6px' height='5px' alt='' />";
                                    $curr_url = $this->CombineUrl($key, '');
                                    $flag_name = isset($val['flag_name']) ? $val['flag_name'] : '';
                                    $flag_value = isset($val['flag_value']) ? $val['flag_value'] : '';
                                    $tooltip = isset($val['tooltip']) ? $val['tooltip'] : $this->lang[$key.'_selected'];
                                    $image = isset($val['image']) ? $val['image'] : $key.".gif" ;
                                    $this->SetUrlString($curr_url, "filtering", 'sorting', 'paging');
                                    $curr_url = str_replace(array('&','"',"'"), array('&amp;',"&#034;","&#039;"), $curr_url);
                                    $http_get_vars_part = ($this->methodPostBack != "get") ? $this->GetHttpGetVars() : '';
                                    $this->DrawModeButton($key, $curr_url, $tooltip, $tooltip, $image, "\"return _dgJsVerifySelected('".$this->uniquePrefix."', '".$this->rowLower."', '".$this->rowUpper."', '".$this->methodPostBack."', '".$this->GetRandomString(20)."', '$curr_url', '$key', '$flag_name', '$flag_value', '$key', '$http_get_vars_part');\"", false, '', 'image', false, false);
                                }
                            }
                        }                            
            echo "\n</td>\n</tr>\n</table>";
            echo "\n</td>\n</tr>\n</table>";
        }
    }

    /**
     * Draw summarize row
     */
    protected function DrawSummarizeRow(){
        if(count($this->arrSummarizeColumns) > 0){
            $this->RowOpen('', $this->rowColor[0]);            
            // draw multi-row footer cell
            if($this->isMultirowAllowed){
                $this->ColOpen('center',0,'nowrap','','');
                echo $this->nbsp;
                $this->ColClose();            
            }
            
            // draw column headers in view mode                    
            for($c_sorted = $this->colLower; $c_sorted < $this->sortedColumnsSize; $c_sorted++){
                // get current column's index (offset)
                $c = $this->sortedColumns[$c_sorted];
                $c_field_name = $this->GetFieldName($c);
                if($c_sorted == $this->colLower){
                    if($this->ModeAllowed('add') || $this->ModeAllowed('edit')){
                        $this->ColOpen('center',0,'nowrap',$this->rowColor[2], $this->cssClass."_dg_td_main");
                        echo "<a class='".$this->cssClass."_dg_a'><b>".$this->lang['total'].":</b></a>";
                        $this->ColClose();                    
                    }
                    if($this->rowsNumeration){
                       $this->ColOpen('center',0,'nowrap'); echo ''; $this->ColClose();
                    }
                }
                if($this->CanViewField($c_field_name)){
                    $this->ColOpen('right',0,'nowrap');
					// tom create 2012-07-30
					$sExportToExcel = ""; 
                    $fp_summarize = $this->GetFieldPropertyBool($c_field_name, "summarize", 'view', false, false);
                    if($fp_summarize){
                        $fp_summarize_function = strtoupper($this->GetFieldProperty($c_field_name, "summarize_function", 'view'));
                        if(!in_array($fp_summarize_function, array("SUM", "AVG", "MAX", "MIN"))) $fp_summarize_function = $this->summarizeFunction;
                        $fp_summarize_sign = $this->GetFieldProperty($c_field_name, "summarize_sign", 'view');
                        if(empty($fp_summarize_sign)) $fp_summarize_sign = $this->summarizeNumberFormat['sign'];
                        
                        //gaizers customize SUMMARY 2012-07-18
                        $fp_summarize_custom_value = $this->GetFieldProperty($c_field_name, "summarize_custom_value", 'view');

                        if($fp_summarize_function == "SUM"){
                        	 // gaizers 2012-07-18 change value to customize SUM value
                        	 if(empty($fp_summarize_custom_value)) {                        	 
                            	$summarize_value = $this->arrSummarizeColumns[$c_field_name]["sum"];
                             } else {
                             	$summarize_value = $fp_summarize_custom_value;
                             }
                        }else if($fp_summarize_function == "AVG" && $this->arrSummarizeColumns[$c_field_name]["count"] != '0'){
                            $summarize_value = $this->arrSummarizeColumns[$c_field_name]["sum"] / $this->arrSummarizeColumns[$c_field_name]["count"];
                        }else if($fp_summarize_function == "MAX"){
                            $summarize_value = $this->arrSummarizeColumns[$c_field_name]["max"];
                        }else if($fp_summarize_function == "MIN"){
                            $summarize_value = $this->arrSummarizeColumns[$c_field_name]["min"];
                        }else{
                            $summarize_value = 0;
                        }
                        
                        //gaizers change default output formatOutput
                        // tomtesttime
                        // if not have custom value we will use sum value 
                        if(empty($fp_summarize_custom_value)) {
                        	$fp_type = $this->GetFieldProperty($c_field_name, "type", 'view');
	                        switch ($fp_type)
	                        {
	                        	case "time":
	                        		echo $this->nbsp."<a class='".$this->cssClass."_dg_a'><b>".$fp_summarize_sign.$this->convertSecToTime($summarize_value)."</b></a>"; 
									$sExportToExcel =  $fp_summarize_sign.$this->convertSecToTime($summarize_value);                       
	                        		break;
								case "distinct":
	                        		echo $this->nbsp."<a class='".$this->cssClass."_dg_a'><b>".$fp_summarize_sign.$summarize_value."</b></a>"; 
									$sExportToExcel = $fp_summarize_sign.$summarize_value;                         
	                        		break;
	                        	default:
	                        		echo $this->nbsp."<a class='".$this->cssClass."_dg_a'><b>".$fp_summarize_sign.number_format($summarize_value, (($this->summarizeNumberFormat['decimal_places'] > 0) ? $this->summarizeNumberFormat['decimal_places'] : '0') , $this->summarizeNumberFormat['decimal_separator'], $this->summarizeNumberFormat['thousands_separator'])."</b></a>";                         
	                        		$sExportToExcel = $fp_summarize_sign.number_format($summarize_value, (($this->summarizeNumberFormat['decimal_places'] > 0) ? $this->summarizeNumberFormat['decimal_places'] : '0') , $this->summarizeNumberFormat['decimal_separator'], $this->summarizeNumberFormat['thousands_separator']);   
	                        		break;
	                        }  
                        	//echo $this->nbsp."<a class='".$this->cssClass."_dg_a'><b>".$fp_summarize_sign.number_format($summarize_value, (($this->summarizeNumberFormat['decimal_places'] > 0) ? $this->summarizeNumberFormat['decimal_places'] : '0') , $this->summarizeNumberFormat['decimal_separator'], $this->summarizeNumberFormat['thousands_separator'])."</b></a>";                        
                        } else { // we use custom value (replace sum value)
                        	echo $this->nbsp."<a class='".$this->cssClass."_dg_a'><b>".$fp_summarize_sign.$summarize_value."</b></a>";
							$sExportToExcel = $fp_summarize_sign.$summarize_value;                     
                        }
                    }
                    // gaizers 2012-07-30
                    // test echo some empty value 
                    else 
                    {
                       //echo "HELLO";
                       $sExportToExcel = "";
                    }

					// tom 2012-07-30
					// get sum to session
					array_push($this->arrExportToExcel, $sExportToExcel);
					session_start();
					$_SESSION["exportToExcel"] = $this->arrExportToExcel;
					// end
					
                    $this->ColClose();
                }                
            }
            if($this->controlsDisplayingType != "grouped"){
                if($this->ModeAllowed('details', '', 'show_button')){
                    $this->ColOpen('right',0,'nowrap');$this->ColClose();
                }        
                if($this->ModeAllowed('delete', '', 'show_button')){
                    $this->ColOpen('right',0,'nowrap');$this->ColClose();
                }                        
            }
            $this->RowClose();
        }    
    }

    /**
     * Sort columns by mode order
     *      @param $mode
     */
    protected function SortColumns($mode = ''){
        if($mode == 'view'){            
            foreach($this->columnsViewMode as $fldName => $fldValue){
                $this->sortedColumns[] = $this->GetFieldOffset($fldName);
            }
        }else if(($mode == 'edit') || ($mode == 'details')){
            if(isset($this->columnsEditMode) && is_array($this->columnsEditMode)){
                foreach($this->columnsEditMode as $fldName => $fldValue){
                    $this->sortedColumns[] = $this->GetFieldOffset($fldName);
                }                            
            }            
        }
        $this->sortedColumnsSize = count($this->sortedColumns);
    }

    /**
     * Add error to array of errors
     *      @param $dSet
     */
    protected function AddErrors(&$dSet = null, $issue_type = "error"){
        if(empty($dSet)) $dSet = $this->dataSet; 
        if($issue_type == "error") $this->isError = true;
        else if($issue_type == "warning") $this->isWarning = true;
        if($this->debug){            
            if($this->dbType == 'PEAR' && $this->dbHandler->isError($dSet) == 1){
                if(!empty($dSet)){ 
                    if($this->CheckIsError($dSet)) $this->errors[] = $dSet->getDebugInfo();
                }else{                
                    if(method_exists($this->dataSet, 'getDebugInfo')) $this->errors[] = $this->dataSet->getDebugInfo();
                }            
            }else if($this->dbType == 'PDO'){
                $err_info = $this->dataSet->errorInfo();
                if($err_info[0] != "000000") $this->errors[] = $err_info[2];                                    
            }
        }
    }
   
    /**
     * Add warning to array of warnings
     *      @param $warning_field
     *      @param $warning_value
     *      @param $str_warning
     */
    protected function AddWarning($warning_field = '', $warning_value = '', $str_warning = '', $warning_key = ''){
        if($this->debug){
            if($str_warning != ''){
                $this->warnings[$warning_key] = $str_warning;
            }else{
                $warning = str_replace('_FIELD_', $warning_field, $this->lang['wrong_parameter_error']);
                $warning = str_replace('_VALUE_', $warning_value, $warning);
                $this->warnings[$warning_key] = $warning;
            }            
        }
    }
        
    /**
     * Display SQL statements
     */
    protected function DisplaySqlStatements(){
        if($this->debug){
            echo "<br /><table width='91%' align='center'><tr><td align='left'>";                                
            foreach($this->sqlStatements as $key){
                echo $key.'<br />';            
            }
            echo "</td></tr></table>";                                
        }        
    }    

    /**
     * Display warnings
     */
    protected function DisplayWarnings(){
        if($this->debug){
            $count = 0;        
            if(count($this->warnings) > 0){
                echo "<table width='91%' align='center'><tr><td align='left'>";                                
                echo "<font class='".$this->cssClass."_dg_warning_message no_print dg_underline'><b>".$this->lang['warnings']."</b>:</font><br /><br />";
                foreach($this->warnings as $key){
                    echo "<font class='".$this->cssClass."_dg_warning_message no_print'>".(++$count).") $key</font><br />";            
                }
                echo '<br />';
                echo "</td></tr></table>";                                
            }
        }
    }

    /**
     * Display errors
     */
    protected function DisplayErrors(){
        if($this->debug){
            $count = 0;
            if(count($this->errors) > 0){
                echo "<table width='91%' align='center'><tr><td align='left'>";            
                echo "<font class='".$this->cssClass."_dg_error_message no_print dg_underline'><b>".$this->lang['errors']."</b>:</font><br /><br />";
                foreach($this->errors as $key){
                    echo "<font class='".$this->cssClass."_dg_error_message no_print'>".(++$count).") </font>";
                    echo "<font class='".$this->cssClass."_dg_label'>".substr($key, 0, strpos($key, "["))."</font><br />";
                    echo "<font class='".$this->cssClass."_dg_error_message no_print'>".stristr($key, "[")."</font><br /><br />";                
                }
                echo '<br />';            
                echo "</td></tr></table>";            
            }
        }
    }

    /**
     * Draw data sent by POST and GET
     */
    protected function DisplayDataSent(){
        if($this->debug){
            echo "<table width='91%' align='center'><tr><td align='left'>";                        
            print_r("<font class='".$this->cssClass."_dg_ok_message no_print'><b><u>POST</u></b>: ");
            if(isset($_POST)){ echo '<pre>'; print_r($_POST); echo '</pre>'; }
            print_r("</font><br /><br />");
            print_r("<font class='".$this->cssClass."_dg_ok_message no_print'><b><u>GET</u></b>: ");
            if(isset($_POST)){ echo '<pre>'; print_r($_GET); echo '</pre>'; }
            print_r("</font><br /><br />");
            print_r("<font class='".$this->cssClass."_dg_ok_message no_print'><b><u>FILES</u></b>: ");
            if(isset($_FILES)){ echo '<pre>'; print_r($_FILES); echo '</pre>'; }
            print_r("</font><br /><br />");
            echo "</td></tr></table>";            
        }
    }
        
    /**
     * Draw messages
     */
    protected function DisplayMessages(){
        if($this->messaging && $this->actMsg){
            $css_class = $this->cssClass."_dg_ok_message";
			$src = $this->directory."images/success_sign.png";
            if($this->isError) $css_class= "".$this->cssClass."_dg_error_message";
            if($this->isWarning) $css_class= "".$this->cssClass."_dg_error_message";            
			if($this->isError || $this->isWarning) $src = $this->directory."images/error_sign.png";
            echo "<div class='".$css_class." no_print'><center><img src='".$src."' alt=''><span>".$this->actMsg."</span></center></div>";
            $this->actMsg = '';            
        }        
    }
 
    /**
     * Save Http Get variables
     *      @param $draw
     */
    protected function SaveHttpGetVars($draw = true){
		$output = '';
        $output .= "<div style='padding:0px; margin:0px;'>\n";        
        if(is_array($this->httpGetVars)){
            foreach($this->httpGetVars as $key){
                if(isset($_GET[$key]) && is_array($_GET[$key])){
                    foreach($_GET[$key] as $k_key => $k_val) $output .= "<input type='hidden' name='".$key."[]' value='".$k_val."' />\n";
                }else{
                    $output .= "<input type='hidden' name='".$key."' id='".$key."' value='".$this->GetVariable($key, false)."' />\n";                            
                }                
            }
        }
        $output .= "<input type='hidden' name='".$this->uniquePrefix."page_size'       id='".$this->uniquePrefix."page_size'       value='".((isset($_REQUEST[$this->uniquePrefix.'page_size']))?$this->GetVariable('page_size'):$this->reqPageSize)."' />\n";
        $output .= "<input type='hidden' name='".$this->uniquePrefix."sort_field'      id='".$this->uniquePrefix."sort_field'      value='".$this->GetVariable('sort_field')."' />\n";
        $output .= "<input type='hidden' name='".$this->uniquePrefix."sort_field_by'   id='".$this->uniquePrefix."sort_field_by'   value='".$this->GetVariable('sort_field_by')."' />\n";
        $output .= "<input type='hidden' name='".$this->uniquePrefix."sort_field_type' id='".$this->uniquePrefix."sort_field_type' value='".$this->GetVariable('sort_field_type')."' />\n";                            
        $output .= "<input type='hidden' name='".$this->uniquePrefix."sort_type'       id='".$this->uniquePrefix."sort_type'       value='".$this->GetVariable('sort_type')."' />\n";
        
        // get URL vars from another  DG
        if(is_array($this->anotherDatagrids) && (count($this->anotherDatagrids) > 0)){
            foreach($this->anotherDatagrids as $key => $val){
                if($val[$this->mode] == true){
                    foreach($_REQUEST as $r_key => $r_val){
                        if(strstr($r_key, $key)){ // ."_ff_"
                           $output .= "<input type='hidden' name='".$r_key."' id='".$r_key."' value='".((isset($_REQUEST[$r_key]))?$_REQUEST[$r_key]:'')."' />\n";
                        }                
                    }                    
                }
            }
        }
        $output .= "</div>\n";                
		if($draw) echo $output;
		else return $output;
    }
    
    /**
     * Combine URL
     *      @param $mode
     *      @param $rid
     *      @param $amp
     *      @param $other_datagrids
     */
    protected function CombineUrl($mode, $rid='', $amp='', $other_datagrids = true){
        $amp = ($amp != '') ? $amp : $this->amp;
        if($this->methodPostBack == 'ajax') $amp = '&';
        $a_url = ($this->methodPostBack == "get") ? $this->GetHttpGetVars() : '';
        if($a_url == '') $a_url = (($this->ignoreBaseTag) ? $this->HTTP_URL : '').'?'.$this->uniquePrefix."mode=".$mode;
        else $a_url .= $amp.$this->uniquePrefix."mode=".$mode;
        if($rid !== '') $a_url .= $amp.$this->uniquePrefix."rid=".$rid;
        
        // get URL vars from another DG
        if(is_array($this->anotherDatagrids) && (count($this->anotherDatagrids) > 0) && $other_datagrids){
            foreach($this->anotherDatagrids as $key => $val){
                if($val[$this->mode] == true){  
                    $a_url .= $amp.$key."mode=".((isset($_REQUEST[$key.'mode']))?$_REQUEST[$key.'mode']:'');
                    $a_url .= $amp.$key."rid=".((isset($_REQUEST[$key.'rid']))?Helper::DecodeParameter($_REQUEST[$key.'rid'], $this->safeMode):'');
                    $a_url .= $amp.$key."sort_field=".((isset($_REQUEST[$key.'sort_field']))?$_REQUEST[$key.'sort_field']:'');
                    $a_url .= $amp.$key."sort_field_by=".((isset($_REQUEST[$key.'sort_field_by']))?$_REQUEST[$key.'sort_field_by']:'');
                    $a_url .= $amp.$key."sort_field_type=".((isset($_REQUEST[$key.'sort_field_type']))?$_REQUEST[$key.'sort_field_type']:'');
                    $a_url .= $amp.$key."sort_type=".((isset($_REQUEST[$key.'sort_type']))?$_REQUEST[$key.'sort_type']:'');
                    $a_url .= $amp.$key."page_size=".((isset($_REQUEST[$key.'page_size']))?$_REQUEST[$key.'page_size']:'');
                    $a_url .= $amp.$key."p=".((isset($_REQUEST[$key.'p']))?$_REQUEST[$key.'p']:'');
                    foreach($_REQUEST as $r_key => $r_val){                    
                        if(strstr($r_key, $key."_ff_")){
                            $a_url .= $amp.$r_key."=".((isset($_REQUEST[$r_key]))?rawurlencode($_REQUEST[$r_key]):'');
                        }                
                    }                    
                }
            }
        }        
        return $a_url;         
    }

    /**
     * Set SQL limit
     */
    protected function SetSqlLimit(){        
        $req_page_num  = '';
        $req_page_size = $this->GetVariable('page_size');
        $req_p = $this->GetVariable('p');
        $req_mode = $this->GetVariable('mode');

        if($req_page_size != '') $this->reqPageSize = $req_page_size;
        if($req_p != '') $req_page_num  = $req_p;        
        if(is_numeric($req_page_num)){
            if($req_page_num > 0) $this->pageCurrent = $req_page_num;
            else $this->pageCurrent = 1;
        }else{
            $this->pageCurrent = 1;
        }

        // if the last row from the last page was deleted
        $check1 = ($this->dgGetDbDriverType() == 'ibm') ? ($this->rowsTotal > 0) : true;
        $check2 = ($req_mode != 'edit' && $req_mode != 'details');
        if($check1 && $check2 && intval($this->rowsTotal) <= intval(($this->pageCurrent - 1) * $this->reqPageSize)){            
            if($this->pageCurrent > 1){
                $this->pageCurrent--;
                $_REQUEST[$this->uniquePrefix.'p'] = $this->pageCurrent;
            }
        }       
        
        $this->limitStart = ($this->pageCurrent - 1) * $this->reqPageSize;
        $this->limitSize = $this->reqPageSize;
    }

    /**
     * Set SQL limit by DB type
     *      @param $limit_start
     *      @param $limit_size
     */
    protected function SetSqlLimitByDbType($limit_start='', $limit_size=''){
        // get full recordset if export_all defined as true
        if($this->GetVariable('export') == 'true' && $this->exportAll == true) return ''; 
            
        $this->SetSqlLimit();
        if($limit_start == '') $limit_start = $this->limitStart;
        if($limit_size == '') $limit_size = $this->limitSize; 
        $limit_string = '';
        switch($this->dgGetDbDriverType()){
			case "odbc":    // ODBC
				$limit_string = " FETCH FIRST ".$limit_size." ROWS ONLY ";			
				break;          
            case "oci8":    // Oracle                
                $limit_string = "AND (rownum > ".$limit_start." AND rownum <= ".intval($limit_start + $limit_size).") ";
                break;          
            case 'mssql':   // MSSQL            
                $limit_string = "AND (RowNumber > ".$limit_start." AND RowNumber <= ".intval($limit_start + $limit_size).") ";
                break;
            case "pgsql":   // PostgreSql                
                $limit_string = "OFFSET ".$limit_start." LIMIT ".$limit_size." ";
                break;                 
            case "ibase":   // iBase
                $limit_string = "ROWS ".$limit_start." TO ".intval($limit_start + $limit_size)." ";
                break;                 
            case "firebird": // Firebird
                $limit_string = "FIRST ".$limit_size." SKIP ".$limit_start." ";
                break;
            case "sybase":  // SyBase
                //$limit_string = "AND (rownum between ".$limit_start." and ".intval($limit_start + $limit_size).") ";
                $limit_string = "TOP ".$limit_size." ";
                break;
            case 'ibm':  // IBM (db2) ##005
                $limit_string = "AND (RowNumber >= ".$limit_start." AND RowNumber <= ".intval($limit_start + $limit_size).") ";
                break;
            case 'mysql':   // MySQL and others 
            default:
                $limit_string = "LIMIT ".$limit_start.", ".$limit_size." ";
                break;            
        }
        return $limit_string;
    }    

    /**
     * Set real escape string by DB type
     *      @param $field_value
     */
    protected function SetRealEscapeStringByDbType($field_value = ''){
        if(!$this->allowRealEscape) return $field_value;
        if($this->dbType == 'PDO'){
            return Helper::EncodeText($field_value);  
        }else{
            switch($this->dgGetDbDriverType()){
                case 'mysql':   // mysql 
                    return @mysql_real_escape_string($field_value);  break;    
                case "pgsql":   // PostgreSql                
                    return @pg_escape_string($field_value);  break;    
                default:
                    return $field_value;  break;    
            }
        }
    }

    /**
     * Set SQL by DB type
     *      @param $sql
     *      @param $order_by
     *      @param $limit
     */
    protected function SetSqlByDbType($sql='', $order_by='', $limit=''){
        $sql_string = '';
        preg_match_all("/\d+/",$limit,$matches);
        $req_mode   = $this->GetVariable('mode');
        
        switch($this->dgGetDbDriverType()){
		    case "odbc":  	// odbc
				$sql_string = $sql." ".$order_by;
				break;          
            case "oci8":    // oracle                
                if($limit != ''){
                    $limit_start = $matches[0][0]; 
                    $limit_size = $matches[0][1]-$limit_start; 
                    $sql_string = $this->dbHandler->modifyLimitQuery($sql." ".$order_by, $limit_start, $limit_size); 
                    if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><b>Oracle sql: </b>".$sql_string."</div><br />"; 
                }else{
                    $sql_string = $sql." ".$order_by;
                }
                break;
            case 'ibm':   // ibm PDO
                    if($req_mode != 'edit' && $req_mode != 'details'){
                        $sql_string = "SELECT * FROM ( ";
                        $sql_string .= str_replace("SELECT ", "SELECT ROW_NUMBER() OVER () AS RowNumber, ", $sql)." ".$order_by;                        
                        $sql_string .= ") as foo ";
                        $sql_string .= "WHERE 1=1 ".$limit." ".$order_by;
                    }else{
                        $sql_string = $sql;
                    }
                break;
            case 'mssql':   // mssql
                /// [#0018] fixed bug 21.05.2010;
                $order_by_parts = explode(".", $order_by);
                if(count($order_by_parts) == 2 && isset($order_by_parts[1])) $order_by = $order_by_parts[1];
                /// [#0015-1]
                if(($order_by != '') && !preg_match("/order/i", $order_by)) $order_by = " ORDER BY ".$order_by;
                $select_top = isset($matches[0][1]) ? $matches[0][1] : '';
                if($select_top != ''){
                    $select_index = strpos(Helper::ConvertCase($sql,'lower',$this->langName), "select ");
                    $from_index   = strpos(Helper::ConvertCase($sql,'lower',$this->langName), "from ");
                    $where_index  = strpos(Helper::ConvertCase($sql,'lower',$this->langName), "where ");
                    // [#0048] fixed bug 09.12.2011
                    $table_name   = substr($sql, $from_index+4, ($where_index != '') ? $where_index-$from_index-4 : strlen($sql));
                    $fields_list  = substr($sql, $select_index+6, $from_index-$select_index-6);
                    // [#0015] fixed bug 14.04.2010
                    if(preg_match('/\bwhere\b/i', $sql)){
                        $where_clause = substr($sql, $where_index+5, strlen($sql)-($where_index+5))." ";
                    }else{
                        $where_clause = "1=1 ";
                    }
                    
                    // [#0014-1] fixed bug 08.04.2010
                    if(trim($fields_list) == "*"){
                        if($table_name == '') $table_name = $this->tblName;
                        $fields_list = $table_name.".*";
                    }
                    
                    if($req_mode != 'edit' && $req_mode != 'details'){
                        $sql_string = "SELECT * FROM ( ";
                        $sql_string .= " SELECT TOP ".$select_top." ROW_NUMBER() OVER (".$order_by.") AS RowNumber, ".$fields_list." FROM ".$table_name;
                        // [#0028 under check - 19.10.10] fix for paging after filtering
                        if($this->mode != 'add') $sql_string .= " WHERE ".$where_clause;
                        $sql_string .= ") as foo ";
                        $sql_string .= "WHERE ".$where_clause;
                        $sql_string .= " ".$limit;
                        $sql_string .= " ".$order_by;
                    }else{
                        if($table_name == '') $table_name = $this->tblName;
                        $sql_string = "SELECT * FROM ".$table_name." WHERE ".$where_clause." ".$order_by;
                    }                    
                }else{
                    /// [#0015-2]
                    $sql_string .= $sql." ".$order_by;
                }
                break;          
            case "ibase":    // interbase
                $sql_string = $sql." ".$order_by." ".$limit;
                break;
            case "firebird": // firebird        
                $sql_string = str_replace("SELECT ", "SELECT ".$limit." ", $sql)." ".$order_by;
                break;
            case "sybase":
                $sql_string = str_replace("SELECT ", "SELECT ".$limit." ", $sql)." ".$order_by;
                break;
            case 'mysql':   // mysql and others
            default:
                $sql_string = $sql." ".$order_by." ".$limit;
                break;            
        }
        return $sql_string;        
    }

    /**
     * Get LCASE function name by DB type
     */
    protected function GetLcaseFooByDbType(){
        $lcase_name = '';
        switch($this->dgGetDbDriverType()){
            case "oci8":     // oracle                
                $lcase_name = 'lower';  break;          
            case 'mssql':    // mssql
                $lcase_name = 'LOWER';  break;
            case "pgsql":    // pgsql 
                $lcase_name = 'lower';  break;                
            case "ibase":    // interbase/firebird
            case "firebird": // 
                $lcase_name = 'lower';  break;
            case 'mysql':    // mysql and others
            default:
                $lcase_name = 'LCASE';  break;            
        }
        return $lcase_name;                
    }    
    
    /**
     * Paging function - part 1
     */
    protected function PagingFirstPart(){        
        // (1) if we got a wrong number of page -> set page=1
        $req_page_num  = '';
        $req_page_size = $this->GetVariable('page_size');
        $req_p = $this->GetVariable('p');
        if(($req_page_size != '') && ($req_page_size != 0)) $this->reqPageSize = $req_page_size;
        if($req_p != '') $req_page_num  = $req_p;
        
        if(is_numeric($req_page_num)){
            if($req_page_num > 0) $this->pageCurrent = $req_page_num;
            else $this->pageCurrent = 1;
        }else{
            $this->pageCurrent = 1;
        }
        // (2) set pagesTotal & pageCurrent vars for paging
        if($this->rowsTotal > 0){
            if(is_float($this->rowsTotal / $this->reqPageSize))
                $this->pagesTotal = intval(($this->rowsTotal / $this->reqPageSize) + 1);
            else
                $this->pagesTotal = intval($this->rowsTotal / $this->reqPageSize);
        }else{
            $this->pagesTotal = 0;
        }   
        if($this->pageCurrent > $this->pagesTotal) $this->pageCurrent = $this->pagesTotal;        
    }

    /**
     * Paging function - part 2
     *      @param $lu_paging
     *      @param false
     *      @param $upper_br
     *      @param $lower_br
     *      @param $type
     */
    protected function PagingSecondPart($lu_paging=false, $upper_br, $lower_br, $type='1'){
        // (4) display paging line
        if(!$this->isPrinting) {$a_tag = "a";} else {$a_tag = "span";};
        $text = '';
        $horizontal_align = ($this->tblAlign[$this->mode] == 'center') ? "margin-left:auto; margin-right:auto;" : '';
        $table_align      = ($this->tblAlign[$this->mode] == 'center') ? "align='center'" : '';
        if($this->pagesTotal >= 1){
            $href_string = '';
            $this->SetUrlString($href_string, '', 'sorting', '', '&');
            $href_string = str_replace('&', '&amp;', $href_string);
            $href_string .= '&amp;'.$this->uniquePrefix."page_size=".$this->reqPageSize;
            //[#0012 - 3] - start
            // new code: suggested by kalak
            $href_string = $this->AddArrayParams($href_string);
            //[#0012 - 3] - end
            if($lu_paging['results'] || $lu_paging['pages'] || $lu_paging['page_size']){
                if($upper_br) $text .= '';  
                $text .= "\n<form name='frmPaging$this->uniquePrefix".$type."' id='frmPaging$this->uniquePrefix".$type."' action='' style='margin:0px;padding:0px;'>";
                $text .= "<table class='".$this->cssClass."_dg_paging_table' dir='".$this->direction."' style='height:7px;width:".$this->tblWidth[$this->mode]."; ".$horizontal_align."' ".$table_align." border='0' >";
                $text .= "<tr>";
                $text .= "<td align='".$lu_paging['results_align']."' class='dg_nowrap'>";
                if($lu_paging['results']){
                    $text .= " ".$this->lang['results'].": ";
                    if(($this->pageCurrent * $this->reqPageSize) <= $this->rowsTotal) $total = ($this->pageCurrent * $this->reqPageSize);
                    else $total = $this->rowsTotal;
                    $text .= number_format(($this->pageCurrent * $this->reqPageSize - $this->reqPageSize + 1), 0, '', ",")." - ".number_format($total, 0, '', ",");
                    $text .= " ".$this->lang['of']." ";
                    $text .= number_format($this->rowsTotal, 0, '', ",")." ";
                }            
                $text .= "</td>";
                $text .= "<td align='".$lu_paging['pages_align']."' class='dg_nowrap'>";
            
                if($lu_paging['pages']){
                    $text .= "<table class='".$this->cssClass."_dg_paging_table' border='0' style='padding:0px;margin:0px;border:0px;' dir='".$this->direction."'><tr>";
                    $text .= "<td>";
                    $text .= " ".$this->lang['pages'].": ";
                    // dropdown paging option                
                    if($this->dropdownPaging === true){                        
                        $paging_array = array();
                        for($i = 1; $i <= $this->pagesTotal; $i++){ $paging_array[$i] = $i; }
                        $ddl_onchange = "javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=' + this.value)";
                        $text .= $this->DrawDropDownList($this->uniquePrefix."dropdownPaging".$type, '', $paging_array, $this->pageCurrent, '', '', '', '', 'onchange="'.$ddl_onchange.'"');
                        $text .= "</td><td>";
                    }
                    $href_prev1 = $href_prev2 = $href_first = '';
                    if($this->pageCurrent > 1){
                        $href_prev1 = "href=\"javascript:void('page=previous');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".($this->pageCurrent - 1)."')\"";
                        $href_prev2 = "href=\"javascript:void('page=previous');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".$this->pageCurrent."')\"";
                        $href_first = "href=\"javascript:void('page=first');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=1')\"";
                    }
                    $text .= " <".$a_tag.(($href_first != '') ? " title='".$this->lang['first']."' class='".$this->cssClass."_dg_p_a no_underline'" : " class='".$this->cssClass."_dg_p_a_empty'")." ".$href_first.'>'.$this->firstArrow.'</'.$a_tag.'>';
                    if($this->pageCurrent > 1) $text .= " <".$a_tag.(($href_prev1 != '') ? " class='".$this->cssClass."_dg_p_a no_underline' title='".$this->lang['previous']."'" : " class='".$this->cssClass."_dg_p_a_empty'")." ".$href_prev1.'>'.$this->previousArrow.'</'.$a_tag.'>';
                    else $text .= " <".$a_tag.(($href_prev2 != '') ? " class='".$this->cssClass."_dg_p_a no_underline' title='".$this->lang['previous']."'" : " class='".$this->cssClass."_dg_p_a_empty'").' '.$href_prev2.'>'.$this->previousArrow.'</'.$a_tag.'>';
                    $text .= " ";
                    $text .= "</td><td>";
                    $low_window_ind = $this->pageCurrent - 3;
                    $high_window_ind = $this->pageCurrent + 3;
                    if($low_window_ind > 1){ $start_index = $low_window_ind; $text .= "..."; }
                    else $start_index = 1;
                    if($high_window_ind < $this->pagesTotal) $end_index = $high_window_ind;
                    else $end_index = $this->pagesTotal;
                    for($ind=$start_index; $ind <= $end_index; $ind++){
                        $href_middle = "javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".$ind."')";
                        if($ind == $this->pageCurrent) $text .= " <".$a_tag." class='".$this->cssClass."_dg_p_a dg_underline' style='text-decoration: underline;' title='".$this->lang['current']."' href='javascript:void(\"page=$ind\");' onclick=\"".$href_middle."\"><b>".$ind.'</b></'.$a_tag.'>'; 
                        else $text .= " <".$a_tag." class='".$this->cssClass."_dg_p_a' href='javascript:void(\"page=$ind\");' onclick=\"".$href_middle."\">".$ind.'</'.$a_tag.'>';
                        if($ind < $this->pagesTotal) $text .= ", ";
                        else $text .= " ";
                    }
                    if($high_window_ind < $this->pagesTotal) $text .= "...";
                    $href_next1 = $href_next2 = $href_last = '';
                    if($this->pageCurrent < $this->pagesTotal){
                        $href_next1 = "href=\"javascript:void('page=next');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".($this->pageCurrent + 1)."')\"";
                        $href_next2 = "href=\"javascript:void('page=next');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".$this->pageCurrent."')\"";
                        $href_last  = "href=\"javascript:void('page=last');\" onclick=\"javascript:".$this->uniquePrefix."_doPostBack('paging','','".$href_string.'&amp;'.$this->uniquePrefix."p=".$this->pagesTotal."')\"";
                    }
                    $text .= "</td><td>";
                    if($this->pageCurrent < $this->pagesTotal) $text .= " <".$a_tag.(($href_next1 != '') ? " class='".$this->cssClass."_dg_p_a no_underline' title='".$this->lang['next']."'" : " class='".$this->cssClass."_dg_p_a_empty'")." ".$href_next1.'>'.$this->nextArrow.'</'.$a_tag.'>';
                    else $text .= " <".$a_tag.(($href_next2 != '') ? " class='".$this->cssClass."_dg_p_a no_underline' title='".$this->lang['next']."'" : " class='".$this->cssClass."_dg_p_a_empty'")." ".$href_next2.'>'.$this->nextArrow.'</'.$a_tag.'>';
                    $text .= " <".$a_tag.(($href_last != '') ? " class='".$this->cssClass."_dg_p_a no_underline' title='".$this->lang['last']."'" : " class='".$this->cssClass."_dg_p_a_empty'")." ".$href_last.'>'.$this->lastArrow.'</'.$a_tag.'>';
                    $text .= "</td>";
                    $text .= "</tr></table>";
                }
            
                $text .= "</td>";
                $text .= "<td align='".$lu_paging['page_size_align']."' class='dg_nowrap'>";            
                if($lu_paging['page_size']){
                    $text .= " ".$this->lang['page_size'].": ";
                    //req_sort_type
                    $url_page_size = ($this->GetVariable('page_size') != '') ? $this->GetVariable('page_size') : $this->reqPageSize;
                    $href_string = $this->RemoveParameterFromURL($href_string, '&amp;'.$this->uniquePrefix."page_size", $url_page_size);
                    $text .= $this->DrawDropDownList('page_size'.$type, '_doPostBack("page_resize","","'.$href_string.'&amp;'.$this->uniquePrefix.'page_size="+document.frmPaging'.$this->uniquePrefix.$type.'.page_size'.$type.'.value)', $this->arrPages, $this->reqPageSize);
                }            
                $text .= "</td>";
                $text .= '</tr>';            
                $text .= '</table>';
                $text .= "</form>\n";
                if($lower_br) $text .= ''; //<br />
            }
            echo $text;
        }
    }
   
    /**
     * Set total number of rows in query
     *      @param $fsort
     *      @param $limit
     *      @param $mode
     *      @param $first_time
     */
    protected function SetTotalNumberRows($fsort = '', $limit = '', $mode = '', $first_time = false){
        $req_mode = ($mode == '') ? $this->GetVariable('mode') : $mode;
        $temp_sql = $this->SetSqlByDbType($this->sql, '', '');
        $this->rowsTotal = 0;
        $bError = false;
        
        if(($req_mode == 'edit') || ($req_mode == 'details')){
            if($first_time){
                if($this->dgGetDbDriverType() == 'ibm'){
                    $this->dataSet = $this->dbHandler->query($temp_sql);
                    $this->rowsTotal = $this->NumberRows();                    
                }else{
                    // [#0046-1 under check - 10.11.11]
                    // here may occur a problem with MSSQL or other db drivers - needed GROUP when used COUNT(*)
                    // [#0057 under check - 29.02.12]
                    $new_sql = SqlParser::ParseString($temp_sql)->getCountQuery();                    
                    if($this->dbType == 'PDO'){
                        try{
                            $this->dataSet = $this->dbHandler->query($new_sql);
                        }catch(PDOException $e){
                            $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                        }
                    }else{
                        $this->dataSet = $this->dbHandler->query($new_sql);
                    }                    
                    if($this->dbType == 'PDO' || ($this->dbType == 'PEAR' && !$this->dbHandler->isError($this->dataSet))){
                        $row = $this->dgFetchRow($this->dataSet);
                        $this->rowsTotal = isset($row[0]) ? $row[0] : '0';
                    } else $bError = true;
                }
            }else{
                $this->dataSet = $this->dbHandler->query($this->SetSqlByDbType($this->sql, $fsort, $limit));
                $this->rowsTotal = $this->NumberRows();                
            }
        }else{            
            $group_by_is = (preg_match("/\bgroup by\b/i", $temp_sql)) ? true : false;
            $union_is = (preg_match("/\bunion\b/i", $temp_sql)) ? true : false;
            $distinct = (preg_match("/\bdistinct\b/i", $temp_sql)) ? true : false;
            $exists_is   = false;
            
			if($distinct){
                /* [#0055 under check - 27.02.12] */ 
                $bError = true;
			}else if($union_is){
                /* [#0046-2 under check - 10.11.11] */
                $new_sql = preg_replace("/SELECT /i", "SELECT COUNT(*) as union_cnt, ", $temp_sql, 1);
                $this->dataSet = $this->dbHandler->query($new_sql);                                        
                if($this->dbType == 'PDO' || ($this->dbType == 'PEAR' && !$this->dbHandler->isError($this->dataSet))){
                    while($row = $this->dgFetchRow($this->dataSet)){
                        $this->rowsTotal += $row[0];
                    }
                } else $bError = true;                             
            }else{
                /* [#0046-3 under check - 10.11.11] */
                if(!preg_match("/SELECT \*/i", $temp_sql)){
                    $new_sql_regex = "SELECT ";
                    $sql_comma = ",";
                }else{
                    $new_sql_regex = "SELECT \*";
                    $sql_comma = '';
                }
                $new_sql = preg_replace("/".$new_sql_regex."/i", "SELECT ".(($group_by_is) ? "* ".$sql_comma : "COUNT(*) as cnt ".$sql_comma." "), $temp_sql, 1);
                if($this->dbType == 'PDO'){
                    try{
                        $this->dataSet = $this->dbHandler->query($new_sql);
                    }catch(PDOException $e){
                        $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                    }
                }else{
                    $this->dataSet = $this->dbHandler->query($new_sql);
                }
                
                if($this->dbType == 'PDO' || ($this->dbType == 'PEAR' && !$this->dbHandler->isError($this->dataSet))){
                    $row = $this->dgFetchRow($this->dataSet);
                    if($group_by_is){
                        $this->rowsTotal = $this->NumberRows();
                    }else{                        
                        $this->rowsTotal = isset($row[0]) ? $row[0] : '0';
                    }
                } else $bError = true;                         
            }            
        }
        if($bError){
            /* try another way to get the count. */
            $new_sql = "SELECT COUNT(*) as cnt FROM ( $temp_sql ) t ";           
            $this->dataSet = $this->dbHandler->query($new_sql);       
            if($this->dbType == 'PDO' || ($this->dbType == 'PEAR' && !$this->dbHandler->isError($this->dataSet))){
                $row = $this->dgFetchRow($this->dataSet);
                $this->rowsTotal = $row[0];
            }
        }        
    }

    /**
     * Rows number
     *      @param $sql
     */
    protected function NumberRows($sql = ''){    
        if($this->dbType == 'PDO'){
            if($this->dgGetDbDriverType() == 'ibm' && $sql != ''){
                try{
                    $rows = $this->dataSet->fetchAll();
                    $this->dataSet = $this->dbHandler->query($sql);
                    return count($rows)+1;                    
                }catch(PDOException $e){
                    $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                    return 1;
                }
            }
            return $this->dataSet->rowCount();            
        }else{
            if($this->dbHandler->isError($this->dataSet)) return 0;
            if($this->dgGetDbDriverType() == "odbc"){
                return $this->dataSet->dbh->features['numrows'];
            }else{
                return $this->dataSet->numRows();
            }
            return 0;
        }
    }
    
    /**
     * Columns number
     */
    protected function NumberCols($dSet = null){
        $dSet = (!empty($dSet)) ? $dSet : $this->dataSet;
        if($this->dbType == 'PDO'){
            return $dSet->columnCount();        
        }else{
            return ($this->dbHandler->isError($dSet)) ? 0 : $dSet->numCols();
        }        
    }

    /**
     * No data found
     */
    protected function NoDataFound(){
        $no_data_found_text = ($this->noDataFoundText != '') ? $this->noDataFoundText : $this->lang['no_data_found'];
        $this->isDataFound = false;
        $this->TblOpen();
        $this->RowOpen(0, $this->rowColor[0]);
            $add_column = 0;
            if($this->ModeAllowed('add') || $this->ModeAllowed('edit')) $add_column += 1;
            if(isset($this->mode['delete']) && $this->mode['delete']) $add_column += 1;
            $this->ColOpen('center', (count($this->sortedColumns) + $add_column),''); 
                if($this->isError){
                    echo "<br /><span class='".$this->cssClass."_dg_warning_message no_print'>".$this->lang['no_data_found_error']."<br /> ";
                    if(!$this->debug){ echo '<br />'.$this->lang['turn_on_debug_mode']."<br >"; }
                    echo '</span>';
                    echo '<br />';
                }else{
                    echo '<br />'.$no_data_found_text."<br /><br /> ";
                }                
            $this->ColClose();                   
        $this->RowClose();
        $this->TblClose();
    }

    /**
     * Clone record
     *      @param $rid
     */
    protected function CloneRow($rid){
        $req_operation_randomize_code = $this->GetVariable("_operation_randomize_code", true);
        if(!$this->CheckF5CaseValidation($req_operation_randomize_code)) return false;
        if(!$this->arrMultirowOperations['clone']['view']) return false;
        if(!$this->CheckMaximumAllowedRecords(count($this->rids))) return false;        
        $file_fileds_array = array();
        $this->rids = explode("-", $rid);
        $keys_list = '';
        $fields_list = '';
        $primary_key_found = false;

        foreach($this->columnsEditMode as $fldName => $fldValue){            
            if($fldName != $this->primaryKey && !preg_match("/delimiter/i", $fldName)){
                $fields_list .= ($fields_list != '') ? ",".$fldName : $fldName;    
            }
        }

        foreach($this->rids as $key){
            $key = (count($this->rids) > 1) ? Helper::DecodeParameter($key, $this->safeMode) : $key;
            $sql = "INSERT INTO ".$this->SetBackQuotes($this->tblName)." (".$fields_list.") (SELECT ".$fields_list." FROM ".$this->SetBackQuotes($this->tblName)." WHERE ".$this->SetBackQuotes($this->primaryKey)." = ".$key.")";         
            $dSet = null;
            $affectedRows = 0;
            if(!$this->isDemo){
                //$this->PrepareFileFields($file_fileds_array, $sql);                
                if($this->dbType == 'PEAR'){
                    $dSet = $this->dbHandler->query($sql);
                    $affectedRows = $this->dgGetAffectedRows();
                }else{
                    try{
                        $affectedRows = $this->dbHandler->exec($sql);
                    }catch(PDOException $e){                    
                        $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                    }                    
                }                
            }            
            if($affectedRows > 0){
                $this->actMsg = ($this->arrDgMessages['clone'] != '') ? $this->arrDgMessages['clone'] : $this->lang['cloning_operation_completed'];                
                if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = $req_operation_randomize_code; }
                $this->isOperationCompleted = true;
                $this->DeleteCache();
            }else{
                if(!$this->isDemo) $this->actMsg = $this->lang['cloning_operation_uncompleted'];
                else $this->actMsg = "Cloning operation is blocked in demo version";            
                if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = ''; }
                $this->isOperationCompleted = false;
                $this->AddErrors($dSet, "warning");
            }
            $keys_list .= ($keys_list != '') ? ",".$key : $key;
            if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Cloning requested record:</i><br><b>insert sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql.'</div>';
        }
        if($this->debug) $this->actMsg .= " ".$this->lang['record_n']." ".$keys_list;
    }

    /**
     * Move records
     *      @param $rid
     *      @param $params
     */
    protected function MoveRow($rid, $params){        
        $req_operation_randomize_code = $this->GetVariable("_operation_randomize_code", true);
        if(!$this->CheckF5CaseValidation($req_operation_randomize_code)) return false;       
        
        $params_p = explode("#", $params);
        $dir = isset($params_p[0]) ? $params_p[0] : '';
        $field_name = isset($params_p[1]) ? $params_p[1] : '';
        
        $up_value = $down_value = $curr_value = '';
        $up_rid = $down_rid = $curr_rid = '';
        if(isset($_SESSION[$this->uniquePrefix.'-move'][$field_name]) && is_array($_SESSION[$this->uniquePrefix.'-move'][$field_name])){
            for($i=0; $i < count($_SESSION[$this->uniquePrefix.'-move'][$field_name]); $i++){
                $parts = explode("#", $_SESSION[$this->uniquePrefix.'-move'][$field_name][$i]);
                $curr_rid = $parts[0];
                $curr_value = $parts[1];
                if($rid == $parts[0]){                    
                    if($dir == "up" && isset($_SESSION[$this->uniquePrefix.'-move'][$field_name][$i-1])){
                        $parts_1 = explode("#", $_SESSION[$this->uniquePrefix.'-move'][$field_name][$i-1]);
                        $up_rid = $parts_1[0];
                        $up_value = $parts_1[1];
                    }
                    if($dir == "down" && isset($_SESSION[$this->uniquePrefix.'-move'][$field_name][$i+1])){
                        $parts_2 = explode("#", $_SESSION[$this->uniquePrefix.'-move'][$field_name][$i+1]);
                        $down_rid = $parts_2[0];
                        $down_value = $parts_2[1];
                    }
                    break;
                }                
            }
        }
        $new_rid = (($dir == "up") ? $up_rid : $down_rid);
        $new_value = (($dir == "up") ? $up_value : $down_value);
        
		$sql_1 = "UPDATE ".$this->SetBackQuotes($this->tblName)." SET ".$this->SetBackQuotes($field_name)." = '".$new_value."' WHERE ".$this->SetBackQuotes($this->primaryKey)." = '".$curr_rid."'";
		$sql_2 = "UPDATE ".$this->SetBackQuotes($this->tblName)." SET ".$this->SetBackQuotes($field_name)." = '".$curr_value."' WHERE ".$this->SetBackQuotes($this->primaryKey)." = '".$new_rid."'";

        if(!$this->isDemo){
            if($curr_rid != '' && $new_value != '') $dSet = $this->dbHandler->query($sql_1);
            if($new_rid != '' && $curr_value != '') $dSet = $this->dbHandler->query($sql_2);
            $affectedRows = $this->dgGetAffectedRows();
        }else{
            $dSet = null;
            $affectedRows = -1;
        }                    

        if($affectedRows >= 0){
            $this->actMsg = ($this->arrDgMessages['move'] != '') ? $this->arrDgMessages['move'] : $this->lang['move_operation_completed'];                
            if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = $req_operation_randomize_code; }
            $this->isOperationCompleted = true;
            $this->DeleteCache();
        }else{
            $this->isWarning = true;
            if(!$this->isDemo) $this->actMsg = $this->lang['move_operation_uncompleted'];
            else $this->actMsg = "Move operation is blocked in demo version";            
            if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = ''; }
            $this->isOperationCompleted = false;
            //if($dSet != null) $this->AddErrors($dSet);
        }

        if($this->debug){
            $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Move requested record:</i><br><b>select sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql_1.'</div>';
            $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Move requested record:</i><br><b>select sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql_2.'</div>';
        }
    }

    /**
     * Delete record
     *      @param $rid
     */
    protected function DeleteRow($rid){
        $req_operation_randomize_code = $this->GetVariable("_operation_randomize_code", true);
        if(!$this->CheckF5CaseValidation($req_operation_randomize_code)) return false;
        if(!$this->CheckSecurityCaseValidation('delete', 'delete', "deleting")) return false;
        
        $file_fileds_array = array();
        $this->rids = explode("-", $rid);
        $keys_list = '';
        $sql = "DELETE FROM ".$this->SetBackQuotes($this->tblName)." WHERE ".$this->SetBackQuotes($this->primaryKey)." IN ('-1' ";         
        foreach($this->rids as $key){
            $key = (count($this->rids) > 1) ? Helper::DecodeParameter($key, $this->safeMode) : $key;
            $keys_list .= ($keys_list != '') ? ",".$key : $key;
            $sql .= ", '".$key."' ";
        }
        $sql .= ");";
        
        $dSet = null;
        $affectedRows = 0;
        if(!$this->isDemo){
            $this->PrepareFileFields($file_fileds_array, $sql);
            if($this->dbType == 'PEAR'){
                $dSet = $this->dbHandler->query($sql);
                $affectedRows = $this->dgGetAffectedRows();
            }else{
                try{
                    $affectedRows = $this->dbHandler->exec($sql);
                }catch(PDOException $e){                    
                    $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                }
            }
        }        
        if($affectedRows > 0){
            $this->actMsg = ($this->arrDgMessages['delete_success'] != '') ? $this->arrDgMessages['delete_success'] : $this->lang['deleting_operation_completed'];                
            if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = $req_operation_randomize_code; }
            $this->isOperationCompleted = true;
            $this->DeleteFileFields($file_fileds_array);
            $this->DeleteCache();
        }else{
            $this->isWarning = true;
            if(!$this->isDemo) $this->actMsg = ($this->arrDgMessages['delete_error'] != '') ? $this->arrDgMessages['delete_error'] : $this->lang['deleting_operation_uncompleted'];                
            else $this->actMsg = "Deleting operation is blocked in demo version";            
            if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = ''; }
            $this->isOperationCompleted = false;
            if(is_object($dSet)) $this->AddErrors($dSet, "warning");
        }
        
        if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Deleting requested record:</i><br><b>delete sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql.'</div>';        
        if($this->debug) $this->actMsg .= " ".$this->lang['record_n']." ".$keys_list;                    
    }

    /**
     * Update record
     *      @param $rid
     */
    protected function UpdateRow($rid){ 
        $req_operation_randomize_code = $this->GetVariable("_operation_randomize_code", true, "post");
        if(!$this->CheckF5CaseValidation($req_operation_randomize_code)) return false;
        if(!$this->CheckSecurityCaseValidation('edit', 'update', "updating")) return false;        
        
        // if we have more that 1 row selected
        $rids = explode("-", $rid);
        $unique_field_found = false;
        $field_header = '';
        $field_count = '0';
        $keys_list = '';
            
        foreach($rids as $key){
            $key = (count($rids) > 1) ? Helper::DecodeParameter($key, $this->safeMode) : $key;
            // check for unique fields
            foreach($this->columnsEditMode as $fldName => $fldValue){
                $fp_unique = $this->GetFieldPropertyBool($fldName, "unique", 'edit', false, false);
                if($fldName != '' && $fp_unique){
                    $field_prefix = "syy";                    
                    if(isset($fldValue['req_type'])){
                        if(strlen(trim($fldValue['req_type'])) == 3){ $field_prefix = $fldValue['req_type']; }
                        else if(strlen(trim($fldValue['req_type'])) == 2){ $field_prefix = $fldValue['req_type']."y"; }
                    }                
                    $field_header     = (isset($fldValue['header'])) ? $fldValue['header'] : $fldName;
                    $unique_condition = (isset($fldValue['unique_condition'])) ? trim($fldValue['unique_condition']) : "" ;
                    if(count($rids) <= 1){
                        $field_value = (isset($_POST[$field_prefix.$fldName])) ? $_POST[$field_prefix.$fldName] : '';                        
                    }else{
                        $field_value = (isset($_POST[$field_prefix.$fldName."_".$key])) ? $_POST[$field_prefix.$fldName."_".$key] : '';                                                
                    }
                    $sql = "SELECT COUNT(*) as count FROM ".$this->SetBackQuotes($this->tblName)." WHERE ".$this->primaryKey." <> '".$key."' AND ".$fldName." = '".$field_value."'";
                    if($unique_condition != '') $sql .= " AND ".$unique_condition." ";
                    if($field_value != '' && ($field_count = $this->SelectSqlItem($sql)) > 0){
                        $unique_field_found = true;
                        break;
                    }
                }            
            }
            if($unique_field_found) break;
        }

        if(!$unique_field_found){            
            // prepare UPDATE SQL for each key
            foreach($rids as $key){
                $arrUploadedFiles = $this->UploadFileImage(((count($rids) > 1) ? $key : '')); /* prepare uploaded files array (if exist) */
                $key = (count($rids) > 1) ? Helper::DecodeParameter($key, $this->safeMode) : $key;
                $keys_list .= ($keys_list != '') ? ",".$key : $key;

                // create update statement
                $sql = "UPDATE ".$this->SetBackQuotes($this->tblName)." SET ";
                $ind = 0;
                $this->AddCheckBoxesValues(((count($rids) > 1) ? '_'.$key : ''));            
                $max = count($_POST);
                foreach($_POST as $fldName => $fldValue){                    
                    // check multirow postfix and remove them
                    if(count($rids) > 1){
                        if(preg_match("/_".$key."/", $fldName)) $fldName = str_replace("_".$key, '', $fldName);
                        else continue;    
                    }
                    // update all fields, excepting uploading fields                    
                    if(!$this->IsExceptedField($fldName)){
                        $fldName = substr($fldName, 3, strlen($fldName));
                        if(!$this->IsReadonly($fldName) && !$this->IsValidator($fldName)){
                            $sql_temp = '';
                            if($this->IsDate($fldName)){
                                if(trim($fldValue) != ''){
                                    $sql_temp = $this->SetBackQuotes($fldName)." = ".$this->IsDatePrepare($fldName, $fldValue);
                                }else{
                                    $sql_temp = $this->SetBackQuotes($fldName)." = NULL";    
                                }                        
                            }else if($this->IsTimeStamp($fldName, $fldValue)){
                                $sql_temp = $this->SetBackQuotes($fldName)." = ".$this->PrepareTimeStamp($fldValue);
                            }else if($this->IsPassword($fldName)){
                                $fldValue_new = $this->IsPasswordCrypted($fldName, $fldValue);
                                if($fldValue_new != '') $sql_temp = $this->SetBackQuotes($fldName)." = ".$fldValue_new." ";
                            }else if($this->IsMoney($fldName)){
                                $fldValue_new = $this->SetMoneyFormat($fldName, $fldValue);
                                $sql_temp = $this->SetBackQuotes($fldName)." = '".$fldValue_new."' ";
                            }else if($this->IsText($fldName)){
                                if(is_array($fldValue)){    /* it was a multiple enum */
                                    $count = 0; $fldValue_new = '';
                                    foreach($fldValue as $val){ if($count++ > 0) $fldValue_new .= ","; $fldValue_new .= $val; }
                                }else{
                                    if($this->convertOutput) $fldValue = hebrev(mb_convert_encoding($fldValue, $this->convertFrom, $this->convertTo));
                                    $fldValue_new = $fldValue;    
                                }
                                $sql_temp = $this->SetBackQuotes($fldName)." = '".$this->SetRealEscapeStringByDbType($fldValue_new)."' ";
                            }else{
                                if($this->convertOutput) $fldValue = hebrev(mb_convert_encoding($fldValue, $this->convertFrom, $this->convertTo));
                                if(trim($fldValue) != ''){
                                    $sql_temp = $this->SetBackQuotes($fldName)." = '".$fldValue."'";
                                }else if($this->IsFieldRequired($fldName)){
                                    $sql_temp = $this->SetBackQuotes($fldName)." = '0'";    
                                }else{
                                    // [#0049] fixed bug 09.12.2011
                                    $sql_temp = $this->SetBackQuotes($fldName)." = NULL";    
                                }                        
                            }
                            if($sql_temp != ''){
                                $sql .= ((intval($ind) >= 1) ? ', ' : '').$sql_temp;
                            }
                            $ind++;
                        }                        
                    }
                }
                $debug_sql = $sql;
                foreach($arrUploadedFiles as $uf_key => $uf_val){
                    $sql .= ", ".$uf_key." = '".$uf_val."'";
                    $debug_sql .= ", ".$uf_key." = '".(ctype_print($uf_val) ? $uf_val : "{value}")."'";
                }
                $where_clause = " WHERE ".$this->SetBackQuotes($this->primaryKey)." = '".$key."'";
                $sql .= $where_clause;
                $debug_sql .= $where_clause;
                $dSet = null;
                $affectedRows = -1;
                if(!$this->isDemo){
                    if($this->dbType == 'PDO'){
                        try{
                            $affectedRows = $this->dbHandler->exec($sql);
                        }catch(PDOException $e){                    
                            $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                        }
                    }else{
                        $dSet = $this->dbHandler->query($sql);
                        $affectedRows = $this->dgGetAffectedRows();
                    }                    
                }
                if($affectedRows >= 0){
                    $this->actMsg = ($this->arrDgMessages['update_success'] != '') ? $this->arrDgMessages['update_success'] : $this->lang['updating_operation_completed'];
                    if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = $req_operation_randomize_code; }
                    $this->isOperationCompleted = true;
                    $this->DeleteCache();
                }else{
                    $this->isWarning = true;
                    if(!$this->isDemo) $this->actMsg = ($this->arrDgMessages['update_error'] != '') ? $this->arrDgMessages['update_error'] : $this->lang['updating_operation_uncompleted'];
                    else $this->actMsg = "Updating operation is blocked in demo version";                
                    if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = ''; }
                    $this->isOperationCompleted = false;
                    $this->AddErrors($dSet, "warning");
                }               
                if($this->debug){
                    $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Updating requested record:</i><br><b>update sql #".$key." (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$debug_sql.'</div>';
                }
            }
        }else{
            $this->isWarning = true;            
            $this->actMsg = str_replace("_FIELD_", $field_header, $this->lang['unique_field_error']);               
            if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Error statement:</i><br><b>select sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$field_count.") </b>".$sql.'</div>';                    
        }
        if($this->debug) $this->actMsg .= " ".$this->lang['record_n']." ".$keys_list;                                
    }

    /**
     * Add record
     */
    protected function AddRow(){
        $req_operation_randomize_code = $this->GetVariable("_operation_randomize_code", true, "post");
        if(!$this->CheckF5CaseValidation($req_operation_randomize_code)) return false;
        if(!$this->CheckSecurityCaseValidation('add', "add_new", "adding")) return false;        
        if(!$this->CheckMaximumAllowedRecords(count($this->rids))) return false;
        
        $unique_field_found = false;
        $field_header = '';
        $field_count = '0';
        $dSet = '';
        
        // check for unique fields
        foreach($this->columnsEditMode as $fldName => $fldValue){
            $fp_unique = $this->GetFieldPropertyBool($fldName, "unique", 'edit', false, false);
            if($fldName != '' && $fp_unique){
                $field_prefix = "syy";                    
                if(isset($fldValue['req_type'])){
                    if(strlen(trim($fldValue['req_type'])) == 3){ $field_prefix = $fldValue['req_type']; }
                    else if(strlen(trim($fldValue['req_type'])) == 2){ $field_prefix = $fldValue['req_type']."y"; }
                }                
                $field_header =     (isset($fldValue['header'])) ? $fldValue['header'] : $fldName;
                $unique_condition = (isset($fldValue['unique_condition'])) ? trim($fldValue['unique_condition']) : "" ;
                $field_value =      (isset($_POST[$field_prefix.$fldName])) ? $_POST[$field_prefix.$fldName] : '';                                 
                $sql = "SELECT COUNT(*) as count FROM ".$this->SetBackQuotes($this->tblName)." WHERE ".$this->SetBackQuotes($fldName)." = '".$field_value."'";
                if($unique_condition != '') $sql .= " AND ".$unique_condition;
                if(($field_count = $this->SelectSqlItem($sql)) > 0){
                    $unique_field_found = true;
                    break;
                }
            }            
        }
        // create insert statement
        if(!$unique_field_found){            
            $arrUploadedFiles = $this->UploadFileImage(); /* prepare uploaded files array (if exist) */
            $this->AddCheckBoxesValues();                    
            $sql = "INSERT INTO ".$this->SetBackQuotes($this->tblName)." (";
                $ind = 0;
                $max = count($_POST);
                if($this->dgGetDbDriverType() == "oci8"){ $sql .= strtoupper($this->primaryKey).", "; }
                foreach($_POST as $fldName => $fldValue){
                    // all fields, excepting uploading fields
                    if(!$this->IsExceptedField($fldName) && !$this->IsValidator($fldName)){
                        if(intval($ind) >= 1) $sql .= ", ";
                        $sql .= $this->SetBackQuotes(substr($fldName, 3, strlen($fldName)));
                        $ind++;
                    }
                }
                foreach($arrUploadedFiles as $uf_key => $uf_val) $sql .= ", ".$uf_key; 
            $sql .= ") VALUES (";
                $ind = 0;
                $max = count($_POST);
                if($this->dgGetDbDriverType() == "oci8"){ $sql .= "(SELECT ".$this->tblName.".".$this->primaryKey." FROM ".$this->tblName."), "; }
                foreach($_POST as $fldName => $fldValue){                    
                    // all fields, excepting uploading fields
                    if(!$this->IsExceptedField($fldName) && !$this->IsValidator($fldName)){    
                        if(intval($ind) >= 1) $sql .= ", ";                
                        $fldName = substr($fldName, 3, strlen($fldName));
                        if($this->IsDate($fldName)){
                            if(trim($fldValue) != ''){
                                $sql .= $this->IsDatePrepare($fldName, $fldValue);
                            }else{
                                $sql .= "NULL";    
                            }                                                        
                        }else if($this->IsTimeStamp($fldName, $fldValue)){
                            $sql .= $this->PrepareTimeStamp($fldValue);
                        }else if($this->IsPassword($fldName)){
                            $fldValue_new = $this->IsPasswordCrypted($fldName, $fldValue);
                            $sql .= $fldValue_new." ";
                        }else if($this->IsMoney($fldName)){
                            $fldValue_new = $this->SetMoneyFormat($fldName, $fldValue);
                            $sql .= "'".$fldValue_new."' ";
                        }else if($this->IsText($fldName)){                            
                            if($fldValue != ''){
                                if($this->convertOutput) $fldValue = hebrev(mb_convert_encoding($fldValue, $this->convertFrom, $this->convertTo));
                                $fldValue_new = $fldValue;
                                if(is_array($fldValue)){    // it was a multiple enum
                                    $count = 0; $fldValue_new = '';
                                    foreach($fldValue as $val){ if($count++ > 0) $fldValue_new .= ","; $fldValue_new .= $val; }
                                }                                        
                                $sql .=  "'".$this->SetRealEscapeStringByDbType($fldValue_new)."'";
                            }else{
                                $fp_default_null = $this->GetFieldPropertyBool($fldName, "default_null", 'edit');
                                if($fp_default_null && !$this->IsFieldRequired($fldName)){
                                    $sql .= "NULL";
                                }else{
                                    $sql .= "''";
                                }
                            }
                        }else{
                            if(trim($fldValue) != ''){
                                if($this->convertOutput) $fldValue = hebrev(mb_convert_encoding($fldValue, $this->convertFrom, $this->convertTo));
                                if($this->dgGetDbDriverType() == "oci8") $sql .= $fldValue;
                                else $sql .=  "'".$fldValue."'";
                            }else if($this->IsFieldRequired($fldName)){
                                $sql .= '0';    
                            }else{
                                $sql .= 'NULL';    
                            }                        
                        }
                        $ind ++;                        
                    }
                }
                foreach($arrUploadedFiles as $uf_key => $uf_val) $sql .= ", '".$uf_val."'";                
            $sql .= ") ";
            $affectedRows = 0;
            $dSet = null;
            if(!$this->isDemo){                
                if($this->dbType == 'PEAR'){
                    $dSet = $this->dbHandler->query($sql);
                    $affectedRows = $this->dgGetAffectedRows();
                }else{
                    try{
                        $affectedRows = $this->dbHandler->exec($sql);
                    }catch(PDOException $e){                    
                        $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                    }
                }
            }            
            if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Inserting new record:</i><br><b>insert sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql.'</div>';        
            if($affectedRows > 0){
                $this->actMsg = ($this->arrDgMessages['add_success'] != '') ? $this->arrDgMessages['add_success'] : $this->lang['adding_operation_completed'];
                $res = $this->dbHandler->query("SELECT MAX(".$this->primaryKey.") as maximal_row FROM ".$this->SetBackQuotes($this->tblName)." ");
                $row = $this->dgFetchRow($res);
                $this->rid = $row[0];
                if($this->debug) $this->actMsg .= " ".$this->lang['record_n']." ".$this->rid;
                if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = $req_operation_randomize_code; }
                $this->isOperationCompleted = true;
                $this->DeleteCache();
            }else{
                $this->isWarning = true;
                if(!$this->isDemo) $this->actMsg = ($this->arrDgMessages['add_error'] != '') ? $this->arrDgMessages['add_error'] : $this->lang['adding_operation_uncompleted'];
                else $this->actMsg = "Adding operation is blocked in demo version";
                if($this->CheckIsError($dSet)){
                    /// $this->isError = true; [#0026 under check - 04.10.10]
                    $this->AddErrors($dSet, "warning");
                }
                if(isset($_SESSION)) { $_SESSION[$this->uniquePrefix.'_operation_randomize_code'] = ''; }
                $this->isOperationCompleted = false;   
            }            
        }else{
            $this->isWarning = true;            
            $this->actMsg = str_replace("_FIELD_", $field_header, $this->lang['unique_field_error']);               
            if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Error statement record:</i><br><b>select sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$field_count.") </b>".$sql.'</div>';                                
        }          

        $this->sql = "SELECT ".$this->SetBackQuotes($this->tblName).".* FROM ".$this->SetBackQuotes($this->tblName)." ";       
        $fsort = " ORDER BY ".$this->SetBackQuotes($this->primaryKey)." DESC";        
        $this->GetDataSet($fsort);
    }   

    /**
     * Check for F5 refresh case
     *      @param $req_operation_randomize_code
     */
    protected function CheckF5CaseValidation($req_operation_randomize_code = ''){
        if(isset($_SESSION[$this->uniquePrefix.'_operation_randomize_code']) && $req_operation_randomize_code != '' && ($_SESSION[$this->uniquePrefix.'_operation_randomize_code'] == $req_operation_randomize_code)){
            $this->isWarning = true;
            $this->warningType = "f5";
            $this->actMsg = $this->lang['operation_was_already_done'];
            return false;
        } return true;
    }

    /**
     * Check for maximum allowed records
     *      @param $additional_value
     */
    protected function CheckMaximumAllowedRecords($additional_value = 0){
        if($this->maximumAllowedRecords != '' && $this->rowsTotal + count($this->rids) > (int)$this->maximumAllowedRecords){
            $this->isWarning = true;
            $this->actMsg = $this->lang['max_number_of_records'];
            return false;
        }
        return true;    
    }
    
    /**
     * Check for security case
     *      @param $mode
     *      @param $operation
     *      @param $gerundy 
     */
    protected function CheckSecurityCaseValidation($mode = '', $operation = '', $gerundy = ''){
        if(($this->modes[$mode]['view'] == false) && ($this->modes[$mode]['edit'] == false)){
            $this->isWarning = true;            
            if($this->debug){
                $this->actMsg = $this->lang[$operation.'_record_blocked'];
            }else{
                $this->actMsg = (isset($this->arrDgMessages[$mode]) && $this->arrDgMessages[$mode] != '') ? $this->arrDgMessages[$mode] : $this->lang[$gerundy.'_operation_uncompleted'];
            }
            return false;
        } return true;        
    }

    /**
     * Get field offset
     *      @param $field_name
     */
    protected function GetFieldOffset($field_name){
        if($this->dbType == 'PDO'){
            for($ind=0; $ind < $this->NumberCols(); $ind++){    
                $meta = $this->dataSet->getColumnMeta($ind);
                if($meta['name'] == $field_name) return $ind;
            }
        }else{
            if(!$this->isError){
                $fields = $this->dataSet->tableInfo();            
                for($ind=0; $ind < $this->NumberCols(); $ind++){
                    if($fields[$ind]['name'] === $field_name) return $ind;  
                }            
            }
        }
        return -1;
    }

    /**
     * Get field info
     *      @param $field
     *      @param $parameter
     *      @param $type
     */
    protected function GetFieldInfo($field, $parameter = '', $type = 0){
        if(!$this->isError){
            if($this->dbType == 'PDO'){
                $field_offset = $this->GetFieldOffset($field);
                if($field_offset != -1){
                    $fields = $this->dataSet->getColumnMeta($field_offset);
                    if($parameter == 'type') $parameter = "native_type";
                    return isset($fields[$parameter]) ? $fields[$parameter] : '';
                }else{
                   return '';
                }
                #Array ( [native_type] => LONG
                #        [pdo_type] => 2
                #        [flags] => Array ( [0] => not_null [1] => primary_key )
                #        [table] => demo_products
                #        [name] => id
                #        [len] => 11
                #        [precision] => 0 )
            }else{
                $fields = $this->dataSet->tableInfo();            
                if($type == 0){
                    $field_offset = $this->GetFieldOffset($field);
                    return ($field_offset != -1) ? $fields[$field_offset][$parameter] : '';
                }else{
                    return $fields[$field][$parameter];
                }
            }
        }
        return -1;
    }          

    /**
     * Set money format
     *      @param $field_name
     *      @param $field_value
     */
    protected function SetMoneyFormat($field_name, $field_value){
        $fp_decimal_places   = $this->GetFieldProperty($field_name, "decimal_places", 'edit'); 
        $fp_dec_separator    = $this->GetFieldProperty($field_name, "dec_separator", 'edit'); 
        $fp_thousands_separator = $this->GetFieldProperty($field_name, "thousands_separator", 'edit');                        
        if($fp_thousands_separator == "." && $fp_dec_separator == ","){
            $field_value = str_replace(".", "#", $field_value);
            $field_value = str_replace(",", ".", $field_value);
            $field_value = str_replace("#", '', $field_value);
        }else if($fp_thousands_separator == "," && $fp_dec_separator == "."){
            $field_value = str_replace(",", '', $field_value);
        }
        return $field_value;
    }

    /**
     * Get money format
     *      @param $field_name
     *      @param $field_value
     */
    protected function GetMoneyFormat($field_name, $field_value){
        if($field_value == '') return '';
        $fp_decimal_places   = $this->GetFieldProperty($field_name, "decimal_places", $this->mode); 
        $fp_dec_separator    = $this->GetFieldProperty($field_name, "dec_separator", $this->mode); 
        $fp_thousands_separator = $this->GetFieldProperty($field_name, "thousands_separator", $this->mode);                        
        if($fp_thousands_separator == "." && $fp_dec_separator == ","){
            $field_value = str_replace(",", ".", $field_value);
            $field_value = number_format($field_value, $fp_decimal_places, $fp_dec_separator, $fp_thousands_separator);
        }
        return $field_value;
    }

    /**
     * Get foreign key input
     *      @param $keyFieldValue
     *      @param $fk_field_name
     *      @param $fk_field_value
     *      @param $mode
     *      @param $multirow_postfix
     */
    protected function GetForeignKeyInput($keyFieldValue, $fk_field_name, $fk_field_value, $mode='edit', $multirow_postfix = ''){
        $req_mode = $this->GetVariable('mode');

        // check if foreign key field is readonly or disabled
        $readonly = '';
        $disabled = '';
        $fp_pre_addition   = $this->GetFieldProperty($fk_field_name, "pre_addition", 'edit');
        $fp_post_addition  = $this->GetFieldProperty($fk_field_name, "post_addition", 'edit');        
        $fp_readonly       = $this->GetFieldPropertyBool($fk_field_name, 'readonly', 'edit', false, false);
        $fp_radiobuttons_alignment = "horizontal";        
        if(isset($this->arrForeignKeys[$fk_field_name]['radiobuttons_alignment']) && (strtolower($this->arrForeignKeys[$fk_field_name]['radiobuttons_alignment']) == "vertical")){
            $fp_radiobuttons_alignment = "vertical";        
        }
        if($req_mode == 'edit'){
            if($fp_readonly) $disabled = "disabled";
        }

        if($this->dbType == 'PEAR') $this->dbHandler->setFetchMode(DB_FETCHMODE_ASSOC);
        $kFieldValue = $fk_field_value;
        /* [#0056 under check - 27.02.12]*/
        //$sql = "SELECT ".$fk_field_name." FROM ".$this->tblName." WHERE ".$this->primaryKey." = '".$keyFieldValue."'";
        //$dSet = $this->dbHandler->query($sql);
        //if($row = $this->dgFetchRow($dSet)){
        //    echo '-'.$kFieldValue = $row[$fk_field_name];
        //}else{
        //    echo '='.$kFieldValue = -1;
        //}
        
        // select from outer table
        $sql  = " SELECT ".$this->arrForeignKeys[$fk_field_name]['field_key'].",".$this->arrForeignKeys[$fk_field_name]['field_name']." ";
        $sql .= " FROM ".(($this->dgGetDbDriverType() == 'ibm') ? $this->dbSchema.'.' : '').$this->arrForeignKeys[$fk_field_name]['table']." ";
        $sql .= " WHERE 1=1 ";
        if($mode !== 'edit'){
            $sql .= " AND ".$this->arrForeignKeys[$fk_field_name]['field_key']." = '".$kFieldValue."'";
        }
        if(isset($this->arrForeignKeys[$fk_field_name]['condition']) && ($this->arrForeignKeys[$fk_field_name]['condition'] != '')){
            $sql .= " AND " .$this->arrForeignKeys[$fk_field_name]['condition'];
        }
        // define sorting order
        if(isset($this->arrForeignKeys[$fk_field_name]['order_by_field']) && ($this->arrForeignKeys[$fk_field_name]['order_by_field'] != '')){
            $order_by_field = $this->arrForeignKeys[$fk_field_name]['order_by_field'];
        }else{
            $order_by_field = $this->arrForeignKeys[$fk_field_name]['field_key'];
        }
        // define sorting type
        $order_type = "DESC";
        if(isset($this->arrForeignKeys[$fk_field_name]['order_type'])){
            if(strtolower($this->arrForeignKeys[$fk_field_name]['order_type']) == "asc"){
                $order_type = "ASC";
            }
        }
        $sql .= " ORDER BY ".$order_by_field." ".$order_type;
        
        $is_error = false;
        if($this->dbType == 'PDO'){
            try{
                $dSet = $this->dbHandler->query($sql);
            }catch(PDOException $e){
                $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                $is_error = true;
            }
        }else{
            $dSet = $this->dbHandler->query($sql);
            if($this->CheckIsError($dSet)){
                $is_error = true;
                $this->AddErrors($dSet);
            }
        }                
        
        if($this->debug){
            if($this->dbType == 'PEAR'){
                $num_rows = (!$is_error) ? $dSet->numRows() : 0;
            }else{
                $num_rows = (!$is_error) ? $dSet->rowCount() : 0;
            }
            $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Retrieve data for foreign key:</i><br><b>search sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$num_rows.") </b>". $sql.'</div>';            
        }
      
        if($mode === 'edit'){            
            // save entered values from fields in add/edit modes
            $req_field_value = $this->GetVariable($this->GetFieldRequiredType($fk_field_name).$fk_field_name, false, "post");            
            $on_js_event = (isset($this->arrForeignKeys[$fk_field_name]['on_js_event'])) ? $this->arrForeignKeys[$fk_field_name]['on_js_event'] : '';
            $view_type = (isset($this->arrForeignKeys[$fk_field_name]['view_type'])) ? $this->arrForeignKeys[$fk_field_name]['view_type'] : '';            
            if($view_type == "label"){ //'view_type"=>"label"
                while($row = $this->dgFetchRow($dSet)){
                    $ff_name = $this->arrForeignKeys[$fk_field_name]['field_name'];
                    $ff_key  = $this->arrForeignKeys[$fk_field_name]['field_key'];
                    if(preg_match("/ as /i", strtolower($ff_name))) $ff_name = substr($ff_name, strpos(strtolower($ff_name), " as ")+4);
                    if($row[$ff_key] === $kFieldValue){
                        return $this->nbsp.$fp_pre_addition.$row[$ff_name].$fp_post_addition.$this->nbsp;                 
                    }
                }
                return '';
            }else if($view_type == 'textbox'){ //'view_type"=>'textbox'
                while($row = $this->dgFetchRow($dSet)){
                    $ff_name = $this->arrForeignKeys[$fk_field_name]['field_name'];
                    if(preg_match("/ as /i", strtolower($ff_name))) $ff_name = substr($ff_name, strpos(strtolower($ff_name), " as ")+4);
                    if($row[$ff_name] === $kFieldValue){
                        $kFieldValue = $row[$ff_name];
                        $kFieldValue = str_replace(array('"',"'"), array("&quot;","&#039;"), $kFieldValue);
                    }
                }
                return "<input class='".$this->cssClass."_dg_textbox' type='text' title='".$this->GetFieldTitle($fk_field_name)."' id='".$this->GetFieldRequiredType($fk_field_name).$fk_field_name.$multirow_postfix."' name='".$this->GetFieldRequiredType($fk_field_name).$fk_field_name.$multirow_postfix."' value='".$kFieldValue."' $disabled ".$on_js_event." />";
            }else if($view_type == 'radiobutton'){ //'view_type"=>'radiobutton'
                if($kFieldValue == '-1') $kFieldValue = $this->GetFieldProperty($fk_field_name, "default");
                return $this->DrawRadioButtons($this->GetFieldRequiredType($fk_field_name).$fk_field_name.$multirow_postfix, $fk_field_name, $dSet, $kFieldValue, 'field_key', 'field_name', $disabled, $on_js_event, $fp_radiobuttons_alignment);
            }else { //'view_type"=>"dropdownlist" - default   
                $req_field_name = $this->GetVariable($this->GetFieldRequiredType($fk_field_name).$fk_field_name, false, "post");                
                if($req_mode == 'add'){
                    if($req_field_name != '') $new_field_value = $req_field_value;
                    else $new_field_value = $this->GetFieldProperty($fk_field_name, "default");
                }else {
                    if(!empty($req_field_name) && empty($fk_field_value)){    
                        $new_field_value = $req_field_value;
                    }else if(!empty($req_field_name) && !empty($fk_field_value)){     
                        // to prevent losing selection when we update 2nd grid
                        if($this->anotherDatagrids != ''){
                            $new_field_value = $fk_field_value;    
                        }else{
                            $new_field_value = $req_field_value;    
                        }
                    }else $new_field_value = $fk_field_value;
                }
                return $fp_pre_addition.$this->DrawDropDownList($this->GetFieldRequiredType($fk_field_name).$fk_field_name.$multirow_postfix, '', $dSet, $new_field_value, $fk_field_name, 'field_key', 'field_name', $disabled, $on_js_event).$fp_post_addition;
            }
        }else{
            if(!isset($dSet->message) || $dSet->message == ''){            
                $row = $this->dgFetchRow($dSet);
                $ff_name = $this->arrForeignKeys[$fk_field_name]['field_name']; 
                if(preg_match("/ as /i", strtolower($ff_name))) $ff_name = substr($ff_name, strpos(strtolower($ff_name), " as ")+4); 
                return $this->nbsp.$fp_pre_addition.(isset($row[$ff_name]) ? $row[$ff_name] : '').$fp_post_addition.$this->nbsp;                 
            }else{
                if(isset($dSet->message)){ echo $dSet->message; }
                if(isset($dSet->userinfo)){ echo $dSet->userinfo; }
                return '';
            }
        }        
    }

    ////////////////////////////////////////////////////////////////////////////
    // URL string creating
    ////////////////////////////////////////////////////////////////////////////
    /**
     * Set URL
     *      @param &$curr_url
     *      @param $filtering
     *      @param $sorting
     *      @param $paging
     *      @param $amp
     *      @param $encode
     */
    protected function SetUrlString(&$curr_url, $filtering='', $sorting='', $paging='', $amp='', $encode=false){
        $amp = ($amp != '') ? $amp : $this->amp;
        $req_sort_field = $this->GetVariable('sort_field');        
        if($filtering != '') $this->SetUrlStringFiltering($curr_url, $amp, $encode);
        // [#0022 under check - 24.08.10] fix for default multiple sorting
        if($this->layouts['edit'] == '0' || ($sorting != '' && $req_sort_field != '')) $this->SetUrlStringSorting($curr_url, $amp);
        if($paging != '') $this->SetUrlStringPaging($curr_url, $amp);
    }
    
    /**
     * Set URL string filtering
     *      @param &$curr_url
     *      @param $amp
     *      @param $encode
     */
    protected function SetUrlStringFiltering(&$curr_url, $amp='', $encode=false){        
        if(!$this->filteringAllowed) return false;
        
        $amp = ($amp != '') ? $amp : $this->amp;
        if($this->methodPostBack == 'ajax') $amp = '&';
        
        foreach($this->arrFilterFields as $fldName => $fldValue){
            $fp_field_type = $this->GetFieldProperty($fldName, 'field_type', 'filter', 'normal');
            if($fp_field_type != '') $fp_field_type = "_fo_".$fp_field_type;
            
            // [#0043] fixed bug 19.09.2011
            $field_value_split = explode(",", $fldValue['field']);
            foreach($field_value_split as $fldValueField){
                
                // get extension for from/to fields
                $table_field_name = str_replace(".", "_d_", trim($fldValue['table']))."_".$fldValueField;
                // split if there is a complicated filed like (last_name, first_name)
                if(preg_match("/\,/", $table_field_name)){
                    $table_field_name_split = explode(",", $table_field_name);
                    $table_field_name = $table_field_name_split[0];
                }

                // full name of field in URL    
                $field_name_in_url = $this->uniquePrefix."_ff_".$table_field_name.$fp_field_type;
                $filter_field_value = (isset($_REQUEST[$field_name_in_url]) && !is_array($_REQUEST[$field_name_in_url])) ? stripcslashes($_REQUEST[$field_name_in_url]) : '';                    
                if($filter_field_value != ''){
                    if($this->methodPostBack == "post" || (($this->methodPostBack == 'ajax') && !$encode)){
                        $curr_url .= $amp.$field_name_in_url."=".$filter_field_value;
                    }else{
                        $curr_url .= $amp.$field_name_in_url."=".urlencode($filter_field_value);
                    }                    
                }
                
                $table_field_name_operator = $table_field_name."_operator";
                // full operator name in URL
                $operator_name_in_url = $this->uniquePrefix."_ff_".$table_field_name_operator.$fp_field_type;                
                if(isset($_REQUEST[$operator_name_in_url]) && ($_REQUEST[$operator_name_in_url] != '')){
                    $curr_url .= $amp.$operator_name_in_url."=".urlencode($_REQUEST[$operator_name_in_url]); 
                }
            }
        }
        if(isset($_REQUEST[$this->uniquePrefix."_ff_".'selSearchType']) && (trim($_REQUEST[$this->uniquePrefix."_ff_".'selSearchType']) != ''))
            $curr_url .= $amp.$this->uniquePrefix."_ff_"."selSearchType=".urlencode($_REQUEST[$this->uniquePrefix."_ff_".'selSearchType']);            
        if($this->onSubmitFilter != '')
            $curr_url .= $amp.$this->uniquePrefix."_ff_"."onSUBMIT_FILTER=search";
            
        $curr_url = str_replace("'", "&#039;", $curr_url);
    }

    /**
     * Set URL string sorting
     *      @param &$curr_url
     *      @param $amp
     */
    protected function SetUrlStringSorting(&$curr_url, $amp=''){
        $amp = ($amp != '') ? $amp : $this->amp;
        if($this->methodPostBack == 'ajax') $amp = '&';
        $sort_field = $this->GetVariable('sort_field');
        $sort_field_by = $this->GetVariable('sort_field_by');
        $sort_field_type = $this->GetVariable('sort_field_type');
        $sort_type = $this->GetVariable('sort_type');
        if(isset($this->defaultSortFieldHelp)) { $this->defaultSortField[0] = $this->defaultSortFieldHelp; }
        if(isset($this->defaultSortTypeHelp)) { $this->defaultSortType[0] = $this->defaultSortTypeHelp; }
        if($sort_field != '') {
           $this->sortField = $sort_field;
           $this->sortFieldBy = $sort_field_by;
           $this->sortFieldType = $sort_field_type;
           $curr_url .= $amp.$this->uniquePrefix."sort_field=".$this->sortField.$amp.$this->uniquePrefix."sort_field_by=".$this->sortFieldBy.$amp.$this->uniquePrefix."sort_field_type=".$this->sortFieldType;
        }else {
            //d 30.01.09 if(!is_numeric($this->defaultSortField[0])){ $this->defaultSortField[0] = $this->GetFieldOffset($this->defaultSortField[0]) + 1; }
            $curr_url .= $amp.$this->uniquePrefix."sort_field=".$this->defaultSortField[0];
        }; // make pKey      
        if($sort_type != '') {
            $this->sortType = $sort_type;
            $curr_url .= $amp.$this->uniquePrefix."sort_type=".$this->sortType;
        } else {
            $curr_url .= $amp.$this->uniquePrefix."sort_type=".$this->defaultSortType[0];
        };          
    }

    /**
     * Set URL string pading
     *      @param &$curr_url
     *      @param $amp
     */
    protected function SetUrlStringPaging(&$curr_url, $amp=''){
        $amp = ($amp != '') ? $amp : $this->amp;
        if($this->methodPostBack == 'ajax') $amp = '&';
        $page_size = $this->GetVariable('page_size');
        $p = $this->GetVariable('p');
        if($this->layouts['edit'] == '0'){            
            if($page_size != ''){
                $this->reqPageSize = $page_size;
                $curr_url .= $amp.$this->uniquePrefix."page_size=".$this->reqPageSize;
            }else{ 
                $curr_url .= $amp.$this->uniquePrefix."page_size=".$this->reqPageSize;
            }            
        }else{            
            if($this->mode === 'view'){
                if($this->methodPostBack == 'ajax'){
                    $curr_url_ps = ($page_size != '') ? $page_size : $this->reqPageSize;
                }else $curr_url_ps = $this->reqPageSize;
                $curr_url .= $amp.$this->uniquePrefix."page_size=".$curr_url_ps;
            }else{ 
                if($page_size != ''){
                    $this->reqPageSize = $page_size;
                }else{
                    if($this->mode == 'edit'){
                        $this->reqPageSize = $this->defaultPageSize;
                    }
                }
                $curr_url .= $amp.$this->uniquePrefix."page_size=".$this->reqPageSize;
            }
        }
        if($p != ''){
            $this->pageCurrent = $p;
            $curr_url .= $amp.$this->uniquePrefix."p=".$this->pageCurrent;
        }else{
            $this->pageCurrent = 1;
            $curr_url .= $amp.$this->uniquePrefix."p=1";
        };
    } 

    ////////////////////////////////////////////////////////////////////////////
    // View & Edit mode methods
    ////////////////////////////////////////////////////////////////////////////
    /**
     * Get enum values
     *      @param $table
     *      @param $field
     */
    protected function GetEnumValues($table, $field){
        $enum_array = array();
        $enum_fields = array();
        $empty_result = array();

        $sql = $this->ShowColumns($table, $field);        
        if($this->dbType != 'PDO') $this->dbHandler->setFetchMode(DB_FETCHMODE_ORDERED);
        $dSet = $this->dbHandler->query($sql);
        if($this->dbType != 'PDO' && $this->dbHandler->isError($dSet) == 1) return $empty_result;
        if($row = $this->dgFetchRow($dSet)){            
            // extract the values, the values are enclosed in single quotes and separated by commas
            $regex = "/'(.*?)'/";
            preg_match_all( $regex , $row[1], $enum_array);            
            $temp_enum_fields = $enum_array[1];
            foreach($temp_enum_fields as $key => $val){
                $enum_fields[$val] = $val;
            }
            return $enum_fields;
        }            
        return $empty_result;
    } 
  
    /**
     * Check if field exists & can be viewed
     *      @param $field_name
     */
    protected function CanViewField($field_name){
        $req_export        = $this->GetVariable('export');
        $fp_visible        = $this->GetFieldPropertyBool($field_name, 'visible', $this->mode, true, true);
        $fp_show_on_print  = $this->GetFieldPropertyBool($field_name, "show_on_print", $this->mode, true, true);
        $fp_show_on_export = $this->GetFieldPropertyBool($field_name, "show_on_export", $this->mode, true, true);
        $columnsArray      = &$this->columnsViewMode;
        if($this->mode === 'view'){
            $columnsArray = &$this->columnsViewMode;
        }else if($this->mode === 'edit' || $this->mode === 'details' || $this->mode === 'add'){
            $columnsArray = &$this->columnsEditMode;
        }
        if($this->mode === 'view' || $this->mode === 'edit' || $this->mode === 'details' || $this->mode === 'add'){
            if(!empty($field_name) && array_key_exists($field_name, $columnsArray)){                
                if($this->isPrinting && $fp_show_on_print) return true;
                else if($req_export == 'true' && $fp_show_on_export) return true;
                else if(!$this->isPrinting && $req_export != 'true' && $fp_visible) return true;
            }
        }
        return false;
    }
    
    /**
     * Get Record ID for selected row
     *      @param $row
     */
    protected function GetRecordID($row){
        return intval($row[(($this->GetFieldOffset($this->primaryKey) != -1) ? $this->GetFieldOffset($this->primaryKey) : 0)]);
    }

    /**
     * Get field value by type
     *      @param $field_value
     *      @param $ind
     *      @param $row
     *      @param $field_name
     *      @param $m_field_req_type
     *      @param $mode
     *      @param $multirow_postfix
     */
    protected function GetFieldValueByType($field_value, $ind, $row, $field_name='', $m_field_req_type='', $mode='', $multirow_postfix=''){
        // Un-quote string quoted by SetRealEscapeStringByDbType()
        if(get_magic_quotes_gpc()) {
            if(ini_get('magic_quotes_sybase')) {
                $field_value = str_replace("''", "'", $field_value);
            } else {
                // [#0013] - remove! $field_value = str_replace("''", "'", $field_value);                
                if($this->allowRealEscape == false){
                    $field_value = str_replace("'", "&#039;", $field_value);
                }
                if(!is_array($field_value)) $field_value = stripslashes($field_value);
            }
        }        
        
        $req_mode  = $this->GetVariable('mode');
        if($mode == '') $mode = $this->mode;
        $output = $fp_pre_addition = $fp_post_addition = '';
      
        if($field_name == '') $field_name = $this->GetFieldName($ind);
        // -= VIEW MODE =-
        if($mode === 'view'){
            if(array_key_exists($field_name, $this->columnsViewMode)){
                
                $fp_tooltip         = $this->GetFieldProperty($field_name, 'tooltip', 'view');
                $fp_tooltip_type    = $this->GetFieldProperty($field_name, "tooltip_type", 'view');
                $fp_pre_addition    = $this->GetFieldProperty($field_name, "pre_addition", 'view');
                $fp_post_addition   = $this->GetFieldProperty($field_name, "post_addition", 'view');
                $fp_on_item_created = $this->GetFieldProperty($field_name, "on_item_created", 'view');
                $fp_text_length     = $this->GetFieldProperty($field_name, "text_length", 'view');
                $fp_type            = $this->GetFieldProperty($field_name, 'type', 'view');
                $fp_case            = $this->GetFieldProperty($field_name, "case", 'view');
                $on_js_event        = $this->GetFieldProperty($field_name, "on_js_event", 'view', 'normal');
                $fp_hide            = $this->GetFieldProperty($field_name, "hide", 'view');
                $title              = '';
                
                // customized working with field value
                if(function_exists($fp_on_item_created) && $fp_type != "money"){
                    //ini_set("allow_call_time_pass_reference", true); 
                    $field_value = $fp_on_item_created($field_value);
                }
                
                $this->PrepareTextLength($field_value, $title, $fp_text_length, $fp_tooltip, $fp_tooltip_type);
                $field_type = ($fp_type == '') ? "label" : $fp_type;
                
                // format case of field value
                if(strtolower($fp_case) == "upper"){
                    $field_value = Helper::ConvertCase($field_value,"upper",$this->langName);
                }else if(strtolower($fp_case) == 'lower'){
                    $field_value = Helper::ConvertCase($field_value,'lower',$this->langName);
                }else if(strtolower($fp_case) == "camel"){
                    $field_value = Helper::ConvertCase($field_value,"camel",$this->langName);
                }
                if($this->isPrinting && !in_array($field_type, array("enum", "barchart", "image"))){ $field_type = "label"; }

                switch($field_type){
                    case "barchart":
                        $fp_field         = $this->GetFieldProperty($field_name,"field",'view');
                        $fp_maximum_value = ($this->GetFieldProperty($field_name,"maximum_value",'view') != '') ? $this->GetFieldProperty($field_name,"maximum_value",'view') : 1;                        
                        $fp_value_sign    = $this->GetFieldProperty($field_name,"value_sign",'view');                        
                        $fp_display_type  = $this->GetFieldProperty($field_name,"display_type",'view');
                        $fp_width         = (int)$this->GetFieldProperty($field_name, "width", 'view', 'lower', "100");
                        $fp_width_relation = ($fp_width/100);

                        if(($fp_field != '') && ($this->GetFieldOffset($fp_field) != -1)) $field_value = $row[$this->GetFieldOffset($fp_field)];
                        $inner_width = (($field_value/$fp_maximum_value) >=1) ? 100 : ($field_value/$fp_maximum_value) * 100;
                        $inner_width = $inner_width * $fp_width_relation;
                        
                        $fp_min_value = ($this->GetFieldProperty($field_name,"minimum_value",'view') != '') ? $this->GetFieldProperty($field_name,"minimum_value",'view') : 33*$fp_width_relation;
                        $fp_min_color = ($this->GetFieldProperty($field_name,"minimum_color",'view') != '') ? $this->GetFieldProperty($field_name,"minimum_color",'view') : "#f0d0d0";
                        $fp_mid_value = ($this->GetFieldProperty($field_name,"middle_value",'view') != '') ? $this->GetFieldProperty($field_name,"middle_value",'view') : 66*$fp_width_relation;
                        $fp_mid_color = ($this->GetFieldProperty($field_name,"middle_color",'view') != '') ? $this->GetFieldProperty($field_name,"middle_color",'view') : "#f0f0d0";
                        $fp_max_color = ($this->GetFieldProperty($field_name,"maximum_color",'view') != '') ? $this->GetFieldProperty($field_name,"maximum_color",'view') : "#d0f0d0";
                        
                        if($inner_width > $fp_mid_value) $inner_color = $fp_max_color; 
                        else if($inner_width > $fp_min_value) $inner_color = $fp_mid_color; 
                        else $inner_color = $fp_min_color; 

                        if($fp_display_type == "vertical"){
                            $output = "<table height='120px' style='border:0px;' align='center' cellpadding='0' cellspacing='0' ".$on_js_event.">
                            <tr>
                                <td valign='bottom' align='center'>".(($field_value >= 0) ? $field_value : '').$fp_value_sign."                            
                                    <table width='20px;' style='background-color:#efefef;border:1px solid #cccccc;' align='center' cellpadding='0' cellspacing='0' ".$on_js_event.">
                                    <tr><td align='center' height='".$inner_width."px' bgcolor='".$inner_color."' class='dg_nowrap'></td></tr>
                                    </table>
                                </td>
                            </tr>
                            </table>";
                        }else{
                            $output = "<table height='10px;' align='center' cellpadding='0' cellspacing='0' ".$on_js_event.">
                            <tr><td align='left' width='".$fp_width."px' title='".$field_value."'>
                                <div style='float:left;font-size:9px;width:".$fp_width."px;height:10px;padding:1px;background-color:#efefef; border:1px solid #cccccc;'>
                                    <div style='float:left;width:".$inner_width."px;height:10px;background-color:".$inner_color.";'></div>
                                </div></td>
                                <td align='right' style='width:16px;font-size:9px;padding-left:3px;'>".(($field_value != 0) ? $field_value : '0').$fp_value_sign."</td>
                            </tr></table>";
                        }
                        break;
                    case "blob":
                        $output = "[BLOB] - ".number_format(strlen($field_value)/1024, 1)." Kb";
                        break;
                    case 'checkbox':
                        $checked = '';
                        $full_field_name = "sy".$field_name.$multirow_postfix;
                        $row_id = $this->GetRecordID($row);
                        $fp_true_value = $this->GetFieldProperty($field_name, 'true_value', 'view');
                        $fp_false_value = $this->GetFieldProperty($field_name, 'false_value', 'view');
                        $fp_readonly    = $this->GetFieldPropertyBool($field_name, 'readonly', 'view', false, false);
                        $pk_value = isset($row[$this->GetFieldOffset($this->primaryKey)]) ? "_".$row[$this->GetFieldOffset($this->primaryKey)] : '';
                        if($fp_readonly) $readonly = 'disabled';
                        else $readonly = '';                 

                        $new_field_value = $fp_true_value;
                        if(($fp_true_value !== '') && ($fp_false_value !== '')){
                            if($field_value == $fp_true_value){
                                $checked = "checked='checked'";
                                $new_field_value = $fp_false_value;
                            }else{
                                $new_field_value = $fp_true_value;
                            }
                        }
                        $href_string = '';
                        $this->SetUrlString($href_string, '', 'sorting', 'paging', '&');
                        $on_change = "onclick='if(confirm(\"".$this->lang['alert_perform_operation']."\")){".$this->uniquePrefix."_doPostBack(\"toggle_status\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"".$href_string.'&'.$this->uniquePrefix."toggle_status=1&".$this->uniquePrefix."toggle_field=".$field_name.'&'.$this->uniquePrefix."toggle_field_value=".$new_field_value."\");}else{_dgStopPropagation(event);return false;};'";
                        $output = "<input ".$on_change." class='".$this->cssClass."_dg_checkbox' type='checkbox' name='".$full_field_name."' id='".$full_field_name.$pk_value."' title='".$this->GetFieldTitle($field_name)."' value='".trim($field_value)."' ".$checked." ".$readonly." ".$on_js_event." />";
                        break;
                    case "color":
                        $fp_view_type = $this->GetFieldProperty($field_name, 'view_type', 'view');
                        $color_name = Helper::GetColorNameByValue($field_value);
                        switch($fp_view_type){
                            case 'image':
                                $output = "<table align='center' cellspacing='0' cellpadding='0' border='0'><tr><td title='".$color_name."'><div style='border:1px solid #cecece;width:17px;height:17px;".((trim($field_value) != '') ? "background-color:".$field_value.';' : '')."'></div></td><td align='right' width='57px'><label class='".$this->cssClass."_dg_label'>".$field_value."</label></td></tr></table>";
                                break;                                
                            case 'text':
                            default:
                                $output = $field_value;
                                break;                                
                        }                        
                        break;                        
                    case "enum":
                        if(isset($this->columnsViewMode[$field_name]["source"]) && is_array($this->columnsViewMode[$field_name]["source"])){
                            if($this->GetFieldProperty($field_name, "multiple", 'view') == true){
                                $output = trim($field_value);   
                            }else{
                                $source_value = isset($this->columnsViewMode[$field_name]["source"][$field_value]) ? $this->columnsViewMode[$field_name]["source"][$field_value] : '';
                                $this->PrepareTextLength($source_value, $title, $fp_text_length, $fp_tooltip, $fp_tooltip_type);
                                $output = "<label class='".$this->cssClass."_dg_label'".$title.'>'.$source_value.'</label>';    
                            }                            
                        }else{
                            $output = "<label>".trim($field_value)."</label>";
                        }
                        break;
                    case 'image':
                        $fp_align        = $this->GetFieldProperty($field_name, 'align', 'view', 'lower', 'center');
                        $fp_target_path  = $this->GetFieldProperty($field_name, "target_path", 'view');
                        $fp_image_width  = $this->GetFieldProperty($field_name, "image_width", 'view', 'lower', '');
                        $fp_image_width_attr  = (trim($fp_image_width) != '') ? " width='".$fp_image_width."'" : '';
                        $fp_image_height = $this->GetFieldProperty($field_name, "image_height", 'view', 'lower', '');
                        $fp_image_height_attr = (trim($fp_image_height) != '') ? " height='".$fp_image_height."'" : '';
                        $fp_default      = $this->GetFieldProperty($field_name, "default", 'view', 'normal');
                        $fp_magnify      = $this->GetFieldProperty($field_name, "magnify", 'view', 'normal');
                        if($this->isPrinting) $fp_magnify = false;
                        $fp_magnify_type = $this->GetFieldProperty($field_name, 'magnify_type', 'view', 'normal');
                        $fp_magnify_power= $this->GetFieldProperty($field_name, "magnify_power", 'view', 'normal');
                        $fp_magnify_power= (is_numeric($fp_magnify_power)) ? $fp_magnify_power : '2';
                        $fp_linkto       = $this->GetFieldProperty($field_name, "linkto", 'view', 'normal');
                        $img_default     = '';
                        $img_magnify     = '';
                        $img_src         = $fp_target_path.trim($field_value);
                        if($fp_default != ''){
                            if($this->IsFileExists($fp_default)){
                                $img_default = "<img src='".$fp_default."' ".$fp_image_width_attr.$fp_image_height_attr." alt='' title='' ".$on_js_event.'>';
                            }else{
                                $img_default = "<span class='".$this->cssClass."_dg_label' ".$on_js_event.'>'.$this->lang['no_image'].'</span>';    
                            }                            
                        }
                        $ret_image_img = $this->nbsp."<img style='vertical-align:middle;border:0px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event.'>'.$this->nbsp;
                        $ret_image = $img_default;
                        if(($fp_magnify == 'true') || ($fp_magnify === true)){
                            if($fp_magnify_type == "lightbox"){
                                if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                    $ret_image = $this->nbsp."<a href='".$img_src."' rel='lytebox' title=''><img style='vertical-align: middle; border:0px solid #cccccc;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event."></a>".$this->nbsp;
                                }                                
                            }else if($fp_magnify_type == "popup"){
                                if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                    $ret_image = $this->nbsp."<img style='vertical-align: middle; border:0px solid #cccccc;cursor:pointer;' onclick=\"new_win=window.open('".$img_src."','ImageViewer','left=100,top=100,width=400,height=300,toolbar=0,menubar=0,resizable=1,location=0,scrollbars=1');new_win.focus()\" src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event." />".$this->nbsp;
                                }
                            }else if($fp_magnify_type == 'magnifier'){
                                $img_magnify = "onmouseover='showtrail(\"".$img_src."\",\"\",\"\",\"1\", ".($fp_image_height*$fp_magnify_power).", 1, ".($fp_image_width*$fp_magnify_power).");' onmouseout='hidetrail();'";   
                                if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                    $ret_image = $this->nbsp."<img style='vertical-align: middle; border:1px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event." ".$img_magnify.'>'.$this->nbsp;
                                }
                            }else if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                $ret_image = $ret_image_img;
                            }
                        }else{
                            if(trim($field_value) != '' && $this->IsFileExists($img_src)) $ret_image = $ret_image_img; 
                        }
                        if ($fp_linkto == 'details'){
                            $curr_url = $this->CombineUrl('details', $this->GetRecordID($row));
                            $this->SetUrlStringPaging($curr_url);
                            $this->SetUrlStringSorting($curr_url);
                            $this->SetUrlStringFiltering($curr_url);
                            $ret_image = "<a class='".$this->cssClass."_dg_a' href='".$curr_url."'>".$ret_image."</a>";
                        }
                        $output = $ret_image;
                        break;
                    case "label":
                        $fp_movable = $this->GetFieldProperty($field_name, "movable", 'view', 'normal');
                        $field_value_trim = trim(Helper::ConvertCase($field_value, 'lower', $this->langName));

                        if(($field_value_trim != '')
                            // we need this for right handling wysiwyg editor values
                            && ($field_value_trim !== "<pre></pre>")
                            && ($field_value_trim !== "<pre>".$this->nbsp."</pre>")
                            && ($field_value_trim !== "<p></p>")
                            && ($field_value_trim !== "<p>".$this->nbsp."</p>")){

                            // add handler of {field_name} holders in on_item_created
                            $temp = '';
                            $this->PrepareOnJSEventFields($on_js_event, $temp, $field_name, $row);
                            $output = $this->nbsp."<label class='".$this->cssClass."_dg_label' ".$title." ".$on_js_event.'>'.trim($field_value)."</label>".$this->nbsp;
                            
                            if($fp_movable === true || $fp_movable == 'true'){
                                $rid = $this->GetRecordID($row);
                                if(isset($_SESSION)){
                                    if(!isset($_SESSION[$this->uniquePrefix.'-move'][$field_name])) $_SESSION[$this->uniquePrefix.'-move'][$field_name] = array();
                                    $_SESSION[$this->uniquePrefix.'-move'][$field_name][] = $rid."#".$field_value;
                                }
                                if(!$this->isPrinting) $output .= " <a href='javascript:void(\"move=up\");' onclick='javascript:".$this->uniquePrefix."_doPostBack(\"move\",\"".Helper::EncodeParameter($rid, $this->safeMode)."\",\"".$this->urlString.'&'.$this->uniquePrefix."mode_parameters=up#".$field_name."\");'>";    
                                $output .= "<img src='".$this->directory."images/up.png' style='margin-bottom:2px' border='0' alt='' title='".$this->lang['move_up']."' />";
                                if(!$this->isPrinting) $output .= "</a>";
                                if(!$this->isPrinting) $output .= "<a href='javascript:void(\"move=down\");' onclick='javascript:".$this->uniquePrefix."_doPostBack(\"move\",\"".Helper::EncodeParameter($rid, $this->safeMode)."\",\"".$this->urlString.'&'.$this->uniquePrefix."mode_parameters=down#".$field_name."\");'>";
                                $output .= "<img src='".$this->directory."images/down.png' style='margin-top:2px' border='0' alt='' title='".$this->lang['move_down']."' />";
                                if(!$this->isPrinting) $output .= "</a>";
                            }                        
                        }else{
                            $output = ' ';
                        }
                        break;                    
                    case 'link':
                    case "linkbutton":
                        $fp_field_data = $this->GetFieldProperty($field_name, "field_data", 'view', 'normal');
                        $fp_rel        = $this->GetFieldProperty($field_name, "rel", 'view');
                        $fp_href       = $this->GetFieldProperty($field_name, "href", 'view');
                        $fp_target     = $this->GetFieldProperty($field_name, "target", 'view');
                        
                        if($fp_field_data != ''){
                            $rel = ($fp_rel != '') ? "rel=".$fp_rel : '';
                            $title = $this->GetFieldTitle($field_name, 'view');
                            $href = $fp_href;

                            // add handler of {field_name} holders in on_item_created
                            $this->PrepareOnJSEventFields($href, $on_js_event, $field_name, $row);

                            // remove unexpected 'http://'s
                            if(strstr($fp_href, "https://") != '' || strstr($href, "https://") != ''){
                                $href = str_replace(array("https://", "http://"), '', $href);
                                $href = "https://".$href;
                            }else if(strstr($fp_href, "http://") != ''){
                                $href = str_replace("http://", '', $href);
                                $href = "http://".$href;
                            }
                            $link_type = '';
                            if($this->GetFieldOffset($fp_field_data) != '-1'){
                                $field_value = trim($row[$this->GetFieldOffset($fp_field_data)]);
                                if(strtolower($fp_case) == "upper"){
                                    $field_value = Helper::ConvertCase($field_value,"upper",$this->langName);
                                }else if(strtolower($fp_case) == 'lower'){
                                    $field_value = Helper::ConvertCase($field_value,'lower',$this->langName);
                                }else if(strtolower($fp_case) == "camel"){
                                    $field_value = Helper::ConvertCase($field_value,"camel",$this->langName);
                                }
                                $link_type = '1';
                            }else if($field_value != ''){
                                $link_type = '2';
                            }else{
                                $output = '';
                            }
                            if($link_type == '1' || $link_type == '2'){
                                if($field_type == "linkbutton"){
                                    $output = "<input type='button' class='".$this->cssClass."_dg_button' value='".$field_value."' onclick=\"javascript:document.location.href='".$href."'\">";
                                }else{                                    
                                    $output = "<a class='".$this->cssClass."_dg_a2' href=\"".$href."\" target='".$fp_target."' ".$rel." title='".$title."' ".$on_js_event.'>'.$field_value."</a>";
                                }
                            }
                        }                        
                        break;
                    case "linktoview":
                        $row_id = $this->GetRecordID($row);
                        $output = "<a class='".$this->cssClass."_dg_a' href='javascript:".$this->uniquePrefix."_doPostBack(\"details\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"".$this->urlString."\");' title='".$this->lang['view_details']."' ".$on_js_event.'>'.trim($field_value)."</a>";
                        break;
                    case "linktoedit":
                        $row_id = $this->GetRecordID($row);
                        $output = "<a class='".$this->cssClass."_dg_a' href='javascript:".$this->uniquePrefix."_doPostBack(\"edit\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\");' title='".$this->lang['edit_record']."' ".$on_js_event.'>'.trim($field_value)."</a>";
                        break;
                    case "linktodelete":
                        $row_id = $this->GetRecordID($row);                         
                        $output = "<a class='".$this->cssClass."_dg_a' href='javascript:".$this->uniquePrefix."verifyDelete(\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"\");' title='".$this->lang['delete_record']."' ".$on_js_event.'>'.trim($field_value)."</a>";
                        break;
                    case "money": 
                        $fp_decimal_places   = $this->GetFieldProperty($field_name, "decimal_places", 'view'); 
                        $fp_dec_separator    = $this->GetFieldProperty($field_name, "dec_separator", 'view'); 
                        $fp_thousands_separator = $this->GetFieldProperty($field_name, "thousands_separator", 'view');                        
                        $fp_money_sign       = $this->GetFieldProperty($field_name, "sign", 'view');
                        $money_sign_after    = $money_sign_before = '';
                        if($this->GetFieldProperty($field_name, "sign_place", 'view') == "after"){
                            $money_sign_after  = $fp_money_sign;
                        }else{                                                        
                            $money_sign_before = $fp_money_sign;                            
                        }
                        if((trim($field_value) != '') 
                            // we need this for right handling wysiwyg editor values 
                            && (trim(Helper::ConvertCase($field_value,'lower',$this->langName)) !== "<pre></pre>") 
                            && (trim(Helper::ConvertCase($field_value,'lower',$this->langName)) !== "<pre>".$this->nbsp."</pre>") 
                            && (trim(Helper::ConvertCase($field_value,'lower',$this->langName)) !== "<p></p>") 
                            && (trim(Helper::ConvertCase($field_value,'lower',$this->langName)) !== "<p>".$this->nbsp."</p>")){ 

                            $field_value = number_format($field_value, $fp_decimal_places, $fp_dec_separator, $fp_thousands_separator);
                            if(function_exists($fp_on_item_created)){
                                //ini_set("allow_call_time_pass_reference", true); 
                                $field_value = $fp_on_item_created($field_value);
                            }
                            $output = "<label>".$money_sign_before.$field_value.$money_sign_after."</label>";
                        } 
                        break;
                    case "object":      
                        $fp_width   = $this->GetFieldProperty($field_name, "width", 'view', 'lower', "100px");
                        $fp_height  = $this->GetFieldProperty($field_name, "height", 'view', 'lower', "50px");
                        $fp_visible = $this->GetFieldProperty($field_name, 'visible', 'view');
                        if($field_value != '' && $fp_visible){
                            $output = "<object width='".$fp_width."' height='".$fp_height."' ".$on_js_event.">
                                       <param name='movie' value='".$field_value."'>
                                       <embed src='".$field_value."' width='".$fp_width."' height='".$fp_height."'></embed>
                                       </object>";                            
                        }
                        break;                    
                    case "password":
                        $output = "<label class='".$this->cssClass."_dg_label'>".(($fp_hide == 'true' || $fp_hide == true) ? "******" : $field_value)."</label>";
                        break;                    
                    case "percent":
                        $fp_decimal_places   = $this->GetFieldProperty($field_name, "decimal_places", 'view');
                        if(!is_numeric($fp_decimal_places)) $fp_decimal_places = '0';
                        $fp_dec_separator    = $this->GetFieldProperty($field_name, "dec_separator", 'view');
                        $field_value = ($field_value != '') ? number_format($field_value, $fp_decimal_places, $fp_dec_separator, ",")."%" : '';
                        $output = "<label>".$field_value."</label>";
                        break;
                    case "data":                        
                        $output = $field_value;
                        break;                    
                    default:
                        $output = "<label class='".$this->cssClass."_dg_label' ".$title." ".$on_js_event.'>'.trim($field_value)."</label>";
                        break;
                }
            }
        // -= ADD / EDIT / DETAILS MODE =-    
        }else if(($mode === 'edit') || ($mode === 'details')){
                
            if(array_key_exists($field_name, $this->columnsEditMode)){
                $fp_maxlength        = $this->GetFieldProperty($field_name, "maxlength");
                $fp_type             = $this->GetFieldProperty($field_name, 'type');
                $fp_req_type         = ($m_field_req_type != '') ? $m_field_req_type : $this->GetFieldProperty($field_name, "req_type");
                
                $fp_width            = $this->GetFieldProperty($field_name, "width");
                $fp_readonly         = $this->GetFieldPropertyBool($field_name, 'readonly', 'edit', false, false);
                $fp_default          = $this->GetFieldProperty($field_name, "default", 'edit', 'normal');
                $fp_value            = $this->GetFieldProperty($field_name, "value", 'edit', 'normal');
                $on_js_event         = $this->GetFieldProperty($field_name, "on_js_event", 'edit', 'normal');
                $fp_pre_addition     = $this->GetFieldProperty($field_name, "pre_addition");
                $fp_post_addition    = $this->GetFieldProperty($field_name, "post_addition");
                $fp_on_item_created  = $this->GetFieldProperty($field_name, "on_item_created", 'edit');
                $fp_autocomplete     = $this->GetFieldProperty($field_name, "autocomplete");
                $autocomplete        = ($fp_autocomplete == "off") ? "autocomplete='off'" : '';
                $fp_hide             = $this->GetFieldProperty($field_name, "hide", 'edit');
                $fp_generate         = $this->GetFieldProperty($field_name, "generate", 'edit');
                $fp_visible          = $this->GetFieldProperty($field_name, 'visible');
                $fp_save_as          = $this->GetFieldProperty($field_name, "save_as");
                
                $fp_calendar_type     = $this->GetFieldProperty($field_name, "calendar_type", 'edit', 'normal', "popup"); 
                $show_seconds         = $this->GetFieldProperty($field_name, "show_seconds", 'edit', 'normal', true); 
                $date_time_format_ymd = ($show_seconds === false) ? "Y-m-d H:i" : "Y-m-d H:i:s";
                $date_time_format_dmy = ($show_seconds === false) ? "d-m-Y H:i" : "d-m-Y H:i:s";
                $date_time_format_mdy = ($show_seconds === false) ? "m-d-Y H:i" : "m-d-Y H:i:s";
                
                $template             = $this->GetFieldProperty($field_name, "template");

                // customized working with field value
                if($fp_type != "enum" && function_exists($fp_on_item_created)){
                    //ini_set("allow_call_time_pass_reference", true);                     
                    $field_value = $fp_on_item_created($field_value);
                }
                
                // detect maxlength for the current field
                // [#0053 under check - 19.02.12]
                if($fp_maxlength == '-1'){
                    $field_maxlength = '';
                }else if(($fp_maxlength != '-1') && ((int)$fp_maxlength > 0)){
                    $field_maxlength = "maxlength='".(int)$fp_maxlength."'";
                }else{
                    $field_maxlen = $this->GetFieldInfo($field_name, 'len', 0);
                    if($field_maxlen <= 0) $field_maxlength = '';
                    else $field_maxlength = "maxlength='".$field_maxlen."'";               
                }

                // detect field's type
                if($fp_type == ''){ $field_type = "label"; } else $field_type = $fp_type;
                // get required prefix for a field
                $field_req_type = $fp_req_type;                
                if(strlen(trim($field_req_type)) == 3){ $field_req_type = $field_req_type; }
                else if(strlen(trim($field_req_type)) == 2){ $field_req_type = $field_req_type."y"; }
                else { $field_req_type = "syy"; }
                $full_field_name = $field_req_type.$field_name.$multirow_postfix;
                
                // detect field's width
                if($fp_width != '') $field_width = "style='width:".$fp_width.";'"; else $field_width = '';
                // detect field's readonly property                
                if($fp_readonly) { $readonly = "readonly='readonly'"; $disabled = "disabled"; }
                else { $readonly = ''; $disabled = ''; }                
                if($this->isPrinting && !in_array($field_type, array("enum", 'image'))){ $field_type = 'print'; }

                // get default value of field
                if($field_type == "hidden"){
                    $field_old_value = $field_value;
                    if($req_mode == 'add'  && $fp_default != '') $field_value = $fp_default;
                    if($req_mode == 'edit' && $fp_value != '' ) $field_value = $fp_value;
                    if($req_mode == 'edit' && $fp_value == '' && $fp_default != '') $field_value = $fp_default;
                }else{
                    if($req_mode == 'add'  && $fp_default != '') $field_value = $fp_default;
                }
                
                if($mode === 'edit'){
                    // save entered values from fields in add/edit modes.
                    // [#0052 under check - 15.02.12] Used method "request" to retrieve array
                    $req_field_value = $this->GetVariable($field_req_type.$field_name.$multirow_postfix, false, "request");                    
                    if($req_field_value != '') $field_value = $req_field_value;
                    switch($field_type){
                        case 'blob':                           
                            $output = "<textarea class='".$this->cssClass."_dg_textarea' name='".$full_field_name."' id='".$full_field_name."' title='".$this->GetFieldTitle($field_name)."' rows='3' cols='50' ".$readonly." ".$on_js_event.'>'.$field_value."</textarea>";
                            break;
                        case 'checkbox':                        
                            $checked = '';                            
                            $fp_true_value = $this->GetFieldProperty($field_name, "true_value");
                            $fp_false_value = $this->GetFieldProperty($field_name, "false_value");
                            $file_act = $this->GetVariable('file_act');                            
                            // save previous value if for was re-uploaded
                            if($file_act == "upload" || $file_act == "remove"){
                                if(isset($_POST[$full_field_name])) $field_value = $fp_true_value;    
                                else $field_value = $fp_false_value;
                            }                            
                            if(($fp_true_value !== '') && ($fp_false_value !== '')){
                                if($field_value == $fp_true_value) $checked = "checked='checked'"; 
                            }                            
                            $output = "<input class='".$this->cssClass."_dg_checkbox' type='checkbox' name='".$full_field_name."' id='".$full_field_name."' title='".$this->GetFieldTitle($field_name)."' value='".trim($field_value)."' ".$checked." ".$readonly." ".$on_js_event." />";
                            break;
                        case 'color':
                            $fp_view_type = $this->GetFieldProperty($field_name, 'view_type');
                            $fp_save_format = $this->GetFieldProperty($field_name, "save_format");
                            
                            switch($fp_view_type){
                                case 'picker':
                                    $output = $this->nbsp.$this->DrawColorPicker($full_field_name, $field_value, $field_name, $disabled, $on_js_event).$this->nbsp;
                                    break;                                
                                case 'dropdownlist':
                                default:
                                    $on_js_event = "onChange=\"_dgChangeColor('".$field_name."_colorbox".$multirow_postfix."', this.value);\"".$on_js_event;                            
                                    $arr_colors = Helper::GetColorsByName();                                    
                                    $output  = "<table cellspacing='0' cellpadding='0' border='0'><tr><td valign='middle'>";
                                    $output .= $this->nbsp.$this->DrawDropDownList($full_field_name, '', $arr_colors, $field_value, $field_name, '', '', $disabled, $on_js_event, false, '1', true).$this->nbsp;
                                    $output .= "</td><td valign='middle' align='left'><div id='".$field_name."_colorbox".$multirow_postfix."' style='border:1px solid #cecece;margin-left:5px;width:17px;height:17px;background-color:".$field_value.";'></div></tr></table>";
                                    break;
                            }                            
                            break;                        
                        case 'date':
                            $output = $this->DrawCalendarButton($field_name, $field_type, "Y-m-d", $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;                        
                        case 'datedmy':
                            $output = $this->DrawCalendarButton($field_name, $field_type, "d-m-Y", $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;                        
                        case 'datemdy':
                            $output = $this->DrawCalendarButton($field_name, $field_type, "m-d-Y", $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;                        
                        case 'datetime':
                            $output = $this->DrawCalendarButton($field_name, $field_type, $date_time_format_ymd, $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;                        
                        case 'datetimedmy':
                            $output = $this->DrawCalendarButton($field_name, $field_type, $date_time_format_dmy, $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;
                        case 'datetimemdy':
                            $output = $this->DrawCalendarButton($field_name, $field_type, $date_time_format_mdy, $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            break;
                        case 'enum':
                            $ret_enum = '';
                            $fp_view_type = $this->GetFieldProperty($field_name, 'view_type');
                            $fp_radiobuttons_alignment = $this->GetFieldProperty($field_name, "radiobuttons_alignment");
                            if($this->GetFieldProperty($field_name, "multiple") == true){ $enum_multiple = true; } else { $enum_multiple = false; }
                            $fp_multiple_size = $this->GetFieldProperty($field_name, "multiple_size", 'edit', 'lower', '4');
                            $arrEnumValues = $this->GetEnumValues($this->tblName, $field_name);
                            switch($fp_view_type){
                                case 'radiobutton':
                                    if(is_array($this->columnsEditMode[$field_name]["source"])){  // don't remove columns_edit_mode
                                        $ret_enum .= $this->nbsp.$this->DrawRadioButtons($full_field_name, $field_name, $this->columnsEditMode[$field_name]["source"], $field_value, 'source', '', $disabled, $on_js_event, $fp_radiobuttons_alignment).$this->nbsp;
                                    }else{
                                        $ret_enum .= $this->nbsp.$this->DrawRadioButtons($full_field_name, $field_name, $arrEnumValues, $field_value, 'source', '', $disabled, $on_js_event, $fp_radiobuttons_alignment).$this->nbsp;
                                    }                                        
                                    break;                            
                                case 'checkbox':
                                    if(is_array($this->columnsEditMode[$field_name]["source"])){  // don't remove columns_edit_mode
                                        $ret_enum .= $this->nbsp.$this->DrawCheckBoxes($full_field_name, '', $this->columnsEditMode[$field_name]["source"], $field_value, '', '', '', $disabled, $on_js_event, $enum_multiple, $fp_multiple_size).$this->nbsp;
                                    }else{
                                        $ret_enum .= $this->nbsp.$this->DrawCheckBoxes($full_field_name, '', $this->GetEnumValues($this->tblName, $field_name), trim($field_value), '', '', '', $disabled, $on_js_event, $enum_multiple, $fp_multiple_size).$this->nbsp;
                                    }
                                    break;    
                                case "dropdownlist":
                                default:
                                    if(is_array($this->columnsEditMode[$field_name]["source"])){  // don't remove columns_edit_mode
                                        $ret_enum .= $this->nbsp.$this->DrawDropDownList($full_field_name, '', $this->columnsEditMode[$field_name]["source"], $field_value, $field_name, '', '', $disabled, $on_js_event, $enum_multiple, $fp_multiple_size).$this->nbsp;
                                    }else{                                        
                                        $ret_enum .= $this->nbsp.$this->DrawDropDownList($full_field_name, '', $arrEnumValues, trim($field_value), $field_name, '', '', $disabled, $on_js_event, $enum_multiple, $fp_multiple_size).$this->nbsp;
                                    }
                                    break;
                            }
                            $output = $ret_enum;
                            break;
                        case "hidden":
                            $ret_hidden = "<input type='hidden' id='".$full_field_name."' name='".$full_field_name."' value='".trim($field_value)."' />";
                            if($fp_visible && ($this->layouts[$this->layoutType] != '0')) $ret_hidden .= "<label class='".$this->cssClass."_dg_label'>".(($req_mode == 'add') ? $field_value : $field_old_value)."</label>";
                            $output = $ret_hidden;                        
                            break;                        
                        case 'image':
                        case 'file':
                            $field_value = trim($field_value);
                            $ret_file = '';
                            $file = false;
                            $file_error_msg = '';
                            $file_name_view = $field_value;
                            $file_act = $this->GetVariable('file_act');
                            $file_id = $this->GetVariable('file_id');
                            // where the file is going to be placed 
                            $fp_target_path   = $this->GetFieldProperty($field_name, "target_path");
                            $fp_file_name     = $this->GetFieldProperty($field_name, "file_name");
                            $fp_allow_image_updating = $this->GetFieldProperty($field_name, "allow_image_updating", '');
                            $fp_allowed_extensions = $this->GetFieldProperty($field_name, "allowed_extensions", 'edit', 'lower');
                            $fp_allowed_extensions_array = explode(",", str_replace(" ", '', $fp_allowed_extensions));
                            $fp_blob_filetype = $this->GetFieldProperty($field_name, "blob_filetype");
                            $fp_blob_filename = $this->GetFieldProperty($field_name, "blob_filename");
                            $fp_blob_filesize = $this->GetFieldProperty($field_name, "blob_filesize");
                            $fp_image_width   = $this->GetFieldProperty($field_name, "image_width", 'edit', 'lower', '');
                            $fp_image_width_attr  = (trim($fp_image_width) != '') ? " width='".$fp_image_width."'" : '';
                            $fp_image_height  = $this->GetFieldProperty($field_name, "image_height", 'edit', 'lower', '');
                            $fp_image_height_attr = (trim($fp_image_height) != '') ? " height='".$fp_image_height."'" : '';
                            $fp_max_file_size = $this->GetFieldProperty($field_name, "max_file_size", 'edit', 'lower');
                            $fp_resize_image  = $this->GetFieldPropertyBool($field_name, "resize_image", 'edit');
                            $fp_resize_dir    = $this->GetFieldProperty($field_name, "resize_dir", 'edit');
                            $fp_resize_width  = $this->GetFieldProperty($field_name, "resize_width", 'edit');
                            $fp_resize_height = $this->GetFieldProperty($field_name, "resize_height", 'edit');
                            $fp_magnify       = $this->GetFieldProperty($field_name, "magnify", 'edit');
                            $fp_magnify_type  = $this->GetFieldProperty($field_name, 'magnify_type', 'edit');
                            $fp_magnify_power = $this->GetFieldProperty($field_name, 'magnify_power', 'edit', 'normal');
                            $fp_magnify_power = (is_numeric($fp_magnify_power)) ? $fp_magnify_power : '2';                            
                            $img_magnify      = '';
                            $img_src          = $fp_target_path.$field_value;
                            $f_size           = '';
                            $ret_file_img     = '';  
                            if($multirow_postfix != '') $rid = str_replace("_", '', $multirow_postfix);
                            else $rid = $this->rid;
                            
                            if($this->GetFieldProperty($field_name, 'host') == 'remote'){                                
                                // *** upload file from url (remote host)
                                $ret_file = '';
                                if($field_value == ''){
                                    if(($file_act == "upload") && ($file_id == $field_name.$multirow_postfix)){
                                        $file_error_msg = $this->lang['file_uploading_error'];
                                        $file = false;
                                    }
                                }else{                                    
                                    if(($file_act == "remove") && ($file_id == $field_name.$multirow_postfix)){                                    
                                        if(!$this->isDemo){
                                            if($req_mode != 'add'){
                                                $sql = "UPDATE $this->tblName SET ".$field_name." = '' WHERE ".$this->primaryKey." = '".$rid."' ";
                                                $this->dbHandler->query($sql);
                                                if($this->debug) echo $sql.'<br />';
                                            }
                                            // delete file from target path
                                            if(@$this->IsFileExists($fp_target_path.$field_value)){ @unlink($fp_target_path.$field_value); }
                                            else{ $file_error_msg = $this->lang['file_deleting_error']; }
                                            $file = false;
                                        } else { $file = true; $file_error_msg = "Deleting operation is blocked in demo version"; }
                                    }else if(($file_act == "upload") && ($file_id == $field_name.$multirow_postfix)){
                                        if(!$this->isDemo){
                                            if($downloaded_file = fopen($field_value, "r")){
                                                $content = $this->HttpGetFile($field_value);
                                                // get file name from url
                                                $field_value = strrev($field_value);
                                                $last_slash = strlen($field_value) - strpos($field_value,'/');
                                                $field_value = strrev($field_value);
                                                if($last_slash) { $field_value = substr($field_value,$last_slash); }
                                                if($fp_file_name != ''){
                                                    $file_name_view = $fp_file_name.strchr(basename($field_value),".");
                                                    $field_value = $file_name_view;                                                
                                                }
                                                if($content == ''){
                                                    $file_error_msg = $this->lang['file_uploading_error'];
                                                }else if($uploaded_file = fopen($fp_target_path.$field_value, 'w')){
                                                    $file_extension = strtolower(strchr(basename($field_value),"."));
                                                    $file_extension_pure = str_replace(".", '', $file_extension);
                                                    $file = true;
                                                    //check for allowed extensions                                                    
                                                    if($fp_allowed_extensions != '' && count($fp_allowed_extensions_array) > 0){
                                                        if(!in_array($file_extension_pure, $fp_allowed_extensions_array)){
                                                            $file = false;
                                                            $file_error_msg = $this->lang['file_extension_error'];
                                                        }
                                                    }
                                                    if($file){
                                                        if(!fwrite($uploaded_file, $content)){
                                                            $file_error_msg = $this->lang['file_writing_error'];
                                                            $file = false;
                                                        }else{
                                                            if($req_mode != 'add'){
                                                                $sql = "UPDATE $this->tblName SET ".$field_name." = '".$field_value."' WHERE ".$this->primaryKey." = '".$rid."'";
                                                                $this->dbHandler->query($sql);
                                                            }
                                                            $file = true;
                                                            fclose($uploaded_file);
                                                        }
                                                    }
                                                }
                                                fclose($downloaded_file);
                                            }else{
                                                $file_error_msg = $this->lang['file_uploading_error'];                                            
                                            }                                            
                                        } else { $file = false; $file_error_msg = "Uploading operation is blocked in demo version"; }
                                    }else{
                                        $file = true;
                                    }
                                }                                

                                // [#0009-1 under check - 19.09.09] - start
                                // to prevent error on uploading after some operation was done on another datagrid
                                $upload_curr_url = $this->QUERY_STRING;
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_act=remove", '', $upload_curr_url);
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_act=upload", '', $upload_curr_url);
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_id=".$field_name.$multirow_postfix, '', $upload_curr_url);
                                if(is_array($this->anotherDatagrids)){
                                    foreach($this->anotherDatagrids as $key => $val){
                                        $upload_curr_url = str_replace($key."mode=update", $key."mode=view", $upload_curr_url);
                                    }
                                }                                
                                /// old variant
                                /// $upload_curr_url = $this->QUERY_STRING;                                
                                // [#0009-1 under check - 19.09.09] - end

                                // if there is a file (uploaded or exists)
                                if($file == true){
                                    if(strlen($field_value) > 40){
                                        $str_start = strlen($field_value) - 40;
                                        $str_prefix = "...";
                                    }else{
                                        $str_start = 0;
                                        $str_prefix = '';
                                    }
                                    if($file_error_msg != '') $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_error_message no_print'>".$file_error_msg."</label><br />";
                                    $ret_file .= '<table><tr valign="middle"><td align="center">';
                                    if($field_type == 'image'){ 
                                        list($f_width, $f_height, $f_type, $f_attr) = @getimagesize($fp_target_path.$field_value);
                                        if(($field_value !== '') && $this->IsFileExists($fp_target_path.$field_value)){
                                            $f_size = number_format((filesize($fp_target_path.$field_value)/1024),2,'.',',').' Kb';
                                            $ret_file_img = $this->nbsp."<img src='".$fp_target_path.$field_value."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value'>".$this->nbsp;
                                        }
                                        if(($fp_magnify == 'true') || ($fp_magnify == true)){
                                            if($fp_magnify_type == "lightbox"){
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<a href='".$img_src."' rel='lytebox' title='$field_value ($f_width x $f_height - $f_size)'><img style='border:0px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value' ".$img_magnify."></a>".$this->nbsp;
                                                }                                
                                            }else if($fp_magnify_type == "popup"){
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<a href=\"javascript:new_win = window.open('".$img_src."','ImageViewer','left=100,top=100,width=400,height=300,toolbar=0,resizable=1,location=0,scrollbars=1'); new_win.focus();\" title=''><img style='vertical-align: middle; border:0px solid #cccccc;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event."></a>".$this->nbsp;
                                                }
                                            }else if($fp_magnify_type == 'magnifier'){
                                                $img_magnify = "onmouseover='showtrail(\"".$img_src."\",\"\",\"\",\"1\", ".($fp_image_height*$fp_magnify_power).", 1, ".($fp_image_width*$fp_magnify_power).");' onmouseout='hidetrail();'";
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<img src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value' ".$img_magnify.'>'.$this->nbsp;
                                                }                                
                                            }
                                        }
                                        $ret_file .= $ret_file_img;                                        
                                    }else{
                                        $ret_file .= $this->nbsp.$str_prefix.substr($field_value, $str_start, 40).$this->nbsp;
                                        $ret_file .= $this->nbsp."<img src='".$this->directory."images/mimetypes/".Helper::GetFileMimetype($field_value).".png' alt='' style='margin:0 0 -3px 5px; width:16px; height:16px;' />".$this->nbsp;                                        
                                    }
                                    if($field_type == 'image') $ret_file .= '<br />';
                                    else $ret_file .= " ";
                                    if(!$fp_readonly && !$this->isPrinting){
                                        $ret_file .= $this->nbsp."<a class='".$this->cssClass."_dg_a' href='javascript:void(0);' onclick='_dgFormAction(\"remove\", \"".$field_name.$multirow_postfix."\", \"".$this->uniquePrefix."\", \"".$this->HTTP_URL."\", \"".$upload_curr_url."\", \"".$this->methodPostBack."\", \"".$this->GetVariable('mode')."\"); return false;'>[".$this->lang['remove']."]</a>".$this->nbsp;
                                    }
                                    $ret_file .= "</td></tr></table>";
                                    $ret_file .= "<input type='hidden' value='$field_value' name='".$full_field_name."' id='".$full_field_name."' />";                                 
                                }else if(!$this->isPrinting){
                                    if($file_error_msg != '') $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_error_message no_print'>".$file_error_msg."</label><br />";                                    
                                    $ret_file .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";
                                    $ret_file .= "<td><input type='textbox' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' ".$disabled." ".$on_js_event." /></td><td nowrap='nowrap' width='7px'></td>";
                                    if($this->uploadType != 'all') $ret_file .= "<td><a class='".$this->cssClass."_dg_a2' ".(($disabled == "disabled") ? "" : "style='cursor: pointer;' onclick='".$this->uniquePrefix."updateWysiwygFields(); _dgFormAction(\"upload\", \"".$field_name.$multirow_postfix."\", \"".$this->uniquePrefix."\", \"".$this->HTTP_URL."\", \"".$upload_curr_url."\", \"".$this->methodPostBack."\", \"".$this->GetVariable('mode')."\"); return false;'").">[".$this->lang['upload']."]</a></td>";
                                    $ret_file .= "</tr></table>";
                                }
                                $output = $ret_file;
                                
                            }else{
                                
                                // *** upload file from local machine                                
                                $ret_file = '';
                                if($file_act == "upload"){ 
                                    $file = true;
                                    if((count($_FILES) > 0) && ($file_id == $field_name.$multirow_postfix)){
                                        if(!$this->isDemo){
                                            $full_field_name_error = isset($_FILES[$full_field_name]["error"]) ? $_FILES[$full_field_name]["error"] : 0;
                                            if($full_field_name_error > 0){
                                                $file_error_msg = $this->lang['file_uploading_error'];
                                                if($this->debug) $file_error_msg .= "<br>Error: ".Helper::FileUploadErrorMessage($full_field_name_error);
                                                $file = false;
                                                $file_extension = '';
                                            }else{
                                                // check file's max size
                                                if($fp_max_file_size != ''){
                                                    $max_file_size = Helper::ConvertFileSize($fp_max_file_size); 
                                                    if(isset($_FILES[$full_field_name]["size"]) && ($_FILES[$full_field_name]["size"] > $max_file_size)){
                                                       $file = false;
                                                       $file_error_msg = $this->lang['file_invalid_file_size'].": ".number_format(($_FILES[$full_field_name]["size"]/1024),2,".",",")." Kb (".$this->lang['max'].". ".number_format(($max_file_size/1024),2,".",",")." Kb) ";
                                                    }
                                                }
                                                $file_extension = strtolower(strchr(basename($_FILES[$full_field_name]['name']),"."));
                                                $file_extension_pure = str_replace(".", '', $file_extension);
                                                //check for allowed extensions
                                                if($fp_allowed_extensions != '' && count($fp_allowed_extensions_array) > 0){
                                                    if(!in_array($file_extension_pure, $fp_allowed_extensions_array)){
                                                        $file = false;
                                                        $file_error_msg = $this->lang['file_extension_error'];
                                                    }
                                                }
                                            }                                    
                                            if($file == true){
                                                // create a directory for uploading, if it was not.
                                                if(!$this->IsFileExists($fp_target_path)) @mkdir($fp_target_path,0744);
                                                // add the original filename to our target path. Result is "uploads/filename.extension"
                                                if($fp_file_name != ''){                                                    
                                                    $target_path_full = $fp_target_path.$fp_file_name.$file_extension;
                                                }else{
                                                    $target_path_full = $fp_target_path.(isset($_FILES[$full_field_name]['name']) ? basename($_FILES[$full_field_name]['name']) : '');
                                                }
                                                if(isset($_FILES[$full_field_name]['tmp_name'])){
                                                    if($field_type == 'file' && $fp_save_as == "blob"){
                                                        $fp = fopen($_FILES[$full_field_name]['tmp_name'], 'r');
                                                        $field_value = fread($fp, filesize($_FILES[$full_field_name]['tmp_name']));
                                                        $field_value = addslashes($field_value);
                                                        fclose($fp);
                                                        $sql_prepare = "UPDATE ".$this->tblName."
                                                                        SET ".$field_name." = '{BLOB}'
                                                                            ".(($fp_blob_filetype != '') ? ", ".$fp_blob_filetype."='".$_FILES[$full_field_name]['type']."'" : '')."
                                                                            ".(($fp_blob_filename != '') ? ", ".$fp_blob_filename."='".Helper::MakeSafeFileName($_FILES[$full_field_name]['name'])."'" : '')."
                                                                            ".(($fp_blob_filesize != '') ? ", ".$fp_blob_filesize."='".filesize($_FILES[$full_field_name]['tmp_name'])."'" : '')."
                                                                        WHERE ".$this->primaryKey." = '".$rid."'";
                                                        $sql = str_replace('{BLOB}', $field_value, $sql_prepare);
                                                        if($req_mode != 'add'){
                                                            if($this->dbType == 'PEAR'){
                                                                $dSet = $this->dbHandler->query($sql);
                                                                $affectedRows = $this->dgGetAffectedRows();
                                                            }else{
                                                                try{
                                                                    $affectedRows = $this->dbHandler->exec($sql);
                                                                }catch(PDOException $e){                    
                                                                    $this->errors[] = 'Line: '.$e->getLine().' '.$e->getMessage();
                                                                }                    
                                                            }                                                            
                                                            if($this->debug) $this->sqlStatements[] = "<div class='".$this->cssClass."_dg_sql_message'><i>Update file/image field:</i><br><b>update sql (".Helper::ConvertCase($this->lang['total'],'lower',$this->langName).": ".$affectedRows.") </b>".$sql_prepare.'</div>';
                                                        }                                                        
                                                        $file = true;
                                                        $img_src = '';
                                                    }else{
                                                        @chmod($fp_target_path, 0777);
                                                        if(move_uploaded_file($_FILES[$full_field_name]['tmp_name'], $target_path_full)){
                                                            // remove old image
                                                            if($fp_allow_image_updating) @unlink($fp_target_path.$field_value);
                                                            $sql = "UPDATE ".$this->tblName." SET ".$field_name;
                                                            $file_name_view = ($fp_file_name != '') ? $fp_file_name.$file_extension : $_FILES[$full_field_name]['name'];
                                                            $sql .= " = '".$file_name_view."' ";
                                                            $field_value = $file_name_view;
                                                            $sql .= " WHERE ".$this->primaryKey." = '".$rid."' ";
                                                            if($req_mode != 'add'){
                                                                $dSet = $this->dbHandler->query($sql);
                                                                if($this->debug){
                                                                    echo $sql.'<br />';
                                                                    if($this->CheckIsError($dSet)) $this->AddErrors($dSet);
                                                                }
                                                            }
                                                            $file = true;
                                                            $img_src = $fp_target_path.$field_value;
                                                            if($fp_resize_image) $this->ResizeImage($fp_target_path, $file_name_view, $fp_resize_width, $fp_resize_height, $fp_resize_dir);
                                                        }else{
                                                            $file_error_msg = $this->lang['file_uploading_error'];
                                                            $file = false;
                                                        }
                                                        @chmod($fp_target_path, 0755);                                                        
                                                    }
                                                }else{ $file = false; }
                                            }                                            
                                        } else { $file = false; $file_error_msg = "Uploading operation is blocked in demo version"; }
                                    }else{
                                        if(!$field_value) $file = false;
                                    }
                                }else if(($file_act == "remove") && ($file_id == $field_name.$multirow_postfix)){
                                    if(!$this->isDemo){                                        
                                        if($req_mode != 'add'){
                                            $sql = "UPDATE ".$this->tblName."
                                                    SET ".$field_name." = ''
                                                        ".(($fp_blob_filetype != '') ? ", ".$fp_blob_filetype."=''" : '')."
                                                        ".(($fp_blob_filename != '') ? ", ".$fp_blob_filename."=''" : '')."
                                                        ".(($fp_blob_filesize != '') ? ", ".$fp_blob_filesize."=''" : '')."
                                                    WHERE ".$this->primaryKey." = '".$rid."' ";
                                            $this->dbHandler->query($sql);
                                            if($this->debug) echo $sql.'<br />';
                                        }                                            
                                        // delete file from target path
                                        if(@$this->IsFileExists($fp_target_path.$field_value)){                                            
                                            @unlink($fp_target_path.$field_value);
                                            $file = false;
                                            $field_value = '';
                                        }else{ $file = false; if($fp_save_as != "blob") $file_error_msg = $this->lang['file_deleting_error']; }
                                    } else { $file = true; $file_error_msg = "Deleting operation is blocked in demo version"; }                                        
                                }else{
                                    if($field_value != '') $file = true;
                                }
                                
                                // [#0009-2 under check - 19.09.09] - start
                                // to prevent error on uploading after some operation was done on another datagrid
                                $upload_curr_url = $this->QUERY_STRING;
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_act=remove", '', $upload_curr_url);
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_act=upload", '', $upload_curr_url);
                                $upload_curr_url = str_replace('&'.$this->uniquePrefix."file_id=".$field_name.$multirow_postfix, '', $upload_curr_url);
                                if(is_array($this->anotherDatagrids)){
                                    foreach($this->anotherDatagrids as $key => $val){
                                        $upload_curr_url = str_replace($key."mode=update", $key."mode=view", $upload_curr_url);
                                    }
                                }
                                /// old variant
                                /// $upload_curr_url = $this->QUERY_STRING;                                
                                // [#0009-2 under check - 19.09.09] - end
                                // if there is a file (uploaded or exists)
                                if($file == true || ($fp_allow_image_updating && $field_value != '')){
                                    if($fp_save_as != "blob" && strlen($field_value) > 40){
                                        $str_start = strlen($field_value) - 40;
                                        $str_prefix = "...";
                                    }else{
                                        $str_start = 0;
                                        $str_prefix = '';
                                    }
                                    if($file_error_msg != '' && !$fp_allow_image_updating) $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_error_message no_print'>".$file_error_msg."</label><br />";
                                    $ret_file .= "<table border='0'><tr valign='middle'><td align='center'>";
                                    if($field_type == 'image'){
                                        $f_width = $f_height = $f_size = 0;
                                        $file_exists = false;
                                        if($field_value != '' && $this->IsFileExists($fp_target_path.$field_value)){
                                            $file_exists = true;
                                        }                                        
                                        if($file_exists){
                                            list($f_width, $f_height, $f_type, $f_attr) = @getimagesize($fp_target_path.$field_value);
                                            $f_size = @number_format((filesize($fp_target_path.$field_value)/1024),2,".",",")." Kb";                                                                                    
                                        }else{
                                            $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_error_message no_print'>".str_replace("_FILE_", $field_value, $this->lang['file_find_error'])."</label><br />";
                                        }
                                        $ret_file_img = ($file_exists) ? $this->nbsp."<img src='".$fp_target_path.$field_value."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value'>".$this->nbsp : '';
                                        if(($fp_magnify == 'true') || ($fp_magnify == true)){                                        
                                            if($fp_magnify_type == "lightbox"){
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<a href='".$img_src."' rel='lytebox' title='$field_value ($f_width x $f_height - $f_size)'><img style='border:0px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value' ".$img_magnify."></a>".$this->nbsp;
                                                }                                
                                            }else if($fp_magnify_type == "popup"){                                                
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<a href=\"javascript:new_win = window.open('".$img_src."','ImageViewer','left=100,top=100,width=400,height=300,toolbar=0,resizable=1,location=0,scrollbars=1'); new_win.focus();\" title=''><img style='vertical-align: middle; border:0px solid #cccccc;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event."></a>".$this->nbsp;
                                                }
                                            }else if($fp_magnify_type == 'magnifier'){
                                                $img_magnify = "onmouseover='showtrail(\"".$img_src."\",\"\",\"\",\"1\", ".($fp_image_height*$fp_magnify_power).", 1, ".($fp_image_width*$fp_magnify_power).");' onmouseout='hidetrail();'";
                                                if(($field_value !== '') && $this->IsFileExists($img_src)){
                                                    $ret_file_img = $this->nbsp."<img src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." title='$field_value ($f_width x $f_height - $f_size)' alt='$field_value' ".$img_magnify.'>'.$this->nbsp;
                                                }                                
                                            }
                                        }
                                        $ret_file .= $ret_file_img;                                        
                                    }else{
                                        if($fp_save_as != "blob"){
                                            $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_label'>".$str_prefix.substr($file_name_view, $str_start, 40)."</label>".$this->nbsp;
                                            $ret_file .= $this->nbsp."<img src='".$this->directory."images/mimetypes/".Helper::GetFileMimetype($field_value).".png' alt='' style='margin:0 0 -3px 5px; width:16px; height:16px;' />".$this->nbsp;
                                        }else{
                                            $sizeinkbytes = number_format(strlen($field_value)/1024, 1);                                            

                                            $fp_blob_filename = $this->GetFieldProperty($field_name, "blob_filename");
                                            $blob_name = isset($row[$this->GetFieldOffset($fp_blob_filename)]) ? $row[$this->GetFieldOffset($fp_blob_filename)] : '';
                                            if(!$blob_name && isset($_FILES[$full_field_name]['name'])) $blob_name = $_FILES[$full_field_name]['name'];
                                            
                                            $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_label'>".$blob_name.(($field_value != '') ? ' ('.$sizeinkbytes.' Kb)' : '').' </label>'.$this->nbsp;
                                        }
                                    }
                                    $ret_file .= ($field_type == 'image') ? '<br />' : "";
                                    if(!$fp_readonly && !$this->isPrinting){
                                        $ret_file .= $this->nbsp."<a class='".$this->cssClass."_dg_a2' href='javascript:void(0);' onclick='_dgFormAction(\"remove\", \"".$field_name.$multirow_postfix."\", \"".$this->uniquePrefix."\", \"".$this->HTTP_URL."\", \"".$upload_curr_url."\", \"".$this->methodPostBack."\", \"".$this->GetVariable('mode')."\"); return false;'>[".$this->lang['remove']."]</a>".$this->nbsp;
                                    }
                                    $ret_file .= "</td></tr></table>";
                                }
                                if(!$file || $fp_allow_image_updating){
                                    if(!$this->isPrinting){
                                        if($file_error_msg != '') $ret_file .= $this->nbsp."<label class='".$this->cssClass."_dg_error_message no_print'>".$file_error_msg."</label><br />";
                                        $ret_file .= "<table border='0' cellspacing='0' cellpadding='0'><tr>";
                                        $fp_allowed_extensions = implode(",", $fp_allowed_extensions_array);
                                        $ret_file .= "<td>".$this->nbsp."<div id='ufd_".$full_field_name."'><input type='file' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' ".$disabled." ".$on_js_event." ".(($this->isDemo) ? "disabled='disabled' " : '')." dg_file_maxsize='".Helper::ConvertFileSize($fp_max_file_size)."' dg_allowed_extensions='".$fp_allowed_extensions."' /></div></td><td nowrap='nowrap' width='7px'></td>";
                                        $ret_file .= "<td>";
                                        if($this->uploadType != "all") $ret_file .= "<a class='".$this->cssClass."_dg_a2' ".(($disabled == "disabled" || $this->isDemo) ? "" : "style='cursor:pointer;' onclick='".$this->uniquePrefix."updateWysiwygFields(); _dgFormAction(\"upload\", \"".$field_name.$multirow_postfix."\", \"".$this->uniquePrefix."\", \"".$this->HTTP_URL."\", \"".$upload_curr_url."\", \"".$this->methodPostBack."\", \"".$this->GetVariable('mode')."\", \"".$full_field_name."\"); return false;'").">[".$this->lang['upload']."]</a> ";
                                        $ret_file .= "<a href='javascript:void(0);' class='".$this->cssClass."_dg_a2' onclick=\"javascript:_dgClearFileInputField('".$full_field_name."');\">[".$this->lang['clear']."]</a>";
                                        $ret_file .= "</td>";
                                        $ret_file .= "</tr></table>";                                        
                                    }
                                }
                                
                                // we need this here to prevent using of 'file' field (with the same name) in insertion/updating records
                                if($fp_save_as != "blob" && ($file == true || ($fp_allow_image_updating && $field_value != ''))){
                                    $ret_file .= "<input type='hidden' value='$field_value' name='".$full_field_name."' id='".$full_field_name."' />";                                   
                                }
                                $output = $ret_file;
                            }
                            break;                        
                        case "label":
                            $output = "<label class='".$this->cssClass."_dg_label' ".$field_width." ".$on_js_event.'>'.trim($field_value)."</label>"; 
                            break;
                        case 'link':
                            $test_link = " <a class='".$this->cssClass."_dg_a' style='cursor:pointer;' onclick=\"test_win = window.open(document.getElementById('".$full_field_name."').value,'testURL','');test_win.focus();\">[".$this->lang['test']."]</a>";
                            $output = "<input type='text' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".trim($field_value)."' $field_maxlength $readonly ".$on_js_event." />".$this->nbsp.$test_link;
                            break;                        
                        case "money": 
                            $fp_money_sign    = $this->GetFieldProperty($field_name, "sign", 'edit');
                            $money_sign_after = $money_sign_before = '';
                            $field_width      = ($fp_width != '') ? "width:".$fp_width.';' : '';
                            if($this->GetFieldProperty($field_name, "sign_place", 'edit') == "after"){
                                $money_sign_after  = $fp_money_sign;
                            }else{                                                        
                                $money_sign_before = $fp_money_sign;                            
                            }
                            $output = $money_sign_before." <input class='".$this->cssClass."_dg_textbox' style='text-align:right;".$field_width."' type='text' title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".trim($this->GetMoneyFormat($field_name, $field_value))."' ".$field_maxlength." ".$readonly." ".$on_js_event." ".$autocomplete." /> ".$money_sign_after;
                            break;
                        case "password":
                            if(strtolower($this->GetFieldProperty($field_name, "cryptography_type", 'edit') == "md5")) $field_value = '';
                            $ret_password = $this->nbsp."<input type='".(($fp_hide == 'true' || $fp_hide == true) ? "password" : 'text')."' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".$field_value."' $field_maxlength $readonly ".$on_js_event.'>'.$this->nbsp;
                            if(($fp_generate == 'true' || $fp_generate === true) && empty($m_field_req_type)){ 
                                $ret_password .= " <a href='javascript:void(0);' class='".$this->cssClass."_dg_a2' onclick='document.getElementById(\"".$full_field_name."\").value = _dgGeneratePassword(8);'>[".Helper::ConvertCase($this->lang['generate'],"camel",$this->langName)."]</a>";
                            }
                            $output = $ret_password;
                            break; 
                        case "percent":
                            $fp_decimal_places = $this->GetFieldProperty($field_name, "decimal_places", 'edit');
                            $fp_dec_separator = $this->GetFieldProperty($field_name, "dec_separator", 'edit');
                            $field_value = number_format(floatval($field_value), $fp_decimal_places, $fp_dec_separator, '');                            
                            $output = "<input class='".$this->cssClass."_dg_textbox' ".$field_width." type='text' title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".$field_value."' ".$field_maxlength." ".$readonly." ".$on_js_event." ".$autocomplete." /> %";
                            break;
                        case 'print':
                            if($fp_type == 'file' && $fp_save_as == 'blob') $field_value = '[BLOB file]';
                            $output = "<label class='".$this->cssClass."_dg_label' ".$field_width." ".$on_js_event.'>'.trim($field_value)."</label>"; 
                            break;                        
                        case "textarea":
                            // double quotation mark, single quotation mark
                            $field_value = str_replace(array('"',"'"), array("&quot;","&#039;"), $field_value);
                            $resizable           = $fp_resizable = $this->GetFieldProperty($field_name, "resizable", 'edit', 'lower', 'false');
                            $field_rows          = $fp_rows      = $this->GetFieldProperty($field_name, "rows", 'edit', 'lower', "3");
                            $field_cols          = $fp_cols      = $this->GetFieldProperty($field_name, "cols", 'edit', 'lower', "23");
                            $field_edit_type     = $fp_edit_type = $this->GetFieldProperty($field_name, 'edit_type');
                            $field_wysiwyg_width = $fp_width     = $this->GetFieldProperty($field_name, "width", 'edit', 'lower', '0');
                            $field_class         = '';
                            $fp_upload_images = $this->GetFieldProperty($field_name, "upload_images", 'edit', 'lower', 'false');
                            $fp_upload_images = (!$this->isDemo && ($fp_upload_images == true || $fp_upload_images == 'true')) ? 'true' : 'false';
                            
                            if(strtolower($field_edit_type) == 'wysiwyg'){
                                $field_maxlength = '';
                            }else if(($resizable === true) || ($resizable == 'true')) {
                                $field_class = " resizable";
                            }
                            
                            $texarea  = $this->nbsp."<textarea class='".$this->cssClass."_dg_textarea".$field_class."' id='".$full_field_name."' name='".$full_field_name."' title='".$this->GetFieldTitle($field_name)."' rows='".$field_rows."' cols='".$field_cols."' ".$field_maxlength." ".$field_width." ".$readonly." ".$on_js_event." >".trim($field_value)."</textarea>".$this->nbsp;
                            if(strtolower($field_edit_type) == 'wysiwyg'){
                                $texarea .= $this->nbsp.$this->ScriptOpen("\n");
                                $texarea .= "wysiwygWidth = ".((intval($field_wysiwyg_width) > ((9.4)*$field_cols)) ? intval($field_wysiwyg_width) : ((9.4)*$field_cols)).';';
                                $texarea .= "wysiwygHeight = ".(21*$field_rows).';';
                                $texarea .= "generate_wysiwyg('".$full_field_name."', ".$fp_upload_images.");";  
                                $texarea .= $this->ScriptClose();
                            }
                            $output = $texarea;    
                            break;                    
                        case 'textbox':                           
                            // double quotation mark, single quotation mark
                            $field_value = str_replace(array('"',"'"), array("&quot;","&#039;"), $field_value);                            
                            if($template != ''){
                                $template_value = str_replace(array("d","c"), "_", $template);
                                $field_required = (substr($fp_req_type, 0, 1) == "r") ? true : false;
                                if($field_value == '' && $field_required) $field_value = $template_value;
                                $field_maxlength = "maxlength='".strlen($template)."'";
                                $template = "template='".$template."'";                            
                                $on_js_event = ($field_required) ? "onBlur='if(this.value == \"\")this.value = \"".$template_value."\"'; onClick='if(this.value==\"".$template_value."\")this.value=\"\";'" : $on_js_event;
                            }                        
                            $output = "<input class='".$this->cssClass."_dg_textbox' ".$field_width." type='text' title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".trim($field_value)."' ".$field_maxlength." ".$readonly." ".$on_js_event." ".$autocomplete." ".$template."/>";
                            break;
                        case 'time':
                            if(strtolower($show_seconds) == 'true' || $show_seconds === true){
                                $time_format = "H:i:s";
                            }else{
                                $time_format = "H:i";
                            }
                            $fp_calendar_type = ($fp_calendar_type == "dropdownlist") ? "dropdownlist" : "popup";
                            $ret_date = $this->DrawCalendarButton($field_name, $field_type, $time_format, $field_value, $field_width, $field_maxlength, $on_js_event, $readonly, $fp_calendar_type, $multirow_postfix);
                            $output = $ret_date;
                            break;
                        case "validator":
                            $fp_for_field       = $this->GetFieldProperty($field_name, "for_field");
                            $fp_validation_type = $this->GetFieldProperty($field_name, "validation_type");
                            $field_v_req_type   = $this->GetFieldRequiredType($field_name);
                            $field_req_type     = $this->GetFieldRequiredType($fp_for_field);
                            $field_value        = $this->GetVariable($field_req_type.$fp_for_field, false, "post");
                            if($fp_validation_type == "password"){ $validator_field_type = "password"; } else { $validator_field_type = 'text'; }
                            $output = "<input type='".$validator_field_type."' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$field_v_req_type.$fp_for_field.$multirow_postfix."' id='".$field_v_req_type.$fp_for_field.$multirow_postfix."' value='".$field_value."' $field_maxlength $readonly ".$on_js_event." />";
                            break;                        
                        default:
                            $output = "<input type='text' class='".$this->cssClass."_dg_textbox' ".$field_width." title='".$this->GetFieldTitle($field_name)."' name='".$full_field_name."' id='".$full_field_name."' value='".trim($field_value)."' $field_maxlength $readonly ".$on_js_event." />";
                            break;
                    }
                }else if($mode === 'details'){
                    switch($field_type){
                        case 'blob':
                            $sizeinkbytes = number_format(strlen($field_value)/1024, 1);
                            $output = "[BLOB] - ".$sizeinkbytes." Kb"; 
                            break;
                        case 'color':
                            $fp_view_type = $this->GetFieldProperty($field_name, 'view_type', 'edit');
                            $color_name = Helper::GetColorNameByValue($field_value);
                            $ret_color = "<div title='' style='float:left;margin-right:5px;border:1px solid #cecece;width:17px;height:14px;background-color:".$field_value.";'></div>";
                            $ret_color .= "<label class='".$this->cssClass."_dg_label'>".$field_value." ".(!empty($color_name) ? "(".$color_name.")" : '')."</label>";
                            $output = $ret_color;
                            break;
                        case 'checkbox':
                            $output = (($field_value == 1) ? $this->lang['yes'] : $this->lang['no']);
                            break;                        
                        case 'date':
                            $field_value = trim($field_value);
                            $output = (($field_value == '0000-00-00') ? '' : $field_value);
                            break;
                        case "datedmy":
                            $output = $this->MyDate($field_value, "datedmy");
                            break;                        
                        case "datemdy":
                            $output = $this->MyDate($field_value, "datemdy");
                            break;                        
                        case "datetime":
                            $field_value = trim($field_value);
                            $output = (($field_value == '0000-00-00 00:00:00') ? '' : $this->MyDate($field_value, "datetime", $show_seconds));
                            break;                        
                        case "datetimedmy":
                            $output = $this->MyDate($field_value, "datetimedmy", $show_seconds);
                            break;
                        case "datetimemdy":
                            $output = $this->MyDate($field_value, "datetimemdy", $show_seconds);
                            break;                        
                        case "enum":
                            $enum_multiple = ($this->GetFieldProperty($field_name, "multiple") == true) ? true : false;
                            $field_value_output = '';
                            $field_value_output_array = explode(",", $field_value);
                            if(isset($this->columnsEditMode[$field_name]['source']) && is_array($this->columnsEditMode[$field_name]['source'])){
                                foreach($this->columnsEditMode[$field_name]['source'] as $val => $opt){
                                    if($enum_multiple){
                                        if(in_array($val, $field_value_output_array)){
                                            $field_value_output .= (($field_value_output != '') ? ',' : '').trim($opt).$this->nbsp;
                                        }
                                    }else if($field_value == $val){
                                        $field_value_output = $opt;
                                        break;
                                    }
                                }
                            }else{
                                $field_value_output = $field_value;
                            }
                            $output = trim($field_value_output);
                            break;
                        case 'file':
                            $fp_target_path       = $this->GetFieldProperty($field_name, "target_path");
                            $fp_allow_downloading = $this->GetFieldProperty($field_name, "allow_downloading");
                            $fp_save_as           = $this->GetFieldProperty($field_name, "save_as");                            
                            if($fp_save_as == "blob"){
                                $fp_blob_filetype = $this->GetFieldProperty($field_name, "blob_filetype");
                                $fp_blob_filename = $this->GetFieldProperty($field_name, "blob_filename");
                                $fp_blob_filesize = $this->GetFieldProperty($field_name, "blob_filesize");

                                $blob_type = isset($row[$this->GetFieldOffset($fp_blob_filetype)]) ? $row[$this->GetFieldOffset($fp_blob_filetype)] : '';
                                $blob_name = isset($row[$this->GetFieldOffset($fp_blob_filename)]) ? $row[$this->GetFieldOffset($fp_blob_filename)] : '';
                                $blob_size = isset($row[$this->GetFieldOffset($fp_blob_filesize)]) ? $row[$this->GetFieldOffset($fp_blob_filesize)] : '';
                                
                                $sizeinkbytes = number_format(strlen($field_value)/1024, 1);
                                $output .= $blob_name.(!empty($blob_name) ? ' ('.$sizeinkbytes.' Kb) ' : '');
                                if($fp_allow_downloading){
                                    if($blob_type != '' && $blob_name != '' && $blob_size != '' && strlen($field_value) != 0){
                                        $post_type = 'session';
                                        if($post_type == 'session'){
                                            $_SESSION['datagrid_df_content'] = $field_value;
                                            $_SESSION['datagrid_df_blob_type'] = $blob_type;
                                            $_SESSION['datagrid_df_blob_name'] = $blob_name;
                                            $_SESSION['datagrid_df_blob_size'] = $blob_size;
                                            $output .= " - [<img src='".$this->directory."images/download.png' alt='' style='margin-bottom:-3px' border='0' /> <a class='".$this->cssClass."_dg_a' href='javascript:void(\"download\")' onclick='document.location.href=\"".$this->directory."scripts/download_blob.php?fn=".$blob_name."\";this.style.display=\"none\";' title='".$this->lang['click_to_download']."'>".$this->lang['download']."</a>]";
                                        }else{
                                            $frid = isset($row[$this->primaryKey]) ? $row[$this->primaryKey] : '';
                                            $output .= " - [<img src='".$this->directory."images/download.png' alt='' style='margin-bottom:-3px' border='0' /> <a class='".$this->cssClass."_dg_a' href='javascript:void(\"download\")' onclick='document.location.href=\"".$this->directory."scripts/download_blob.php?frid=".$frid."\";this.style.display=\"none\";' title='".$this->lang['click_to_download']."'>".$this->lang['download']."</a>]";
                                        }
                                    }
                                }
                            }else{
                                $output .= "<img src='".$this->directory."images/mimetypes/".Helper::GetFileMimetype($field_value).".png' alt='' style='margin:0 5px -3px 5px; width:16px; height:16px;' />";
                                if($fp_allow_downloading) $output .= "[<img src='".$this->directory."images/download.png' alt='' style='margin-bottom:-3px' border='0' /> <a class='".$this->cssClass."_dg_a' href='".$fp_target_path.$field_value."' title='".$this->lang['click_to_download']."'>".$this->lang['download']."</a>]";
                            }
                            $output = trim($output);                         
                            break;
                        case "hidden":
                            if($fp_visible && ($this->layouts[$this->layoutType] != '0')) $output = "<label class='".$this->cssClass."_dg_label'>".(($req_mode == 'add') ? $field_value : $field_old_value)."</label>";
                            else $output = '';   
                            break;                        
                        case 'image':
                            $fp_target_path   = $this->GetFieldProperty($field_name, "target_path");
                            $fp_image_width   = $this->GetFieldProperty($field_name, "image_width", 'edit', 'lower', '');
                            $fp_image_width_attr  = (trim($fp_image_width) != '') ? " width='".$fp_image_width."'" : '';
                            $fp_image_height  = $this->GetFieldProperty($field_name, "image_height", 'edit', 'lower', '');
                            $fp_image_height_attr = (trim($fp_image_height) != '') ? " height='".$fp_image_height."'" : '';
                            $fp_default       = $this->GetFieldProperty($field_name, "default", 'edit', 'normal');
                            $img_default      = (($fp_default != '') && $this->IsFileExists($fp_target_path.trim($fp_default))) ? "<img src='".$fp_target_path.$fp_default."' ".$fp_image_width_attr.$fp_image_height_attr." alt='' title=''>" : "<span class='".$this->cssClass."_dg_label'>".$this->lang['no_image'].'</span>';                    
                            $fp_magnify       = $this->GetFieldProperty($field_name, "magnify", 'edit', 'normal');
                            $fp_magnify_type  = $this->GetFieldProperty($field_name, 'magnify_type', 'edit', 'normal');
                            $fp_magnify_power = $this->GetFieldProperty($field_name, "magnify_power", 'edit', 'normal');
                            $fp_magnify_power = (is_numeric($fp_magnify_power)) ? $fp_magnify_power : '2';
                            $img_src                      = $fp_target_path.trim($field_value);
                            $fp_allow_downloading = $this->GetFieldProperty($field_name, "allow_downloading");
                            
                            if((trim($field_value) !== '') && $this->IsFileExists($fp_target_path.trim($field_value))){
                                $ret_image_img = $this->nbsp."<img style='vertical-align: middle; border:1px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event.'>'.$this->nbsp;
                                if(($fp_magnify == 'true') || ($fp_magnify == true)){
                                    $ret_image_img = $this->nbsp;
                                    if($fp_magnify_type == "lightbox"){
                                        if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                            if(!$this->isPrinting) $ret_image_img .= "<a href='".$img_src."' rel='lytebox'>";
                                            $ret_image_img .= "<img style='vertical-align:middle;border:0px solid #cccccc;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event." alt='' />";
                                            if(!$this->isPrinting) $ret_image_img .= "</a>";
                                        }
                                    }else if($fp_magnify_type == "popup"){
                                        if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                            if(!$this->isPrinting) $ret_image_img .= "<a href=\"javascript:new_win = window.open('".$img_src."','ImageViewer','left=100,top=100,width=400,height=300,toolbar=0,resizable=1,location=0,scrollbars=1'); new_win.focus();\">";
                                            $ret_image_img .= "<img style='vertical-align:middle;border:0px solid #cccccc;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event." alt='' />";
                                            if(!$this->isPrinting) $ret_image_img .= "</a>";
                                        }
                                    }else if($fp_magnify_type == 'magnifier'){
                                        $img_magnify = (!$this->isPrinting) ? "onmouseover='showtrail(\"".$img_src."\",\"\",\"\",\"1\", ".($fp_image_height*$fp_magnify_power).", 1, ".($fp_image_width*$fp_magnify_power).");' onmouseout='hidetrail();'" : '';
                                        if((trim($field_value) !== '') && $this->IsFileExists($img_src)){
                                            $ret_image_img .= "<img style='vertical-align:middle; border:1px;' src='".$img_src."' ".$fp_image_width_attr.$fp_image_height_attr." ".$on_js_event." ".$img_magnify.'>';
                                        }
                                    }
                                    $ret_image_img .= $this->nbsp;
                                }
                                $ret_image = $ret_image_img;
                                if($fp_allow_downloading && !$this->isPrinting) $ret_image .= "<br />[<img src='".$this->directory."images/download.png' alt='' style='margin-bottom:-3px' border='0' /> <a class='x-blue_dg_a' href='".$img_src."' title='".$this->lang['click_to_download']."'>".$this->lang['download']."</a>]";
                                $output = $ret_image;                            
                            }else{
                                $output = "<table style='border:solid 1px #000000;' ".$fp_image_width_attr.$fp_image_height_attr."><tr><td align='center'>".$img_default."</td></tr></table>";
                            }
                            break;
                        case "label":
                            $output = "<label class='".$this->cssClass."_dg_label' ".$on_js_event.'>'.trim($field_value)."</label>";
                            break;
                        case 'link':                        
                            $fp_field_data = $this->GetFieldProperty($field_name, "field_data", 'edit', 'normal');
                            if($fp_field_data != ''){
                                // [#0011 under check - 21.11.09] - start
                                // [#0011 under check - 21.11.09] - end
                                
                                $href = $href_inner = $fp_href = $this->GetFieldProperty($field_name, "href");
                                $fp_target = $this->GetFieldProperty($field_name, "target");
                                $on_js_event  = $this->GetFieldProperty($field_name, "on_js_event", 'details', 'normal');

                                // add handler of {field_name} holders in on_item_created
                                $temp = '';                                
                                $this->PrepareOnJSEventFields($href, $temp, $field_name, $row, 'details');
                                
                                // remove unexpected 'http://'s
                                if(strstr($fp_href, "https://") != '' || strstr($href, "https://") != ''){
                                    $href = str_replace(array("https://", "http://"), '', $href);
                                    $href = "https://".$href;
                                }else if(strstr($href_inner, "http://") != ''){
                                    $href = str_replace("http://", '', $href);
                                    $href = "http://".$href;
                                }
                                $link_value = ($this->GetFieldOffset($fp_field_data) != '-1') ? trim($row[$this->GetFieldOffset($fp_field_data)]) : '';
                                $output = "<a class='".$this->cssClass."_dg_a2' ".(($href != '') ? "href='".$href."'" : "style='cursor:pointer;'")." target='".$fp_target."' ".$on_js_event.'>'.$link_value."</a>";
                            }else{
                                $output = $field_value;
                            }                        
                            break;                        
                        case "money": 
                            $fp_decimal_places   = $this->GetFieldProperty($field_name, "decimal_places", 'edit'); 
                            $fp_dec_separator    = $this->GetFieldProperty($field_name, "dec_separator", 'edit'); 
                            $fp_thousands_separator = $this->GetFieldProperty($field_name, "thousands_separator", 'edit');                        
                            $fp_money_sign       = $this->GetFieldProperty($field_name, "sign", 'edit');
                            $money_sign_after    = $money_sign_before = '';
                            if($this->GetFieldProperty($field_name, "sign_place", 'edit') == "after"){
                                $money_sign_after  = $fp_money_sign;
                            }else{                                                        
                                $money_sign_before = $fp_money_sign;                            
                            }
                            $output = $money_sign_before."<label class='".$this->cssClass."_dg_label' ".$on_js_event.'>'.number_format($field_value, $fp_decimal_places, $fp_dec_separator, $fp_thousands_separator)."</label>".$money_sign_after;
                            break;                     
                        case "password":
                            $output = "<label class='".$this->cssClass."_dg_label'>".(($fp_hide == 'true' || $fp_hide == true) ? "******" : $field_value)."</label>";
                            break;                    
                        case 'print':
                            if($fp_type == 'file' && $fp_save_as == 'blob') $field_value = '[BLOB file]';
                            $output = "<label class='".$this->cssClass."_dg_label' ".$field_width.'>'.trim($field_value)."</label>"; 
                            break;
                        case "textarea":
                            $output = '<span class="dg_wrap">'.nl2br($field_value).'</span>';
                            break;
                        case 'textbox':
                            $output = trim($field_value);
                            break;
                        case "validator":
                            $output = '';
                            break;                        
                        default:
                            $output = trim($field_value);
                            break;
                    }                                        
                }
            }                        
        }
        if($this->convertOutput){
            $output = mb_convert_encoding($output, $this->convertTo, $this->convertFrom);
        }                        
        return $fp_pre_addition.$output.$fp_post_addition;
    }

    /**
     * Add check voxes values
     *      @param $multirow_postfix
     */
    protected function AddCheckBoxesValues($multirow_postfix = ''){
        $toggle_status = $this->GetVariable('toggle_status');
        $toggle_field = $this->GetVariable('toggle_field');
        $toggle_field_value = $this->GetVariable('toggle_field_value');
        if($toggle_status == '1'){
            // toggle checkbox values for View Mode 
            $_POST["syy".$toggle_field] = $toggle_field_value;            
        }else{
            // save checkbox values for Edit Mode 
            foreach($this->columnsEditMode as $itemName => $itemValue){
                $full_field_name = $this->GetFieldRequiredType($itemName).$itemName.$multirow_postfix;
                if(isset($itemValue['type']) && $itemValue['type'] == 'checkbox'){
                    $found = false;
                    foreach($_POST as $i => $v){
                        if($i == $full_field_name){
                            $found = true;
                        }
                    }
                    if(!$found){                    
                        $_POST[$full_field_name] = $itemValue['false_value'];
                    }else{
                        $_POST[$full_field_name] = $itemValue['true_value'];
                    }
                }            
            }            
        }
    }

    /**
     * Get $_REQUEST variable
     *      @param $var
     *      @param $prefix
     *      @param $method
     *      @param $assign_var
     */
    protected function GetVariable($var = '', $prefix = true, $method = "request", $assign_var = false){
        $prefix = (($prefix == true) || ($prefix == 'true')) ? true : false;
        $unique_prefix = ($prefix) ? $this->uniquePrefix : "" ;
        $unique_prefix_var = (isset($_GET[$unique_prefix.$var])) ? $_GET[$unique_prefix.$var] : '0';
        $clear = ($this->securityLevel == "medium" || $this->securityLevel == "high") ? true : false;
        $output = '';

        // check for possible hack attack        
        $max_page_size = intval(max($this->arrPages));
        if(($var == "page_size") && (intval($unique_prefix_var) > intval($max_page_size))) {
            return $max_page_size; 
        } 
 
        switch($method){
            case "get":
                $output = isset($_GET[$unique_prefix.$var]) ? $_GET[$unique_prefix.$var] : '';                                
                break;
            case "post":
                $output = isset($_POST[$unique_prefix.$var]) ? $_POST[$unique_prefix.$var] : '';                                
                break;
            default:
                if(isset($_REQUEST[$unique_prefix.$var])){
                    $unique_prefix_var = $_REQUEST[$unique_prefix.$var];
                    if(is_array($unique_prefix_var)){
                        $assign_var = false;
                        foreach($unique_prefix_var as $key => $val) $output .= ((!empty($output)) ? '&' : '').$var."[]=".$val;    
                    }else{
                        $output = $unique_prefix_var;                                        
                    }
                }
                break;
        }
        $output = (($assign_var) ? $var."=" : '').$output;        
        return ($clear) ? $this->RemoveBadChars($output) : $output;
    }

    /**
     * Draw RadioButtons
     *      @param $tag_name
     *      @param $field_name
     *      @param &$select_array
     *      @param $compare 
     *      @param $sub_field_value
     *      @param $sub_field_name
     *      @param $disabled
     *      @param $on_js_event
     *      @param $radiobuttons_alignment
     */
    protected function DrawRadioButtons($tag_name, $field_name, &$select_array, $compare = '', $sub_field_value='', $sub_field_name='', $disabled='', $on_js_event='', $radiobuttons_alignment=''){
        $break_by = ($radiobuttons_alignment == "vertical") ? '<br />' : '';
        $output = $print_output = '';        
        $radio_count = '0';
        
        if($on_js_event !='') $output .= "<span ".$on_js_event.'>';
        if(is_object($select_array)){
            $print_output = "<span ".$on_js_event.">none</span>";                
            while($row = $this->dgFetchRow($select_array)){
                $tag_id = $tag_name.$radio_count;
                if(strtolower($row[$this->arrForeignKeys[$field_name][$sub_field_value]]) == strtolower($compare)){ 
                    $output .= "<input class='".$this->cssClass."_dg_radiobutton' type='radio' title='".$this->GetFieldTitle($field_name)."' name='".$tag_name."' id='".$tag_id."' value='".$row[$this->arrForeignKeys[$field_name][$sub_field_value]]."' checked='checked' ".$disabled."><label for='".$tag_id."' class='".$this->cssClass."_dg_label'>".$row[$this->arrForeignKeys[$field_name][$sub_field_name]]."</label>".$this->nbsp.$break_by;
                    if($this->isPrinting){
                        $print_output = "<span ".$on_js_event.'>'.$row[$this->arrForeignKeys[$field_name][$sub_field_name]].'</span>';
                        break;
                    }                        
                }else{
                    $output .= "<input class='".$this->cssClass."_dg_radiobutton' type='radio' title='".$this->GetFieldTitle($field_name)."' name='".$tag_name."' id='".$tag_id."' value='".$row[$this->arrForeignKeys[$field_name][$sub_field_value]]."'  ".$disabled."><label for='".$tag_id."' class='".$this->cssClass."_dg_label'>".$row[$this->arrForeignKeys[$field_name][$sub_field_name]]."</label>".$this->nbsp.$break_by;
                }
                $radio_count++;
            }                
        }else{
            $print_output = $compare;
            if(is_array($select_array)){
                foreach($select_array as $key => $val){
                    $tag_id = $tag_name.$radio_count;
                    if(strtolower($key) == strtolower($compare)){
                        $output .= "<input class='".$this->cssClass."_dg_radiobutton' type='radio' id='".$tag_id."' name='".$tag_name."' value='".$key."' title='".$this->GetFieldTitle($field_name)."' checked='checked' ".$disabled."><label for='".$tag_id."' class='".$this->cssClass."_dg_label'>".$val."</label> ".$break_by;                    
                        if($this->isPrinting){ $print_output = $val; break; }
                    }else{
                        $output .= "<input class='".$this->cssClass."_dg_radiobutton' type='radio' id='".$tag_id."' name='".$tag_name."' value='".$key."' title='".$this->GetFieldTitle($field_name)."' ".$disabled."><label for='".$tag_id."' class='".$this->cssClass."_dg_label'>".$val."</label> ".$break_by;
                    }
                    $radio_count++;
                }
            }
        }
        if($on_js_event != '') $output .= '</span>';
        
        if($this->isPrinting) return $print_output;
        else  return $output;
    }

    /**
     * Draw checkboxes
     *      @param $tag_name
     *      @param $foo_name
     *      @param &$select_array
     *      @param $compare
     *      @param $field_name
     *      @param $sub_field_value
     *      @param $sub_field_name
     *      @param $disabled
     *      @param $on_js_event
     *      @param $multiple
     *      @param $multiple_size
     */
    protected function DrawCheckBoxes($tag_name, $foo_name, &$select_array, $compare = '', $field_name='', $sub_field_value='', $sub_field_name='', $disabled='', $on_js_event='', $multiple=false, $multiple_size='4'){
        $text = '';
        $checkboxes_count = '0';
        $tag_id = $tag_name;
        $tag_name = ($multiple) ? $tag_name = $tag_name."[]" : $tag_name;
        $readonly = '';
        if(!$this->isPrinting){
            if(is_array($select_array)){
                if(!is_array($compare)){ $split_compare = explode(",", $compare); }else{ $split_compare = $compare; }
                $text .= "<input class='".$this->cssClass."_dg_checkbox' type='hidden' name='".$tag_name."' id='".$tag_id."' value='' />";                
                foreach($select_array as $key => $val){
                    $checkboxes_count++;
                    $checked = '';                    
                    if(count($split_compare) >= 1){
                        foreach($split_compare as $spl_val){
                            if($spl_val == $key) {$checked = "checked='checked'"; break; }	
                        }
                    }else{
                        $checked = ((strtolower($compare) == strtolower($key)) ? "checked='checked'" : '');
                    }
                    $text .= "<input class='".$this->cssClass."_dg_checkbox' type='checkbox' name='".$tag_name."' id='".$tag_id.$checkboxes_count."' title='".$this->GetFieldTitle($field_name)."' value='".$key."' ".$checked." ".$readonly." ".$on_js_event." />";
                    $text .= "<label for='".$tag_id.$checkboxes_count."' class='".$this->cssClass."_dg_label'>".$val."</label> ";
                    if($multiple && ($checkboxes_count % $multiple_size == 0)) $text .= '<br />';
                }
            }
        }else{
            $text = $compare;     
        }
        return $text;
    }
    
    /**
     * Draw dropdown list
     *      @param $tag_name
     *      @param $foo_name
     *      @param &$select_array
     *      @param $compare
     *      @param $field_name
     *      @param $sub_field_value
     *      @param $sub_field_name
     *      @param $disabled
     *      @param $on_js_event
     *      @param $multiple
     *      @param $multiple_size
     *      @param $draw_select_option
     */
    protected function DrawDropDownList($tag_name, $foo_name, &$select_array, $compare='', $field_name='', $sub_field_value='', $sub_field_name='', $disabled='', $on_js_event='', $multiple=false, $multiple_size='4', $draw_select_option=false){
        $text = '';
        $multiple_parameters = ($multiple) ? $multiple_parameters = "multiple size='".$multiple_size."'" : '';
        $tag_id = $tag_name;
        $tag_name = ($multiple) ? $tag_name = $tag_name."[]" : $tag_name;
        $fp_show_count = '';
        $fp_width = $this->GetFieldProperty($field_name, "width", $this->mode);
        $style_attr = (!empty($fp_width)) ? " style='width:".$fp_width."';" : '';
        $options_count = '0';        
        if(!$this->isPrinting){
            if(is_object($select_array)){
                $text = "<select class='".$this->cssClass."_dg_select' name='".$tag_name."' id='".$tag_id."' title='".$this->GetFieldTitle($field_name)."' ".(($foo_name != '') ? "onChange='".$this->uniquePrefix.$foo_name."'" : '')." ".$disabled." ".$on_js_event." ".$multiple_parameters.$style_attr.'>';
                $text .= "<option value=''>-- ".$this->lang['select']." --</option>";
                if($this->dbType == 'PDO' || !$this->CheckIsError($select_array)){    
                    while($row = $this->dgFetchRow($select_array)){
                        $ff_name = $this->arrForeignKeys[$field_name][$sub_field_name];
                        $fp_show_count = isset($this->arrForeignKeys[$field_name]["show_count"]) ? $this->arrForeignKeys[$field_name]["show_count"] : '';
                        if(preg_match("/ as /i", strtolower($ff_name))) $ff_name = substr($ff_name, strpos(strtolower($ff_name), " as ")+4);                        
                        if(strtolower($row[$this->arrForeignKeys[$field_name][$sub_field_value]]) == strtolower($compare)) 
                            $text .= "<option selected='selected' style='font-weight:bold;' value='".$row[$this->arrForeignKeys[$field_name][$sub_field_value]]."'>".$row[$ff_name]."</option>";
                        else 
                            $text .= "<option value='".$row[$this->arrForeignKeys[$field_name][$sub_field_value]]."'>".$row[$ff_name]."</option>";
                        $options_count++;
                    }
                }
            }else{
                // [#0031] in check (using commas in enum values)
                if(!is_array($compare)){
                    if($multiple) $split_compare = explode(",", $compare);
                    else $split_compare = array('0'=>$compare); 
                }else{
                    $split_compare = $compare;
                }
                
                $text = "<select class='".$this->cssClass."_dg_select' name='".$tag_name."' id='".$tag_id."' title='".$this->GetFieldTitle($field_name)."' ".(($foo_name != '') ? "onChange='".$this->uniquePrefix.$foo_name."'" : '')." ".$disabled." ".$on_js_event." ".$multiple_parameters.$style_attr.'>';
                if($draw_select_option) $text .= "<option value=''>-- ".$this->lang['select']." --</option>";
                if(is_array($select_array)){
                    foreach($select_array as $key => $val){
                        $selected = '';
                        if(count($split_compare) >= 1){
                            foreach($split_compare as $spl_val){
                                if($spl_val == $key) {$selected = "selected='selected' style='font-weight:bold;'"; break; }	
                            }
                        }else{
                            $selected = ((strtolower($compare) == strtolower(str_replace("''", "'", $key))) ? "selected='selected' style='font-weight:bold;'" : '');
                        }
                        
                        if(is_array($val)){
                            $text .= "<optgroup label='".$key."'>";
                            foreach($val as $val_key => $val_val){
                                $selected = ((strtolower($compare) == strtolower($val_key)) ? "selected='selected' style='font-weight:bold;'" : '');
                                $text .= "<option ".$selected." value='".$val_key."'>(".$val_key.") ".$val_val."</option>";
                            }
                            $text .= "</optgroup>";
                        }else{
                            $text .= "<option ".$selected." value='".$key."'>".$val."</option>";
                        }
                    }                    
                }
            }
            $text .= "</select>";
            if(($fp_show_count == 'true' || $fp_show_count === true) && $options_count) $text .= " (".$options_count." ".(($options_count>0) ? $this->lang['items'] : $this->lang['item']).")";
        }else{
            if(is_object($select_array)){
                $found = 0;
                while(($row = $this->dgFetchRow($select_array)) && (!$found)){                    
                    if(strtolower($row[$this->arrForeignKeys[$field_name][$sub_field_value]]) == strtolower($compare)){
                        $text .= "<span>".$row[$this->arrForeignKeys[$field_name][$sub_field_name]].'</span>';
                        $found = 1;
                    }                        
                }
                if($found == 0) $text .= "<span>none</span>";                
            }else{                
                $text = $compare;
                foreach($select_array as $key => $val){
                    if(strtolower($compare) == strtolower($key)){
                        $text = $val;
                        break;
                    }
                }                
            }            
        }
        return $text;
    }

    /**
     * Mode Allowed
     *      @param $mode
     *      @param $current_mode
     *      @param $mode_type
     */
    protected function ModeAllowed($mode, $current_mode = '', $mode_type = ''){
        $current_mode = ($current_mode != '') ? $current_mode : $this->mode;
        $show_button = isset($this->modes[$mode]['show_button']) ? $this->modes[$mode]['show_button'] : true;
        if($mode == "clone" && $this->arrMultirowOperations["clone"]['view']){
            return true;    
        }
        if(isset($this->modes[$mode][$current_mode]) && $this->modes[$mode][$current_mode]){
            if($mode_type != 'show_button'){
                return true;            
            }else if($mode_type == 'show_button' && $show_button){
                return true;    
            }
        }
        if($mode == 'cancel') return true;  
        return false;
    }
    
    /**
     * Add array params
     *      @param $href_string
     */
    protected function AddArrayParams($href_string){
        $href_string = str_replace('&amp;', '&', $href_string);
        $array_params = '';
        foreach($_GET as $key => $value){            
            if(is_array($this->httpGetVars) && in_array($key, $this->httpGetVars)){
                // don't enter httpGetVars vars to URL
                continue;
            }            
            if(is_array($value)){
                $count = 0;
                foreach($value as $paramvalue){
                    $array_params .= '&'.$key."=".$value[$count];
                    $count++;
                }
            }
        }                                    
        $array_params = str_replace("%3D", "%5B%5D=", str_replace("%26", '&', urlencode($array_params)));                                    
        $href_string = $array_params.$href_string;
        $href_string = str_replace('&', '&amp;', $href_string);
        return $href_string;
    }

    /**
     * Change parameter in URL
     *      @param $url
     *      @param $param_name
     *      @param $old_value
     *      @param $new_value
     */
    protected function ChangeParameterInURL($url, $param_name='', $old_value='', $new_value=''){
        return preg_replace("/$param_name=$old_value/i", "$param_name=$new_value", $url);
    }

    /**
     * Remove parameter from URL
     *      @param $url
     *      @param $param_name
     *      @param $param_value
     */
    protected function RemoveParameterFromURL($url, $param_name='', $param_value=''){
        return preg_replace("/$param_name=$param_value/i", '', $url);
    }

    /**
     * Prepare Tooltip
     *      @param $field_name
     *      @param $mode
     */
    protected function PrepareTooltip($field_name = '', $mode = 'view'){
        $output = '';
        $fp_header_tooltip = $this->GetFieldProperty($field_name, 'header_tooltip', $mode);
        $fp_header_tooltip_type = $this->GetFieldProperty($field_name, 'header_tooltip_type', $mode);
        if(!$this->isPrinting && $fp_header_tooltip != ''){
            if($fp_header_tooltip_type == 'floating'){
                $tooltip_title = "onmouseover=\"return overlib('".str_replace("'", "\'", $fp_header_tooltip)."');\" onmouseout='return nd();'";
            }else{
                $tooltip_title = "title='".str_replace("'", "&#039;", $fp_header_tooltip)."'";
            }                        
            $output = " <img src='".$this->directory."images/question_mark.gif' class='".$this->cssClass."_question_mark' alt='' ".$tooltip_title." />";
        }
        return $output;        
    }

    /**
     * Replace with alias
     *      @param $table_name
     */
    protected function ReplaceWithAlias($table_name){
        if(is_array($this->arrFilterFields)){
            foreach($this->arrFilterFields as $fldName => $fldValue){
                $table = isset($fldValue['table']) ? trim($fldValue['table']) : '';
                $table_alias = isset($fldValue['table_alias']) ? $fldValue['table_alias'] : '';
                if($table == $table_name && $table_alias != ''){
                    return $table_alias;    
                }
            }            
        }
        return $table_name;
    }
    
    /**
     * Prepare password decryption
     */
    protected function PreparePasswordDecryption(){
        // prepare decryption of password
        $fields_list = '';
        foreach($this->columnsEditMode as $column_name => $column_array){
            $fp_type = $this->GetFieldProperty($column_name, 'type', 'edit');
            if($fp_type == "password"){
                $fp_cryptography = $this->GetFieldProperty($column_name, "cryptography", 'edit');
                $fp_cryptography_type = $this->GetFieldProperty($column_name, "cryptography_type", 'edit');
                $fp_aes_password = $this->GetFieldProperty($column_name, "aes_password", 'edit');
                if($fp_cryptography == true || $fp_cryptography == 'true'){
                    if($fp_cryptography_type == "aes"){
                        $fields_list .= "AES_DECRYPT(".$column_name.", '".$fp_aes_password."') as ".$column_name.", ";    
                    }
                }
            }
        }
        return $fields_list;
    }
    
    /**
     * Prepare file fields
     *      @param &$file_fileds_array
     *      @param $sql
     */
    protected function PrepareFileFields(&$file_fileds_array, $sql){
        // prepare list of file/image fields
        $files = array();
        if(is_array($this->columnsEditMode)){        
            foreach($this->columnsEditMode as $fldName => $fldParam){
                if(isset($fldParam['type']) && ($fldParam['type'] == 'image' || $fldParam['type'] == 'file')){
                    if(isset($fldParam['file_name']) && isset($fldParam['target_path'])){
                        $files[$fldName] = array('file_name' => $fldParam['file_name'], 'target_path' => $fldParam['target_path']);                        
                    }                    
                }
            }
        }        
        // there are some file/image fields 
        if(count($files) > 0){
            $fields_list_count = 0;
            $fields_list = '';
            foreach($files as $key => $val){
                if($fields_list_count++ > 0) $fields_list .= ", ";
                $fields_list .= $key;
            }
            $sql = str_replace('DELETE', "SELECT ".$fields_list." ", $sql);
            $dSet = $this->dbHandler->query($sql);
            while($row = $this->dgFetchRow($dSet)){
                $ind = 0;
                foreach($files as $key => $val){
                    $files[$key]["file_name"] = $row[$ind++];
                }
            }
            $file_fileds_array = array_merge($file_fileds_array, $files);
        }
    }

    /**
     * Delete file fields
     *      @param $file_fileds_array
     */
    protected function DeleteFileFields($file_fileds_array){
        foreach($file_fileds_array as $key => $val){
            @unlink($val["target_path"].$val["file_name"]); 
        }        
    }
    
    /**
     * Draw control buttons JS
     */
    protected function DrawControlButtonsJS(){
        // write control buttons javascript function
        $filtering_part = ''; $this->SetUrlString($filtering_part, "filtering", '', '');
        if($this->methodPostBack == 'ajax'){ $filtering_part_a = ''; $this->SetUrlString($filtering_part_a, "filtering", '', '', '', true); }
        $sorting_part = ''; $this->SetUrlString($sorting_part, '', 'sorting', '');
        $paging_part = ''; $this->SetUrlString($paging_part, '', '', 'paging');
        $http_get_vars_part = ($this->methodPostBack != "get") ? $this->GetHttpGetVars() : '';

        // [#0024]
        $print_export_mode = str_replace("clone", 'view', $this->GetVariable('mode'));
        $print_curr_url = $this->CombineUrl($print_export_mode, $this->GetVariable('rid'));
        $export_curr_url = $this->CombineUrl($print_export_mode, $this->GetVariable('rid'));
        
        $details_curr_url = $this->CombineUrl('details', "_RID_");
        $delete_curr_url = $this->CombineUrl('delete', "_RID_");
        $edit_curr_url = $this->CombineUrl('edit', "_RID_");
        $add_curr_url = $this->CombineUrl('add', "_RID_");
        $back_curr_url = $this->CombineUrl("cancel", "_RID_");
        $cancel_curr_url = $this->CombineUrl("cancel", "_RID_");
        $sorting_curr_url = $this->CombineUrl('view');
        $paging_curr_url  = $this->CombineUrl('view');
        $page_resize_curr_url = $this->CombineUrl('view');
        $reset_curr_url = $this->CombineUrl('view');
        $move_curr_url = $this->CombineUrl("move", "_RID_");
        $toggle_curr_url = $this->CombineUrl('update', "_RID_"); 

        // [methodPostBack - IN TEST #0010-1] 
        if($this->methodPostBack != "get"){
            echo "\n<form name='".$this->uniquePrefix."frmMain' id='".$this->uniquePrefix."frmMain' action='' style='margin:0px;padding:0px' method='post'></form>\n";
        }
        
        echo $this->ScriptOpen()."function ".$this->uniquePrefix."_doPostBack(mode,rid,param){
        var f_part = '".$filtering_part."';
        var f_part_a = ".(($this->methodPostBack == 'ajax') ? "'".$filtering_part_a."'" : "f_part").";
        var s_part = '".$sorting_part."';
        var p_part = '".$paging_part."';
        var h_part = '".$http_get_vars_part."';
        var h_part_print = '".str_replace('?', '&', $http_get_vars_part)."';
        
        var param = (param == null) ? '' : param;
        var details_url = ('".$details_curr_url."'+f_part".(($this->methodPostBack == 'ajax')?"":"+s_part+p_part")."+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var delete_url  = ('".$delete_curr_url."'+f_part_a+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var edit_url    = ('".$edit_curr_url."'+f_part+s_part+p_part+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var add_url     = ('".$add_curr_url."'+f_part".(($this->methodPostBack == 'ajax')?"":"+s_part+p_part")."+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var back_url    = ('".$back_curr_url."'+f_part".(($this->methodPostBack == 'ajax')?"":"+s_part+p_part")."+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var cancel_url  = ('".$cancel_curr_url."'+f_part+s_part+p_part+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var sorting_url = ('".$sorting_curr_url."'+f_part_a+param).replace(/&amp;/g, '&');";
        // [#0012 - 4] start suggested by kalak
        echo "sorting_url = sorting_url.replace(/\[\]\=/g, '%5B%5D='); sorting_url = sorting_url.replace(/\+\&/g, '%2B&');"; 
        // [#0012 - 4] end
        echo "
        var print_url   = (".(($this->methodPostBack == 'ajax')?"param":"'".$print_curr_url."'+f_part+s_part+p_part").").replace(/_RID_/g, '').replace(/&amp;/g, '&');
        var export_url  = ('".$export_curr_url."'+f_part".(($this->methodPostBack == 'ajax')?"":"+s_part+p_part")."+param).replace(/_RID_/g, '').replace(/&amp;/g, '&');
        var paging_url  = ('".$paging_curr_url."'+f_part_a+param).replace(/&amp;/g, '&');
        var page_resize_url = ('".$page_resize_curr_url."'+f_part_a+param).replace(/&amp;/g, '&');        
        var reset_url   = ('".$reset_curr_url."'+s_part+p_part+param).replace(/&amp;/g, '&');
        var move_url    = ('".$move_curr_url."'+s_part+p_part+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var toggle_url  = ('".$toggle_curr_url."'+f_part+param).replace(/_RID_/g, rid).replace(/&amp;/g, '&');
        var postback_method = '".(($this->methodPostBack == "get") ? "get" : "post")."';
        
        if(mode == 'details')    { ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(details_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', details_url, h_part, '".$this->methodPostBack."');")." }
        else if(mode == 'delete'){ ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(delete_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', delete_url, h_part, '".$this->methodPostBack."');")." }
        else if(mode == 'edit')  { _dgDoSimpleRequest('".$this->uniquePrefix."', edit_url, h_part, postback_method); }
        else if(mode == 'add')   { _dgDoSimpleRequest('".$this->uniquePrefix."', add_url, h_part, postback_method); }
        else if(mode == 'back')  { ".(($this->methodPostBack == 'ajax' && !$this->isMultirowAllowed) ? $this->uniquePrefix."_doAjaxRequest(back_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', cancel_url, h_part, postback_method);")." }
        else if(mode == 'cancel'){ _dgDoSimpleRequest('".$this->uniquePrefix."', cancel_url, h_part, postback_method); }
        else if(mode == 'sort')  { ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(sorting_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', sorting_url, h_part, '".$this->methodPostBack."');")." } 
        else if(mode == 'paging'){ ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(paging_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', paging_url, h_part, '".$this->methodPostBack."');")." }
        else if(mode == 'page_resize'){ ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(page_resize_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', page_resize_url, h_part, '".$this->methodPostBack."');")." }
        else if(mode == 'reset') { _dgDoSimpleRequest('".$this->uniquePrefix."', reset_url, h_part, postback_method); }
        else if(mode == 'print') { ".$this->uniquePrefix."myRef=window.open(print_url+'&".$this->uniquePrefix."print=true'+h_part_print,'PrintableView','left=20,top=20,width=840,height=630,toolbar=0,menubar=0,resizable=0,location=0,scrollbars=1');".$this->uniquePrefix."myRef.focus(); }
        else if(mode == 'export'){ ".$this->uniquePrefix."myRef=window.open(export_url+'&".$this->uniquePrefix."export=true'+h_part_print,'ExportTo','left=100,top=100,width=540,height=360,toolbar=0,menubar=0,resizable=0,location=0,scrollbars=1');".$this->uniquePrefix."myRef.focus(); }
        else if(mode == 'toggle_status') { ".(($this->methodPostBack == 'ajax') ? $this->uniquePrefix."_doAjaxRequest(toggle_url, h_part_print);" : "_dgDoSimpleRequest('".$this->uniquePrefix."', toggle_url, h_part, '".$this->methodPostBack."');")." }
        else if(mode == 'move')  { _dgDoSimpleRequest('".$this->uniquePrefix."', move_url, h_part, postback_method); }
        else{ ".(($this->debug) ? "alert('Unknown Mode!');" : '')." } }".$this->ScriptClose();
    }

    /**
     * Returnd converted datetime format for filtering fields
     *      @param $datetime_format
     */
    protected function GetDateFormatForFilteringCal($datetime_format = ''){
        if($datetime_format == "datedmy")       $format = "dd-mm-yyyy"; 
        else if($datetime_format == "datemdy")  $format = "mm-dd-yyyy"; 
        else if($datetime_format == "datetime") $format = "yyyy-mm-dd H:i:s"; 
        else if($datetime_format == "time")     $format = "H:i:s";
        else $format = "yyyy-mm-dd";
        return $format;
    }
    
    /**
     * Converts date format to floating calendar date format
     *      @param $datetime_format
     */
    protected function GetDateFormatForFloatingCal($datetime_format = ''){
        $if_format = "%Y-%m-%d";
        
        if($datetime_format == "Y-m-d")             { $if_format = "%Y-%m-%d"; }
        else if($datetime_format == "d-m-Y")        { $if_format = "%d-%m-%Y"; }
        else if($datetime_format == "Y-m-d H:i:s")  { $if_format = "%Y-%m-%d %H:%M:%S"; }
        else if($datetime_format == "Y-m-d H:i")    { $if_format = "%Y-%m-%d %H:%M"; }
        else if($datetime_format == "d-m-Y H:i:s")  { $if_format = "%d-%m-%Y %H:%M:%S"; }
        else if($datetime_format == "d-m-Y H:i")    { $if_format = "%d-%m-%Y %H:%M"; }
        else if($datetime_format == "m-d-Y H:i:s")  { $if_format = "%m-%d-%Y %H:%M:%S"; }
        else if($datetime_format == "m-d-Y H:i")    { $if_format = "%m-%d-%Y %H:%M"; }
        else if($datetime_format == "datedmy")      { $if_format = "%d-%m-%Y"; }
        else if($datetime_format == "datemdy")      { $if_format = "%m-%d-%Y"; }
        else if($datetime_format == "m-d-Y")        { $if_format = "%m-%d-%Y"; }
        else if($datetime_format == "datetime")     { $if_format = "%Y-%m-%d %H:%M:%S"; }
        else if($datetime_format == 'time')         { $if_format = "%H:%M:%S"; }
        
        if($this->dtSeparator != '') $if_format = str_replace("-", $this->dtSeparator, $if_format);
        return $if_format;
    }
    
    /**
     * Draws calendar button
     *      @param $field_name
     *      @param $field_type
     *      @param $datetime_format
     *      @param $field_value
     *      @param $field_width
     *      @param $field_maxlength
     *      @param $on_js_event
     *      @param $readonly
     *      @param $fp_calendar_type
     *      @param $multirow_postfix
     */
    protected function DrawCalendarButton($field_name, $field_type, $datetime_format="Y-m-d", $field_value='', $field_width='', $field_maxlength='', $on_js_event='', $readonly=false, $fp_calendar_type = "popup", $multirow_postfix = ''){
        $if_format = $this->GetDateFormatForFloatingCal($datetime_format);
        $show_seconds = 'false'; 
        $show_time = 'false';
        $show_date = true;        
        if($datetime_format == "Y-m-d")           { $show_time = 'false'; }
        else if($datetime_format == "d-m-Y")      { $show_time = 'false'; }
        else if($datetime_format == "m-d-Y")      { $show_time = 'false'; }
        else if($datetime_format == "Y-m-d H:i:s"){ $show_time = 'true'; $show_seconds = 'true'; }
        else if($datetime_format == "Y-m-d H:i")  { $show_time = 'true'; }
        else if($datetime_format == "m-d-Y H:i")  { $show_time = 'true'; }
        else if($datetime_format == "m-d-Y H:i:s"){ $show_time = 'true'; $show_seconds = 'true'; }
        else if($datetime_format == "d-m-Y H:i")  { $show_time = 'true'; }
        else if($datetime_format == "d-m-Y H:i:s"){ $show_time = 'true'; $show_seconds = 'true'; }
        else if($datetime_format == "H:i:s")      { $show_time = 'true'; $show_seconds = 'true'; $show_date = false; }
        else if($datetime_format == "H:i")        { $show_time = 'true'; $show_seconds = 'false'; $show_date = false; }
        
        $fp_req_type = $this->GetFieldRequiredType($field_name);
        $fp_title = $this->GetFieldTitle($field_name);
        $full_field_name = $fp_req_type.$field_name.$multirow_postfix;        

        $date_datetime_format = @date($datetime_format);
        if($this->dtSeparator != '') $date_datetime_format = str_replace("-", $this->dtSeparator, $date_datetime_format); 
        
        if($fp_calendar_type == 'floating'){
            $ret_date  = $this->nbsp."<input class='".$this->cssClass."_dg_textbox' ".$field_width." readonly type='text' title='".$fp_title."' name='".$full_field_name."' id='".$full_field_name."' value='".$this->MyDate($field_value, $field_type, $show_seconds)."' $field_maxlength ".$on_js_event." />";
            if(!$readonly) $ret_date .= "<img id='img".$full_field_name."' src='".$this->directory."styles/".$this->cssClass."/images/cal.gif' alt='".$this->lang['set_date']."' title='".$this->lang['set_date']."' align='top' style='cursor:pointer;margin:3px;margin-left:6px;margin-right:6px;border:0px;' />".$this->nbsp.$this->ScriptOpen()."Calendar.setup({firstDay : ".$this->weekStartingDay.", inputField : '".$full_field_name."', ifFormat : '".$if_format."', showsTime : ".$show_time.", button : 'img".$full_field_name."'});".$this->ScriptClose();
        }else if($fp_calendar_type == "dropdownlist"){
            $field_id  = $this->uniquePrefix."frmEditRow".$full_field_name;
            $ret_date  = $this->nbsp."<input style='width:0px;border:0px;margin:0px;padding:0px;' type='text' title='".$fp_title."' name='".$full_field_name."' id='".$field_id."' value='".$this->MyDate($field_value, $field_type, $show_seconds)."' $field_maxlength ".$on_js_event." />";
            
            $arr_ret_date = array();
            if($show_date){
                $arr_ret_date["y"] = "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_year' id='".$field_id."__nc_year' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['year']."</option>"; for($i=@date("Y")-90; $i<=@date("Y")+10; $i++) { $arr_ret_date["y"] .= "<option value='".$i."'>".$i."</option>"; }; $arr_ret_date["y"] .= "</select>";                            
                $arr_ret_date["m"] = "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_month' id='".$field_id."__nc_month' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['month']."</option>"; for($i=1; $i<=12; $i++) { $arr_ret_date["m"] .= "<option value='".(($i < 10) ? '0'.$i : $i)."'>".$this->lang['months'][$i]."</option>"; }; $arr_ret_date["m"] .= "</select>";
                $arr_ret_date["d"] = "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_day' id='".$field_id."__nc_day' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['day']."</option>"; for($i=1; $i<=31; $i++) { $arr_ret_date["d"] .= "<option value='".(($i < 10) ? '0'.$i : $i)."'>".(($i < 10) ? '0'.$i : $i)."</option>"; }; $arr_ret_date["d"] .= "</select>";

                $ret_date .= $arr_ret_date[strtolower(substr($datetime_format, 0, 1))];
                $ret_date .= $arr_ret_date[strtolower(substr($datetime_format, 2, 1))];
                $ret_date .= $arr_ret_date[strtolower(substr($datetime_format, 4, 1))];
            }
            if($show_time == 'true'){
                if($show_date) $ret_date .= " : ";
                $ret_date .= "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_hour' id='".$field_id."__nc_hour' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['hour']."</option>"; for($i=0; $i<=23; $i++) { $ret_date .= "<option value='".(($i < 10) ? '0'.$i : $i)."'>".(($i < 10) ? '0'.$i : $i)."</option>"; }; $ret_date .= "</select>"; 
                if(!$show_date) $ret_date .= ":"; $ret_date .= "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_minute' id='".$field_id."__nc_minute' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['min']."</option>"; for($i=0; $i<=59; $i++) { $ret_date .= "<option value='".(($i < 10) ? '0'.$i : $i)."'>".(($i < 10) ? '0'.$i : $i)."</option>"; }; $ret_date .= "</select>";                    
                if($show_seconds == 'true') { if(!$show_date) $ret_date .= ":"; $ret_date .= "<select class='".$this->cssClass."_dg_select' name='".$field_id."__nc_second' id='".$field_id."__nc_second' onChange='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\")'><option value=''>".$this->lang['sec']."</option>"; for($i=0; $i<=59; $i++) { $ret_date .= "<option value='".(($i < 10) ? '0'.$i : $i)."'>".(($i < 10) ? '0'.$i : $i)."</option>"; }; $ret_date .= "</select>"; }
            }
            $ret_date .= " ";
            if(!$readonly) $ret_date .= "<a class='".$this->cssClass."_dg_a2' style='cursor: pointer;' onclick='_dgSetCalendarDate(\"".$this->uniquePrefix."frmEditRow\", \"".$field_id."\", \"".$datetime_format."\", \"".@date($datetime_format)."\", \"".(@date("Y")-90)."\", false)'>[".$date_datetime_format."]</a>";
            if((!$readonly) && (substr($fp_req_type, 0, 1) == "s")) $ret_date .= " <a class='".$this->cssClass."_dg_a2' style='cursor: pointer;' onclick='_dgResetDDL(\"".$field_id."__nc_year\");_dgResetDDL(\"".$field_id."__nc_month\");_dgResetDDL(\"".$field_id."__nc_day\", true);_dgResetDDL(\"".$field_id."__nc_hour\");_dgResetDDL(\"".$field_id."__nc_minute\");_dgResetDDL(\"".$field_id."__nc_second\");' title='".$this->lang['clear']."'>[".$this->lang['clear']."]</a>";                                    
            $ret_date .= $this->ScriptOpen()."_dgSetCalendarDate('".$this->uniquePrefix."frmEditRow', '".$field_id."', '".$datetime_format."', '".trim($field_value)."', '".(@date("Y")-90)."');".$this->ScriptClose();    
        }else{
            $ret_date  = $this->nbsp."<input class='".$this->cssClass."_dg_textbox' ".$field_width." readonly type='text' title='".$fp_title."' name='".$full_field_name."' id='".$full_field_name."' value='".$this->MyDate($field_value, $field_type, $show_seconds)."' $field_maxlength ".$on_js_event." />";
            if(!$readonly) $ret_date .= "<a class='".$this->cssClass."_dg_a2' title='".$fp_title."' href=\"javascript:_dgOpenCalendar('".(($this->ignoreBaseTag) ? $this->HTTP_HOST."/" : '').$this->directory."','separator=".$this->dtSeparator."','".$this->uniquePrefix."frmEditRow','".$full_field_name."','".$field_name."','$field_type')\"><img src='".$this->directory."styles/".$this->cssClass."/images/cal.gif' alt='".$this->lang['set_date']."' title='".$this->lang['set_date']."' align='top' style='margin:3px;margin-left:6px;margin-right:6px;border:0px;' /></a>".$this->nbsp;
        }
        if(($fp_calendar_type == 'floating') || ($fp_calendar_type == "popup")){
            if(!$readonly) $ret_date .= "<a class='".$this->cssClass."_dg_a2' style='cursor:pointer;' onclick='document.getElementById(\"".$full_field_name."\").value=\"".$date_datetime_format."\"'>[".$date_datetime_format."]</a>";
            if((!$readonly) && (substr($fp_req_type, 0, 1) == "s")) $ret_date .= " <a class='".$this->cssClass."_dg_a2'  style='cursor: pointer;' onclick='document.getElementById(\"".$full_field_name."\").value=\"\"' title='".$this->lang['clear']."'>[".$this->lang['clear']."]</a>";                            
        }
        
        return $ret_date;
    }

    /**
     * Download export file
     *      @param $file_name
     */
    protected function ExportDownloadFile($file_name){
        $export_params = '';
        if($this->exportMethod == "session"){
            $_SESSION['datagrid_export_dir']  = $this->exportingDirectory;
            $_SESSION['datagrid_export_file'] = $file_name;
            $_SESSION['datagrid_debug']       = $this->debug;            
        }else{
            $export_params .= "?datagrid_export_dir=".$this->exportingDirectory;
            $export_params .= "&datagrid_export_file=".$file_name;
            $export_params .= "&datagrid_debug=".$this->debug;
        }
        
        return $this->ScriptOpen()."if(confirm('Do you want to export datagrid content into [".$file_name."] file?')){ ".
        " document.write('".str_replace("_FILE_", $file_name, $this->lang['export_message'])."'); ".            
        " document.location.href = '".$this->directory."scripts/download.php".$export_params."'; ".
        "} else {".
        " window.close();".
        "}".$this->ScriptClose();
    }
    
    /**
     * Get remote file content
     *      @param $url
     */
    protected function HttpGetFile($url)  {    
        $url_stuff = parse_url($url);
        $port = isset($url_stuff['port']) ? $url_stuff['port']:80;     
        $fp = fsockopen($url_stuff['host'], $port);     
        $query  = 'GET '.$url_stuff['path']." HTTP/1.0\n";
        $query .= 'Host: '.$url_stuff['host']."\n\n";
        $buffer = '';
        fwrite($fp, $query);    
        while ($line = fread($fp, 1024)) $buffer .= $line;
        preg_match('/Content-Length: ([0-9]+)/', $buffer, $parts);        
        if($buffer != '' && isset($parts[1])) return substr($buffer, - $parts[1]);    
        else if($buffer != '') return $buffer;
        else return '';    
    }    
    
    /**
     * Resize uploaded image
     *      @param $image_path
     *      @param $image_name
     *      @param $resize_width
     *      @param $resize_height
     *      @param $fp_resize_dir
     */
    function ResizeImage($image_path, $image_name, $resize_width = '', $resize_height = '', $fp_resize_dir = ''){
        $image_path_name = $image_path.$image_name;        
        if(empty($image_path_name)){ // No Image?    
            $this->AddWarning('', '', $this->lang['uploaded_file_not_image']);
        }else{
            $case   = '';
            $size   = getimagesize($image_path_name);
            $width  = $size[0];
            $height = $size[1];
            
            if($fp_resize_dir == "down" && !($width > $resize_width && $height > $resize_height)){
                return false;
            }else if($fp_resize_dir == "up" && !($width < $resize_width && $height < $resize_height)){
                return false;
            }            
            
            $ext       = strtolower(substr($image_path_name, strrpos($image_path_name,".")+1));
            $imagetype = exif_imagetype($image_path_name);
            if($imagetype == '1' && $ext != 'gif') $ext = 'gif';
            else if($imagetype == '2' && $ext != 'jpg' && $ext != 'jpeg') $ext = 'jpg';
            else if($imagetype == '3' && $ext != 'png') $ext = 'png';
            switch($ext){
                case 'png':
                    $iTmp = imagecreatefrompng($image_path_name);
                    $case = 'png';
                    break;
                case 'gif':
                    $iTmp = imagecreatefromgif($image_path_name);
                    $case = 'gif';
                    break;                
                case 'jpeg':            
                case 'jpg':
                    $iTmp = imagecreatefromjpeg($image_path_name);
                    $case = 'jpg';
                    break;                
            }
                        
			if($case != ''){
                if($resize_width != '' && $resize_height == ''){
                    $new_width  = $resize_width;
                    $new_height = ($height/$width)*$new_width;                
                }else if($resize_width == '' && $resize_height != ''){
                    $new_height = $resize_height;
                    $new_width  = ($width/$height)*$new_height;
                }else if($resize_width != '' && $resize_height != ''){
                    $new_width  = $resize_width;
                    $new_height = $resize_height;                    
                }else{
                    $new_width  = $width;  
                    $new_height = $height;
                }
				$iOut = imagecreatetruecolor(intval($new_width), intval($new_height));     
				imagecopyresampled($iOut,$iTmp,0,0,0,0, intval($new_width), intval($new_height), $width, $height);
                imagejpeg($iOut, $image_path_name, 100);
			}
        }        
    }        

    /**
     * Split URL vars into hidden fields
     *      @param $curr_url
     */
    protected function PrintHiddenFieldsFromUrl($curr_url){
        if($this->methodPostBack != 'get'){
            $curr_url_temp = str_replace(array('?', '&amp;'), array('', '&'), $curr_url);
            parse_str($curr_url_temp, $curr_url_pairs);
            foreach($curr_url_pairs as $key => $val) {
                echo "<input type='hidden' name='".$key."' id='".$key."' value='".$val."' />".chr(13);
            }
        }        
    }  
    
    /**
     * Check if file exists
     *      @param $file
     */
    protected function IsFileExists($file){
        $file = trim($file);
        if(strtolower($this->platform) == 'windows' && $file != ''){
            if(@file_exists($file)) return true;
        }else if(file_exists($file)){
            return true;
        }
        return false;
    }

    /**
     * Set Http Get Vars
     */
    protected function GetHttpGetVars(){
        $output = '';
        $amp = '&';
        if(is_array($this->httpGetVars)){
            foreach($this->httpGetVars as $key){
                if(empty($output)) $output = (($this->ignoreBaseTag) ? $this->HTTP_URL : '').'?';
                else $output .= $amp;                
                $output .= $this->GetVariable($key, false, 'request', true);
            }
        }
        return $output;
    }

    //==========================================================================
    // PRIVATE MEMBER FUNCTIONS 
    //==========================================================================
    /**
     * Set filtering fields in bind()
     */
    private function SetFieldsFilteringInBind(){
        $req_selSearchType   = $this->GetVariable('_ff_selSearchType');
        $filter_fields_count = 0; /* used to count fields in SQL (() and () and ())*/

        $filter_fields_array = $this->arrFilterFields;

        if($this->onSubmitFilter != ''){            
            $search_type_start = 'AND';
            if($req_selSearchType == '0'){
                $search_type = 'AND';                    
            }else{
                $search_type = 'OR';
            }
            
            $parsed_sql = SqlParser::ParseString($this->sqlView)->getCountQuery();
            if(!preg_match('/\bwhere\b/i', $parsed_sql) && !preg_match('/\bhaving\b/i', $parsed_sql)) $this->sqlView .= " WHERE 1=1 ";
            if(count($filter_fields_array) > 0) $this->sqlView .= " ".$search_type_start." (";
            // 1. loop by filter fields		
            foreach($filter_fields_array as $fldName => $fldValue){
                $table_field_name = '';
                $fldValue_fields = str_replace(" ", '', $fldValue['field']);
                $fldValue_fields = explode(",", $fldValue_fields);
                
                $fp_filter_condition  = $this->GetFieldProperty($fldName, "filter_condition", 'filter', 'normal');
                $fp_type  = $this->GetFieldProperty($fldName, 'type', 'filter', 'normal');
                // get extension for from/to fields                    
                $fp_field_type = $this->GetFieldProperty($fldName, 'field_type', 'filter', 'normal');
                if($fp_field_type != '') $fp_field_type = "_fo_".$fp_field_type;
                $fp_table = trim($this->GetFieldProperty($fldName, 'table', 'filter', 'normal'));
                
                // 2. loop by filter fields 
                $words_count_outer = 0;
                $sqlViewTemp = ''; 
                foreach($fldValue_fields as $fldValue_field){
                    // ignore filter field if there was empty 'table' or 'field' attribute
                    if(($fp_table == '') || (trim($fldValue['field']) == '')) { continue; }
                    // table-filed name with fixed "dot" issue
                    $table_field_name = str_replace(".", "_d_", $fp_table)."_".$fldValue_field;
                    // full name of field in URL
                    $field_name_in_url = $this->uniquePrefix."_ff_".$table_field_name.$fp_field_type;
                    if(isset($_REQUEST[$field_name_in_url]) && ($_REQUEST[$field_name_in_url] !== '')){
                        $filter_field_operator = $table_field_name."_operator";                        
                        if(isset($fldValue['case_sensitive']) && ($fldValue['case_sensitive'] != true || $fldValue['case_sensitive'] != 'true')){
                            $fldValue_table = $this->ReplaceWithAlias($fp_table);
                            // [#0037] fixed bug 01.05.2011
                            if($this->dgGetDbDriverType() == 'mssql'){
                                $fldTableField = $this->GetLcaseFooByDbType()."(".$fldValue_field.") ";
                            }else{
                                $fldTableField = $this->GetLcaseFooByDbType()."(".(($fldValue_table != '') ? (($this->dgGetDbDriverType() == 'ibm') ? $this->dbSchema.'.' : '').$fldValue_table."." : '').$fldValue_field.") ";
                            }
                            $fldTableFieldName = Helper::ConvertCase($_REQUEST[$field_name_in_url],'lower',$this->langName);
                        }else{
                            // [#0016] fixed bug 21.05.2010
                            if($this->dgGetDbDriverType() == 'mssql'){
                                $fldTableField = $fldValue_field;
                            }else{
                                $fldTableField = (($fp_table != '') ? $fp_table."." : "" ).$fldValue_field;
                            }
                            $fldTableFieldName = $_REQUEST[$field_name_in_url];
                        }
                        
                        $field_comparison_type = isset($fldValue['comparison_type']) ? strtolower($fldValue['comparison_type']) : "string";
                        $left_quote = "'"; 
                            
                        // split by separated words if user split them by ","
                        if(!is_array($fldTableFieldName)){
                            if($fp_type != "dropdownlist" && $fp_type != "enum"){
                                // to prevent splitting of text fields, including commas (,)
                                $split_fldTableFieldName = explode(",", $fldTableFieldName);
                            }else{
                                $split_fldTableFieldName = array($fldTableFieldName);
                            }
                        }else{
                            $split_fldTableFieldName = $fldTableFieldName;
                        }
                        
                        if(count($split_fldTableFieldName) > 0){
                            if($filter_fields_count++ > 0){
                                if($fp_field_type == "_fo_to"){ // [#0050-1 under check - 24.12.11]
                                    $sqlViewTemp .= " AND ";
                                }else{
                                    $sqlViewTemp .= " ".(($words_count_outer > 0) ? " OR " : $search_type_start);
                                }
                            }
                        }
                        if(count($split_fldTableFieldName) > 1) $sqlViewTemp .= ' ( ';
                        $words_count_inner = 0;
                        foreach($split_fldTableFieldName as $separated_word){
                            $separated_word = urldecode(trim($separated_word));
                            // check if there is a formated date fields
                            $separated_word = $this->IsDatePrepare($fldName, $separated_word, 'filter', 'date_format', false);                            
                            // [#0020 under check - 26.07.10] - quotes escape 
                            $separated_word = addslashes($separated_word);                                                       
                            $requested_filter_field_operator = isset($_REQUEST[$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type]) ? $_REQUEST[$this->uniquePrefix."_ff_".$filter_field_operator.$fp_field_type] : '';

                            if($words_count_inner > 0) $sqlViewTemp .= ' OR ';

                            if($requested_filter_field_operator != ''){                                
                                if($field_comparison_type == "binary") $comparison_type = "BINARY";
                                else $comparison_type = '';
                                // simple check for entered data, if comparison type = numeric
                                if($field_comparison_type == "numeric" && ($separated_word == "NULL" || is_numeric($separated_word))) $left_quote = '';
                                $requested_filter_field_operator = urldecode($requested_filter_field_operator);
                                if($requested_filter_field_operator == "like"){
                                    $sqlViewTemp .= " $fldTableField ".$requested_filter_field_operator." ".$comparison_type." '%".$separated_word."%'";
                                }else if($requested_filter_field_operator == "like%"){
                                    $sqlViewTemp .= " $fldTableField ".substr($requested_filter_field_operator, 0, 4)." ".$comparison_type." '".$separated_word."%'";
                                }else if($requested_filter_field_operator == "%like"){
                                    $sqlViewTemp .= " $fldTableField ".substr($requested_filter_field_operator, 1, 4)." ".$comparison_type." '%".$separated_word."'";
                                }else if($requested_filter_field_operator == "%like%"){
                                    $sqlViewTemp .= " $fldTableField ".substr($requested_filter_field_operator, 1, 4)." ".$comparison_type." '%".$separated_word."%'";
                                }else{
                                    $sqlViewTemp .= " $fldTableField ".$requested_filter_field_operator." $left_quote".$separated_word."$left_quote ";
                                }
                            }else{
                                $sqlViewTemp .= " $fldTableField = $left_quote".$separated_word."$left_quote ";
                            }                            
                            $words_count_outer++;
                            $words_count_inner++;
                        }
                        if(count($split_fldTableFieldName) > 1) $sqlViewTemp .= ' ) ';
                        // add here field_property_filter_condition from "filter_condition" attribute
                        if($fp_filter_condition != ''){
                            $sqlViewTemp .= (preg_match('/and/i', $fp_filter_condition)) ? ' '.$fp_filter_condition." " : " AND ".$fp_filter_condition." ";
                        }
                        if($search_type_start !== $search_type){ $search_type_start = $search_type; }
                    }                        
                } // 2. end loop
                $this->sqlView .= ((count($fldValue_fields) > 1 && $words_count_outer > 0)) ? " (".$sqlViewTemp.") " : $sqlViewTemp;    
            }// 1. end loop
            if($filter_fields_count == 0 && count($filter_fields_array) > 0) $this->sqlView .= "1=1 ";
            if(count($filter_fields_array) > 0) $this->sqlView .= " ) ";
            $this->DataSourceOld($this->dbHandler, $this->sqlView);
        }else if($this->defaultFilteringAllowed){
            // set default filtering 
            foreach($filter_fields_array as $fldName => $fldValue){
                $df_table = isset($fldValue['table']) ? trim($fldValue['table']) : '';
                $df_field = isset($fldValue['field']) ? $fldValue['field'] : '';
                $df_default_operator = isset($fldValue['default_operator']) ? $fldValue['default_operator'] : '';
                $df_comparison_type = isset($fldValue['comparison_type']) ? strtolower($fldValue['comparison_type']) : "string";
                if($df_comparison_type == "binary") $df_comparison_type = "BINARY"; else $df_comparison_type = '';
                $df_default = isset($fldValue['default']) ? $fldValue['default'] : '';
                if($this->GetFieldProperty($fldName, 'type', 'filter') == "calendar" && !empty($df_default)){
                    $df_default = $this->IsDatePrepare($fldName, $df_default, 'filter', 'date_format', false);
                }
                
                if($df_default != ''){
                    $this->sqlView .= " AND ".$df_table.".".$df_field." ";
                    if($df_default_operator == "like"){
                        $this->sqlView .= "LIKE ".$df_comparison_type." '%".$df_default."%' ";
                    }else if($df_default_operator == "like%"){
                        $this->sqlView .= "LIKE ".$df_comparison_type." '".$df_default."%' ";
                    }else if($df_default_operator == "%like"){
                        $this->sqlView .= "LIKE ".$df_comparison_type." '%".$df_default."' ";
                    }else if($df_default_operator == "%like%"){
                        $this->sqlView .= "LIKE ".$df_comparison_type." '%".$df_default."%' ";
                    }else{
                        $this->sqlView .= $df_default_operator." '".$df_default."' ";
                    }                    
                }           
			}
            $this->DataSourceOld($this->dbHandler, $this->sqlView);                
        }
    }
    
    /**
     * Set datetime field in right format (dd-mm-yyyy)|(yyyy-mm-dd)
     *      @param $field_name
     *      @param $fldValue
     *      @param $mode
     *      @param $attr
     *      @param $quotes
     */
    private function IsDatePrepare($field_name, $fldValue, $mode = 'edit', $attr = 'type', $quotes = true){
        if(preg_match("/CURRENT_TIMESTAMP/i", $fldValue) || preg_match("/NOW\(/i", $fldValue)){
            return "CURRENT_TIMESTAMP()";    
        }else if(preg_match("/CURRENT_DATE/i", $fldValue) || preg_match("/CURDATE/i", $fldValue)){
            return "CURRENT_DATE()";    
        }else{
            $fp_type = $this->GetFieldProperty($field_name, $attr, $mode, 'normal');
            $fldValue = trim($fldValue);
            switch($fp_type){
                case 'date':        // date: DATE
                case 'datetime':    // date: DATE
                    break;                
                case 'datetimedmy': // date: DATETIME 23-10-2009 14:58:00
                    $time   = substr($fldValue, 11, 8);
                    $year   = substr($fldValue, 6, 4);
                    $month  = substr($fldValue, 3, 2);
                    $day    = substr($fldValue, 0, 2);
                    $fldValue = $year."-".$month."-".$day." ".$time;
                    break;
                case 'datetimemdy': // date: DATETIME 10-23-2009 14:58:00
                    $time   = substr($fldValue, 11, 8);
                    if(stripos($fldValue, $this->dtSeparator) == 2){
                        $year   = substr($fldValue, 6, 4);
                        $month  = substr($fldValue, 0, 2);
                        $day    = substr($fldValue, 3, 2);                        
                    }else{
                        $year   = substr($fldValue, 0, 4);
                        $month  = substr($fldValue, 5, 2);
                        $day    = substr($fldValue, 8, 2);                                                
                    }
                    $fldValue = $year.'-'.$month.'-'.$day.' '.$time;
                    break;
                case 'datedmy':    // date: DATE 23-10-2009
                    $year   = substr($fldValue, 6, 4);
                    $month  = substr($fldValue, 3, 2);
                    $day    = substr($fldValue, 0, 2);
                    $fldValue = $year."-".$month."-".$day;
                    break;
                case 'datemdy':    // American format: DATE 10-23-2009
                    $year   = substr($fldValue, 6, 4);
                    $month  = substr($fldValue, 0, 2);
                    $day    = substr($fldValue, 3, 2);
                    $fldValue = $year."-".$month."-".$day;
                    break;
                default:
                    break;
            }
            if($quotes) return "'".$fldValue."'";
            else return $fldValue;            
        }        
    }

    /**
     * Draw color picker
     *      @param $full_field_name
     *      @param $field_value
     *      @param $field_name
     *      @param $disabled
     *      @param $on_js_event
     */
    private function DrawColorPicker($full_field_name, $field_value, $field_name, $disabled, $on_js_event=''){
        $output  = "<img src='".$this->directory."images/colors.png' alt='' title='' align='top' /> ";
        $output .= "<input class='".$this->cssClass."_dg_textbox dg_picker_color' maxlength='7' style='width:90px' name='".$full_field_name."' value='".$field_value."' ".$on_js_event.'>';
        return $output;    
    }
    
    /**
     * Set datetime field in timestamp format
     *      @param $fld_value
     */
    private function PrepareTimeStamp($fld_value){
        if(preg_match("/CURRENT_TIMESTAMP/i", $fld_value) || preg_match("/NOW\(/i", $fld_value)){
            return "CURRENT_TIMESTAMP()";    
        }else if(preg_match("/CURRENT_DATE/i", $fld_value) || preg_match("/CURDATE/i", $fld_value)){
            return "CURRENT_DATE()";
        }else if(preg_match("/CURRENT_TIME/i", $fld_value) || preg_match("/CURTIME/i", $fld_value)){
            return "CURRENT_TIME()";
        }
        return "'".$fldValue."'";
    }    

    /**
     * Check if datetime field in timestamp format
     *      @param $field_name
     *      @param $fld_value
     */
    private function IsTimeStamp($field_name, $fld_value){
        if($this->GetFieldProperty($field_name, 'type') == "hidden"){
            if(preg_match("/CURRENT_TIMESTAMP/i", $fld_value) || preg_match("/NOW\(/i", $fld_value)){
                return true;    
            }else if(preg_match("/CURRENT_DATE/i", $fld_value) || preg_match("/CURDATE/i", $fld_value)){
                return true;    
            }else if(preg_match("/CURRENT_TIME/i", $fld_value) || preg_match("/CURTIME/i", $fld_value)){
                return true;    
            }            
        }
        return false;    
    }

    /**
     * Check if field type needs ''(text) or not (numeric...)
     *      @param $field_name
     */
    private function IsText($field_name){
        $field_type = $this->GetFieldInfo($field_name, 'type', 0);
        $result = true;
        switch (strtolower($field_type)){
            case 'int':     // int: TINYINT, SMALLINT, MEDIUMINT, INT, INTEGER, BIGINT, TINY, SHORT, LONG, LONGLONG, INT24
            case 'real':    // real: FLOAT, DOUBLE, DECIMAL, NUMERIC
            case 'null':    // empty: NULL
            case 'long':    // int: LONG
            case 'number':  // NUMBER - for oci8 (oracle)
                $result = false; break;
            case 'string':  // string: CHAR, VARCHAR, TINYTEXT, TEXT, MEDIUMTEXT, LONGTEXT, ENUM, SET, VAR_STRING
            case 'blob':    // blob: TINYBLOB, MEDIUMBLOB, LONGBLOB, BLOB, TEXT
            case 'date':    // date: DATE
            case 'timestamp':    // date: TIMESTAMP
            case 'year':    // date: YEAR
            case 'time':    // date: TIME
            case 'datetime':    // date: DATETIME
                $result = true; break;
            default:
                $result = true; break;
        }
        return $result;
    }

    /**
     * Check if field type is a date/time type
     *      @param $field_name
     *      @param $mode
     */
    private function IsDate($field_name, $mode = 'edit'){
        $result = false;
        if($mode == 'edit'){
            $field_type = $this->GetFieldProperty($field_name, 'type', $mode, 'normal');    
        }else{
            $field_type = $this->GetFieldInfo($field_name, 'type', 0);            
        }        
        switch (strtolower($field_type)){
            case 'date':        // date: DATE
            case 'datedmy':     // date: DATE 23-10-2009
            case 'datemdy':     // American format: DATE 10-23-2009
            case 'datetime':    // date: DATETIME            
            case 'datetimedmy': // date: DATETIME 23-10-2009 14:58:00
            case 'datetimemdy': // date: DATETIME 10-23-2009 14:58:00            
            case 'timestamp':   // date: TIMESTAMP
            case 'year':        // date: YEAR
            case 'time':        // date: TIME
                $result = true; break;
            default:
                $result = false; break;
        }
        return $result;
    }

    /**
     * Check if password crypted
     *      @param $field_name
     *      @param $fldValue
     */
    private function IsPasswordCrypted($field_name, $fldValue){
        $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit');
        $fp_cryptography = $this->GetFieldPropertyBool($field_name, "cryptography", 'edit', false, false);
        $fp_cryptography_type = $this->GetFieldProperty($field_name, "cryptography_type", 'edit');
        $fp_aes_password = $this->GetFieldProperty($field_name, "aes_password", 'edit');
        if($fp_type == "password" && $fp_cryptography){
            if($fp_cryptography_type == "md5"){
                return ($fldValue == '') ? "" : "'".md5($fldValue)."'";
            }else if($fp_cryptography_type == "aes"){
                return "AES_ENCRYPT('".$fldValue."', '".$fp_aes_password."')";                
            }
        }
        return "'".$fldValue."'";    
    }
    
    /**
     * Check if field type is a password
     *      @param $field_name
     */
    private function IsPassword($field_name){
        $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit');
        return ($fp_type == "password") ? true : false; 
    }    

    /**
     * Check if field type is a money
     *      @param $field_name
     */
    private function IsMoney($field_name){
        $fp_type = $this->GetFieldProperty($field_name, 'type', 'edit');
        return ($fp_type == "money") ? true : false; 
    }    

    /**
     * Check if a field is readonly
     *      @param $field_name
     */
    private function IsReadonly($field_name){
        return $this->GetFieldPropertyBool($field_name, 'readonly', 'edit', false, false);
    }    

    /**
     * Check if a field is validator
     *      @param $field_name
     */
    private function IsValidator($field_name){
        $validator_letter = substr($field_name, 1, 1);
        $validator_field = substr($field_name, 3, strlen($field_name));
        if($validator_letter == "v"){
            foreach($this->columnsEditMode as $key => $val){
                if(isset($val['type']) && $val['type'] == "validator" && $val['for_field'] == $validator_field){
                    return true;        
                }
            }            
        }
        return false;
    }    
    
    /**
     * Check if a field is a foreign key
     *      @param $field_name
     */
    private function IsForeignKey($field_name){
        return (array_key_exists($field_name, $this->arrForeignKeys)) ? true : false;
    }
    
    /**
     * Check if a field is enum
     *      @param $field_name
     */
    private function IsEnum($field_name){
        if(isset($this->columnsEditMode[$field_name]['type']) && $this->columnsEditMode[$field_name]['type'] == "enum"){
            return true;        
        }            
        return false;
    }    

    /**
     * Check is field required
     *      @param $field
     */
    private function IsFieldRequired($field){        
        if(!$this->isError){
            $field_offset = $this->GetFieldOffset($field);
            if($field_offset != -1){
                if($this->dbType == 'PDO'){                    
                    $fields = $this->dataSet->getColumnMeta($field_offset);
                    if(isset($fields['flags'][0]) && $fields['flags'][0] == "not_null") return true;
                }else{                    
                    $fields = $this->dataSet->tableInfo();
                    $flags = $fields[$field_offset]['flags'];
                    if(strstr(strtolower($flags), "not_null")) return true;                     
                }                
            }
        }        
        return false;
    }

    /**
     * Check if field excepted
     *      @param $field_name
     */
    private function IsExceptedField($field_name){        
        if(preg_match('/file_act/i', $field_name) || preg_match('/ration_randomize_code/i', $field_name) || preg_match("/__nc/i", $field_name)){                
            return true;
        }        
        if($this->methodPostBack != 'get'){            
            $arr_excepted_words = array('mode', 'rid', 'sort_field', "sort_field_by", "sort_field_type", "sort_type", "page_size", "p", "_ff_", "new", "toggle_status", "toggle_field", "toggle_field_value");
            // handle current datagrids
            foreach($arr_excepted_words as $key){                
                if(preg_match("/".$this->uniquePrefix.$key."/i", $field_name)) { return true; }
            }
            // handle other datagrids
            if(is_array($this->anotherDatagrids)){
                foreach($this->anotherDatagrids as $key_prefix => $val_prefix){
                    foreach($arr_excepted_words as $key){                
                        if(preg_match("/".$key_prefix.$key."/i", $field_name)) { return true; }
                    }                    
                }
            }                                
        }        
        return false;
    }
    
    /**
     * Get field title
     *      @param $field_name
     *      @param $mode
     */
    private function GetFieldTitle($field_name, $mode = 'edit'){
        $field_title = $this->GetFieldProperty($field_name, 'title', $mode, '');
        if($field_title === ''){
            $field_header = $this->GetFieldProperty($field_name, 'header', $mode);
            if($field_header === ''){
                return $field_name;            
            }else{
                return str_replace("'", "&#039;", $field_header);            
            }            
        }else{
            return $field_title;
        }
    }
    
    /**
     * Get field property
     *      @param $field_name
     *      @param $property_name
     *      @param $mode
     *      @param $case
     *      @param $ret_value
     */
    private function GetFieldProperty($field_name, $property_name, $mode = 'edit', $case = 'normal', $ret_value = ''){
        $return_value = '';
        switch($mode){
            case 'view':
                if(isset($this->columnsViewMode[$field_name][$property_name])){
                    $field_property_value = $this->columnsViewMode[$field_name][$property_name];
                    if($case === 'lower'){
                        $return_value = strtolower($field_property_value);
                    }else{
                        $return_value = $field_property_value;
                    }
                }
                break;
            case 'filter':
                if(isset($this->arrFilterFields[$field_name][$property_name])){
                    if($case === 'lower'){
                        $return_value = strtolower($this->arrFilterFields[$field_name][$property_name]);
                    }else{
                        $return_value = $this->arrFilterFields[$field_name][$property_name];
                    }
                }            
                break;
            case 'details':
            case 'edit':
            default:
                if(isset($this->columnsEditMode[$field_name][$property_name])){
                    if($case === 'lower'){                        
                        if(is_array($this->columnsEditMode[$field_name][$property_name])){
                            return $this->columnsEditMode[$field_name][$property_name];
                        }else{
                            $return_value = strtolower($this->columnsEditMode[$field_name][$property_name]);
                        }                        
                    }else{
                        $return_value = $this->columnsEditMode[$field_name][$property_name];
                    }
                }
                break;
        }
        if($return_value === 'true'){
            $return_value = true;
        }else if($return_value === 'false'){
            $return_value = false;
        }else if($return_value === ''){
            $return_value = $ret_value;
        }
        return $return_value;        
    }

    /**
     * Get field boolean property
     *      @param $field_name
     *      @param $property_name
     *      @param $mode
     *      @param $default_value
     *      @param $empty_value
     */
    private function GetFieldPropertyBool($field_name, $property_name, $mode = 'edit', $default_value = false, $empty_value = ''){
        $return_value = false;
        switch($mode){
            case 'view':
                $columnsArray = &$this->columnsViewMode; break;
            case 'details':
            case 'edit':
                $columnsArray = &$this->columnsEditMode; break;
            case 'filter':
                $columnsArray = &$this->arrFilterFields; break;
            default:
                $columnsArray = array(); break;
        }

        if(isset($columnsArray[$field_name][$property_name])){
            $field_property_value = $columnsArray[$field_name][$property_name];
            if($field_property_value === '' && $empty_value !== ''){
                $return_value = $empty_value;
            }else{
                $field_property_value = strtolower($field_property_value);
                if($field_property_value === 'true' || $field_property_value === true || $field_property_value == 1){
                    $return_value = true;
                }
            }
        }else{
            $return_value = $default_value;
        }
        return $return_value; 
    }

    /**
     * Returns field name
     *      @param $field_offset
     */
    private function GetFieldName($field_offset){
        if(!$this->isError){
            if($this->dbType == 'PEAR'){
                if(!$this->dbHandler->isError($this->dataSet)){
                    $fields = $this->dataSet->tableInfo();
                    if(isset($fields[$field_offset]['name'])) return $fields[$field_offset]['name'];
                }
            }else{
                if($field_offset != '-1'){
                    $meta = $this->dataSet->getColumnMeta($field_offset);
                    if(isset($meta['name'])) return $meta['name'];
                }
            }
        }
        return $field_offset;
    }  

    /**
     * Get field required type
     *      @param $field_name
     *      @param $validator
     */
    private function GetFieldRequiredType($field_name, $validator = false){
        $field_prefix = "syy";
        $field_req_type = trim($this->GetFieldProperty($field_name, "req_type"));
        if($field_req_type != ''){
            if(strlen($field_req_type) == 3){ $field_prefix = $field_req_type; }
            else if(strlen($field_req_type) == 2){
                $field_prefix = $field_req_type."y";
            }
        }
        if($validator) $field_prefix[1] = "v";
        return $field_prefix;
    }

    /**
     * Check if field exists & can be viewed
     *      @param $field_name
     *      @param $force_simple
     */
    private function GetHeaderName($field_name, $force_simple = false){
        $force_simple = (($force_simple == true) || ($force_simple == 'true')) ? true : false ;
        $fp_header = $this->GetFieldProperty($field_name, 'header', $this->mode, 'normal');
        if($this->mode === 'view'){
            if(array_key_exists($field_name, $this->columnsViewMode) && ($fp_header != '')){
                return $fp_header;
            }
        }else if($this->mode === 'edit'){
            if(array_key_exists($field_name, $this->columnsEditMode)){
                if($fp_header == '') $fp_header = $field_name;
                if((substr($this->GetFieldRequiredType($field_name), 0, 1) == "r") && (!$force_simple)){
                    return ucfirst($fp_header)." <font color='#cd0000'>*</font> ";
                }else{
                    return $fp_header;
                }
            }                
        }else if($this->mode === 'details'){
            if(array_key_exists($field_name, $this->columnsEditMode) && ($fp_header != '')){
                return $fp_header;
            }
        }        
        return $field_name;
    }

    /**
     * Get field alignment
     */
    private function GetFieldAlign($ind, $row, $mode = 'view'){
        $field_name = $this->GetFieldName($ind);
        $field_align = $this->GetFieldProperty($field_name, 'align', $mode);
        if($mode == 'edit' && $field_align == ''){
            return 'left';
        }else if($field_align != ''){
            return $field_align;            
        }else{            
            if(isset($row[$ind]) && $this->IsText($field_name)){
                return ($this->direction == "ltr") ? 'left' : 'right';
            }else{
                return ($this->direction == "ltr") ? 'right' : 'left';
            }
        }
    }

    /**
     * Get header alignment
     */
    private function GetHeaderAlign($field_name, $mode = 'view'){
        $header_align = $this->GetFieldProperty($field_name, "header_align", $mode, 'normal', '');
        if($header_align == '' && $mode == 'view'){
            $header_align = $this->GetFieldProperty($field_name, 'align', $mode, 'normal', 'center');
        }
        if(!in_array(strtolower($header_align), array('left', 'center', 'right'))) $header_align = '';
        return $header_align;
    }

    /**
     * Draw control buttons (details and delete)
     *      @param $row_id
     *      @param $type
     *      @param $buttons
     */
    private function DrawControlButtons($row_id = '', $type = '', $buttons = 0){
        if($this->ModeAllowed('details', '', 'show_button')){
            if($type != "grouped") $this->ColOpen('center',0,'nowrap','','',"6%");
            if($type == "grouped" && $buttons > 0) echo "&nbsp;&nbsp;";
            $this->DrawModeButton('details', "javascript:".$this->uniquePrefix."_doPostBack(\"details\",\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"".$this->urlString."\");", $this->lang['details'], $this->lang['view_details'], "details.gif", "''", false, $this->nbsp, '');                        
            if($type != "grouped") $this->ColClose();            
            if($type == "grouped") $buttons++;
        }
        if($this->ModeAllowed('delete', '', 'show_button')){
            $href_string = '';
            $this->SetUrlString($href_string, '', 'sorting', '', '&');
            $href_string = str_replace('&', '&amp;', $href_string);
            $href_string .= '&amp;'.$this->uniquePrefix."page_size=".$this->reqPageSize;
            $href_string = $this->AddArrayParams($href_string);
            $href_string .= '&amp;'.$this->uniquePrefix."p=".$this->pageCurrent;
            
            if($type != "grouped") $this->ColOpen('center',0,'nowrap','','',"6%");
            if($type == "grouped" && $buttons > 0) echo "&nbsp;&nbsp;";
            $this->DrawModeButton('delete', "javascript:".$this->uniquePrefix."verifyDelete(\"".Helper::EncodeParameter($row_id, $this->safeMode)."\",\"".$href_string."\");", $this->lang['delete'], $this->lang['delete_record'], "delete.gif", "''", false, '', '');                        
            if($type != "grouped") $this->ColClose();
        }
    }

    /**
     * Draw mode button
     *      @param $mode
     *      @param $mode_url
     *      @param $botton_name
     *      @param $alt_name
     *      @param $image_file
     *      @param $on_click
     *      @param $div_align
     *      @param $nbsp
     *      @param $type
     *      @param $is_return
     *      @param $check_buttons
     */
    private function DrawModeButton($mode, $mode_url, $botton_name, $alt_name, $image_file, $on_click="''", $div_align=false, $nbsp='', $type='', $is_return=false, $check_buttons=true){
        $return_value = '';        
        if($check_buttons && !$this->ModeAllowed($mode, $this->mode, 'show_button')) return $return_value;
        if($type == ''){
            $mode_type = (isset($this->modes[$mode]['type'])) ? $this->modes[$mode]['type'] : '';
        }else{
            $mode_type = $type;
        }
        
        $accesskey = (!empty($this->accessKeys[$mode])) ? ' accesskey="'.$this->accessKeys[$mode].'"' : '';        
        if(!$this->isError){                
            if(!$this->isPrinting){
                switch($mode_type){
                    case "button":
                        $on_click = ($on_click != "''" && $on_click != '') ? $on_click : '"'.str_replace('"', "'", $mode_url).'"';
                        $return_value .= $nbsp."<input class='".$this->cssClass."_dg_button' type='button' ";
                        if($div_align){ $return_value .= "style='float: "; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= "' "; }                    
                        $return_value .= "onclick=$on_click value='".$botton_name."'>".$nbsp;
                        break;
                    case 'image':                        
                        $on_click = ($on_click != "''" && $on_click != '') ? $on_click : '"'.str_replace('"', "'", $mode_url).'"';
                        if($div_align){ $return_value .= "<div style='float:"; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= ";'>"; }
                        $return_value .= $nbsp."<img style='cursor:pointer; vertical-align: middle;' onclick=".$on_click." src='".$this->directory."styles/".$this->cssClass."/images/".$image_file."' alt='$alt_name' title='$alt_name' />".$nbsp;
                        if($div_align) $return_value .= '</div>'; 
                        break;                        
                    default:
                        if($div_align){ $return_value .= "<div style='float:"; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= ";'>"; }
                        $return_value .= $nbsp."<a class='".$this->cssClass."_dg_a".(($mode == 'add') ? "_header" : '')."' href='$mode_url'".(($on_click != "''") ? " onclick=".$on_click : '').$accesskey." title='".$alt_name."'>".$botton_name."</a>".$nbsp;
                        if($div_align) $return_value .= '</div>'; 
                        break;
                }
            }else{
                switch($mode_type){                    
                    case "button":
                        $return_value .= '<span ';
                        if($div_align){ $return_value .= "style='float: "; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= "' "; }                                        
                        $return_value .= '>'.$botton_name.'</span>';
                        break;
                    case 'image':
                        if($div_align){ $return_value .= "<div style='float:"; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= ";'>"; }
                        $return_value .= "<img style='vertical-align: middle;' src='".$this->directory."styles/".$this->cssClass."/images/".$image_file."' readonly>";
                        if($div_align) $return_value .= '</div>';     
                        break;                        
                    default:
                        if($div_align){ $return_value .= "<div style='float:"; $return_value .= ($this->direction == 'rtl')?'right':'left'; $return_value .= ";'>"; }
                        $return_value .= $nbsp."<span class='".$this->cssClass."_dg_a'>".$botton_name.'</span>'.$nbsp;
                        if($div_align) $return_value .= '</div>'; 
                        break;
                }
            }
        }
        if($is_return == true){
            return $return_value;
        }else{
            echo $return_value;    
        }        
    }

    /**
     * Set common JavaScriptAjax
     */
    private function SetCommonJavaScriptAjax(){        
        if($this->methodPostBack == 'ajax'){
            $is_test = false;
            echo $this->ScriptOpen("\n", "src='".$this->include_path."scripts/dg_ajax.js'").$this->ScriptClose('');
        }
        echo $this->ScriptOpen();
            if($this->scrollingOption && $this->mode == 'view'){ $run_scrolling = true; $scrolling_height = $this->scrollingHeight; }
            else{ $run_scrolling = false; $scrolling_height = $this->scrollingHeight; }

            echo "function ".$this->uniquePrefix."_doAjaxRequest(query_string, h_part){
                var http_url = '".$this->HTTP_URL."';
                dg_doAjaxRequest(query_string+h_part, '".$this->uniquePrefix."', http_url, ".(($this->debug) ? 'true': 'false').", '".$run_scrolling."', '".$scrolling_height."'); \n
            }\n";              
            foreach($this->jsCode as $key => $val){
                echo $val."\n";                 
            }
            echo "function ".$this->uniquePrefix."_doOpenFloatingCalendar(textbox_id, if_format, show_time){
                Calendar.setup({firstDay : ".$this->weekStartingDay.", inputField : textbox_id, ifFormat : if_format, showsTime : show_time, button : 'img_'+textbox_id}); \n}\n";
            
            if($this->scrollingOption && $this->mode == 'view'){
                if($this->browserName == "MSIE"){
                    echo "makeScrollableTable('".$this->uniquePrefix."_contentTable',false,'".$this->scrollingHeight."');\n";
                }else if($this->browserName != "Firefox"){ // other
                    echo "var t = new ScrollableTable(document.getElementById('".$this->uniquePrefix."_contentTable'),'".$this->scrollingHeight."');\n";
                }
            }
        echo $this->ScriptClose();
    }
    
    /**
     * Set common JavaScript
     */
    private function SetCommonJavaScript(){
        $req_mode = $this->GetVariable('mode');
        $req_new = $this->GetVariable('new');
        $magnify_field_lightbox = false;
        $magnify_field_magnifier = false;
        $color_picker = false;
        
        // change mode after update
        if(($req_mode == 'update') && ($req_new != 1) && ($this->modeAfterUpdate == 'edit')){
            $req_mode = $this->modeAfterUpdate;
        }        

        echo "\n<!-- START This script was generated by datagrid.class.php v".self::$dgVersion." (http://www.apphp.com/php-datagrid/index.php) START -->";
        $this->CheckExistingFields();

        // set common JavaScript
        if($this->debug && !$this->IsFileExists($this->directory.'scripts/dg.js')){            
            echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."scripts/dg.js</b>. Check if this file exists and you use a correct path!</label><br /><b>";
        }else{
            if(!defined("_DG_JS_INCLUDED")){
                echo $this->ScriptOpen("\n", "src='".$this->include_path."scripts/dg.js'").$this->ScriptClose('');
                echo $this->ScriptOpen('', "src='".$this->include_path."languages/js/dg-".$this->langName.".js'").$this->ScriptClose('');
                define("_DG_JS_INCLUDED", true);
            }
        }        

        if($req_mode == 'add' || $req_mode == 'edit' || $req_mode == 'details'){
            // ADD/ EDIT / DETAILS MODE            
            if(($this->existingFields['magnify_field_edit']) && ($this->existingFields['magnify_field_edit_lightbox'])) $magnify_field_lightbox = true;
            if(($this->existingFields['magnify_field_edit']) && ($this->existingFields['magnify_field_edit_magnifier'])) $magnify_field_magnifier = true;
            if($this->existingFields['color_picker_field']) $color_picker = true;
        }else{
            // VIEW MODE            
            if($this->filteringAllowed && !defined("_DG_JQUERY_INCLUDED")){
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/jquery/jquery.js'").$this->ScriptClose('');
                define("_DG_JQUERY_INCLUDED", true);
            }            

            if(($this->existingFields['magnify_field_view']) && ($this->existingFields['magnify_field_view_lightbox'])) $magnify_field_lightbox = true;
            if(($this->existingFields['magnify_field_view']) && ($this->existingFields['magnify_field_view_magnifier'])) $magnify_field_magnifier = true;

            // include autosuggest.js file and other for AutoSuggestion
            if($this->existingFields['autosuggestion_field'] && !defined("_DG_AUTOSUGGESTION_INCLUDED")){
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/autosuggest/js/bsn.AutoSuggest_2.1.3.js'").$this->ScriptClose('');
                echo "\n<link rel='stylesheet' href='".$this->include_path."modules/autosuggest/css/autosuggest_inquisitor.css' type='text/css' media='screen' charset='utf-8' />";
                define("_DG_AUTOSUGGESTION_INCLUDED", true);
            }            
            if($this->scrollingOption && !defined("_DG_SCROLLING_INCLUDED")){
                // include scrolling files
                $scroll_file = '';
                if($this->browserName == 'MSIE'){
                    $scroll_file = "scroll_ie.js";
                }else if($this->browserName == 'Firefox'){
                    $scroll_file = "scroll_ff.css";        
                }else{
                    $scroll_file = 'scroll_other.js';        
                }
                if($this->browserName == "Firefox"){
                    echo "\n<link rel='stylesheet' href='".$this->include_path."modules/scrolling/".$scroll_file."' type='text/css' media='screen' charset='utf-8' />\n";                            
                }else{
                    if($this->debug && !$this->IsFileExists($this->directory.'modules/scrolling/'.$scroll_file)){            
                        echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->directory."modules/scrolling/".$scroll_file."</b>. Check if this file exists and you use a correct path!</label><br /><br />";
                    }else{                 
                        echo $this->ScriptOpen('', "src='".$this->include_path."modules/scrolling/".$scroll_file."'").$this->ScriptClose('');
                    }
                    define("_DG_SCROLLING_INCLUDED", true);
                }
            }
        }        
        // include highlight.js file for rows highlighting
        if($this->isRowHighlightingAllowed && !defined("_DG_HIGHLIGHT_INCLUDED")){
            if($this->debug && !$this->IsFileExists($this->directory.'scripts/highlight.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."scripts/highlight.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{                 
                echo $this->ScriptOpen('', "src='".$this->include_path."scripts/highlight.js'").$this->ScriptClose('');
            }
            define("_DG_HIGHLIGHT_INCLUDED", true);
        }
        // include overlib.js file for floating tooltips
        if($this->existingFields['tooltip_type_floating'] && !defined("_DG_OVERLIB_INCLUDED")){
            if($this->debug && !$this->IsFileExists($this->directory.'modules/overlib/overlib.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."modules/overlib/overlib.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/overlib/overlib.js'").$this->ScriptClose('');
            }
            define("_DG_OVERLIB_INCLUDED", true);
        }
        // include magnify files for magnifying images
        if($magnify_field_magnifier && !defined("_DG_MAGNIFIER_INCLUDED")){
            if($this->debug && !$this->IsFileExists($this->directory.'scripts/magnify.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."scripts/magnify.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{
                echo $this->ScriptOpen('', "src='".$this->include_path."scripts/magnify.js'").$this->ScriptClose('');
                echo "\n<STYLE>#trailimageid { DISPLAY: none; FONT-SIZE: 0.75em; Z-INDEX: 200; LEFT: 0px; POSITION: absolute; TOP: 0px; HEIGHT: 0px }</STYLE>";
            }
            define("_DG_MAGNIFIER_INCLUDED", true);            
        }                    
        // include lightbox scripts
        if($magnify_field_lightbox && !defined("_DG_LIGHTBOX_INCLUDED")){
            if($this->debug && !$this->IsFileExists($this->directory.'modules/lytebox/js/lytebox.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."modules/lytebox/js/lytebox.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{
                echo $this->ScriptOpen("\n", "src='".$this->include_path."modules/lytebox/js/lytebox.js'").$this->ScriptClose('');
                echo "\n<link rel='stylesheet' href='".$this->include_path."modules/lytebox/css/lytebox.css' type='text/css' media='screen' charset='utf-8' />";        
            }
            define("_DG_LIGHTBOX_INCLUDED", true);            
        }            
        // include color picker script
        if($color_picker && !defined("_DG_COLOR_PICKER_INCLUDED")){
            if($this->debug && !$this->IsFileExists($this->directory.'modules/jscolor/jscolor.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."modules/jscolor/jscolor.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{
                echo $this->ScriptOpen("\n", "src='".$this->include_path."modules/jscolor/jscolor.js'").$this->ScriptClose('');
            }
            define("_DG_COLOR_PICKER_INCLUDED", true);            
        }            
        // include calendar script (floating), if needed        
        if($this->existingFields['calendar_type_floating'] && !defined("_DG_FLOATING_CAL_INCLUDED")) {
            // set calendar JS                
            echo "<style type='text/css'>@import url(".$this->include_path."modules/jscalendar/skins/aqua/theme.css);</style>\n"; 
            //<!-- import the calendar script -->
            echo $this->ScriptOpen('', "src='".$this->include_path."modules/jscalendar/calendar.js'").$this->ScriptClose('');
            //<!-- import the language module -->
            echo $this->ScriptOpen('', "src='".$this->include_path."modules/jscalendar/lang/calendar-".Helper::GetLangAbbrForCalendar($this->langName).".js'").$this->ScriptClose('');
            //<!-- the following script defines the Calendar.setup helper function, which makes adding a calendar a matter of 1 or 2 lines of code. -->
            echo $this->ScriptOpen('', "src='".$this->include_path."modules/jscalendar/calendar-setup.js'").$this->ScriptClose('');
            define("_DG_FLOATING_CAL_INCLUDED", true);            
        }
    }

    /**
     * Set common JavaScript end part
     */
    private function SetCommonJavaScriptEnd(){
        $req_mode = $this->GetVariable('mode');
        $req_new  = $this->GetVariable('new');
        $req_rid  = $this->GetVariable('rid');
        
        // change mode after update
        if(($req_mode == 'update') && ($req_new != 1) && ($this->modeAfterUpdate == 'edit')){
            $req_mode = $this->modeAfterUpdate;
        }        

        // [#0032-4] fix for unique fields check
        if(($req_mode == 'update') && ($req_rid == '-1') && $this->isWarning){
            $req_mode = 'add';
        }        

        if(($req_mode == 'add') || ($req_mode == 'edit')){
            // include form checking script, if needed
            if($this->debug && !$this->IsFileExists($this->directory.'modules/jsafv/form.scripts.js')){            
                echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."modules/jsafv/form.scripts.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
            }else{
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/jsafv/lang/jsafv-".Helper::GetLangAbbrForJSAFV($this->langName).".js'").$this->ScriptClose('');
                if($this->encoding == "utf8"){
                    echo $this->ScriptOpen('', "src='".$this->include_path."modules/jsafv/chars/diactric_chars_utf8.js'").$this->ScriptClose('');
                }else{
                    echo $this->ScriptOpen('', "src='".$this->include_path."modules/jsafv/chars/diactric_chars.js'").$this->ScriptClose('');
                }
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/jsafv/form.scripts.js'").$this->ScriptClose('');
            }
            // include resizable textarea script, if needed        
            if($this->existingFields['resizable_field'] && !defined("_DG_RESIZE_INCLUDED")){
                if($this->debug && !$this->IsFileExists($this->directory.'scripts/resize.js')){            
                    echo "<label class='".$this->cssClass."_dg_error_message no_print'>Cannot find file: <b>".$this->include_path."scripts/resize.js</b>. Check if this file exists and you use a correct path!</label><br /><br />";
                }else{
                    echo $this->ScriptOpen('', "src='".$this->include_path."modules/jquery/jquery.js'").$this->ScriptClose('');
                    echo $this->ScriptOpen('', "src='".$this->include_path."scripts/resize.js'").$this->ScriptClose('');
                }
                define('_DG_RESIZE_INCLUDED', true);
            }            
            // include WYSIWYG script, if needed
            if($this->existingFields['wysiwyg_field']) {            
                // set WYSIWYG
                echo $this->ScriptOpen("\n");
                echo "imagesDir = '".$this->directory."modules/wysiwyg/icons/';\n";  // Images Directory
                echo "cssDir = '".$this->directory."modules/wysiwyg/styles/';\n";    // CSS Directory
                echo "popupsDir = '".$this->directory."modules/wysiwyg/popups/';\n"; // Popups Directory
                echo "addonsDir = '".$this->directory."modules/wysiwyg/addons/';\n"; // AdOne Directory
                echo $this->ScriptClose();
                echo $this->ScriptOpen('', "src='".$this->include_path."modules/wysiwyg/wysiwyg.js'").$this->ScriptClose('');
                if($this->isDemo){
                    if(isset($_SESSION)) $_SESSION['wysiwyg_image_uploading'] = false;
                }else{
                    if(isset($_SESSION)) $_SESSION['wysiwyg_image_uploading'] = true;
                }
            }
            echo $this->ScriptOpen("\n");
            if($this->documentEnterKeyAllowed){
                echo "document.onkeyup = function(){ var key_id = (window.event) ? event.keyCode : e.keyCode; if(key_id == 13) ".$this->uniquePrefix."sendEditFields(); };\n";                
            }
            // set verify JS functions
            $cancel_mode = ($req_mode == 'add' || $req_mode = 'edit') ? 'edit' : 'view';
            if($this->ModeAllowed('edit', $cancel_mode) || $this->ModeAllowed('cancel', $cancel_mode)){
                echo "function ".$this->uniquePrefix."verifyCancel(rid, param){if(confirm(\"".$this->lang['cancel_creating_new_record']."\")){ ".$this->uniquePrefix."_doPostBack(\"cancel\",rid,param); } else { false;}};";
            }
            echo $this->ScriptClose();
        }
        // set verify JS functions  
        if($this->ModeAllowed('delete')){
            echo $this->ScriptOpen();
            echo "function ".$this->uniquePrefix."verifyDelete(rid,prm,e){if(!e) e = window.event; if(confirm(\"".$this->lang['delete_this_record']."\")){".$this->uniquePrefix."_doPostBack(\"delete\",rid,prm);}else{_dgStopPropagation(e);false;}};";            
            echo $this->ScriptClose();
        }
        if($this->isAnchorAllowed){
            echo $this->ScriptOpen();
            echo '_dgSkipToAnchor(\''.$this->uniquePrefix.'\');';
            echo $this->ScriptClose();
        }
    }
  
    /**
     * Set edit fields form script
     *      @param $url
     */
    private function SetEditFieldsFormScript($url = ''){
        echo $this->ScriptOpen();       
        echo "function ".$this->uniquePrefix."updateWysiwygFields(){ ";
            if($this->browserName == "Firefox"){
                echo " result_value = _dgUpdateWysiwygFieldsFF('".$this->uniquePrefix."', false);";
            }else{ // "MSIE" or other
                echo " result_value = _dgUpdateWysiwygFieldsIE('".$this->uniquePrefix."', false);";
            };
        echo "}\n";        
        echo "function ".$this->uniquePrefix."sendEditFields(){ _dgJsSendEditFields('".$this->uniquePrefix."', '".$this->browserName."', '".$this->jsValidationErrors."', '".$this->uploadType."') }";
        echo $this->ScriptClose();
    }  
    
    /**
     * Return date format
     *      @param $field_value
     *      @param $type
     *      @param $show_seconds
     */
    private function MyDate($field_value, $type = "datedmy", $show_seconds = true){
        $ret_date = '';
        if(strtolower($show_seconds) == 'true' or $show_seconds === true) $show_seconds = true;
        if($type == "datedmy"){ 
            if(substr(trim($field_value), 4, 1) == "-"){ 
                $year1 = substr(trim($field_value), 0, 4); 
                $month1 = substr(trim($field_value), 5, 2); 
                $day1 = substr(trim($field_value), 8, 2);                 
            }else{         
                $year1 = substr(trim($field_value), 6, 4); 
                $month1 = substr(trim($field_value), 3, 2); 
                $day1 = substr(trim($field_value), 0, 2); 
            }
            if($day1 != '') $ret_date = $day1."-".$month1."-".$year1;
        }else if($type == "datemdy"){
            if(substr(trim($field_value), 4, 1) == "-"){ 
                $year1 = substr(trim($field_value), 0, 4); 
                $month1 = substr(trim($field_value), 5, 2); 
                $day1 = substr(trim($field_value), 8, 2);
            }else{
                $year1 = substr(trim($field_value), 6, 4);
                $month1 = substr(trim($field_value), 0, 2); 
                $day1 = substr(trim($field_value), 3, 2);                 
            }
            if($month1 != '' && $day1 != '' && $year1 != '') $ret_date = $month1."-".$day1."-".$year1;
        }else if($type == "datetimedmy"){
            if(substr(trim($field_value), 4, 1) == "-"){        
                $year1 = substr(trim($field_value), 0, 4); 
                $month1 = substr(trim($field_value), 5, 2); 
                $day1 = substr(trim($field_value), 8, 2); 
                $time1 = substr(trim($field_value), 11, 2); 
                $time2 = substr(trim($field_value), 14, 2); 
                $time3 = substr(trim($field_value), 17, 2);
                if($time3 == '') $time3 = '00';                
            }else{         
                $year1 = substr(trim($field_value), 6, 4); 
                $month1 = substr(trim($field_value), 3, 2); 
                $day1 = substr(trim($field_value), 0, 2); 
                $time1 = substr(trim($field_value), 11, 2); 
                $time2 = substr(trim($field_value), 14, 2); 
                $time3 = substr(trim($field_value), 17, 2);
                if($time3 == '') $time3 = "00";
            } 
            if($day1 != '') $ret_date = $day1."-".$month1."-".$year1." ".$time1.":".$time2.(($show_seconds)?':'.$time3:''); 
        }else{
            if($show_seconds){
                $ret_date = $field_value;                 
            }else{
                if(strlen($field_value) > 16){
                    $ret_date = substr($field_value, 0, strlen($field_value)-3);
                }else{
                    $ret_date = $field_value;                    
                }
            }
        }
        if($this->dtSeparator != '') $ret_date = str_replace('-', $this->dtSeparator, $ret_date); 
        return $ret_date; 
    }

    /**
     * Get formatted microtime
     */
    private function GetFormattedMicrotime(){
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }    

    /**
     * Check existing types of fields
     */
    private function CheckExistingFields(){        
        $tooltip_allowed = false;
        // view mode filter fields
        if(isset($this->columnsViewMode)){
            foreach($this->columnsViewMode as $fldName => $fldValue){
                foreach($fldValue as $key => $val){
                    if(($key == 'tooltip') && (($val == true) || ($val == 'true'))){ $tooltip_allowed = true; }
                    if($tooltip_allowed && ($key == "tooltip_type") && (strtolower($val) == 'floating')) { $this->existingFields['tooltip_type_floating'] = true; }
                    if(($key == "header_tooltip_type") && (strtolower($val) == 'floating')) { $this->existingFields['tooltip_type_floating'] = true; }
                    if(($key == "magnify") && (($val == true) || ($val == 'true'))){ $this->existingFields['magnify_field_view'] = true; }
                    if(($key == 'magnify_type') && ($val == 'magnifier')) { $this->existingFields['magnify_field_view_magnifier'] = true; }
                    if(($key == 'magnify_type') && ($val == 'lightbox')) { $this->existingFields['magnify_field_view_lightbox'] = true; }
                }
            }
        }
        // add/edit/details mode filter fields
        if(is_array($this->columnsEditMode)){        
            foreach($this->columnsEditMode as $fldName => $fldValue){
                $found_field_type = false;        
                foreach($fldValue as $key => $val){
                    if(($key == 'resizable') && (($val == true) || ($val == 'true'))) $this->existingFields['resizable_field'] = true;
                    if(($key == 'edit_type') && (strtolower($val) == 'wysiwyg')) $this->existingFields['wysiwyg_field'] = true;                    
                    if($key == 'type'){
                        if(($val == 'date') || ($val == "datedmy") || ($val == "datemdy") || ($val == "datetime") || ($val == "datetimedmy") || ($val == "datetimemdy") || ($val == 'time')){
                            $found_field_type = true;
                        }
                    }
                    if($key == "calendar_type"){
                        if($found_field_type && (strtolower($val) == 'floating')) $this->existingFields['calendar_type_floating'] = true;
                        if($found_field_type && (strtolower($val) == "popup")) $this->existingFields['calendar_type_popup'] = true;
                    }                    
                    if(($key == 'tooltip') && (($val == true) || ($val == 'true'))) $tooltip_allowed = true;
                    if($tooltip_allowed && ($key == "tooltip_type") && (strtolower($val) == 'floating')) $this->existingFields['tooltip_type_floating'] = true;
                    if(($key == "header_tooltip_type") && (strtolower($val) == 'floating')) $this->existingFields['tooltip_type_floating'] = true;
                    if(($key == 'magnify') && (($val == true) || ($val == 'true'))) $this->existingFields['magnify_field_edit'] = true;
                    if(($key == 'magnify_type') && ($val == 'magnifier')) $this->existingFields['magnify_field_edit_magnifier'] = true;
                    if(($key == 'magnify_type') && ($val == "lightbox")) $this->existingFields['magnify_field_edit_lightbox'] = true;
                    if(($key == 'view_type') && ($val == "picker")) $this->existingFields['color_picker_field'] = true;
                }
            }
        }
        // filter fields
        if(is_array($this->arrFilterFields)){
            foreach($this->arrFilterFields as $fldName => $fldValue){
                foreach($fldValue as $key => $val){
                    if(($key == 'autocomplete') && (($val == true) || ($val == 'true'))) $this->existingFields['autosuggestion_field'] = true;;
                    if($key == "calendar_type"){
                        if(strtolower($val) == 'floating'){ $this->existingFields['calendar_type_floating'] = true; }
                    }                    
                }
            }            
        }
    }

    /**
     * Get http port 
     */
    private function GetPort(){        
        $port = '';
        if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != "80"){
            if(strpos($_SERVER['HTTP_HOST'], ":")) $port = ":".$_SERVER['SERVER_PORT'];
        }
        return $port;        
    }    

    /**
     * Get protocol (http/s)
     */
    private function GetProtocol(){        
        $protocol = "http://";
        $https = isset($_SERVER['HTTPS']) ? strtolower($_SERVER['HTTPS']) : '';
        $server_protocol = isset($_SERVER['SERVER_PROTOCOL']) ? strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, 5)) : '';
        if(($https != '' && $https != 'off') || $server_protocol == "https") $protocol = "https://";
        return $protocol;        
    }

    /**
     * Get server name
     */
    private function GetServerName(){
        $server = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';
        $colon = strpos($server,':');
        if($colon > 0 && $colon < strlen($server)) $server = substr($server, 0, $colon);
        return $server;
    }

    /**
     * Return last substring occurence
     *      @param $string
     *      @param $substring
     *      @param $reverse
     */
    private function SubStrOccurence($string, $substring, $reverse = false){
        $string = str_replace(array("\t", "\n"), ' ', $string);
        if($reverse == true){
            $string = strrev($string);
            $substring = strrev($substring);
        }
        return strpos(strtolower($string), strtolower($substring));
    }

    /**
     * Check chache files
     */
	private function CheckCacheFiles(){		
		$files_count = 0;
		$oldest_file_name = '';
		$oldest_file_time = @date('Y-m-d H:i:s');
		if($hdl = @opendir($this->cacheDir)){
			while(false !== ($obj = @readdir($hdl))){
				if($obj == '.' || $obj == '..' || $obj == '.htaccess') continue; 
				$file_time = @date('Y-m-d H:i:s', filectime($this->cacheDir.$obj));
				if($file_time < $oldest_file_time){
					$oldest_file_time = $file_time;
					$oldest_file_name = $this->cacheDir.$obj;
				}				
				$files_count++;
			}
		}		
		if($files_count > $this->maxCacheFiles){
			@unlink($oldest_file_name);		
		}
	}

    /**
     * Start Caching of page
     *      @param $cachefile 
     */
	private function StartCaching($cachefile){
        if($cachefile != '' && $this->IsFileExists($cachefile)) {        
            $cachetime = (int)$this->cacheLifetime * 60; /* cache lifetime in minutes */
            // Serve from the cache if it is younger than $cachetime
            if($this->IsFileExists($cachefile) && (@filesize($cachefile) > 0) && ((time() - $cachetime) < filemtime($cachefile))){
                // the page has been cached from an earlier request output the contents of the cache file
                include_once($cachefile); 
                echo "<!-- Generated from cache at ".@date('H:i', filemtime($cachefile))." -->\n";
                return true;
            }        
        }
        // start the output buffer
        ob_start();
	}
	
    /**
     * Finish Caching of page
     * 	    @param $cachefile 
     */
	private function FinishCaching($cachefile){
		if($cachefile != ''){
			$fp = fopen($cachefile, 'w'); 
			fwrite($fp, ob_get_contents());
			fclose($fp); 
			// Send the output to the browser
			ob_end_flush();
			// check if we exeeded max number of cache files
			$this->CheckCacheFiles();
		}
	}

    /**
     * Prepare links for all modes
     */
    private function PrepareLinks(){
        if($this->methodPostBack == 'ajax'){
            $this->SetUrlString($this->urlString, '', 'sorting', 'paging');
            $this->urlString = $this->AddArrayParams($this->urlString);            
        }
    }
    
    /**
     * Prepare field holders for on_js_event
     *      @param &$output
     *      @param &$output_2
     *      @param $field_name
     *      @param $row
     *      @param $mode
     */
    private function PrepareOnJSEventFields(&$output, &$output_2 = '', $field_name, $row, $mode = 'view'){
        if($output != ''){            
            if($mode === 'edit' || $mode === 'details'){
                $columnsArray = &$this->columnsEditMode;
                $offset = ($mode === 'edit') ? 1 : 0;
            }else{
                $columnsArray = &$this->columnsViewMode;
                $offset = 0;
            }
            foreach($columnsArray[$field_name] as $search_field_key => $search_field_value){
                if(substr($search_field_key, 0, 9) == 'field_key'){
                    $field_number = intval(substr($search_field_key, 10, strlen($search_field_key) - 10));
                    // [#0051 under check - 01.02.12]
                    $field_inner = ($this->GetFieldOffset($search_field_value) != '-1') ? $row[$this->GetFieldOffset($search_field_value)-$offset] : '';
                    if(strpos($output, "{".$field_number."}") >= 0){
                        $output = str_replace("{".$field_number."}", $field_inner, $output);
                    }
                    if(strpos($output_2, "{".$field_number."}") >= 0){
                        $output_2 = str_replace("{".$field_number."}", $field_inner, $output_2);
                    }
                }                                
            }
        }
    }

    /**
     * Set filtering state
     *      @param $type
     *      @param &$hide_display
     *      @param &$unhide_display
     */
	private function SetFilteringState($type = '', &$hide_display = '', &$unhide_display = ''){
        $hide_search = isset($_COOKIE[$this->uniquePrefix.'hide_search']) ? $_COOKIE[$this->uniquePrefix.'hide_search'] : '';
		if($this->initFilteringState == 'closed' && $this->onSubmitFilter == ''){
			if(!empty($type)) { $hide_display = "display:none;"; $unhide_display = ''; }
			$this->hideDisplay = "display:none;";                                         
		}else if($hide_search == 1){    
            if(!empty($type)) { $hide_display = "display:none;"; $unhide_display = ''; }
            $this->hideDisplay = "display:none;"; 
        }else{
            if(!empty($type)) { $hide_display = ''; $unhide_display = "display:none;"; }
            $this->hideDisplay = '';
        }
	}    

    /**
     * Get database driver type
     */
    private function dgGetDbDriverType(){
        if($this->dbType == 'PDO'){
            $phptype = $this->dbHandler->getAttribute(PDO::ATTR_DRIVER_NAME);        
        }else{
            $phptype = $this->dbHandler->phptype;
        }
        return $phptype;
    }

    /**
     * Get affected rows
     */
    private function dgGetAffectedRows(){
        if($this->dbType == 'PDO'){
            $affectedRows = $this->dbHandler->lastInsertId();
        }else{
            $affectedRows = $this->dbHandler->affectedRows();    
        }            
        return $affectedRows;
    }

    /**
     * Fetch Row
     *      @param $dSet
     */
    private function dgFetchRow(&$dSet = null){
        $row = '';
        if(empty($dSet)){
            return $row;
        }else if($this->dbType == 'PDO'){
            if($this->dgGetDbDriverType() == 'ibm'){
                $row = $dSet->fetch();
            }else{
                if($dSet->rowCount() > 0) $row = $dSet->fetch();    
            }
        }else if(!$this->CheckIsError($dSet)){
            if($this->dgGetDbDriverType() == "odbc"){
                $row = $dSet->fetchRow();
            }else{
                if($dSet->numRows() > 0) $row = $dSet->fetchRow();    
            }
        }
        return $row;
    }
    
	/**
	 *	Upload image/file
	 *	    @param $rid
	 */	
	private function UploadFileImage($rid = '')
	{
		$arrUploadedFiles = array();
        if($this->uploadType == 'by_one') return $arrUploadedFiles;
        $rid_postfix = !empty($rid) ? '_'.$rid : '';
        
		foreach($this->columnsEditMode as $key => $val){
            if(isset($val['type']) && ($val['type'] == 'image' || $val['type'] == 'file')){                
                $full_field_name = $this->GetFieldRequiredType($key).$key.$rid_postfix;
                $fp_target_path  = $this->GetFieldProperty($key, 'target_path');
                $fp_file_name    = $this->GetFieldProperty($key, 'file_name');
                $fp_host         = $this->GetFieldProperty($key, 'host');
                $fp_save_as      = $this->GetFieldProperty($key, 'save_as');
              
                if($fp_host == "remote"){
                    $file_name = $this->GetVariable($full_field_name, false);                       
                    if(!empty($file_name)){
                        if($downloaded_file = fopen($file_name, "r")){
                            $content = $this->HttpGetFile($file_name);
                            $file_name_view = basename($file_name);
                            $target_path_full = $fp_target_path.$file_name_view;
    
                            if($uploaded_file = fopen($target_path_full, 'w')){                            
                                if(fwrite($uploaded_file, $content)){
                                    $arrUploadedFiles[$key] = $file_name_view;
                                }
                                fclose($uploaded_file);
                            }                        
                        }                    
                    }
                }else{
                    $tmp_name = isset($_FILES[$full_field_name]['tmp_name']) ? $_FILES[$full_field_name]['tmp_name'] : '';
                    $upload_name = isset($_FILES[$full_field_name]['name']) ? $_FILES[$full_field_name]['name'] : '';
                    if(!empty($upload_name)){
                        if($fp_save_as == "blob"){
                            if($tmp_name != ''){
                                if($fp = fopen($tmp_name, 'r')){
                                    $field_value = fread($fp, filesize($tmp_name));
                                    $field_value = addslashes($field_value);
                                    fclose($fp);
                                    $arrUploadedFiles[$key] = $field_value;
                                }                                
                            }
                        }else{                        
                            $file_extension = strtolower(strchr(basename($upload_name),"."));                    
                            if($fp_file_name != ''){
                                $target_path_full = $fp_target_path.$fp_file_name.$file_extension;
                                $file_name_view = $fp_file_name.$file_extension;
                            }else{
                                $target_path_full = $fp_target_path.(isset($upload_name) ? basename($upload_name) : '') ;
                                $file_name_view = $upload_name;                                                            
                            }
                            if(move_uploaded_file($tmp_name, $target_path_full)){
                                $arrUploadedFiles[$key] = $file_name_view;
                            }
                        }
                    }                    
                }
            }
		}			
		
		return $arrUploadedFiles;
	}
    
	/**
	 *	Handle error
	 *	        @param $dset
	 */	
	private function CheckIsError(&$dSet = null){
        if(empty($dSet)) $dSet = $this->dataSet;
        if($this->dbType == 'PEAR'){
            if($this->dbHandler->isError($dSet) == 1){
                return true;
            }            
        }
        return false;        
    }    

    /**
     * Get field type info
     *      @param $field_type
     */
    private function GetFieldTypeInfo($field_type){
        $output = array('type'=>'textbox', 'symbol'=>'t');
        $field_type = preg_replace('/[\(0-9\),]/', '', $field_type);
        switch(strtolower($field_type)){
            case 'int':       // int: TINYINT, SMALLINT, MEDIUMINT, INT, INTEGER, BIGINT, TINY, SHORT, LONG, LONGLONG, INT24
            case 'long':
            case 'short':      
                $output['symbol'] = 'i'; break;            
            case 'decimal':      // real: DECIMAL
                $output['symbol'] = 'n'; break;
            case 'real':      // real: FLOAT, DOUBLE, DECIMAL, NUMERIC
                $output['symbol'] = 'f'; break;            
            case 'null':      // empty: NULL            
                $output['symbol'] = 't'; break;
            case 'string':    // string: CHAR, VARCHAR, TINYTEXT, TEXT, MEDIUMTEXT, LONGTEXT, ENUM, SET, VAR_STRING
            case 'varchar':   // string: VARCHAR
            case 'timestamp': // date: TIMESTAMP
            case 'year':      // date: YEAR
                $output['symbol'] = 't'; break;                        
            case 'blob':      // blob: TINYBLOB, MEDIUMBLOB, LONGBLOB, BLOB, TEXT
            case 'mediumblob':      
                $output['type'] = 'file';
                $output['symbol'] = 't'; break;
            case 'time':      // date: TIME
                $output['type'] = 'time';
                $output['symbol'] = 't'; break;                        
            case 'date':      // date: DATE
                $output['type'] = 'date';
                $output['symbol'] = 't'; break;
            case 'datetime':  // date: DATETIME
                $output['type'] = "datetime";
                $output['symbol'] = 't'; break;
            default:
                $output['symbol'] = 't'; break;
        }            
        return $output;
    }
  
	/**
	 * Show columns from current database
	 *      @param $table
	 *      @param $field
	 */
    private function ShowColumns($table, $field = ''){
		switch($this->dbDriver){
			case 'ibm':
                $sql = "SELECT COLUMN_NAME FROM qsys2.syscolumns WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA = 'ZENDSVR'";
				break;
			case 'mysql':
			default:
				$sql = "SHOW COLUMNS FROM ".$table.(($field != '') ? " LIKE '".$field."'" : '');
				break;
		}
		return $sql;   
    }
    
	/**
	 * Prepare text length
	 *      @param &$field_value
	 *      @param &$title
	 *      @param $fp_text_length
	 *      @param $fp_tooltip
	 *      @param $fp_tooltip_type
	 */
    private function PrepareTextLength(&$field_value, &$title, $fp_text_length = '', $fp_tooltip = false, $fp_tooltip_type = ''){
        if(($fp_text_length != '-1') && ($fp_text_length != '') && ($field_value != '')){
            if((strlen($field_value)) > $fp_text_length){
                // double quotation mark, single quotation mark, chr(13) CR sign, chr(10) LF sign  
                $field_value = str_replace(array('"',"'",chr(13),chr(10)), array("&quot;","&#039;",''," "), $field_value);
                if(!$this->isPrinting){
                    if(($fp_tooltip == true) || ($fp_tooltip == 'true')){
                        if($fp_tooltip_type == 'floating'){
                            $field_value_slashed = str_replace("&#039;", "\'", $field_value);
                            $title = " onmouseover=\"return overlib('".$field_value_slashed."');\" onmouseout='return nd();' style='cursor: help;'";
                        }else{
                            $title = " title='".$field_value."' style='cursor:help;'";
                        }
                    }                        
                }
                $field_value = Helper::SubString($field_value, $fp_text_length, $this->langName, true);
            }
        }
    }
    
    /**
     * Set backquotes
     *      @param $str
     */
    private function SetBackQuotes($str = ''){
        return ($this->addBackQuotes) ? '`'.$str.'`' : $str;        
    }
    
}// end of class
?>