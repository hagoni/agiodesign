<?php
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
define('_VIEW3BOARD_', TRUE);
@include_once														"../../../view3.php";
######################################################################################################################################################
$blog_table = 'project_01';
$blog_sca = $_REQUEST['sca'];
if ($blog_sca == "0" || $blog_sca == "") {
    $sca_query = "";
} else {
    $sca_query = "AND view3_sca = '{$blog_sca}'";
}
$blog_list_query = "SELECT * FROM `".TABLE_LEFT.$blog_table."` WHERE view3_use = '1' {$sca_query} ORDER BY view3_order DESC, view3_write_day DESC LIMIT ".$_REQUEST['start'].", ".$_REQUEST['limit'];
$blog_result = mysql_query($blog_list_query);
$blog_data = Array();
$blog_i = 0;
while($blog_list = mysql_fetch_assoc($blog_result)) {
    $img = explode("||",$blog_list['view3_file']);
    $img_path = "{$root}/upload/project_01{$img[2]}";
    $blog_data[$blog_i] = Array(
        'dataId' => 'projcet',
        'idx' => $blog_list['view3_idx'],
        'title' => $blog_list['view3_title_01'],
        'sub' => $blog_list['view3_title_02'],
        'sca' => $blog_list['view3_sca'],
        'image' => $img_path,
    );
    $blog_i++;
}
echo json_encode($blog_data);
?>
