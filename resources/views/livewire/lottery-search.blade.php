<div>
    <div class="form-group">
        <label for="search">Cari</label>
        <input type="text" class="form-control" id="search" placeholder="Masukkan pencarian"
            wire:model.live.debounce.150ms="search">
    </div>
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Undian</th>
                <th>Arena</th>
                <th>Hari ke</th>
                <th>Tanggal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td>{{ $item->arena->name ?? '-' }}</td>
                    <td>{{ $item->day_of ?? '-' }}</td>
                    <td>{{ Carbon\Carbon::parse($item->match_date)->format('d F Y') ?? '-' }}</td>
                    <td>
                        <span class="badge btn-primary" wire:click="selectLottery({{ $item->id }})"
                            style="cursor: pointer">Pilih</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
