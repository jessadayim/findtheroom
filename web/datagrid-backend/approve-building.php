<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Approve Building</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name='keywords'
          content='php grid, php datagrid, php data grid, datagrid sample, datagrid php,
          datagrid, grid php, datagrid in php, data grid in php, free php grid, free php datagrid, pear
          datagrid, datagrid paging'/>
    <meta name='description'
          content='Advanced Power of PHP - using ApPHP DataGrid Pro for displaying some statistical data'/>
    <!--    <meta content='Advanced Power of PHP' name='author'></meta>-->
    <meta content='Advanced Power of PHP' name='author'>
</head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    function updateBuilding(id, publish) {
        $.ajax({
            type:"POST",
            url:location.href,
            data:{
                buildingID:id,
                publish:publish,
                typePost:'updateBuilding'
            },
            success:function (msg) {
                if (msg.search('finish')) {
                    window.location.reload();
                } else {
                    alert(msg);
                }
            }
        });
    }
</script>
<body style="padding:10px">
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
################################################################################
## +---------------------------------------------------------------------------+
## | 1. Creating & Calling:                                                    |
## +---------------------------------------------------------------------------+
##  *** define a relative (virtual) path to datagrid.class.php file
##  *** (relatively to the current file)
##  *** RELATIVE PATH ONLY ***
define("DATAGRID_DIR", "datagrid/"); /* Ex.: "datagrid/" */
require_once(DATAGRID_DIR . 'datagrid.class.php');

// includes database connection parameters
include_once('lib/base.inc.php');

##  *** set needed options
$debug_mode = false;
$messaging = true;
$unique_prefix = "f_";
$dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix);

ob_start();


##  *** set data source with needed options
##  *** put a primary key on the first place
$sql = "
    SELECT
      `building_site`.id AS a_id,
      `building_type`.id AS b_id,
      `pay_type`.id AS c_id,
      `building_site`.*,
      `building_type`.*,
      `pay_type`.*,
      CASE
        WHEN `building_site`.`publish` = 0
        THEN CONCAT('<input type=\"checkbox\"/><span style=\"color:#FF3B3B;\"><b>', 'Unapprove', '</b></span>')
        WHEN `building_site`.`publish` = 1
        THEN CONCAT('<input type=\"checkbox\" checked/><span style=\"color:#37D93F;\"><b>', 'Approve', '</b></span>')
        WHEN `building_site`.`publish` = 2
        THEN CONCAT('<input type=\"checkbox\"/><span style=\"color:#FFF83B;background-color:#B0A6FF; \"><b>',
        '&nbsp;&nbsp;&nbsp;Waiting&nbsp;&nbsp;&nbsp;', '</b></span>')
      END AS status_publish,
      '<input type=\"checkbox\"/>' AS test
    FROM
      `building_site`
      INNER JOIN `building_type`
        ON (`building_site`.`building_type_id` = `building_type`.`id`)
      INNER JOIN `pay_type`
        ON (`building_site`.`pay_type_id` = `pay_type`.`id`)
    WHERE 1
      AND `building_site`.`deleted` = 0
      AND `building_type`.`deleted` = 0
      AND `pay_type`.`deleted` = 0
    ";
$default_order = array("a_id" => "ASC");
$dgrid->DataSource("PEAR", "mysql", $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order);

if ($_POST) {
    $getBuildingID = @$_POST['buildingID'];
    $getPublish = @$_POST['publish'];
    $getTypePost = @$_POST['typePost'];
    if ($getTypePost == 'updateBuilding') {
        $setPublish = 0;
        $dateNow = date('Y-m-d H:i:s');
        switch ($getPublish) {
            case 0:
                $setPublish = 1;
                break;
            case 1:
                $setPublish = 0;
                break;
            case 2:
                $setPublish = 1;
                break;
        }
        $strSqlUpdate = "
            UPDATE
              building_site
            SET
              publish = $setPublish,
              lastupdate = '$dateNow'
            WHERE id = $getBuildingID
        ";
        if ($dgrid->Execute($strSqlUpdate)) {
            echo 'finish';
        } else {
            echo 'fail';
        }
        exit();
    }
}
$dg_caption = '<b><a href=approve-building.php>Approve Building</a></b>';
$dgrid->SetCaption($dg_caption);

