@extends('main.master.main')

@section('page-heading')
List Tugas
@endsection

@section('page-content')
<section class="row">
    <div class="col-12">
        <button class="btn btn-sm btn-primary mb-3" type="button" onclick="showPanel('','create')"><i
                class="fas fa-plus"></i> Tugas</button>
        <div class="row">
            @foreach ($data as $val)
            <div class="col-6 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-2 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <img src="https://ui-avatars.com/api/?name={{ $val->assignment_name }}&color=ffffff&background=9694ff"
                                        alt="avatar" class="rounded shadow-sm"
                                        style="width: 550px !important; height: auto;" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5 class="text-muted mb-1">{{ $val->assignment_name }} </h5>
                                <p class="mb-0 text-sm"><small>{{ $val->description }}</small></p>
                                <span class="badge text-bg-primary mb-1">{{ $val->deadline }}</span>
                                <br>
                                <button class="btn btn-sm btn-primary" type="button"
                                    onclick="showPanel('{{ $val->assignment_id }}','edit')"><i
                                        class="fas fa-pen"></i></button>
                                <button class="btn btn-sm btn-danger" type="button"
                                    onclick="deleteData('{{ $val->assignment_id }}')"><i
                                        class="fas fa-trash"></i></button>
                                <a href="{{ route('assignment.submission', ['id' => $val->assignment_id]) }}"
                                    class="btn btn-sm btn-info" type="button"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Tugas</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required cols="30"
                            rows="6"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="deadline" class="form-label">Deadline</label>
                        <input type="datetime-local" class="form-control" name="deadline" id="deadline">
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    function showPanel(id, type) {
        $('#name').val('');
        $('#description').val('');
        $('#deadline').val('');
        if (type == 'create') {
            $('#ModalLabel').html('Tambah Data');
            $('#Modal').modal('show');
            $('#userForm').attr('action', "{{ route('assignment.create', ['id' => $id_course]) }}");
        } else if (type == 'edit') {
            $('#ModalLabel').html('Edit Data');
            $('#Modal').modal('show');
            $('#userForm').attr('action', "{{ route('assignment.update', ['id' => ':id']) }}".replace(':id', id)
                .replace(':id', id))
            getData(id, function (data) {
                console.log(data);
                $('#ModalLabel').html('Edit Data');
                $('#name').val(data.assignment_name);
                $('#description').val(data.description);
                $('#deadline').val(data.deadline);
            });
        }
    }


    function getData(id, callback) {
        $.ajax({
            url: "{{ route('assignment.detail', ['id' => ':id']) }}".replace(':id', id),
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                callback(data);
            },
            beforeSend: function () {
                $('#ModalLabel').html('Loading...');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                callback(null);
            }
        });
    }

    $('#userForm').submit(function (e) {
        e.preventDefault();

        var data = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (data) {
                swal({
                    title: "Berhasil!",
                    text: "Data berhasil disimpan!",
                    icon: "success",
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            },
            error: function (err) {
                swal({
                    title: "Gagal!",
                    text: err.responseJSON.message,
                    icon: "error",
                    button: "OK",
                });
            }
        });
    })

    function deleteData(id) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((value) => {
            if (value) {
                $.ajax({
                    url: "{{ route('assignment.delete', ['id' => ':id']) }}".replace(':id', id),
                    type: "GET",
                    success: function (data) {
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus!",
                            icon: "success",
                            button: "OK",
                        }).then((value) => {
                            location.reload();
                        });
                    },
                    error: function (err) {
                        swal({
                            title: "Gagal!",
                            text: err.responseJSON.message,
                            icon: "error",
                            button: "OK",
                        });
                    }
                });
            }
        });
    }
</script>
@endsection