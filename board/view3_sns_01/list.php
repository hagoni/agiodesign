<?
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
if(!defined('_VIEW3BOARD_'))exit;
######################################################################################################################################################
?>

<div class="sub_titles rline">
	<h3 class="engtxt">Akasaka Media</h3>
	<h4 class="imgtxt"><img src="<?=$root?>/img/board/media_page_title.png" alt="보도자료"></h4>
</div>

<!-- board wrapper start -->
<div id="boardWrap">
	<ul class="tabmenu fs_def">
		<li<?if($view3_tab == '' || $view3_tab == 1){echo ' class="on"';}?>><a href="<?=URL_PATH.'?'.get("page||type||tab||idx","tab=1");?>">보도자료</a></li>
		<li<?if($view3_tab == 2){echo ' class="on"';}?>><a href="<?=URL_PATH.'?'.get("page||type||tab||idx","tab=2");?>">영상자료</a></li>
	</ul>

	<div class="tabcons">
<?
	if($view3_tab == '' || $view3_tab == 1) {
		include_once('inc/naver.php');
	} else if($view3_tab == 2) {
		include_once('inc/video.php');
	}
?>
	</div>

</div>
<!-- //board wrapper end -->