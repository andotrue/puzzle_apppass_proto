<div class="row-fluid" id="container" data-puzzle-type="np" data-puzzle-id="<?= $puz_id ?>" data-entry-id="<?= $entry_id ?>" data-puzzle-timestamp="<?= $timestamp ?>">

	<?php if(strstr ($_SERVER['HTTP_USER_AGENT'], "spass-app")){?>
	<div id="info">
		<div id="pztitle">
			<a href="#" id="option"><img src="/img/play/button_option.png" data-active-src="/img/play/button_option_f.png" STYLE="height: 26px;" /></a>
			<a href="#" id="answer-check"><img src="/img/play/button_answer.png" data-active-src="/img/play/button_answer_f.png" STYLE="height: 26px;" /></a>
		</div>
		<div id="timer">00:00:00</div>
	</div>
	<?php }else{ ?>
	<div id="info">
		<div id="difficulty">
			<?php for ($i=1;$i<=$level;$i++): ?>
				<img src="/img/public_difficulty.png">
			<?php endfor ?>
		</div>
		<div id="pztitle"><?= $title ?></div>
		<div id="timer">00:00:00</div>
	</div>
	<?php } ?>




	<div id="main" class="span6">
<?////= $puzzle ?>

<table id="np">
<tbody>
<tr>
<td data-grp='1' data-col='1' class='fx'><div class="num">5</div></td><td data-grp='1' data-col='2'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='1' data-col='3' class='fx'><div class="num">2</div></td><td data-grp='2' data-col='4' class='fx'><div class="num">8</div></td><td data-grp='2' data-col='5' class='fx'><div class="num">3</div></td><td data-grp='2' data-col='6' class='fx'><div class="num">6</div></td><td data-grp='3' data-col='7' class='fx'><div class="num">1</div></td><td data-grp='3' data-col='8'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='3' data-col='9' class='fx'><div class="num">7</div></td></tr>
<tr>
<td data-grp='1' data-col='1'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='1' data-col='2' class='fx'><div class="num">7</div></td><td data-grp='1' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='2' data-col='4' class='fx'><div class="num">1</div></td><td data-grp='2' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='2' data-col='6' class='fx'><div class="num">4</div></td><td data-grp='3' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='3' data-col='8' class='fx'><div class="num">5</div></td><td data-grp='3' data-col='9'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td></tr>
<tr>
<td data-grp='1' data-col='1' class='fx'><div class="num">1</div></td><td data-grp='1' data-col='2' class='fx'><div class="num">3</div></td><td data-grp='1' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='2' data-col='4'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='2' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='2' data-col='6'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='3' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='3' data-col='8' class='fx'><div class="num">8</div></td><td data-grp='3' data-col='9' class='fx'><div class="num">6</div></td></tr>
<tr>
<td data-grp='4' data-col='1' class='fx'><div class="num">7</div></td><td data-grp='4' data-col='2'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='4' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='4' class='fx'><div class="num">9</div></td><td data-grp='5' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='6' class='fx'><div class="num">2</div></td><td data-grp='6' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='8'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='9' class='fx'><div class="num">4</div></td></tr>
<tr>
<td data-grp='4' data-col='1' class='fx'><div class="num">3</div></td><td data-grp='4' data-col='2' class='fx'><div class="num">4</div></td><td data-grp='4' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='4'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='6'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='8' class='fx'><div class="num">2</div></td><td data-grp='6' data-col='9' class='fx'><div class="num">1</div></td></tr>
<tr>
<td data-grp='4' data-col='1'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='4' data-col='2'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='4' data-col='3' class='fx'><div class="num">8</div></td><td data-grp='5' data-col='4'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='5' data-col='6'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='7' class='fx'><div class="num">7</div></td><td data-grp='6' data-col='8'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='6' data-col='9'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td></tr>
<tr>
<td data-grp='7' data-col='1' class='fx'><div class="num">9</div></td><td data-grp='7' data-col='2'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='7' data-col='3' class='fx'><div class="num">3</div></td><td data-grp='8' data-col='4' class='fx'><div class="num">5</div></td><td data-grp='8' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='6' class='fx'><div class="num">7</div></td><td data-grp='9' data-col='7' class='fx'><div class="num">4</div></td><td data-grp='9' data-col='8'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='9' data-col='9' class='fx'><div class="num">8</div></td></tr>
<tr>
<td data-grp='7' data-col='1'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='7' data-col='2' class='fx'><div class="num">6</div></td><td data-grp='7' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='4'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='6'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='9' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='9' data-col='8' class='fx'><div class="num">1</div></td><td data-grp='9' data-col='9'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td></tr>
<tr>
<td data-grp='7' data-col='1' class='fx'><div class="num">2</div></td><td data-grp='7' data-col='2' class='fx'><div class="num">8</div></td><td data-grp='7' data-col='3'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='4' class='fx'><div class="num">6</div></td><td data-grp='8' data-col='5'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='8' data-col='6' class='fx'><div class="num">1</div></td><td data-grp='9' data-col='7'><div class="num"><table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table></div></td><td data-grp='9' data-col='8' class='fx'><div class="num">7</div></td><td data-grp='9' data-col='9' class='fx'><div class="num">9</div></td></tr>
</tbody>
</table>

