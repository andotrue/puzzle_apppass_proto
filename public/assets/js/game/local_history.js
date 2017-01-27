function localHistory() {
    var key = $('#container').data().puzzleType+$('#container').data().puzzleId;
    //if (sessionStorage.length>=10) sessionStorage.pop();
    this._history = function() { return JSON.parse(sessionStorage.getItem(key)||'[]'); };
    this.get = function(flg) {
        var history = this._history();
        if (history.length<=0) {
			var ls_history = localStorage.getItem(key);
			if (ls_history == null) return false;
			$('#main').html(ls_history);
			return false;
		}
        if (flg) {
            history.shift();
            sessionStorage.setItem(key, JSON.stringify(history));
        }
        $('#main').html(history[0]);
    };
    this.set = function() {
        var history = this._history();
		history.unshift($('#main').html());
        //if (history.length>10) history = history.slice(0, 10);
        sessionStorage.setItem(key, JSON.stringify(history));
    };
	this.clear = function(flg) {
		sessionStorage.removeItem(key);
		if (flg) {
            localStorage.removeItem(key);
            localStorage.removeItem(key+'timer');
        }
	};
	this.save = function() {
		localStorage.setItem(key, $('#main').html());
        this.timer('o');
		this.clear();
	};
    this.get(); this.set();
    var timer_id;
    this.timer = function(flg) {
        if (flg != 'i' && flg != 'o') return false;
        if (flg == 'i') {
            var $this = this;
            timer_id = setInterval(function(){
                var time = $this.time(),
                    h = (time / (1000 * 60 * 60)|0),
                    m = ((time - h*1000*60*60) / (1000 * 60)|0),
                    s = ((time - h*1000*60*60 - m*1000*60) / 1000|0);
                document.getElementById('timer').innerHTML = '' +
                    (h<10? '0' : '') + h + ':' +
                    (m<10? '0' : '') + m + ':' +
                    (s<10? '0' : '') + s;
            }, 1000);
        }
        var records = JSON.parse(localStorage.getItem(key+'timer')||'[]');
        records.push({ flg: flg, time: +new Date() });
        localStorage.setItem(key+'timer', JSON.stringify(records));
        return true;
    };
    this.time = function() {
        var records = JSON.parse(localStorage.getItem(key+'timer')||'[]');
        if (records.length <= 0) return false;
        records.push({ flg: 'o', time: +new Date() });
        var score = 0, _in = 0;
        for (i in records) {
            if (records[i].flg == 'i') {
                if (_in == 0) _in = records[i].time;
            } else if (records[i].flg == 'o') {
                if (_in != 0) {
                    score += records[i].time - _in;
                    _in = 0;
                } else return false;
            }
        }
        return score;
    };
    this.stopTimer = function() {
        clearInterval(timer_id);
    };
};
var dummy = function() {
    this.set = this.get = this.clear = function(){};
    this.save = this.timer = this.time = function(){};
};
