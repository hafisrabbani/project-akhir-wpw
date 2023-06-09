@extends('main.master.main')

@section('page-heading')
List Materi
@endsection

@section('page-content')
<section class="row">
    <div class="col-md-8">
        <div class="row">
            @foreach ($data as $lesson)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <img src="https://ui-avatars.com/api/?name={{ $lesson->lesson_name }}&color=ffffff&background=9694ff"
                                        alt="avatar" class="img-fluid rounded shadow-sm" />
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted mb-1">{{ $lesson->lesson_name }}</h6>
                                @if($lesson->attachment)
                                <div class="my-2">
                                    <a href="{{ asset('files/materi/' . $lesson->attachment) }}"
                                        class="p-2 badge text-bg-primary" target="_blank">Lihat File</a>
                                </div>
                                @endif
                                <p class="mb-0 text-sm">{{ $lesson->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
@endsection