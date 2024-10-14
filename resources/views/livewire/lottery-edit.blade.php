@section('title', $title)
<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="/lottery">Lottery</a></li>
                            <li class="breadcrumb-item active">Edit Lottery</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if (session()->has('error'))
                    @foreach (session('error') as $message)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Error!</h5>
                            {{ $message }}
                        </div>
                    @endforeach
                @endif
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-default" wire:click="lotteryPage">
                            <i class="fas fa-caret-left mr-2 text-center"></i>
                            Kembali
                        </button>
                    </div>
                    {{-- <form> --}}
                    <div class="card-body">

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalSearchArena">Cari</button>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" wire:model="name_arena">
                        </div>
                        <div class="form-group">
                            <label for="hari_ke">Hari ke</label>
                            <input type="number" class="form-control" id="hari_ke" placeholder="Masukkan hari ke"
                                wire:model="day_of">
                        </div>
                        <div class="form-group">
                            <label>Date:</label>
                            <div class="input-group" id="reservationdate" data-target-input="nearest">
                                <input type="date" class="form-control" wire:model="date_match" />
                            </div>
                        </div>
                        @if ($is_empty)
                            <div>
                                <h3 class="text-center">Daftar Hilir Undian Masih Kosong</h3>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal"
                                    data-target="#modalTambahPutaran">Tambah Putaran</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" wire:click="storeRecord" class="btn btn-primary">Simpan</button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="modalSearchArena">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Daftar Arena</h4>
                </div>
                <div class="modal-body">
                    @livewire('arena-pencarian')
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>

    {{-- Modal Tambah Putaran --}}
    <div class="modal fade" id="modalTambahPutaran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Putaran</h4>
                </div>
                <div class="modal-body">
                    @livewire('tambah-putaran', ['id_undian' => $lottery_id])
                </div>
            </div>
            {{-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    @script
        <script>
            $wire.on('selectArena', () => {
                $('#modalSearchArena').modal('hide')
            });

            $wire.on('tambahPutaran', () => {
                $('#modalTambahPutaran').modal('hide')
            });
        </script>
    @endscript
</div>
