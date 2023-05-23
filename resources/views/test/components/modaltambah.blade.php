<!-- Show success or error message after form submission -->
@if(session('success'))
                    <br>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- modal tambah --}}
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="pengalaman_kerja_form" method="POST"
                                    action="{{ route('daftarsampah.tambah') }}">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group mb-3">
                                            <label for="nama_sampah">Nama Sampah</label>
                                            <input type="text" class="form-control" name="nama_sampah" id="nama_sampah" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="jenis_sampah">Jenis Sampah</label>
                                            <select class="form-control" name="jenis_sampah" id="jenis_sampah" required>
                                                <option value="sampah kertas">Sampah Kertas</option>
                                                <option value="sampah plastik">Sampah Plastik</option>
                                                <option value="sampah kaca">Sampah Kaca</option>
                                                <option value="sampah kaleng">Sampah Kaleng</option>
                                                <option value="sampah kayu">Sampah Kayu</option>
                                                <option value="sampah besi">Sampah Besi</option>
                                                <option value="sampah kain">Sampah Kain</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="point">Point</label>
                                            <input type="number" class="form-control" name="point" id="point" min="10" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="harga_jual">Harga Jual</label>
                                            <input type="number" class="form-control" name="harga_jual"
                                                id="harga_jual" min="1000" required>
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