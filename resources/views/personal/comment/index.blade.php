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
                    <div class="col-12">
                        <div class="card col-6">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $comment->message }}</td>
                                            <td>
{{--                                                <a href="{{ route('admin.comment.show', $comment->id) }}" class="mr-3"><i class="far fa-eye"></i></a>--}}
                                                <a href="{{ route('personal.comment.edit', $comment->id) }}" class="text-success mr-3"><i class="fas fa-pen-alt"></i></a>
                                                <form action="{{ route('personal.comment.destroy', $comment->id) }}"
                                                      method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="bg-transparent border-0 p-0">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- Info boxes -->

            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