## +---------------------------------------------------------------------------+
## | 2. General Settings:                                                      |
## +---------------------------------------------------------------------------+
## +-- PostBack Submission Method ---------------------------------------------+
##  *** defines postback submission method for DataGrid: AJAX, POST(default) or GET
$postback_method = 'AJAX';
$dgrid->SetPostBackMethod($postback_method);
##  *** set CSS class for datagrid
##  *** 'default|blue|gray|green|pink|empty|x-blue|x-gray|x-green' or your own css style
$css_class = 'pink';
$dgrid->SetCssClass($css_class);

$modes = array(
    'add' => array(
        'view' => false,
        'edit' => false,
        'type' => 'link',
        'show_button' => false,
        'show_add_button' => 'inside|outside'
    ),
    'edit' => array(
        'view' => false,
        'edit' => true,
        'type' => 'link',
        'show_button' => true,
        'byFieldValue' => ''
    ),
    'details' => array(
        'view' => true,
        'edit' => false,
        'type' => 'link',
        'show_button' => false
    ),
    'delete' => array(
        'view' => true,
        'edit' => true,
        'type' => 'image',
        'show_button' => false
    )
);
$dgrid->SetModes($modes);

## +---------------------------------------------------------------------------+
## | 4. Sorting & Paging Settings:                                             |
## +---------------------------------------------------------------------------+
##  *** set sorting option: true(default) or false
$sorting_option = true;
$dgrid->AllowSorting($sorting_option);
##  *** set paging option: true(default) or false
$paging_option = true;
$rows_numeration = false;
$numeration_sign = 'N #';
$dropdown_paging = false;
$dgrid->AllowPaging($paging_option, $rows_numeration, $numeration_sign, $dropdown_paging);
##  *** set paging settings
$bottom_paging = array(
    'results' => true,
    'results_align' => 'left',
    'pages' => true,
    'pages_align' => 'center',
    'page_size' => true,
    'page_size_align' => 'right'
);
$top_paging = array(
    'results' => true,
    'results_align' => 'left',
    'pages' => true,
    'pages_align' => 'center',
    'page_size' => true,
    'page_size_align' => 'right'
);
$pages_array = array(
    '10' => '10', '25' => '25', '50' => '50', '100' => '100', '250' => '250', '500' => '500', '1000' => '1000'
);
$default_page_size = 10;
$paging_arrows = array('first' => '|&lt;&lt;', 'previous' => '&lt;&lt;', 'next' => '&gt;&gt;', 'last' => '&gt;&gt;|');
$dgrid->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size, $paging_arrows);

## +---------------------------------------------------------------------------+
## | 5. Filter Settings:                                                       |
## +---------------------------------------------------------------------------+
##  *** set filtering option: true or false(default)
$filtering_option = true;
$show_search_type = false;
$dgrid->AllowFiltering($filtering_option, $show_search_type);

##  *** set additional filtering settings
$filtering_fields = array(
    "ชื่อหอพัก" => array(
        "type" => "textbox",
        "table" => "building_site",
        "field" => "building_name",
        "filter_condition" => "",
        "show_operator" => "false",
        "default_operator" => "%like%",
        "case_sensitive" => "false",
        "comparison_type" => "string",
        "width" => "",
        "on_js_event" => ""
    ),
    "ประเภท" => array(
        "type" => "enum",
        "table" => "building_type",
        "field" => "type_name",
        "filter_condition" => "",
        "show_operator" => "false",
        "default_operator" => "=",
        "case_sensitive" => "false",
        "comparison_type" => "numeric",
        "width" => "",
        "on_js_event" => ""
    ),
    "ชนิด" => array(
        "type" => "enum",
        "table" => "pay_type",
        "field" => "typename",
        "filter_condition" => "",
        "show_operator" => "false",
        "default_operator" => "=",
        "case_sensitive" => "false",
        "comparison_type" => "numeric",
        "width" => "",
        "on_js_event" => ""
    ),
);
$dgrid->SetFieldsFiltering($filtering_fields);


