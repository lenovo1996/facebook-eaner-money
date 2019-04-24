@extends('user.layout')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary" style="display:none">
            <div class="panel-heading">Nhiệm vụ 1</div>
            <div class="panel-body">
                <span class="pull-left">Đăng 1 bài lên tường (Tự động)</span>
                <span class="pull-right"><button class="btn btn sm btn-danger post">Bắt đầu</button></span>
            </div>
        </div>
        <div class="panel panel-primary" style="display:none">
            <div class="panel-heading">Nhiệm vụ 2</div>
            <div class="panel-body">
                <span class="pull-left">Tag 4 bạn bè 5 lần ở bài vừa đăng (Tự động)</span>
                <span class="pull-right"><button class="btn btn sm btn-danger tag">Bắt đầu</button></span>
            </div>
        </div>
        <div class="panel panel-primary" style="display:none">
            <div class="panel-heading">Nhiệm vụ 3</div>
            <div class="panel-body">
                <span class="pull-left">Comment và tag 4 bạn bè 5 lần ở bài viết của bạn bè (Tự động)</span>
                <span class="pull-right"><button class="btn btn sm btn-danger comment">Bắt đầu</button></span>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <input type="hidden" name="access_token" value="{{ session('access_token') }}">
	{{ csrf_field() }}
	<script src="/js/post.js"></script>
	<script src="/js/tag.js"></script>
@endsection