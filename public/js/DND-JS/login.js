$(document).ready(function() {
	$('.guest-btn').click(function() {
		$(location).attr('href','/');
	});
    $('.password-btn').click(function() {
		$(location).attr('href','/find_pw');
	});
    $('.join-btn').click(function() {
		$(location).attr('href','/join');
	});
});
