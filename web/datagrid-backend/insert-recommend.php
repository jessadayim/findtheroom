<?php

$debug_mode = false;
$messaging = true;
$unique_prefix = "in_";
$dgridAddRecommend = new DataGrid($debug_mode, $messaging, $unique_prefix);
##  *** set data source with needed options
##  *** put a primary key on the first place
$sql = "
    SELECT
      `building_site`.`building_name`,
      `building_site`.id AS a_id,
      `recommend_building`.`id` AS id,
      `recommend_building`.`building_id`,
      `recommend_building`.`recommend_type`,
      `recommend_building`.`recommend_order`,
      CASE
        WHEN `recommend_building`.`recommend_type` = 1
        THEN 'ห้องพักใกล้ BTS'
        WHEN `recommend_building`.`recommend_type` = 2
        THEN 'ห้องพักใกล้ MRT'
        WHEN `recommend_building`.`recommend_type` = 3
        THEN 'ห้องพักใกล้มหาวิทยาลัย'
      END AS recommend_type_name
    FROM
      `building_site`
      INNER JOIN `recommend_building`
        ON (
          building_site.`id` = recommend_building.`building_id`
        )
    WHERE 1
      AND building_site.`deleted` = 0
    ";
$default_order = array("`recommend_building`.`recommend_type`" => "ASC");
$dgridAddRecommend->DataSource("PEAR", "mysql", $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order);

$dg_caption = '<br><b>รายการหอพักแนะนำ</b>';
$dgridAddRecommend->SetCaption($dg_caption);

## +---------------------------------------------------------------------------+
## | 2. General Settings:                                                      |
## +---------------------------------------------------------------------------+
## +-- PostBack Submission Method ---------------------------------------------+
##  *** defines postback submission method for DataGrid: AJAX, POST(default) or GET
$postback_method = 'GET';
$dgridAddRecommend->SetPostBackMethod($postback_method);
##  *** set CSS class for datagrid
##  *** 'default|blue|gray|green|pink|empty|x-blue|x-gray|x-green' or your own css style
$css_class = 'x-green';
$dgridAddRecommend->SetCssClass($css_class);

$modes = array(
    'add' => array(
        'view' => false,
        'edit' => true,
        'type' => 'link',
        'show_button' => true,
        'show_add_button' => 'inside|outside'
    ),
    'edit' => array(
        'view' => true,
        'edit' => true,
        'type' => 'link',
        'show_button' => true,
        'byFieldValue' => ''
    ),
    'details' => array(
        'view' => true,
        'edit' => true,
        'type' => 'link',
        'show_button' => true
    ),
    'delete' => array(
        'view' => true,
        'edit' => true,
        'type' => 'image',
        'show_button' => true
    )
);
$dgridAddRecommend->SetModes($modes);

## +---------------------------------------------------------------------------+
## | 4. Sorting & Paging Settings:                                             |
## +---------------------------------------------------------------------------+
##  *** set sorting option: true(default) or false
$sorting_option = true;
$dgridAddRecommend->AllowSorting($sorting_option);
##  *** set paging option: true(default) or false
$paging_option = true;
$rows_numeration = true;
$numeration_sign = 'ลำดับที่';
$dropdown_paging = false;
$dgridAddRecommend->AllowPaging($paging_option, $rows_numeration, $numeration_sign, $dropdown_paging);
##  *** set paging settings
$bottom_paging = array(
    'results' => true, 'results_align' => 'left', 'pages' => true, 'pages_align' => 'center', 'page_size' => true,
    'page_size_align' => 'right'
);
$top_paging = array(
    'results' => true, 'results_align' => 'left', 'pages' => true, 'pages_align' => 'center', 'page_size' => true,
    'page_size_align' => 'right'
);
$pages_array = array(
    '10' => '10', '25' => '25', '50' => '50', '100' => '100', '250' => '250', '500' => '500', '1000' => '1000'
);
$default_page_size = 10;
$paging_arrows = array('first' => '|&lt;&lt;', 'previous' => '&lt;&lt;', 'next' => '&gt;&gt;', 'last' => '&gt;&gt;|');
$dgridAddRecommend->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size, $paging_arrows);


