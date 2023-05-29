


{{-- // modal order --}}
<div class="modal fade" id="editModal-{{ $lj->kode_transaksi }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <p class="text-dark">Kode Transaksi: {{ $lj->kode_transaksi }}</p>
                <!-- Tambahkan bagian ini untuk mengambil data dari tabel lain berdasarkan kode transaksi -->
                @if ($lj->transaksiJual)
                    <p class="text-dark">Nama Sampah: {{ $lj->transaksiJual->nama_sampah }}</p>
                    <p class="text-dark">Jumlah Sampah: {{ $lj->transaksiJual->jumlah_sampah }}</p>
                    <p class="text-dark">Total: {{ $lj->transaksiJual->total }}</p>
                @endif
            </div>
        </div>
    </div>
</div>