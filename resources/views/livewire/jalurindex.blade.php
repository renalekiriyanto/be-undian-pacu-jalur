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
                            <li class="breadcrumb-item active">Jalur</li>
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
                @if (session()->has('success'))
                    @foreach (session('success') as $message)
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                            {{ $message }}
                        </div>
                    @endforeach
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-1">
                                <button type="button" class="btn btn-primary btn-block" wire:click="createPage"><i
                                        class="fas fa-plus mr-2"></i>
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama Jalur</th>
                                    <th>Asal</th>
                                    <th style="width: 40px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td>{{ $item->asal->name ?? '-' }}/{{ $item->asal->kecamatan->code_city == '14.09' ? $item->asal->kecamatan->name : $item->asal->kecamatan->city->name ?? '-' }}
                                        </td>
                                        <td><span class="badge bg-danger">55%</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $data->links('components.layouts.parts.pagination') }}
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @push('add-script')
        <script>
            // toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        </script>
    @endpush
</div>
