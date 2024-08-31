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
                            <li class="breadcrumb-item"><a href="/jalur">Jalur</a></li>
                            <li class="breadcrumb-item active">Tambah Jalur</li>
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
                        <button type="button" class="btn btn-default" wire:click="jalurPage">
                            <i class="fas fa-caret-left mr-2 text-center"></i>
                            Kembali
                        </button>
                    </div>
                    {{-- <form> --}}
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="col-1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jalur_name">Nama Jalur</label>
                            <input type="text" class="form-control" id="jalur_name" placeholder="Masukkan nama jalur"
                                wire:model="jalur_name">
                        </div>
                        <div class="form-group">
                            <label>Asal</label>
                            <select class="form-control select2bs4" style="width: 100%;" wire:ignore
                                wire:change="selectChange($event.target.value)">
                                <option selected="selected">--Pilih Daerah--</option>
                                @foreach ($villages as $desa)
                                    <option value="{{ $desa->code }}">{{ $desa->name }}</option>
                                @endforeach
                            </select>
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
    @push('add-script')
        <script>
            $(function() {
                $('.select2bs4').on('change', function(e) {
                    console.log('change')
                    this.Livewire.emit('selectChange', $(this).val());
                });
            })
        </script>
    @endpush
</div>
