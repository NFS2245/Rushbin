{{-- // modal bayar --}}
<form action="{{ route('transaksibeli.bayar', $tb->kode_transaksi) }}" method="POST">
    @csrf
    <div class="modal fade" id="editModal-{{ $tb->kode_transaksi }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bayar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="id_pengguna">Id Pelanggan</label>
                            <select class="form-control" name="id_pengguna" id="id_pengguna" required>
                                <option value="">Pilih Id Pelanggan</option>
                                @foreach ($daftar_pengguna as $pengguna)
                                    <option value="{{ $pengguna->id_pengguna }}">{{ $pengguna->id_pengguna }} - {{ $pengguna->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</form>