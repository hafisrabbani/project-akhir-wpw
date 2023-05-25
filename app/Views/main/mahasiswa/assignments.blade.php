@extends('main.master.main')

@section('page-heading')
    List Tugas
@endsection

@section('page-content')
    <section class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach ($data as $assignment)
                    <div class="col-md-6">
                        <div class="card" style="height: 100%;">
                            <div class="card-body px-4">
                                <div class="row">
                                    <div class="col-md-2 d-flex justify-content-start ">
                                        <div class="stats-icon purple mb-2">
                                            <img src="https://ui-avatars.com/api/?name={{ $assignment->assignment_name }}&color=ffffff&background=9694ff"
                                                alt="avatar" class="img-fluid rounded shadow-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted mb-1">{{ $assignment->assignment_name }}</h6>
                                        <h6 class="text-muted mb-1">{{ $assignment->deadline }}</h6>
                                        <p class="mb-0 text-sm">Deadline :
                                            {{ date('d/m/Y H:i:s', strtotime($assignment->deadline)) }}</p>
                                        @if ($assignment->submission_id)
                                            <p class="mb-1 text-sm">Dikumpulkan :
                                                {{ date('d/m/Y H:i:s', strtotime($assignment->uploaded_at)) }}</p>
                                            <div class="my-2">
                                                <a href="{{ asset('files/tugas/' . $assignment->file) }}"
                                                    class="badge text-bg-primary" target="_blank">Lihat File</a>
                                            </div>
                                        @endif
                                        <div
                                            class="btn btn-outline-{{ $assignment->submission_id ? 'primary' : 'danger' }}">
                                            <small>
                                                {{ $assignment->submission_id ? 'Sudah Mengumpulkan' : 'Belum Mengumpulkan' }}
                                            </small>
                                        </div>
                                        <button class="btn btn-md btn-primary" type="button"
                                            onclick="uploadTugas({{ $assignment->assignment_id }})">Upload
                                            Tugas</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="description" class="form-label">description</label>
                            <textarea class="form-control" id="description" name="description" required cols="30" rows="6"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">file</label>
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
        function uploadTugas(id) {
            $('#Modal').modal('show');
            $('#userForm').attr('action', "{{ route('mhs.assignment.post', ['id' => ':id']) }}".replace(':id', id));
        }

        $('#userForm').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan!",
                        icon: "success",
                        button: "OK",
                    }).then((value) => {
                        location.reload();
                    });
                },
                error: function(err) {
                    swal({
                        title: "Gagal!",
                        text: err.responseJSON.message,
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        });




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
