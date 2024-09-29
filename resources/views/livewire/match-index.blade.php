@section('title', $title)
<div>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
                            <li class="breadcrumb-item active">Match</li>
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
                                        class="fas fa-plus mr-2"></i>Add
                                </button>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Hilir</th>
                                    <th>Undian</th>
                                    <th>Tanggal</th>
                                    <th style="width: 40px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ ($data->currentpage() - 1) * $data->perpage() + $loop->index + 1 }}
                                        <td>{{ $item->urutan_hilir ?? '-' }}
                                        <td>{{ $item->lottery->name ?? '-' }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->lottery->match_date)->format('d F Y') ?? '-' }}
                                        </td>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-flat"
                                                    data-toggle="modal" data-target="#modal-detail-{{ $item->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning btn-flat"
                                                    wire:click="pageEditUndian({{ $item->id }})">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-flat"
                                                    wire:click="deleteUndian({{ $item->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
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
</div>
