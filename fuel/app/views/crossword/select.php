<style type="text/css">
<!--
body { background-image:url(/img/game_bg.png); }
.puzzle.status
{ background-image: url(/img/menu/word.png); }
.puzzle.status:hover,
.puzzle.status:active
{ background-image: url(/img/menu/word_f.png); }
.puzzle.status0
{ background-image: url(/img/menu/word_continue.png); }
.puzzle.status0:hover,
.puzzle.status0:active
{ background-image: url(/img/menu/word_continue_f.png); }
.puzzle.status9
{ background-image: url(/img/menu/word_clear.png); }
.puzzle.status9:hover,
.puzzle.status9:active
{ background-image: url(/img/menu/word_clear_f.png); }
.control-group {
	margin-bottom: 0;
}
button {
	display: block;
	margin: auto;
	border: none;
	background: none;
	width: 150px;
}
.modal-backdrop { background-color: transparent; }
#dialog {
    background-color: transparent;
    background-image: url(/img/dialog/popup_80alpha.png);
    background-repeat: no-repeat;
    background-size: cover;
    top: 20%;
    width: 308px;
    height: 283px;
    left: 50%;
    margin-left: -154px;
    border: none; outline: none;
    text-align: center;
}
.modal-inner a > img {
    height: auto;
    width: 80%;
}
#dialog table {
    margin: 15px auto;
    height: 40px;
    width: 300px;
}
#dialog table img {
    height: 40px;
    margin: 0;
}
-->
</style>
<script src="/js/button.js"></script>
<script>
$(function() {
    var puzzle = '';
    $('a.puzzle').click(function() {
        puzzle = this.href;
        $('#dialog h6').text($('h6', this).text());
        $('#dialog').modal('show');
        return false;
    });
    $('#dialog a').click(function() {
        if ($(this).attr('id')=='start') {
            var key = 'np' + puzzle.split('/').pop();
            sessionStorage.removeItem(key);
            localStorage.removeItem(key);
            localStorage.removeItem(key+'timer');
        }
        if ( ! $(this).hasClass('dismiss')) location.href = puzzle;
    });
});
</script>

<h2 id="sub-header"><img src="/img/title_word.png"></h2>
<div align="center">
<?php if($sort == 1){?>
<?=Html::anchor('/crossword/select/', '<img src="/img/nanido1_f.png" data-active-src="/img/nanido1_f.png">', array('title',"★")) ?>
<?php }else{ ?>
<?=Html::anchor('/crossword/select/1/1', '<img src="/img/nanido1.png" data-active-src="/img/nanido1_f.png">', array('title',"★")) ?>
<?php } ?>

<?php if($sort == 2 ){?>
<?=Html::anchor('/crossword/select/', '<img src="/img/nanido2_f.png" data-active-src="/img/nanido2_f.png">', array('title',"★★")) ?>
<?php }else{ ?>
<?=Html::anchor('/crossword/select/1/2', '<img src="/img/nanido2.png" data-active-src="/img/nanido2_f.png">', array('title',"★★")) ?>
<?php } ?>

<?php if($sort == 3 ){?>
<?=Html::anchor('/crossword/select/', '<img src="/img/nanido3_f.png" data-active-src="/img/nanido3_f.png">', array('title',"★★★")) ?>
<?php }else{ ?>
<?=Html::anchor('/crossword/select/1/3', '<img src="/img/nanido3.png" data-active-src="/img/nanido3_f.png">', array('title',"★★★")) ?>
<?php } ?>
</div>

<section id="puzzle-menu">
<?php foreach($pzs as $key => $val): ?>
	<a class="puzzle status<?= $val['status'] ?>" href="/crossword/play/<?= $val['puzzleid'] ?>">
        <h6>No.<?= $val['question'] ?> / status:<?= $val['status'] ?></h6>
        <div class="stars">
            <?php if($val['mapsizeh'] < 6){?><img src="/img/public_difficulty.png">
            <?php }elseif($val['mapsizeh'] >= 6 and $val['mapsizeh'] <= 7){?><img src="/img/public_difficulty.png"><img src="/img/public_difficulty.png">
            <?php }elseif($val['mapsizeh'] > 7){?><img src="/img/public_difficulty.png"><img src="/img/public_difficulty.png"><img src="/img/public_difficulty.png">
            <?php }?>
        </div>
    </a>
