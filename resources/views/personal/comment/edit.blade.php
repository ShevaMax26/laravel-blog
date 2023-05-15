@extends('personal.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Comments</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Home</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('personal.comment.update', $comment->id) }}" method="post" class="w-50">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <textarea name="message" class="form-control" rows="10">{{ $comment->message }}</textarea>

                            @error('message')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-warning mt-3 pl-4 pr-4">Update</button>
                        </div>
                    </form>
                </div>
                <!-- Info boxes -->

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
