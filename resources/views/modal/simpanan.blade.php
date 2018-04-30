{{--Modal Add Simpanan--}}
<div class="modal fade" id="addSimModal" role="dialog" aria-labelledby="addOrgLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrgLabel">Tambah Simpanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{route('admin.datamaster.simpanan.add_simpanan')}}" enctype="multipart/form-data"  id="addSimpanan">
                {{csrf_field()}}
                <div class="modal-body">
                    <div id="ifInduk" >
                        <div class="form-group">
                            <label for="id_" class="control-label">Pilih Jenis Simpanan <star>*</star></label>
                            <select class="form-control select2" id="id_" name="idRek" style="width: 100%;" required>
                                <option class="bs-title-option" value="">Pilih Jenis Simpanan</option>
                                @foreach ($dropdown_simpanan as $rekening)
                                    <option value="{{ $rekening->id_rekening }}">{{ $rekening->nama_rekening }} {{$rekening->id_rekening }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaSim" class="control-label">Nisbah Simpanan <star>*</star></label>
                        <input type="text" class="form-control" name="nisbah" required="true">
                    </div>
                    <div class="form-group">
                        <label for="namaSim" class="control-label">Saldo Minimal Simpanan <star>*</star></label>
                        <input type="text" class="form-control" name="saldo" required="true">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Simpanan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Modal Edit Simpanan--}}
<div class="modal fade" id="editSimModal" role="dialog" aria-labelledby="EditSimLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSimLabel">Edit Simpanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="{{route('admin.datamaster.simpanan.edit_simpanan')}}" enctype="multipart/form-data"  id="editSimpanan">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_edit" name="id_">
                        <label for="nisbahSim" class="control-label">Nisbah <star>*</star></label>
                        <input type="text" class="form-control" id="nisbahSim" name="nisbah"  required="true">
                    </div>
                    <div class="form-group">
                        <label for="saldoSim" class="control-label">Saldo Minimal <star>*</star></label>
                        <input type="text" class="form-control" id="saldoSim" name="saldo"  required="true">
                    </div>

                    <div class="category"><star>*</star> Required fields</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Edit Simpanan</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{--Modal Hapus Simpanan--}}
<div class="modal fade" id="delSimModal" role="dialog" aria-labelledby="delSimLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('admin.datamaster.simpanan.delete_simpanan')}}" enctype="multipart/form-data"  id="delSimpanan">
                {{csrf_field()}}
                <input type="hidden" id="id_del" name="id_">
                <div class="modal-header">
                    <h5 class="modal-title" id="delSimlabel">Hapus Simpanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Hapus Simpanan</h4>
                    <h5 id="toDelete"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>