<?php 
//var_dump($table2);exit;
//echo count($table2);
//var_dump($table2);
echo "<table id='np'>\n";
echo "<tbody>\n";
foreach($table2 as $row){
    echo "<tr>\n";
    foreach($row as $cell){
        //var_dump($cell);
        $td_obj = "";
        $td_obj = isset($cell["data-col"])? " data-col='".$cell["data-col"]."'" :"";
        $td_obj .= isset($cell["data-grp"])? " data-grp='".$cell["data-grp"]."'" :"";
        echo isset($cell["class"])? "<td $td_obj class='".$cell["class"]."'>" : "<td>";
        echo isset($cell["data"])? "<div class='num'>" . $cell["data"] . "</div>" : "";
        echo "</td>";
    }
    echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>\n";
?>
</div>

<div id="sub" class="span6">
    <div id="num-select"><div>
	<a href="#" data-num="1"><img src="/img/play/numberplace/num_1.png" data-active-src="/img/play/numberplace/num_1_f.png" /></a>
	<a href="#" data-num="2"><img src="/img/play/numberplace/num_2.png" data-active-src="/img/play/numberplace/num_2_f.png" /></a>
	<a href="#" data-num="3"><img src="/img/play/numberplace/num_3.png" data-active-src="/img/play/numberplace/num_3_f.png" /></a>
    </div><div>
	<a href="#" data-num="4"><img src="/img/play/numberplace/num_4.png" data-active-src="/img/play/numberplace/num_4_f.png" /></a>
	<a href="#" data-num="5"><img src="/img/play/numberplace/num_5.png" data-active-src="/img/play/numberplace/num_5_f.png" /></a>
	<a href="#" data-num="6"><img src="/img/play/numberplace/num_6.png" data-active-src="/img/play/numberplace/num_6_f.png" /></a>
    </div><div>
	<a href="#" data-num="7"><img src="/img/play/numberplace/num_7.png" data-active-src="/img/play/numberplace/num_7_f.png" /></a>
	<a href="#" data-num="8"><img src="/img/play/numberplace/num_8.png" data-active-src="/img/play/numberplace/num_8_f.png" /></a>
	<a href="#" data-num="9"><img src="/img/play/numberplace/num_9.png" data-active-src="/img/play/numberplace/num_9_f.png" /></a>
    </div></div>
    <div id="commands">
	<a href="#" id="num-set" class="active"><img src="/img/play/numberplace/button_honoki_f.png" /></a><br>
	<a href="#" id="num-undo"><img src="/img/play/numberplace/button_undo.png" data-active-src="/img/play/numberplace/button_undo_f.png" /></a>
	<a href="#" id="num-clear"><img src="/img/play/numberplace/button_delete.png" data-active-src="/img/play/numberplace/button_delete_f.png" /></a><br>
	<a href="#" id="num-memo"><img src="/img/play/numberplace/button_memo.png" /></a><br>
    </div>
</div>

	<?php if(!strstr ($_SERVER['HTTP_USER_AGENT'], "spass-app")){?>
<div id="alert"><div>
    <h3>注意！</h3>
    ブラウザバックで戻ると回答データが保存されません。<br>
    「オプション」より【保存して中断】を選択してください。<br>
    ※データ保存はパズルメイト会員のみの機能です。<br>
</div></div>
<div id="alert">
	<a href="#" id="option"><img src="/img/play/button_option.png" data-active-src="/img/play/button_option_f.png" STYLE="height: 26px;" /></a>
	<a href="#" id="answer-check"><img src="/img/play/button_answer.png" data-active-src="/img/play/button_answer_f.png" STYLE="height: 26px;" /></a>
</div>
<footer>
        <?php if ($entry_id): ?>
	<a href="" class="back_entry"><img src="/img/play/button_back.png" data-active-src="/img/play/button_back_f.png"></a>
		<?php else: ?>
	<a href="" class="back"><img src="/img/play/button_back.png" data-active-src="/img/play/button_back_f.png"></a>
		<?php endif ?>
</footer>
<?php }?>
</div>

<div id="result-confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="result-confirm-label" aria-hidden="true">
	<h2>答え合わせをしますか？</h2>
	<a href="#" class="dismiss" data-dismiss="modal"></a>
	<div class="modal-inner">
		<a href="#" class="btn2" id="answer-check-yes"><img src="/img/dialog/ok_f.png" data-active-src="/img/dialog/ok.png"></a>
		<a href="#" class="btn2" id="answer-check-no"><img src="/img/dialog/no_f.png" data-active-src="/img/dialog/no.png"></a>
	</div>
</div>

<div id="result-ok" class="modal hide fade result" tabindex="-1" role="dialog" aria-hidden="true">
	<h2 style="text-align:left;left:2em;">結果表示</h2>
	<div class="modal-inner">
        <?php if ($entry_id): ?>
		<h2><img src="/img/dialog/clear.png"></h2>
		<a href="/entry/input" class="btn2"><img src="/img/dialog/present_oubo.png" data-active-src="/img/dialog/present_oubo_f.png"></a>	
		<a href="/entry/lp" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
		<?php else: ?>
        <div id="clear_time">
            <dl><dt>クリアタイム</dt>
            <dd></dd></dl>
            <img src="/img/dialog/high_score.png" style="opacity:0;width:70%">
        </div>
		<a href="#" class="btn2"><img src="/img/dialog/face_f.png" data-active-src="/img/dialog/face.png"></a>
        <a href="/rank/index/numberplace" class="btn2"><img src="/img/dialog/ranking.png" data-active-src="/img/dialog/ranking_f.png"></a>
		<a href="/numberplace/select" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
		<?php endif ?>
	</div>
</div>

<div id="result-ng" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<h2><img src="/img/dialog/not_clear.png"></h2>
	<div class="modal-inner">
		<a href="#" class="btn2" id="game" data-dismiss="modal"><img src="/img/dialog/game_f.png" data-active-src="/img/dialog/game.png"></a>
        <?php if ($entry_id): ?>
		<a href="/entry/lp" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
		<?php else: ?>
		<a href="/numberplace/select" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
		<?php endif ?>
	</div>
</div>

<div id="dialog-option" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
	<h2>オプション</h2>
	<div class="modal-inner">
        <?php if ($entry_id): ?>
			<a href="#" class="btn2" id="save_entry"><img src="/img/dialog/save_f.png" data-active-src="/img/dialog/save.png"></a>
			<a href="#" class="btn2" id="restart_entry"><img src="/img/dialog/restart_f.png" data-active-src="/img/dialog/restart.png"></a>
		<?php else: ?>
			<?php ////if ($this->is_login): ?>
			<a href="#" class="btn2" id="save"><img src="/img/dialog/save_f.png" data-active-src="/img/dialog/save.png"></a>
			<?php ////else: ?>
			<a class="btn2"><img src="/img/dialog/save_gray.png"></a>
			<p style="margin:-2em auto;font-size:xx-small">パズルメイト会員になると<br>ゲームの途中保存が可能です！</p>
			<?php ////endif ?>
			<a href="#" class="btn2" id="restart"><img src="/img/dialog/restart_f.png" data-active-src="/img/dialog/restart.png"></a>
		<?php endif ?>
	</div>
</div>
