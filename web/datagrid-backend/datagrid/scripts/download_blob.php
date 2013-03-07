<?php
    // Last changed: 26.01.2012

    session_start();    
    
    $post_type = 'session';
        
    if($post_type == 'session'){
        $file_content = isset($_SESSION['datagrid_df_content']) ? $_SESSION['datagrid_df_content'] : '';        
        $file_type    = isset($_SESSION['datagrid_df_blob_type']) ? $_SESSION['datagrid_df_blob_type'] : '';        
        $file_name    = isset($_SESSION['datagrid_df_blob_name']) ? $_SESSION['datagrid_df_blob_name'] : '';
        $file_size    = isset($_SESSION['datagrid_df_blob_size']) ? $_SESSION['datagrid_df_blob_size'] : '';
        $fn           = isset($_GET['fn']) ? $_GET['fn'] : '';
    }else{
        $frid = isset($_GET['frid']) ? $_GET['frid'] : '';
        
        //add database connection parameters here...
        //...
        //$sql = 'SELECT bin_data, filetype, filename, filesize FROM tbl_Files WHERE id_files='.$file_name;
        //  
        //$result = @mysql_query($sql, $db);
        //$file_content = @mysql_result($result, 0, 'bin_data');
        //$file_name = @mysql_result($result, 0, 'filename');
        //$file_size = @mysql_result($result, 0, 'filesize');
        //$file_type = @mysql_result($result, 0, 'filetype');        
    }

    if($file_name == '' || $file_size == 0 || $file_type == '' || $file_content == ''){
        echo 'Wrong parameters passed. Please refresh the page and try to download file again. <a href="javascript:history.go(-1);">Back</a>';
        exit;
    }else if($file_name != $fn){
        echo 'Wrong parameters passed. Please refresh the page and try to download file again.';
        exit;        
    }
    
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
    header('Pragma: no-cache'); // HTTP/1.0

    header('Content-type: '.$file_type);
    header('Content-length: '.$file_size);
    header('Content-Disposition: attachment; filename='.$file_name);
    header('Content-Description: PHP Generated Data');
    echo $file_content;
        
    unset($_SESSION['datagrid_df_content']);
    unset($_SESSION['datagrid_df_blob_type']);
    unset($_SESSION['datagrid_df_blob_name']);
    unset($_SESSION['datagrid_df_blob_size']);
    exit;
?>