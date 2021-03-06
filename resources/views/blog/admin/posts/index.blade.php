@extends('layouts.app')
@section('content')
    <div class="container">
        @include('blog.admin.posts.includes.result_messages')
        <div class="row justify-content-center">
            <div class="coll-md-12">
                <nav class="navbar navbar-toggler-md navbar-dark bg-dark">
                    <a href="{{route('blog.admin.posts.create')}}" class="btn btn-primary">Write</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Date published</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $post)
                                <tr @if(!$post->is_published) style="background-color: #ccc;" @endif>
                                    <td>{{$post->id}}</td>
{{--                                    // Простой запрос к таблице blog_post--}}
{{--                                    <td>{{$post->user_id}}</td>--}}
{{--                                    <td>{{$post->category_id}}</td>--}}

{{-- Запрос через связанные таблицы к user и blog_category (но подгружает сервер,нужна оптимизация ,в репозиторие) --}}
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->category->title}}</td>
                                    <td>
                                        <a href="{{route('blog.admin.posts.edit',$post->id)}}">{{$post->title}}</a>
                                    </td>
                                    <td>
                                        {{$post->published_at ? \Carbon\Carbon::parse($post->published_at)
                                           ->format('d.M H:i') : ''}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($paginator ->total() > $paginator->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{$paginator->links()}}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
