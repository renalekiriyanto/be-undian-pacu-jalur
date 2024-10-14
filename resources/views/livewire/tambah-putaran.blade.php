<div>
    <form wire:submit.prevent="tambahPutaran">
        <div class="form-group">
            <label for="jumlah_hilir">Jumlah Hilir</label>
            <input type="number" class="form-control" id="jumlah_hilir" placeholder="Masukkan jumlah hilir"
                wire:model="jumlah_hilir">
        </div>
        <div class="row d-flex">
            <div class="col-6">
                <button type="submit" class="btn btn-block bg-gradient-success">Tambah</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-block bg-gradient-gray" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </form>
</div>
