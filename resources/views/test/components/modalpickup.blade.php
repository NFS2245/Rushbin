<div class="modal fade" id="editModal-{{ $p->id_pengantaran }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pickup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($p->gambar1)
                    <img src="data:image/jpeg;base64,{{ base64_encode($p->gambar1) }}" alt="Gambar">
                @endif
            </div>
        </div>
    </div>
</div>
