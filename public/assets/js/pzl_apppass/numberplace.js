var table = '<table class="memo"><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td></tr></table>';
$(function(){

//var _h = new dummy();
var _h = new localHistory();
_h.timer('i');

var count_numbers = function() {
    var counts = {1:0, 2:0, 3:0, 4:0, 5:0, 6:0, 7:0, 8:0, 9:0};
    $('.num').each(function() {
        if ($('table', this).length <= 0) counts[$(this).text()]++;
    });
    $.each(counts, function(k, v) {
        if (v>=9) $('#num-select a[data-num="'+k+'"]').addClass('over');
        else $('#num-select [data-num="'+k+'"]').removeClass('over');
    });
};
count_numbers();

(function(w){ $('head').append('<style>#np>tbody>tr,#np td div{height:'+w+'px;line-height:'+w+'px}</style>'); })($('#np td').eq(0).width());
$('body').addClass('container-fluid');
$('#np *').live('click touchstart', function(){
	var td = $(this).hasClass('num')? $(this).parent('td') : ($(this).parent('.num').length>0? $(this).parent('.num').parent('td') : null);
	if (td==null) return;
    if (td.hasClass('fx')) return false;
    var c = td.data().col, g = td.data().grp;
    $('.selected').removeClass('selected');
    td.addClass('selected');
    $('td').removeClass('same');
    td.parent().find('td').addClass('same');
    $('td[data-col="'+c+'"], td[data-grp="'+g+'"]').addClass('same');
    $('.num').removeClass('same-number');
    var val = $('.num', td).text();
    if (val!='') $('.num').each(function() { if ($(this).text()==val) $(this).addClass('same-number'); });
	//event.preventDefault();
	//event.stopPropagation();
});
$('#num-select a').click(function(){
    if ($(this).hasClass('over')) return;
    var tgt = $('#np td.selected'),
		val = $(this).data().num;
    $('.num').removeClass('same-number');
    if ($('#num-set').hasClass('active')) {
        if (tgt.length!=1) return false;
        tgt.attr('class', 'selected same n-'+val);
        $('.num', tgt).text(val);
        if (val!='') $('.num').each(function() { if ($(this).text()==val) $(this).addClass('same-number'); });
    } else {
        if ($('table', tgt).length == 0)
            $('.num', tgt).html(table);
        var tgt2 = $('table', tgt).find('td').eq(val-1);
        $('table', tgt).find('td').eq(val-1).text(tgt2.text()==val?'':val);
    }
    count_numbers();
    _h.set();
});
$('#num-undo').click(function(){ _h.get(true); });
$('#num-clear').click(function(){
    $('.num').removeClass('same-number');
	$('#np td.selected div.num').html(table);
    count_numbers();
	_h.set();
});

$('#option').click(function(){
	$('#dialog-option').modal('show');
});
$('#save,a.back').click(function(){ event.preventDefault(); _h.save(); location.href = '/top/menu'; });
$('#restart').click(function(){ _h.clear(true); location.href = '/numberplace/reset/' + $('#container').data().puzzleId; });

$('#save_entry,a.back_entry').click(function(){ event.preventDefault(); _h.save(); location.href = '/entry/lp'; });
$('#restart_entry').click(function(){ _h.clear(true); location.href = '/numberplace/reset_entry/' + $('#container').data().puzzleId + '/' + $('#container').data().entryId; });

$('#answer-check').click(function(){
	$('#result-confirm').modal('show');
});
$('#answer-check-no').click(function(){
	$('#result-confirm').modal('hide');
});
$('#answer-check-yes').click(function(){
	$('#result-confirm').modal('hide');
	var answer = (function(){
		var r = '';
		$('#np .num').each(function(){
			if ($(this).find('table').length>0) {
				$('#sub').before('<div class="alert fade in">' +
					'<button type="button" class="close" data-dismiss="alert">×</button>' +
					'すべてのマスが埋まっていません' +
				'</div>');
				setTimeout(function(){ $('.alert').fadeOut(function(){ $(this).remove(); }); }, 2000);
				return false;
			}
			r += $(this).text();
		});
		return r;
	})();
	if (!answer) return false;
	$.ajax({
		url:	'/numberplace/finish/' + $('#container').data().puzzleId,
		//data:	{ answer: answer, timestamp: $('#container').data().puzzleTimestamp },
		data:	{ answer: answer, score: _h.time() },
		type:	'POST',
		dataType:	'json',
		error: function(xhr, stat, err) {
			$('<div>エラーが発生しました<br>'+stat+'</div>').insertAfter('#sub');
		},
		success: function(data, type) {
			// { correct: bool, clear_time: 'ms', high_score: bool, error: 'string' or null }
			if (data.error != null) {
				$('<div>エラーが発生しました<br>'+error+'</div>').insertBefore('#answer-input');
			}
			if (data.correct) {
                _h.stopTimer();
                $('#result-ok dd').text(data.clear_time);
                if (data.high_score) $('#clear_time img').css('opacity', 1);
                else $('#clear_time img').css('opacity', 0);
				$('#result-ok').modal('show');
				_h.clear();
			} else $('#result-ng').modal('show');
		}
	});
});

$('#num-set').click(function() {
    if ( ! $(this).hasClass('active')) {
        $(this).addClass('active');
        $('img', this).attr('src', '/img/play/numberplace/button_honoki_f.png');
        $('#num-memo').removeClass('active');
        $('#num-memo img').attr('src', '/img/play/numberplace/button_memo.png');
    }
});
$('#num-memo').click(function() {
    if ( ! $(this).hasClass('active')) {
        $(this).addClass('active');
        $('img', this).attr('src', '/img/play/numberplace/button_memo_f.png');
        $('#num-set').removeClass('active');
        $('#num-set img').attr('src', '/img/play/numberplace/button_honoki.png');
    }
});

});
