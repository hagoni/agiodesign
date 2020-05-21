<?
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
if(!defined('_VIEW3BOARD_'))exit;
######################################################################################################################################################
?>
<div id="videoBoardWrap">
<?
if($total_data > 0) {
	$list_page = 8;
	$page_per_list = 3;
	$start = ($view3_page - 1) * $list_page;
	if($_REQUEST['idx']) {
		$view3_idx = $_REQUEST['idx'];
		$top_sql = $main_sql." and view3_idx='".$view3_idx."'".$view_order;
	} else {
		$top_sql = $main_sql.$view_order." limit ".$start.", 1";
	}
	$top_out_sql = mysql_query($top_sql);
	$top_list = mysql_fetch_assoc($top_out_sql);
	$view3_table = TABLE_LEFT.$board;
	if(!$view3_idx) {
		$view3_idx = $top_list['view3_idx'];
	}
	view3_prev_next($view3_table,$view3_idx);
?>

	<div class="box_wrap">
		<div id="videoViewContainer" class="video_view_container">
			<div class="fix_box">
				<div class="fix_fit">
<?
	switch(strtolower($top_list['view3_video'])) {
		case 'youtube':
			echo '<iframe id="iframeVideo" src="http://www.youtube.com/embed/'.$top_list['view3_link'].'?autoplay=1&amp;rel=0&amp;vq=hd720" width="100%" height="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
			break;
		default:
			echo '<iframe id="iframeVideo" src="//player.vimeo.com/video/'.$top_list['view3_link'].'?autoplay=0&amp;loop=1" width="100%" height="100%" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
			break;
	}
?>
				</div>
			</div>
			<p class="video_title ellipsis"><?=$top_list['view3_title_01']?></p>
<?
	if($temp_prev) {
?>
			<a href="#none" id="videoPrevBtn" class="video-btns video-prev" data-idx="<?=$temp_prev?>" data-page="<?=$view3_page - 1?>">이전</a>
<?
	}
	if($temp_next) {
?>
			<a href="#none" id="videoNextBtn" class="video-btns video-next" data-idx="<?=$temp_next?>" data-page="<?=$view3_page + 1?>">다음</a>
<?
	}
?>
		</div>

        <ul class="grid_list">
<?
$list_page = 8;
$page_per_list = 10;
$start = ($view3_page - 1) * $list_page;
page($total_data, $list_page, $page_per_list, $path_next, "img", $view3_page, $end_page_path);
$sql = $main_sql.$view_order." limit ".$start.", ".$list_page;
$out_sql = mysql_query($sql);
$i = 1;
while($list = mysql_fetch_assoc($out_sql)) {
    $list_img_arr = explode('||', $list['view3_file']);
    $list_img = $list_img_arr[2] != '' ? $pc.'/upload/'.$board.$list_img_arr[2] : $pc.'/design/noimg/'.$board.'.jpg';
    if($list['view3_idx'] == $view3_idx && $i % 4 == 0) {
        $class_attr = ' class="on last_col"';
    } else if($list['view3_idx'] == $view3_idx) {
        $class_attr = ' class="on"';
    } else if($i % 4 == 0) {
        $class_attr = ' class="last_col"';
    } else {
        $class_attr = '';
    }
?>
            <li<?=$class_attr?> data-idx="<?=$list['view3_idx']?>">
                <a href="#none" class="bindVideoPlay">
                    <div class="grid_img_area" style="background-image:url('<?=$list_img?>')"></div>
                    <p class="grid_txt_area ellipsis"><?=$list['view3_title_01']?></p>
                </a>
            </li>
<?
    $i++;
}
?>

        </ul>
    </div>

	<!-- paging start -->
	<div class="paging fs_def">
		<?=$out_page?>
	</div>
	<!-- //paging end -->

<?
} else {
	echo '<p class="nodata">게시물이 없습니다.</p>'.PHP_EOL;
}
?>
</div>

<script src="<?=BOARD.'/'.$view3_skin?>/js/VideoPlay.js?<?=$time?>"></script>