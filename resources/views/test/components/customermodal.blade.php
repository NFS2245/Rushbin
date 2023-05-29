{{-- // modal edit --}}
                            <div class="modal fade" id="editModal-{{ $c->id_pengguna }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Customer</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="edit" method="POST"
                                            action="{{ route('customer.update', $c->id_pengguna) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                            <div class="form-group mb-3">
                                                <label for="id_pengguna">Id Pelanggan</label>
                                                <input type="text" class="form-control" name="id_pengguna" id="id_pengguna" value="{{ $c->id_pengguna}}" readonly>
                                            </div>

                                                <div class="form-group mb-3">
                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                                        value="{{ $c->nama_lengkap }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="telepon">No HP</label>
                                                    <input type="number" class="form-control" name="telepon" id="telepon" value="{{ $c->telepon }}" required minlength="10" maxlength="13">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="alamat1">Alamat 1</label>
                                                    <input type="text" class="form-control" name="alamat1" id="alamat1"
                                                        value="{{ $c->alamat1}}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="alamat2">alamat 2</label>
                                                    <input type="text" class="form-control" name="alamat2" id="alamat2"
                                                        value="{{ $c->alamat2 }}" required>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="alamat3">alamat 3</label>
                                                    <input type="text" class="form-control" name="alamat3" id="alamat3"
                                                        value="{{ $c->alamat3 }}" required>
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