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
                <th>Arena</th>
                <th>Asal</th>
                <th style="width: 40px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->asal->name }}
                    </td>
                    <td>
                        <span class="badge btn-primary" wire:click="selectArena({{ $item->id }})"
                            style="cursor: pointer">Pilih</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
