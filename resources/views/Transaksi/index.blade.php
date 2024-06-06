@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Transaction') }}
                    </div>
                    <div class="float-end">
                        <form action="" method="post">
                            @csrf
                            <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-outline-primary">Tambah
                                Data</a>

                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Payment Method</th>
                                    <th>Payment Amount</th>
                                    <th>Payment Date</th>
                                    <th>Id Reservation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($transaksi as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{!! $data->metode_pembayaran !!}</td>
                                    <td>{{$data->jumlah_pembayaran}}</td>
                                    <td>{{$data->tanggal_transaksi}}</td>
                                    <td>{{ $data->reservasi->id}}</td>

                                    <td>
                                        <form action="{{ route('transaksi.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('transaksi.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-success">Edit</a> |
                                            <button type="submit" onclick="return confirm('Are You Sure ?');"
                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
