<!-- sitemap start -->
<div id="sitemapWrap" class="sitemap_wrap" style=" display:none">
	<div class="sitemap h100">
        <div class="sitemap_in v_mid">
			<a href="<?=$root?>/freebest/download_file.php?filepath=<?=$root?>/img/catalog.pdf&amp;filename=catalog.pdf" target="_blank" class="ctlg_down"><span class="down_text">Catalog Download</span><span class="down_img"><img src="<?=$root?>/img/common/down.png" alt=""></span></a>
            <p class="stm_text">
                AGIO DESIGN<br>
                <em>사람을 담는 공간</em>
            </p>
    		<ul class="stm_depth1_ul">
                <li class="stm_depth1_li">
                    <a href="<?=$root?>/" class="stm_depth1_a">HOME</a>
                </li>
<?
$depth1_link_query = "SELECT * FROM `".TABLE_LEFT."group` WHERE view3_use = '1' AND view3_setup = '$html_idx' ORDER BY view3_order";
$depth1_result = @mysql_query($depth1_link_query);
while($depth1_list = @mysql_fetch_assoc($depth1_result)) {
    $depth2_link_query = "SELECT * FROM `".TABLE_LEFT."board` WHERE view3_use = '1' AND view3_setup = '$html_idx' AND view3_group_idx = '".$depth1_list['view3_idx']."' ORDER BY view3_order";
    $depth2_result = @mysql_query($depth2_link_query);
	unset($depth1_link);
	while($depth2_list = mysql_fetch_assoc($depth2_result)) {
		switch($depth2_list['view3_style']) {
			case 'html':
				if(file_exists(ROOT_INC.'/html/'.$depth2_list['view3_link'])) {
					$depth1_link = $root.'/html/'.$depth2_list['view3_link'];
				}
				break;
			case 'board':
				$depth1_link = BOARD.'/index.php?board='.$depth2_list['view3_link'];
				break;
			case 'http':
				$depth1_link = $depth2_list['view3_link'].'" target="_blank';
				break;
			case 'url':
				$depth1_link = $depth2_list['view3_link'];
				break;
			default:
				if(file_exists(ROOT_INC.'/html/'.$depth2_list['view3_link'])) {
					$depth1_link = $root.'/html/'.$depth2_list['view3_link'];
				}
		}
		if($depth1_link) {
			if($depth2_list['view3_sca']) {
				if(strpos($depth1_link, '?') > -1) $depth1_link .= '&amp;sca='.$depth2_list['view3_sca'];
				else $depth1_link .= '?sca='.$depth2_list['view3_sca'];
			}
			break;
		}
	}
?>
    			<li class="stm_depth1_li<?if($depth1_list['view3_order_css'] == $gnb_index){echo ' on';}?>">
    				<a href="<?=$depth1_link?>" class="stm_depth1_a"><?=strip_tags(html_entity_decode($depth1_list['view3_title_02']))?></a>
    			</li>
<?
}
?>
		  </ul>
        </div>
	</div>
    <a href="#none" class="bindSitemapFold stm_close">닫기</a>
</div>
<!-- //sitemap end -->
