$(function(){
	$('img[data-active-src]').each(function(){
		// 差し替え用画像のプリロード
		new Image().src = $(this).attr('data-active-src');
		// 元に戻す時用に元のsrcを別名で保持
		$(this).attr('data-default-src', $(this).attr('src'));
	}).bind('mouseover touchstart', function(){
		// カーソル乗る or タッチスタートで画像差し替え
		$(this).attr('src', $(this).attr('data-active-src'));
	}).bind('mouseout touchend', function(){
		// カーソル出る or タッチエンドで画像差し替え
		$(this).attr('src', $(this).attr('data-default-src'));
	});
	$('img[data-toggle-src]').each(function(){
		// 差し替え用画像のプリロード
		new Image().src = $(this).attr('data-toggle-src');
		// 元に戻す時用に元のsrcを別名で保持
		$(this).attr('data-default-src', $(this).attr('src'));
		if ($(this).parent('a').hasClass('active')) {
			$(this).attr('src', $(this).attr('data-toggle-src'));
		}
	}).bind('click', function(){
		var src = $(this).parent('a').hasClass('active')
			? $(this).attr('data-default-src') : $(this).attr('data-toggle-src');
		$(this).attr('src', src).parent('a').toggleClass('active');
	});
});