<?php endforeach ?>
<!--div class="pagination pagination-centered"><ul>
	<li class="<?= $prev? '' : 'disabled' ?>">
        <a href="<?= ($prev !== FALSE)? "/crossword/select/{$prev}" : '#' ?>">前へ</a>
	<li class="<?= $next? '' : 'disabled' ?>">
		<a href="<?= ($next !== FALSE)? "/crossword/select/{$next}" : '#' ?>">次へ</a>
</ul></div-->
<div class="control-group" align="center"><table>
<tr>
    <?php if($prev !== FALSE){?>
    <td><button type="button" onclick="location.href='<?= ($prev !== FALSE)? "/crossword/select/{$prev}/{$sort}" : '#' ?>'"><img src="/img/button_before.png" data-active-src="/img/button_before_f.png"></button></td>
    <?php } ?>
    <?php if($next !== FALSE){?>
    <td><button type="button" onclick="location.href='<?= ($next !== FALSE)? "/crossword/select/{$next}/{$sort}" : '#' ?>'"><img src="/img/button_next.png" data-active-src="/img/button_next_f.png"></button></td>
    <?php } ?>
</tr>
</table></div>

</section>

<?php ////if ($this->is_login): ?>
<?php if (true): ?>
<?php
$chart = "//chart.googleapis.com/chart";
    $chart .= "?chf=a,s,000000|bg,lg,0,224499,1|c,s,1398E5";
    $chart .= "&chxr=0,30,1|1,60,0";
    $chart .= "&chxs=0,BBCCED,0,0,lt,676767|1,BBCCED,12,0,l,676767";
    $chart .= "&chxt=x,y";
    $chart .= "&chs=350x200";
    $chart .= "&cht=ls";
    $chart .= "&chco=F3E630,00FF6E,FF0000";
    $chart .= "&chds=-60,0";
    $chart .= "&chd=t:".$graph["1"]."|".$graph["2"]."|".$graph["3"];
    $chart .= "&chg=3,5,5,0";
    $chart .= "&chls=2|2|2";
    $chart .= "&chma=5,5,10,15";
?>
<div id="graph">
<img src="<?=$chart?>">
<div id="label-y">タイム<br>(分)</div>
<div id="label-x">SCORE</div>
<div id="notes">
    <span>★<strike>　　</strike></span>
    <span>★★<strike>　　</strike></span>
    <span>★★★<strike>　　</strike></span>
</div>
</div>
<p>過去3ヶ月/最高30問のクリアタイムの推移を表示しています。</p>
<?php else : ?>
<img src="/img/graph_hikaiin.png" width="100%">
<?php endif ?>

<div align="right">
<?=Html::anchor('/top/menu', '<img src="/img/button_back.png" data-active-src="/img/button_back_f.png">', array('title',"戻る")) ?>
</div>

<div id="dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
    <table><tr>
        <td width="85%"><img src="/img/dialog/title_num.png"></td>
        <td><a href="#" class="dismiss" data-dismiss="modal"><img src="/img/dialog/dismiss.png" data-active-src="/img/dialog/dismiss_f.png"></a></td>
    </tr></table>
	<div class="modal-inner">
        <h6></h6>
    <?php ////if ($this->is_login): ?>
		会員なら。。。<br>
		<a href="#" class="btn2" id="load"><img src="/img/dialog/button_tudukikara.png" data-active-src="/img/dialog/button_tudukikara_f.png"></a>
    <?php ////else: ?>
    	<br><br>非会員なら。↓<br>
		<a class="btn2"><img src="/img/dialog/button_tudukikara_gray.png"></a>
        <p>パズルメイト会員になると<br>ゲームの途中保存が可能です！</p>
    <?php ////endif ?>
    
    	<br><br>どっちも<br>
		<a href="#" class="btn2" id="start"><img src="/img/dialog/button_hajimekara.png" data-active-src="/img/dialog/button_hajimekara_f.png"></a>
	</div>
</div>

