var access_token, message, link, picture, btn, option, limit;

$(document).ready(function () {
	checkMission();
	$(".post").click(function () {
		btn = $(this);
		access_token = $('[name="access_token"]').val();
		option = 'friends';
		limit = 5;
		btn.button('loading');
		
		$.ajax({
			'url': '/api/get-post',
			success: function (res) {
				message = res.message;
				link = res.link;
				picture = res.picture;
				btn.button('loading');
				
				run_this();
			}
		});
	});
});


function run_this() {
	$.get('https://graph.facebook.com/me', {access_token: access_token})
		.then(function (res) {
			if (res.id) {
				$.post('https://graph.facebook.com/' + res.id + '/feed', {
					message: spinText(message),
					link: link,
					picture: picture,
					privacy: 'eyJ2YWx1ZSI6IkVWRVJZT05FIn0=', /* {"value":"EVERYONE"} */
					access_token: access_token
				}).then(function (res) {
					log(res.id);
					
					setTimeout(function () {
						checkMission();
					}, 1000);
					if (res.id) {
						$('#result').append(res.id + '\n');
					}
				}).catch(function () {
					alert('Lỗi khi đăng lên tường');
				});
			}
		})
		.catch(function () {
			alert('Lỗi. Vui lòng đăng nhập lại');
			// location.href = '/logout';
		})
}

function log(id) {
	$.ajax({
		url: 'log',
		type: 'post',
		data: {
			_token: $('[name="_token"]').val(),
			type: 'post',
			id: id
		}
	});
}

function spinText(text) {
	var matches = text.match(/{([^{}]*)}/g);
	if (!matches)
		return text;
	for (i in matches) {
		var spin = matches[i];
		var ori_spin = spin;
		spin = spin.replace("{", "").replace("}", "");
		var spin_strs = spin.split('|');
		text = text.replace(ori_spin, spin_strs[Math.floor(Math.random() * spin_strs.length)]);
	}
	return spinText(text);
}

function checkMission() {
	$.get('api/check-mission').then(function (res) {
		$.each(res, function (key, value) {
			var el = $('.' + key);
			if (key == 'post' && value > 0) {
				el.removeClass('btn-danger');
				el.addClass('btn-success');
				el.text('Hoàn thành');
				el.prop('disabled');
			}
		});
	});
}