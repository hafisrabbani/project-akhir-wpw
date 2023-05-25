@extends('main.master.main')

@section('page-heading')
    List Kelas
@endsection

@section('page-content')
    <section class="row">
        <div class="col-md-8">
            <div class="row">
                @foreach ($data as $course)
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ $course->courses->course_name }}&color=ffffff&background=9694ff"
                                                alt="avatar" class="img-fluid rounded shadow-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted mb-1">{{ $course->courses->course_name }}</h6>
                                        <h6 class="mb-0 text-sm"><small>{{ $course->courses->description }}</small></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-info mb-2"
                                            href="{{ route('mhs.list-assignment', ['id' => $course->course_id]) }}"
                                            style="width: 100%;" type="button"><small><i
                                                    class="fas fa-tasks"></i></small></a>
                                    </div>
                                    <div class="col-6">
                                        <a class="btn btn-warning mb-2"
                                            href="{{ route('mhs.list-lesson', ['id' => $course->course_id]) }}"
                                            style="width: 100%;" type="button"><small><i
                                                    class="fas fa-clipboard"></i></small></a>
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
    <script>
        function getData(id, callback) {
            $.ajax({
                url: "{{ route('course.mhs') . ':id' }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    callback(data);
                },
                beforeSend: function() {
                    $('#ModalLabel').html('Loading...');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    callback(null);
                }
            });
        }
    </script>
@endsection