## +---------------------------------------------------------------------------+
## | 6. View Mode Settings:                                                    |
## +---------------------------------------------------------------------------+
##  *** set view mode table properties
$vm_table_properties = array('width' => '100%');
$dgrid->SetViewModeTableProperties($vm_table_properties);
##  *** set columns in view mode
##  *** Ex.: 'on_js_event'=>'onclick="alert(\'Yes!!!\');"'
##  ***      'barchart' : number format in SELECT SQL must be equal with number format of max_value
$fill_from_array = array(
    '0' => 'Banned', '1' => 'Active', '2' => 'Closed', '3' => 'Removed'
); /* as 'value'=>'option' */
$vm_columns = array(
    'a_id' => array(
        'header' => 'ID หอพัก',
        'type' => 'label',
        'align' => 'right'
    ),
    'building_name' => array(
        'header' => ' ชื่อหอพัก',
        'type' => 'label',
        'align' => 'left'
    ),
    'type_name' => array(
        'header' => ' ประเภท',
        'type' => 'label',
        'align' => 'left'
    ),
    'typename' => array(
        'header' => ' ชนิด',
        'type' => 'label',
        'align' => 'left'
    ),
    'datetimestamp' => array(
        'header' => ' วันที่ลง',
        'type' => 'label',
        'align' => 'left'
    ),
    'lastupdate' => array(
        'header' => ' แก้ไขล่าสุด',
        'type' => 'label',
        'align' => 'left'
    ),
//    'status_publish' => array('header' => ' Approve Status', 'type' => 'link', "width" => "110px",
//        "field_key" => "a_id", "field_key_1" => "publish", 'align' => 'left', "sort_by" => "publish",
//        "on_js_event" => "onclick=javascript:updateBuilding({0},{1})"),
    'status_publish' => array(
        'header' => 'Approve Status',
        'type' => 'link',
        'align' => 'left',
        'width' => 'X%|Xpx',
        'wrap' => 'wrap|nowrap',
        'text_length' => '-1',
        'tooltip' => 'false',
        'tooltip_type' => 'floating|simple',
        'case' => 'normal|upper|lower|camel',
        'summarize' => 'false',
        'summarize_sign' => '',
        'sort_type' => 'string|numeric',
        'sort_by' => '',
        'visible' => 'true',
        'on_js_event' => 'onclick=javascript:updateBuilding({0},{1})',
        'field_key' => 'a_id',
        'field_key_1' => 'publish',
        'field_data' => 'status_publish',
        'rel' => '',
        'title' => '',
        'target' => '_self',
        'href' => '#'
    ),
//    'test' => array('header' => ' แก้ไขล่าสุด', 'type' => 'label', "field_key" => "a_id",
//        "field_key_1" => "publish", 'align' => 'left',
//        "on_js_event" => "onclick=javascript:updateBuilding({0},{1})"),
//
//
//    "publish" => array("header" => "Approve Status", "type" => "checkbox", "align" => "center",
//        "width" => "80px", "wrap" => "wrap|nowrap", "sort_type" => "numeric", "sort_by" => "",
//        "visible" => "true", "on_js_event" => "onclick=javascript:alert(55);", "true_value" => 1, "false_value" => 0
//    ),

);
$dgrid->SetColumnsInViewMode($vm_columns);
##  *** set auto-generated columns in view mode
$auto_column_in_view_mode = false;
$dgrid->SetAutoColumnsInViewMode($auto_column_in_view_mode);

## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        |
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode
$table_name = "building_site";
$primary_key = "id";
$condition = "";
$dgrid->SetTableEdit($table_name, $primary_key, $condition);
$dgrid->SetAutoColumnsInEditMode(true);

## +---------------------------------------------------------------------------+
## | 8. Bind the DataGrid:                                                     |
## +---------------------------------------------------------------------------+
##  *** set debug mode & messaging options
$dgrid->Bind();
ob_end_flush();

?>
</body>
</html>