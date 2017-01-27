$(function(){
    setTimeout(function(){
        if ($('#new-ans').length < 1) {
            $('#cw').after(new_ans);
        }
        //$('#new-ans table').width($('#cw tr').height()*2);
        //var _x = $('#cw td').height() + 3;
        var _x = $('#new-ans').width() * .6;
        $('#new-ans div').css({
            width: _x, height: _x,
            lineHeight: _x+'px',
            fontSize: _x * .8
        });
        scrollBy(0, 1);
    }, 100);
    var _h = new localHistory();

    // inputタグのフォーカス無効化
    $('#cw input').attr('disabled', 'disabled');
    // 独自キーボード入力待ち
    $('#cw input').live('mousedown touchstart', function(){
    });
    var current_key = null, current_cell = 0,
        last_cell_h = $('#cw input').length - 1,
        vector = 'h', cells = $('#cw td').length,
        line_cell_cnt = Math.sqrt(cells),
        last_cell_v = (function(){
            for (i=cells-1; i>line_cell_cnt; i-=line_cell_cnt) {
                if ($('#cw td:eq('+i+')').children('input').length>0)
                    return $('#cw input').index($('#cw td:eq('+i+')').children('input'));;
            }
        })();
    var chars = {
        'kb-a': ['ア', 'イ', 'ウ', 'エ', 'オ'],
        'kb-k': ['カ', 'キ', 'ク', 'ケ', 'コ'],
        'kb-s': ['サ', 'シ', 'ス', 'セ', 'ソ'],
        'kb-t': ['タ', 'チ', 'ツ', 'テ', 'ト'],
        'kb-n': ['ナ', 'ニ', 'ヌ', 'ネ', 'ノ'],
        'kb-h': ['ハ', 'ヒ', 'フ', 'ヘ', 'ホ'],
        'kb-m': ['マ', 'ミ', 'ム', 'メ', 'モ'],
        'kb-y': ['ヤ', 'ユ', 'ヨ'],
        'kb-r': ['ラ', 'リ', 'ル', 'レ', 'ロ'],
        'kb-w': ['ワ', 'ヲ', 'ン', 'ー'],
        'kb-br': ['ー'],
    };
    var sp_chars = [
        'ウカキクケコサシスセソタチツテトハヒフヘホバビブベボパピプペポ',
        'ヴガギグゲゴザジズゼゾダヂヅデドバビブベボパピプペポハヒフヘホ'
    ];
    function henkan(c) {
        n = sp_chars[0].indexOf(c, 0);
        if (n >= 0) c = sp_chars[1].charAt(n);
        else {
            n = sp_chars[1].indexOf(c, 0);
            if (n >= 0) c = sp_chars[0].charAt(n);
        }
        return c;
    }
    function selected() {
        $('#cw input').parent('td').removeClass('selected');
        var tgt_td = $('#cw input:eq('+current_cell+')').parent('td');
        tgt_td.addClass('selected');

        var has_no = tgt_td.find('.cell-no');
        if (has_no.length > 0) {
        var cell_no = tgt_td.find('.cell-no').data().cellNo;
            var hint_id = '#'+vector+'k';
            var k = $(hint_id+' [data-answer-no="' + cell_no + '"]').text();
            $('#new-hint > div').text(k);
            if (k.length >= 19) {
                setTimeout(function() {
                    $('#new-hint > div').html('<marquee>'+k+'</marquee>');
                }, 3000);
            }
        }
        $('#cw td').css('background-color', '');
        $('#cw td').removeClass('selected-line');
        if (vector=='h') {
            tgt_td.addClass('selected-line');
            var r_td = tgt_td, l_td = tgt_td;
            for (var i=0; i<line_cell_cnt; i++) {
                if (r_td != null) {
                    r_td = r_td.next('td');
                    if (r_td.find('input').length>0) {
                        r_td.addClass('selected-line');
                    } else r_td = null;
                }
                if (l_td != null) {
                    l_td = l_td.prev('td');
                    if (l_td.find('input').length>0) {
                        l_td.addClass('selected-line');
                    } else l_td = null;
                }
            }
        } else {
            tgt_td.addClass('selected-line');
            var t_idx = $('#cw td').index(tgt_td),
                b_idx = $('#cw td').index(tgt_td);
            for (var i=1; i<=line_cell_cnt; i++) {
                if (t_idx != null) {
                    t_idx = t_idx-line_cell_cnt;
                    if (t_idx >= 0) {
                        if ($('#cw td:eq('+t_idx+')').find('input').length>0) {
                            $('#cw td:eq('+t_idx+')').addClass('selected-line');
                        } else t_idx = null;
                    } else t_idx = null;
                }
                if (b_idx != null) {
                    b_idx = b_idx+line_cell_cnt;
                    if (b_idx <= cells) {
                        if ($('#cw td:eq('+b_idx+')').find('input').length>0) {
                            $('#cw td:eq('+b_idx+')').addClass('selected-line');
                        } else b_idx = null;
                    } else b_idx = null;
                }
            }
        }
    }
    selected();
    var touch = ('ontouchstart' in window)
        ? { start: 'touchstart', end: 'touchend' }
        : { start: 'mousedown', end: 'mouseup' };
    $('#kb-main > div')
        .live(touch.start, function(){
            $(this).addClass('active');
        })
        .live(touch.end, function(e){
            var line = chars[$(this).attr('id')];
            var val = '';
            if (line == undefined) val = '';
            if (current_key == null) {
                val = line[0];
                current_key = $(this).attr('id');
            } else if ($(this).attr('id') == current_key) {
                var current_val = $('#cw input').get(current_cell).value;
                for (i in line) {
                    if (current_val == line[i]) {
                        val = (i<line.length-1)? line[++i] : line[0];
                    }
                }
                if (val == '') val = line[0];
            } else {
                if ($(this).attr('id')=='kb-bl') {
                    var current_val = $('#cw input').get(current_cell).value;
                    if (current_val) val = henkan(current_val);
                } else {
                    val = line[0];
                    if (vector == 'h') {
                        if (current_cell == last_cell_h) {
                            current_cell = 0;
                        } else current_cell++;
                    } else {
                        if (current_cell == last_cell_v) {
                            current_cell = 0;
                        } else {
                            current_cell = (function(){
                                var current_td = $('#cw td').index($('#cw input:eq('+current_cell+')').parent('td'));
                                for (i=current_td+line_cell_cnt; i<cells; i+=line_cell_cnt) {
                                    if ($('#cw td:eq('+i+')').children('input').length>0) {
                                        return $('#cw input').index($('#cw td:eq('+i+')').children('input'));
                                    }
                                }
                                for (i=1; i>=0; i++) {
                                    var x = current_td - (line_cell_cnt * (line_cell_cnt-i) - 1);
                                    if (x>0 && $('#cw td:eq('+x+')').children('input').length>0) {
                                        return $('#cw input').index($('#cw td:eq('+x+')').children('input'));
                                    }
                                }
                                return 0;
                            })();
                        }
                    }
                }
                selected();
            }
            $('#cw input:eq('+current_cell+')').attr('value', val);
            var td = $('#cw input:eq('+current_cell+')').parent('td');
            if (td.hasClass('ans')) {
                var td_idx = $('#cw td').index(td);
                //$('#new-ans input[name="ans_'+(++td_idx)+'"]').attr('value', val);
                $('#new-ans div[name="ans_'+(++td_idx)+'"]').text(val);
            }
            $(this).removeClass('active');
            if ($(this).attr('id')!='kb-bl') current_key = $(this).attr('id');
        _h.set();
        });

        $('#kb-change').click(function(){
            vector = (vector=='h')? 'v' : 'h';
            selected();
        });

        $('#kb-del').click(function(){
            $('#cw input:eq('+current_cell+')').attr('value', '');
            current_key = null;
        });

        $('#cur-left').click(function(){
            current_key = null;
            current_cell--;
            if (current_cell<0) current_cell = last_cell_h;
            selected();
        });
        $('#cur-right').click(function(){
            current_key = null;
            current_cell++;
            if (current_cell>last_cell_h) current_cell = 0;
            selected();
        });

        $('#cur-down').click(function(){
            current_key = null;
            if (current_cell >= last_cell_h) current_cell = 0;
            else current_cell = (function(){
                var current_td = $('#cw td').index($('#cw input:eq('+current_cell+')').parent('td'));
                for (i=current_td+line_cell_cnt; i<cells; i+=line_cell_cnt) {
                    if ($('#cw td:eq('+i+')').children('input').length>0) {
                        return $('#cw input').index($('#cw td:eq('+i+')').children('input'));
                    }
                }
                for (i=1; i>=0; i++) {
                    var x = current_td - (line_cell_cnt * (line_cell_cnt-i) - 1);
                    if (x>0 && $('#cw td:eq('+x+')').children('input').length>0) {
                        return $('#cw input').index($('#cw td:eq('+x+')').children('input'));
                    }
                }
                return 0;
            })();
            selected();
        });

        $('#cur-up').click(function(){
            current_key = null;
            if (current_cell <= 0) current_cell = last_cell_h;
            else current_cell = (function(){
                var current_td = $('#cw td').index($('#cw input:eq('+current_cell+')').parent('td'));
                for (i=current_td-line_cell_cnt; i>=0; i-=line_cell_cnt) {
                    if ($('#cw td:eq('+i+')').children('input').length>0) {
                        return $('#cw input').index($('#cw td:eq('+i+')').children('input'));
                    }
                }
                for (i=1; i>=0; i++) {
                    var x = current_td + (line_cell_cnt * (line_cell_cnt-i) - 1);
                    if (x>=0 && $('#cw td:eq('+x+')').children('input').length>0) {
                        return $('#cw input').index($('#cw td:eq('+x+')').children('input'));
                    }
                }
                return 0;
            })();
            selected();
        });

        $('#cw td').click(function(){
            current_key = null;
            if ($(this).find('input').length>0) {
                var td = $('#cw td').index(this);
                current_cell = $('#cw input').index($('#cw td:eq('+td+')').children('input'));
                selected();
            }
        });
});
