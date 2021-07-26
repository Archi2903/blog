@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="coll-md-12">
                <nav class="navbar navbar-toggler-md navbar-dark bg-dark">
                    <a href="{{route('blog.admin.categories.create')}}" class="btn btn-primary">Add category</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Parent</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <a href="{{route('blog.admin.categories.edit', $item)}}">{{$item->title}}</a>
                                    </td>
                                    <td @if(in_array($item->parent_id,[0,1])) style="color: #ffe924"@endif>
                                        {{$item->parentCategory->title ?? '?'}}

{{--                                        {{$item->parentTitle}}--}}
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
