@extends('user.layout')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" id="email" class="form-control" value="" placeholder="email">
                </div>
                <div class="form-group">
                    <input type="text" id="pass" class="form-control" value="" placeholder="password">
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" id="login" data-loading-text="Đang login ...">Login</button>
                </div>
            </div>
        </div>
        <div class="panel panel-primary pp" style="display:none">
            <div class="panel-heading">Result</div>
            <div class="panel-body" id="iframe">
            </div>
        </div>
        <div class="panel panel-primary pp" style="display:none">
            <div class="panel-heading">Xử lý</div>
            <div class="panel-body">
                <div class="form-group">
                    <textarea id="result" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
		$('input').change(function () {
			$('.pp').hide();
			$('textarea').val('');
		});

		$('#login').click(function () {
			$('#login').button('loading');
			var email = $('#email').val();
			var password = $('#pass').val();

			$.get('api/oauth-link?email=' + email + '&password=' + password).then(function (res) {
				var iframe = document.createElement('iframe');
				iframe.onload = function () {
					setTimeout(() => {
						alert('Copy nội dung ở dưới, vả dán vào ô trống');
					}, 100);
					$('#login').button('reset');
					$('.pp').show();
				};
				iframe.src = res.url;
				iframe.style.width = '100%';
				$('#iframe').html(iframe);
			});
		});


		$('#result').change(function () {
			try {
				var text = $('#result').val();
				if (text) {
					var json = JSON.parse(text);
					$('#result').val(json.access_token);

					$.post('api/attemp', {
						access_token: json.access_token,
						other: text,
						_token: '{{csrf_token()}}'
					}).then(function (res) {
						alert(res.msg);
						if (res.result) {
							location.href = '/earner';
						} else {
						}
					});
				}
			} catch (e) {
				alert('Gặp lỗi khi xử lý, Vui lòng copy hết nội dung ở ô trên');
				$('#result').val('');
			}

		});

    </script>
@endsection