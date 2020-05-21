<?
######################################################################################################################################################
//VIEW3 BOARD 1.0
######################################################################################################################################################
if(!defined('_VIEW3BOARD_'))exit;
######################################################################################################################################################
$view3_sca = $_REQUEST['sca'];
?>

<ul class="pj_tabmenu fs_def t_center">
    <li <?if ($view3_sca == "0") {echo 'class="on"';}?>><a href="#none" data-sca="0">All Projects <span class="num">57</span></a></li>
    <li <?if ($view3_sca == "1") {echo 'class="on"';}?>><a href="#none" data-sca="1">Education Place <span class="num">20</span></a></li>
    <li <?if ($view3_sca == "2") {echo 'class="on"';}?>><a href="#none" data-sca="2">Commercial Place <span class="num">12</span></a></li>
    <li <?if ($view3_sca == "3") {echo 'class="on"';}?>><a href="#none" data-sca="3">Other <span class="num">03</span></a></li>
</ul>

<!-- sns start -->
<div class="sns">
    <ul id="sns-data-container" class="sns_list">
<?
$data = $_POST['data'];
if($data) {
    for($i=0; $i<count($data); $i++) {
?>
        <li class="grid-item">
            <a href="#none" class="bindSnsModalOpen" data-type="iframe" data-idx="<?=$data[$i]['idx']?>">
                <img src="<?=$data[$i]['image']?>" alt="">
                <div class="sns_title"><?=$data[$i]['title']?></div>
                <div class="pc_text_area">
                    <div class="v_mid w100 t_center">
                        <p class="pc_ttl"><?=$data[$i]['title']?></p>
                        <p class="pc_text"><?=$data[$i]['sub']?></p>
                    </div>
                </div>
            </a>
        </li>
<?
    }
}
?>
    </ul>
    <!-- <a href="#none" class="bind-sns-load load_more">더보기</a> -->
    <style>
        .progress{position:absolute;top:0;left:0;width:100%;height:100%;background-color:rgba(161,161,161,0.5);}
        .progress img{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)}
        .progress.on{z-index:-1;opacity:-1}
    </style>
    <div class="progress on">
        <img src="<?=BOARD?>/<?=$view3_skin?>/img/progress.gif" alt="">
    </div>
</div>
<!-- //sns end -->


<?
if ($_POST['idx']) {
    $sql = "select * from ".TABLE_LEFT."project_01 where view3_use = 1 and view3_idx = {$_POST['idx']}";
    $res = mysql_query($sql);
    $lst = mysql_fetch_assoc($res);
    $img = explode("||",$lst['view3_file']);
?>
<div id="pjPopup">
    <div class="pj_popup">
        <a href="#none" class="pop_close">닫기</a>
        <div class="pop_in">
            <div class="text_area t_center">
                <p class="pop_title"><?=$lst['view3_title_01']?></p>
                <p class="pop_text"><?=$lst['view3_title_02']?></p>
            </div>
            <ul class="pop_imgs inner">
            <?
            for ($i=3; $i < count($img); $i++) {
            ?>
                <li><img src="<?=$root?>/upload/project_01<?=$img[$i]?>" alt="" class="w100"></li>
            <?
            }
            ?>
            </ul>
        </div>
        <div class="pop_slide_wrap">
            <div class="inner">
                <p class="pop_slide_title">PROJECT</p>
                <div class="pop_slide">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper">
                            <?
                            $pr_sql = "select * from ".TABLE_LEFT."project_01 where view3_use = 1 order by view3_order desc, view3_write_day desc limit {$_POST['cnt']}";
                            $pr_res = mysql_query($pr_sql);
                            while ($pr_lst = mysql_fetch_assoc($pr_res)) {
                                $pr_img = explode("||",$pr_lst['view3_file']);
                                if ($_POST['idx'] == $pr_lst['view3_idx']) {
                                    $pick = 'pick';
                                } else {
                                    $pick = '';
                                }
                            ?>
                                <li class="swiper-slide hr <?=$pick?>">
                                    <a href="#none" class="bindSnsModalOpen" data-idx="<?=$pr_lst['view3_idx']?>">
                                        <img src="<?=$root?>/upload/project_01<?=$pr_img[2]?>" alt="">
                                        <p class="store_name ellipsis"><?=$pr_lst['view3_title_01']?></p>
                                    </a>
                                </li>
                            <?
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <button type="button" class="pop_btns pop_prev">이전</button>
                <button type="button" class="pop_btns pop_next">다음</button>
                <div class="swiper-pagination swiper-pagination-progressbar">
                    <span class="swiper-pagination-progressbar-fill"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?
}
?>



<script type="text/javascript">
var snsActive = {blog: true};
var snsLimit = 3;
var start = 0;
</script>
<script src="<?=BOARD.'/'.$view3_skin?>/js/SnsModal.js?<?=$time?>"></script>
<script src="<?=BOARD.'/'.$view3_skin?>/js/sns.js?<?=$time?>"></script>
<script>
(function($) {
    doc.ready(function() {
        new SocialLive('#sns-data-container', {
            active: snsActive,
            limit: snsLimit,
        });
        // new SnsModal();

        $('body').on('click','.pj_tabmenu a',function(e){
            var sca = $(this).data('sca');
            var html = "";

            new SocialLive('#sns-data-container', {
                active: snsActive,
                limit: snsLimit,
                sca: sca
            });
            // $.post(requestUrl,{sca: sca},function(res){
            //
            // });
        });

        $('body').on('click','.bindSnsModalOpen', function(e) {
            e.preventDefault();
            $.post(location.href,{idx:$(this).data('idx'),cnt:$('.sns_list .grid-item').length},function(res){
                $('body').append($(res).filter('#pjPopup').length > 0 ? $(res).filter('#pjPopup').html() : $(res).find('#pjPopup').html());
            	$("html, body").addClass("not_scroll");

                new Swiper('.pop_slide .swiper-container', {
                    observer: true,
                    observeParents: true,
                    slidesPerView: 'auto',
                    freeMode: 'free',
                    speed: 500,
                        autoplay: {
                        delay: 2000,
                    },
                    navigation: {
                        nextEl: '.pop_btns.pop_next',
                        prevEl: '.pop_btns.pop_prev',
                    },
                    pagination: {
                    	el: '.pop_slide_wrap .swiper-pagination',
                    	type: 'progressbar'
                    }
                });
            });
        });

        $('body').on('click', '.pop_close', function(e) {
        	$('.pj_popup').remove();
        	$("html, body").removeClass("not_scroll");
        	e.preventDefault();
        });
    });
}(jQuery));
</script>
