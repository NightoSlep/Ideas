@extends('layout.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                <h1>Terms</h1>
                <div class="container py-4">
                    <div>comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good
                        and Evil)
                        by
                        Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the
                        Renaissance.
                        The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                    </div>
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
