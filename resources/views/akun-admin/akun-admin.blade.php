@extends('layouts.main')

@section('content')

@include('layouts.top-navbar')

<div id="layoutSidenav">
    @include('layouts.side-navbar')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="breadcrumb rounded-pill mb-4 bg-light" style="color: RGBA(107,107,107,0.75); background-color: rgbA">
                    <div class="item px-3">
                        <i class="fas fa-home pt-1"></i>&nbsp;
                        <a href="/" style="text-decoration: none; color: inherit;">Beranda /</a>
                        <a href="/akun-admin" style="text-decoration: none; color: inherit;">Kelola Akun Admin</a>
                    </div>
                </div>

                <h2 class="pb-3">Kelola Akun Admin</h2>

                <h5 class="mb-3 mt-1 mx-1"> Akun Terdaftar</h5>

                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kontak</th>
                                    <th>Ubah Status</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($activeAdmins as $index => $admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin['name'] }}</td>
                                    <td>{{ $admin['email'] }}</td>
                                    <td>{{ $admin['kontak'] }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('update-admin.status', ['id' => $admin['id_penggunaWeb']]) }}" id="status-form-active-{{ $index }}">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="status" value="{{ $admin['status'] == 'active' ? 'non-active' : 'active' }}">
                                            <div class="custom-control custom-switch text-center pt-2">
                                                <input type="checkbox" class="custom-control-input" id="toggle-switch-active{{ $index }}" name="status_checkbox" @if($admin['status'] == 'active') checked @endif onchange="confirmUpdateAdminStatus({{ $index }})">
                                                <label class="custom-control-label" for="toggle-switch-active{{ $index }}">Active/Non-Active</label>
                                            </div>
                                        </form>
                                    </td>
                                    <td><span class="badge rounded-pill bg-success">{{ $admin['status'] }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 class="mb-3 mt-1 mx-1"> Akun Baru</h5>

                <div class="card mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple2" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kontak</th>
                                    <th>Is_Approved</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($nonActiveAdmins as $index => $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin['name'] }}</td>
                                    <td>{{ $admin['email'] }}</td>
                                    <td>{{ $admin['kontak'] }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('update-admin.isApproved', ['id' => $admin['id_penggunaWeb']]) }}" id="status-form-nonactive-{{ $index }}">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="is_approved" value="{{ $admin['is_approved'] == 1 ? 2 : 1 }}">
                                            <div class="custom-control custom-switch text-center pt-2">
                                                <input type="checkbox" class="custom-control-input" id="toggle-switch-nonactive{{ $index }}" name="is_approved_checkbox" @if($admin['is_approved'] == 1) checked @endif onchange="confirmUpdateNewAdminStatus({{ $index }})">
                                                <label class="custom-control-label" for="toggle-switch-nonactive{{ $index }}">Terima/Tolak</label>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
        @include('layouts.footer')
    </div>
</div>

<!-- Modal untuk status admin -->
<div class="modal fade" id="confirmStatusModal" tabindex="-1" role="dialog" aria-labelledby="confirmStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmStatusModalLabel">Konfirmasi Perubahan Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda ingin menonaktifkan admin tersebut?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmStatusButton">Lanjutkan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk is_approved -->
<div class="modal fade" id="confirmApprovalModal" tabindex="-1" role="dialog" aria-labelledby="confirmApprovalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmApprovalModalLabel">Konfirmasi Persetujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda menyetujui admin tersebut?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmApprovalButton">Lanjutkan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    let formIndex;
    let formType;

    function confirmUpdateAdminStatus(index) {
        formIndex = index;
        formType = 'active';
        $('#confirmStatusModal').modal('show');
    }

    function confirmUpdateNewAdminStatus(index) {
        formIndex = index;
        formType = 'nonactive';
        $('#confirmApprovalModal').modal('show');
    }

    document.getElementById('confirmStatusButton').addEventListener('click', function () {
        document.getElementById('status-form-' + formType + '-' + formIndex).submit();
    });

    document.getElementById('confirmApprovalButton').addEventListener('click', function () {
        document.getElementById('status-form-' + formType + '-' + formIndex).submit();
    });

    $('#confirmStatusModal').on('hidden.bs.modal', function () {
        document.getElementById('toggle-switch-' + formType + formIndex).checked = !document.getElementById('toggle-switch-' + formType + formIndex).checked;
    });

    $('#confirmApprovalModal').on('hidden.bs.modal', function () {
        document.getElementById('toggle-switch-' + formType + formIndex).checked = !document.getElementById('toggle-switch-' + formType + formIndex).checked;
    });
</script>

@endsection
