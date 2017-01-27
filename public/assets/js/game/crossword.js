$(function(){

    setTimeout(function(){
(function(w){
	w=(w|0); $('head').append('<style id="tr-height">' +
		'#cw>tbody>tr{height:'+w+'px;line-height:'+w+'px;}' +
		//'#cw>tbody>tr:not(:first-of-type){height:'+w+'px;line-height:'+w+'px;}' +
		'.word,#cw input{font-size:'+(w*.7|0)+'px;line-height:'+(w*.7|0)+'px}' +
	'</style>');
})($('#cw td').eq(3).width());
}, 200);

var _h = new localHistory();
_h.timer('i');

$('#cw input')
	.live('focus', function(){
        $('.popover').remove();
		if ($(this).parent().find('.cell-no').length>0) {
			var cell_no = $(this).parent().find('.cell-no').data().cellNo;
			var placement = $('#cw tr').index($(this).parents('tr')) >= $('#cw tr').length / 2? 'top' : 'bottom';
            var cell_index = $('#cw td').index($(this).parent('td'));
			$(this).popover({
				content: function(){
                    var vk = $('#vk [data-answer-no="' + cell_no + '"]').text(),
                        hk = $('#hk [data-answer-no="' + cell_no + '"]').text(),
                        vkt = (vk)? '<a href="#" id="vnb' + cell_index + '">縦のカギ</a>' : '縦のカギ',
                        hkt = (hk)? '<a href="#" id="hnb' + cell_index + '">横のカギ</a>' : '横のカギ';
                    return '' +
					    '<div class="vk">' + vkt + ')<span>' + vk + '</span></div>' +
					    '<div class="hk">' + hkt + ')<span>' + hk + '</span></div>';
				},
				placement: placement, trigger: 'manual', html: true
			});
            $this = $(this);
            setTimeout(function() { $this.popover('show'); }, 100);
			//
		}
	})
	.live('change', function(){
        if ($(this).val()==' ' || $(this).val()=='　') $(this).val('');
        $(this).attr('value', $(this).val()); _h.set();
    })
	//.live('mouseup touchend', function(){ $(this).select(); });
$('[id^="vnb"],[id^="hnb"]').live('click', function() {
    $('.popover').eq(1).remove();
    var direction  = $(this).attr('id').substr(0, 1),
        cell_index = $(this).attr('id').substr(3),
        nb_class   = $(this).attr('id');
    $(this).popover({
        content: '<div class="input-append"><input type="text" style="width:60%">' +
                 '<button class="btn ' + nb_class + '">連続入力</button></div>' +
                 '既に入力済みのマスは上書きされます',
        html: true, placement: 'bottom', trigger: 'manual'
    }).popover('show');
    setTimeout(function() { $('.popover input[type="text"]').focus(); }, 200);
    $('button.' + nb_class).live('click', function() {
        var value = $(this).prev().val();
            step  = (direction=='v')? $('#cw tr:first td').length : 1;
        for (i=0;i<=value.length;i++) {
            var cell = $('#cw tr td').eq((cell_index*1) + (step*i));
            if (cell.find('input').length >= 1) cell.find('input').attr('value', value[i]);
            else break;
        }
        $('.popover').remove();
        _h.set();
    });
});

$('#num-clear').click(function(){
});
$('#num-undo').click(function(){ _h.get(true); });

$('#option').click(function(){
	$('#dialog-option').modal('show');
});
$('#save,a.back').click(function(){ event.preventDefault(); _h.save(); location.href = '/top/menu'; });
$('#restart').click(function(){ _h.clear(true); location.href = '/crossword/reset/' + $('#container').data().puzzleId; });

$('#save_entry,a.back_entry').click(function(){ event.preventDefault(); _h.save(); location.href = '/entry/lp'; });
$('#restart_entry').click(function(){ _h.clear(true); location.href = '/crossword/reset_entry/' + $('#container').data().puzzleId + '/' + $('#container').data().entryId; });


$('#answer-check').click(function(){
	$('#result-confirm').modal('show');
});
$('#answer-check-no').click(function(){
	$('#result-confirm').modal('hide');
});
$('#answer-check-yes').click(function(){
	$('#result-confirm').modal('hide');
	var answer = $('#answer').val();
    if ($('#new-ans td div').length>0) {
        answer = '';
        for (var i=0; i<$('#new-ans td div').length; i++) {
            answer += $('#new-ans td div')[i].innerHTML;
        }
    }
	$.ajax({
		url:	'/crossword/finish/' + $('#container').data().puzzleId,
		//data:	{ answer: answer, timestamp: $('#container').data().puzzleTimestamp },
		data:	{ answer: answer, score: _h.time() },
		type:	'POST',
		dataType:	'json',
		error:	function(xhr, stat, err) {
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

});
