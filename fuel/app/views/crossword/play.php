<div class="row-fluid" id="container" data-puzzle-type="np" data-puzzle-id="<?= $puz_id ?>" data-puzzle-timestamp="<?= $timestamp ?>">

	<div id="main2" class="span6">
		<div id="hk">
			<?php foreach ($hk as $k => $v): ?><div data-answer-no="<?= $k ?>"><?= $v ?></div><?php endforeach ?>
		</div>
		<div id="vk">
			<?php foreach ($vk as $k => $v): ?><div data-answer-no="<?= $k ?>"><?= $v ?></div><?php endforeach ?>
		</div>
		<?////= $puzzle ?>


		<table id="cw">
		<tbody>
		<tr>
		<td class=''><div class="cell-no" data-cell-no="1">1</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><div class="cell-no" data-cell-no="2">2</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class='black'>&nbsp;</td><td class='ans'><div class="cell-no" data-cell-no="3">3</div><div class="ans-no" name="3">3</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><div class="cell-no" data-cell-no="4">4</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td></tr>
		<tr>
		<td class='black'>&nbsp;</td><td class=''><div class="cell-no" data-cell-no="5">5</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td></tr>
		<tr>
		<td class=''><div class="cell-no" data-cell-no="6">6</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class='black'>&nbsp;</td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class='black'>&nbsp;</td></tr>
		<tr>
		<td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class='black'>&nbsp;</td><td class='ans'><div class="cell-no" data-cell-no="7">7</div><div class="ans-no" name="1">1</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><div class="cell-no" data-cell-no="8">8</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td></tr>
		<tr>
		<td class='ans'><div class="cell-no" data-cell-no="9">9</div><div class="ans-no" name="2">2</div><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td><td class='black'>&nbsp;</td><td class=''><input type="text" maxlength="1" autocorrect="off" name="cells[]" /></td></tr>
		</tbody>
		</table>
		

		<div id="new-ans"><table><?php foreach ($answer_cells as $idx => $ac): ?>
					<?php if ($ac): ?><tr><td><div name="ans_<?= $ac ?>" title="<?= $idx+1 ?>"></div></td></tr><?php endif ?>
				<?php endforeach ?></table></div>
	</div>

	<div id="kb">
		<div id="timer">00:00:00</div>
		<div id="new-hint" style="display:block;"><div></div></div>
		<div id="kb-left">
			<div id="cur-up"></div>
			<div id="cur-left"></div>
			<div id="cur-down"></div>
		</div><div id="kb-main"><!--
line 1st
     --><div id="kb-a" title="ア"></div><!--
     --><div id="kb-k" title="カ"></div><!--
     --><div id="kb-s" title="サ"></div><!--
     --><!--
line 2nd
     --><div id="kb-t" title="タ"></div><!--
     --><div id="kb-n" title="ナ"></div><!--
     --><div id="kb-h" title="ハ"></div><!--
     --><!--
line 3rd
     --><div id="kb-m" title="マ"></div><!--
     --><div id="kb-y" title="ヤ"></div><!--
     --><div id="kb-r" title="ラ"></div><!--
     --><!--
line 4th
     --><div id="kb-bl" title="ﾞ ﾟ"></div><!--
     --><div id="kb-w" title="ワ"></div><!--
     --><div id="kb-br" title="ー"></div>
		</div><div id="kb-right">
			<div id="kb-del"></div>
			<div id="cur-right"></div>
			<div id="kb-change"></div>
		</div>
	</div>

	<div id="sub" class="span6">
		<img src="/img/play/text.png">
		<div class="input-prepend" id="answer-input">
			<span class="add-on">こたえ</span>
			<input class="span12" id="answer" type="text">
		</div>
		<a href="#" id="num-undo"><img src="/img/play/numberplace/button_undo.png" data-active-src="/img/play/numberplace/button_undo_f.png" /></a>
	</div>

	<table style="width:80%;margin:2px auto"><tr>
			<td style="text-align:center"><a href="#" id="option"><img src="/img/kbd/btn_option.png" data-active-src="/img/kbd/btn_option_f.png" /></a></td>
			<td style="text-align:center"><a href="#" id="answer-check"><img src="/img/kbd/btn_answer.png" data-active-src="/img/kbd/btn_answer_f.png" /></a></td>
		</tr></table>

	<?php if(!strstr ($_SERVER['HTTP_USER_AGENT'], "spass-app")){?>
	<div id="alert">
		<div>
			<h3>注意！</h3>
			ブラウザバックで戻ると回答データが保存されません。<br>
			「オプション」より【保存して中断】を選択してください。<br>
			※データ保存はパズルメイト会員のみの機能です。<br>
		</div>
		<footer>
			<a href="" class="back"><img src="/img/play/button_back.png" data-active-src="/img/play/button_back_f.png"></a>
		</footer>
	</div>
	<?php } ?>
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
        <a href="/rank/index/crossword" class="btn2"><img src="/img/dialog/ranking.png" data-active-src="/img/dialog/ranking_f.png"></a>
		<a href="/crossword/select" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
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
		<a href="/crossword/select" class="btn2"><img src="/img/dialog/menu_f.png" data-active-src="/img/dialog/menu.png"></a>
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
			<?php /////if ($this->is_login): ?>
			<a href="#" class="btn2" id="save"><img src="/img/dialog/save_f.png" data-active-src="/img/dialog/save.png"></a>
			<?php ////else: ?>
			<a class="btn2"><img src="/img/dialog/save_gray.png"></a>
			<p style="margin:-2em auto;font-size:xx-small">パズルメイト会員になると<br>ゲームの途中保存が可能です！</p>
			<?php ////endif ?>
			<a href="#" class="btn2" id="restart"><img src="/img/dialog/restart_f.png" data-active-src="/img/dialog/restart.png"></a>
		<?php endif ?>
	</div>
</div>

<script>var new_ans = $('#new-ans');</script>
