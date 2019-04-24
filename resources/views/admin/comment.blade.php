@extends('admin.layout')

@section('content')
    <div class="col-md-12">
        <button class="btn btn-primary" data-toggle="modal" data-target="#postModal">Thêm Comment</button>
    </div>

    @foreach($share as $item)
        <div class="col-md-3">
            <div class="layers bd bgc-white p-20">
                <div class="layer w-100">
                    {!! nl2br(e(substr($item->message, 0, 200))) !!}...
                    <hr>
                    <a class="btn btn-danger" href="/adm/comment/{{ $item->id }}">Xóa</a>
                </div>
            </div>
        </div>

    @endforeach
    <div class="col-md-12">
        {!! $share->links() !!}
    </div>


    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Thêm Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form id="add-post">
                        <input type="hidden" class="form-control" name="_token"
                               value="{{ csrf_token() }}">
                        <div class="form-group col col-md-12">
                            <label for="">Message:</label>
                            <textarea type="text" class="form-control" name="message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $('#save').click(function () {
            var form = $('#add-post');

            var data = {};
            form.find('[name]').each(function (key, value) {
                var name = $(value).attr('name');
                var val = $(value).val();

                data[name] = val;
            });

            $.post('/adm/comment', data).then(function () {
                location.reload();
            });
        });
    </script>
@endsection