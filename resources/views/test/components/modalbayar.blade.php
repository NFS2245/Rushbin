{{-- // modal edit --}}
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
                        <input type="text" class="form-control" name="id_pengguna" id="id_pengguna" required>
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