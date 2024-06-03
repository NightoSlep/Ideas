@extends('layout.layout')

@section('title', 'Edit Profile')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                <div class="mt-3">
                    @include('user.shared.user-edit-card')
                </div>
                <hr>
                @forelse ($user->ideas as $idea)
                    @include('ideas.shared.idea-card')
                @empty
                    <p class="text-center my-3">No Results Found</p>
                @endforelse
            </div>
            <div class="col-3">
                {{-- search bar and follow box --}}
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
