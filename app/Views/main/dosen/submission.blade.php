@extends('main.master.main')

@section('page-heading')
List Kelas
@endsection

@section('page-content')
<section class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <h6>Tugas : {{ $data->assignment_name }}</h6>
                        <h6>Deadline : {{ date('d/m/Y H:i', strtotime($data->deadline)) }}</h6>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">NRP</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tb">
                                @foreach($submission as $val)
                                <tr>
                                    <td>{{ $val->users->nrp }}</td>
                                    <td>{{ $val->users->name }}</td>
                                    <td>
                                        @if($val->file)
                                        <a href="{{ asset('files/tugas/' . $val->file) }}" target="_blank"
                                            class="p-2 badge text-bg-primary"><i class="fas fa-file"></i></a>
                                        @else
                                        <span class="p-2 badge text-bg-danger">
                                            <i class="fas fa-times-circle"></i>
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ ($val->submission_time) ? date('d/m/Y H:i', strtotime($val->submission_time))
                                        : '-' }}</td>
                                    <td>
                                        @if($val->isLate === true)
                                        <span class="badge bg-danger">Terlambat</span>
                                        @elseif($val->isLate === false)
                                        <span class="badge bg-success">Tepat Waktu</span>
                                        @else
                                        <span class="badge bg-secondary">Belum Mengumpulkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ ($val->nilai) ?? 'Belum Dinilai' }}</span>
                                    </td>
                                    <td>
                                        @if($val->isLate !== null)
                                        <button class="btn btn-sm btn-primary" type="button"
                                            onclick="showPanel('{{ $val->submission_id}}')"><i
                                                class="fas fa-pen"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                <form id="userForm">
                    <div class="mb-3">
                        <label for="score" class="form-label">Nilai</label>
                        <input type="number" class="form-control" id="score" name="score" required>
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
    function showPanel(id) {
        $('#ModalLabel').html('Nilai Tugas');
        $('#Modal').modal('show');
        $('#userForm').attr('action', '{{ route("assignment.submission.post", ["id" => ":id"]) }}'.replace(':id',
            id));
        $('#userForm').append('<input type="hidden" name="id" value="' + id + '">');
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
</script>
@endsection