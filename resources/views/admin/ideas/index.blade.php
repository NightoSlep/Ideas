@extends('layout.layout')
@section('title', 'Admin Ideas Dashboard')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('admin.shared.left-sidebar')
            </div>
            <div class="col-9">
                <h1>IDEA</h1>
                <table class="table table-striped mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Content</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ideas as $idea)
                            <tr>
                                <td>{{ $idea->id }}</td>
                                <td>{{ $idea->user->name }}</td>
                                <td>{{ $idea->content }}</td>
                                <td>{{ $idea->created_at->toDateString() }}</td>
                                <td>
                                    <a href=" {{ route('ideas.show', $idea->id) }} ">View</a>
                                    <a href=" {{ route('ideas.edit', $idea->id) }} ">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div> {{ $ideas->links() }} </div>
            </div>
        </div>
    </div>
@endsection
