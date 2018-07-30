@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                {{--<div class="text-center">--}}
                {{--<img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" width="120" class="img-circle"--}}
                {{--alt="">--}}
                {{--<form method="post" action="{{route('user.change.avatar')}}" enctype="multipart/form-data">--}}
                {{--{!! csrf_field() !!}--}}
                {{--<input type="file" name="avatar">--}}


                {{--<button type="submit" class="btn btn-primary form-control">上传头像</button>--}}
                {{--</form>--}}
                {{--</div>--}}

                <div class="text-center">
                    <div id="validation-errors"></div>
                    <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" width="120" class="img-circle"
                         id="user-avatar" alt="">
                    <form method="post" action="{{route('user.change.avatar')}}" enctype="multipart/form-data"
                          id="avatar">
                        {!! csrf_field() !!}

                        <div class="text-center">
                            <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像
                            </button>
                        </div>
                        <input type="file" name="avatar" id="image" class="avatar">

                    </form>
                    <div class="span5">
                        <div id="output" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            var options = {
                beforeSubmit: showRequest,
                success: showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function () {
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });
        });

        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display', 'none');
            return true;
        }

        function showResponse(response) {
            if (response.success === false) {
                var responseErrors = response.errors;
                $.each(responseErrors, function (index, value) {
                    if (value.length !== 0) {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
                $('#user-avatar').attr('src', response.avatar);
                $('#upload-avatar').html('成功');
            }
        }
    </script>
@endsection