## +---------------------------------------------------------------------------+
## | 6. View Mode Settings:                                                    |
## +---------------------------------------------------------------------------+
##  *** set view mode table properties
$vm_table_properties = array('width' => '100%');
$dgridAddRecommend->SetViewModeTableProperties($vm_table_properties);
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
    'recommend_type_name' => array(
        'header' => ' ชนิด',
        'type' => 'label',
        'align' => 'left'
    ),
    'recommend_order' => array(
        'header' => ' ลำดับ',
        'type' => 'label',
        'align' => 'right'
    )

);
$dgridAddRecommend->SetColumnsInViewMode($vm_columns);
##  *** set auto-generated columns in view mode
$auto_column_in_view_mode = false;
$dgridAddRecommend->SetAutoColumnsInViewMode($auto_column_in_view_mode);


## +---------------------------------------------------------------------------+
## | 7. Add/Edit/Details Mode settings:                                        |
## +---------------------------------------------------------------------------+
##  ***  set settings for edit/details mode

$table_name = "recommend_building";
$primary_key = "id";
$condition = "";

$dgridAddRecommend->SetAutoColumnsInEditMode(false);
$dgridAddRecommend->SetTableEdit($table_name, $primary_key, $condition);

$arrRecommendType = array("1" => 'ห้องพักใกล้ BTS', "2" => 'ห้องพักใกล้ MRT', "3" => 'ห้องพักใกล้มหาวิทยาลัย');
$arrListBuilding = array(@$_GET['in_rid'] => @$_GET['b_name']);

//เพิ่ม focus ไปที่จุดเพิ่มข้อมูล
if (!empty($_GET['b_name'])) {
    echo "
    <script>$(document).ready(function(){
        $('#styrecommend_type').focus();
    });
    </script>
    ";
}
$em_columns = array(

    'building_id' => array(
        'header' => ' ประเภทห้องพักแนะนำ',
        'type' => 'enum',
        'req_type' => 'sy',
        'width' => '200px',
        'title' => '', 'readonly' => 'false',
        'maxlength' => '-1', 'default' => '',
        'unique' => 'false', 'unique_condition' => '',
        'visible' => 'true', 'on_js_event' => '',
        'source' => $arrListBuilding,
        'view_type' => 'dropdownlist(default)|radiobutton|checkbox',
        'radiobuttons_alignment' => 'horizontal|vertical',
        'multiple' => 'false',
        'multiple_size' => '4'
    ),

    'recommend_type' => array(
        'header' => ' ประเภทห้องพักแนะนำ', 'type' => 'enum',
        'req_type' => 'st', 'width' => '200px',
        'title' => '', 'readonly' => 'false',
        'maxlength' => '-1', 'default' => '',
        'unique' => 'false', 'unique_condition' => '',
        'visible' => 'true', 'on_js_event' => '',
        'source' => $arrRecommendType,
        'view_type' => 'dropdownlist(default)|radiobutton|checkbox',
        'radiobuttons_alignment' => 'horizontal|vertical',
        'multiple' => 'false',
        'multiple_size' => '4'
    ),
    'recommend_order' => array(
        'header' => ' ลำดับการแนะนำ',
        'type' => 'textbox',
        'req_type' => 'rt',
        'width' => '210px',
        'title' => '',
        'readonly' => 'false',
        'maxlength' => '-1',
        'default' => '',
        'unique' => 'false',
        'unique_condition' => '',
        'visible' => 'true',
        'on_js_event' => ''
    ),
);
$dgridAddRecommend->SetColumnsInEditMode($em_columns);


## +---------------------------------------------------------------------------+
## | 8. Bind the DataGrid:                                                     |
## +---------------------------------------------------------------------------+
##  *** set debug mode & messaging options
$dgridAddRecommend->Bind();

?>