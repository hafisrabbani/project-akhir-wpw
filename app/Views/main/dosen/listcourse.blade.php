@extends('main.master.main')

@section('page-heading')
List Course
@endsection

@section('page-content')
<section class="row">
    <div class="col-12">
        <div class="row">
            @foreach($data as $course)
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('list-course.detail', ['id' => $course->course_id]) }}">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <img src="https://ui-avatars.com/api/?name={{ $course->course_name }}&color=ffffff&background=9694ff"
                                            alt="avatar" class="img-fluid rounded shadow-sm" />
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted mb-1">{{ $course->course_name }}</h6>
                                    <h6 class="mb-0 text-sm"><small>{{ $course->description }}</small></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection