{{-- // modal edit --}}
                            <div class="modal fade" id="editModal-{{ $ds->id_sampah }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Sampah</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="edit" method="POST"
                                            action="{{ route('daftarsampah.update', $ds->id_sampah) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                            <div class="form-group mb-3">
                                                <label for="id_sampah">Id Sampah</label>
                                                <input type="text" class="form-control" name="id_sampah" id="id_sampah" value="{{ $ds->id_sampah }}" readonly>
                                            </div>

                                                <div class="form-group mb-3">
                                                    <label for="nama_sampah">Nama Sampah</label>
                                                    <input type="text" class="form-control" name="nama_sampah" id="nama_sampah"
                                                        value="{{ $ds->nama_sampah }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="jenis_sampah">Jenis Sampah</label>
                                                    <select class="form-control" name="jenis_sampah" id="jenis_sampah" required>
                                                        <option value="sampah kertas" {{ $ds->jenis_sampah === 'sampah kertas' ? 'selected' : '' }}>Sampah Kertas</option>
                                                        <option value="sampah plastik" {{ $ds->jenis_sampah === 'sampah plastik' ? 'selected' : '' }}>Sampah Plastik</option>
                                                        <option value="sampah kaca" {{ $ds->jenis_sampah === 'sampah kaca' ? 'selected' : '' }}>Sampah Kaca</option>
                                                        <option value="sampah kaleng" {{ $ds->jenis_sampah === 'sampah kaleng' ? 'selected' : '' }}>Sampah Kaleng</option>
                                                        <option value="sampah kayu" {{ $ds->jenis_sampah === 'sampah kayu' ? 'selected' : '' }}>Sampah Kayu</option>
                                                        <option value="sampah besi" {{ $ds->jenis_sampah === 'sampah besi' ? 'selected' : '' }}>Sampah Besi</option>
                                                        <option value="sampah kain" {{ $ds->jenis_sampah === 'sampah kain' ? 'selected' : '' }}>Sampah Kain</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tahun_masuk">Point</label>
                                                    <input type="number" class="form-control" name="point"
                                                        id="tahun_masuk" min="10"
                                                        value="{{ $ds->point }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="tahun_keluar">Harga Jual</label>
                                                    <input type="number" class="form-control" name="harga_jual"
                                                        id="tahun_keluar" min="1000"
                                                        value="{{ $ds->harga_jual }}" required>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>