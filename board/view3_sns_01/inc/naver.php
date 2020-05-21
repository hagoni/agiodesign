<?
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
if(!defined('_VIEW3BOARD_'))exit;
######################################################################################################################################################
if($total_data > 0) {
?>

		<p class="sns_title t_center"><em>NAVER</em> <?=$board_name;?> 검색결과입니다. :: 검색건수 : <?=$total_data;?>건</p>

        <!-- board list start -->
        <ul class="board_list">
<?
    $list_page = 10;
    $page_per_list = 3;
    $start = ($view3_page - 1) * $list_page;
    page($total_data, $list_page, $page_per_list, $path_next, "img", $view3_page, $end_page_path);
    $sql = $main_sql.$view_order." limit ".$start.", ".$list_page;
    $out_sql = mysql_query($sql);
    while($list = mysql_fetch_assoc($out_sql)) {
        $list_count = $total_data-$start-$i; //높은 숫자부터 출력
        $path_view = URL_PATH.'?'.view3_link('||idx||select||search','view&select='.$view3_select.'&search='.$view3_search.'&idx='.$list['view3_idx']);
        $next_command_01 = cut($list['view3_command_01'], 126);
        $write_day = date('Y-m-d', strtotime($list['view3_pubdate']));
?>
            <li class="fs_def">
                <a href="<?=$list['view3_link']?>" target="_blank" class="bindSnsModalOpen" data-type="iframe">
                    <p class="stitle ellipsis"><?=html_entity_decode($list['view3_title'])?></p>
                    <div class="text"><?=html_entity_decode($list['view3_description'])?></div>
                    <p class="date"><?=$write_day?></p>
                </a>
            </li>
<?
      $i++;
    }
?>
        </ul>
        <!-- //board list end -->

        <!-- paging start -->
      	<div class="paging fs_def">
      		<?=$out_page?>
      	</div>
      	<!-- //paging end -->

<script src="<?=BOARD.'/'.$view3_skin?>/js/SnsModal.js?<?=$time?>"></script>
<script>
(function($) {
	doc.ready(function() {
        new SnsModal();
	});
}(jQuery));
</script>

<?
} else {
	echo '<p class="nodata">게시물이 없습니다.</p>'.PHP_EOL;
}
?>