<div>
    <div class="form-group">
        <label for="search">Cari</label>
        <input type="text" class="form-control" id="search" placeholder="Masukkan pencarian"
            wire:model.live.debounce.150ms="search">
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Nama Daerah</th>
                <th>Kecamatan/Kota</th>
                <th style="width: 40px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->kecamatan->city->code == '14.09' ? $item->kecamatan->name : $item->kecamatan->name . ' - ' . $item->kecamatan->city->name }}
                    </td>
                    <td>
                        <span class="badge btn-primary" wire:click="selectDaerah({{ $item->id }})"
                            style="cursor: pointer">Pilih</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
