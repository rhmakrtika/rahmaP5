@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Reservation') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('reservasi.create') }}" class="btn btn-sm btn-outline-primary">Tambah Data</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Reservation Date</th>
                                    <th>Nuber of People</th>
                                    <th>Visitor Name</th>
                                    <th>Destination Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($reservasi as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->tanggal_reservasi }}</td>
                                    <td>{{$data->jumlah_orang}}</td>
                                    <td>{{$data->pengunjung->nama}}</td>
                                    <td>{{$data->destinasi->nama_destinasi}}</td>
                                    <td>
                                        <form action="{{ route('reservasi.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('reservasi.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-success">Edit</a> |
                                            <button type="submit" onsubmit="return confirm('Are You Sure ?');"
                                                class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Data not yet available.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $reservasi->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
