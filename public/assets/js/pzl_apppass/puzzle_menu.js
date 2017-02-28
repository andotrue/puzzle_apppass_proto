$(function(){

$('.puzzle').height($('.puzzle').width() + 20);
var star_size = $('.puzzle').width() / 4|0;
$('.puzzle .stars img').css({ width: star_size, height: star_size });

});
