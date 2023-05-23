@extends('main.master.main')

@section('page-heading')
    Dashboard
@endsection

@section('page-content')
    <section class="row">
        @if (session()->get('user')->roles->role_name == 'dosen')
            @include('main.dashboard.dosen')
        @else
            @include('main.dashboard.admin')
        @endif
    </section>
@endsection
