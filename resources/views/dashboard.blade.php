@extends('layout.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                @include('ideas.shared.submit-idea')
                <hr>
                @forelse ($ideas as $idea)
                    @include('ideas.shared.idea-card')
                @empty
                    <p class="text-center my-3">No Ideas Found</p>
                @endforelse
                <div class="mt-3">
                    {{ $ideas->withQueryString()->links() }}
                </div>
            </div>
            <div class="col-3">
                {{-- search bar and follow box --}}
                @include('shared.search-bar')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
