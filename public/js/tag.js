var access_token, message, post_id, btn, option, limit = 2;
var delay_from = 5, delay_to = 10;
var dataFr = [];

$(".tag").click(function () {
        btn = $(this);
        access_token = $('[name="access_token"]').val();
        btn.button('loading');

        $.ajax({
            'url': '/api/get-comment',
            success: function (res) {
                btn.button('loading');
                message = res.message;
                post_id = res.post_id;
                run_this(0);
            }
        });

        function run_this(count) {
            checkMission();
            $.get('https://graph.facebook.com/me', {access_token: access_token})
                .then(function (res) {
                    getFriend(count);
                });
        }

        function getFriend(count) {
            if (count >= limit) {
                btn.button('reset');
                checkMission();
                return;
            }

            $.get('https://graph.facebook.com/fql', {
                access_token: access_token,
                q: 'select uid,name from user where uid in(select uid2 from friend where uid1 = me()) and can_post = 1 order by rand() desc limit 300'
            }).done(function (e) {
                start_comment(count, e.data);
            }).error(function () {
                if (count < 5) {
                    run_this(count + 1);
                } else {
                    btn.button('reset');
                }
            });
        }

        function start_comment(count, data) {
            var tag = '';
            var a = 0;

            $.each(data, function (key, value) {

                if (dataFr.indexOf(value.uid) != -1) {
                    return;
                }

                if (a >= 4) {
                    return;
                }
                a++;

                dataFr.push(value.uid);
                tag += '@[' + value.uid + ':0] + ';
            });

            $.ajax({
                url: 'https://graph.facebook.com/' + post_id + '/comments',
                data: {
                    message: message + ' ' + tag,
                    access_token: access_token
                },
                type: 'post',
                success: function (res) {
                    log(res.id);
                    var delay = Math.floor(Math.random() * (delay_to - delay_from + 1) + delay_from) * 1000;
                    $('#delay').html(delay / 1000 + 's');
                    setTimeout(function () {
                        run_this(count + 1);
                    }, delay);
                },
                error: function () {
                    run_this(count + 1);
                }
            });
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

        function checkMission() {
            $.get('api/check-mission').then(function (res) {

                var panelEl = $('.panel');

                for (var i = 0; i < res.mission; i++) {
                    $(panelEl[i]).show();
                }

                $.each(res, function (key, value) {
                    var el = $('.' + key);
                    if (el.length && value) {
                        el.removeClass('btn-danger');
                        el.addClass('btn-success');
                        el.text('Hoàn thành');
                        el.prop('disabled', true);
                    } else if (el.length && !value) {
                        el.prop('disabled', false);
                        el.removeClass('disabled');
                        el.text('Bắt đầu');
                    }
                });
            });
        }
    }
);