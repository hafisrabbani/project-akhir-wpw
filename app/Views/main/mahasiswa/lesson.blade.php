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

                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ $lesson->lesson_name }}&color=ffffff&background=9694ff"
                                                alt="avatar" class="img-fluid rounded shadow-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted mb-1">{{ $lesson->lesson_name }}</h6>
                                        <p>
                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#detail{{ $lesson->lesson_id }}" aria-expanded="false"
                                                aria-controls="detail{{ $lesson->lesson_id }}">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </p>
                                        <div class="collapse" id="detail{{ $lesson->lesson_id }}">
                                            <div class="card card-body">

                                                <h6 class="mb-0 text-sm"><small>{{ $lesson->content }}</small></h6>
                                            </div>
                                        </div>
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
