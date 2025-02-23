@extends('layouts.admin')

@section('title', $module_name)

@section('content')
  <div class="container">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">
          {{ $module_name }}
        </h6>
        <div class="ml-auto">
          <a href="{{ route($help_key. '.create') }}" class="btn btn-primary">
            <span class="icon text-white-50">
              <i class="fa fa-plus"></i>
            </span>
            <span class="text">{{ __('Tambah ') . $module_name }}</span>
          </a>
        </div>
      </div>
      <div class="table-responsive p-3">
        <table class="table table-hover table-bordered dt-wow w-100">
          <thead class="thead-light">
            <tr>
              <th>Aksi</th>
              <th>Gambar</th>
              <th>Nama</th>
              <th>Jumlah Produk</th>
              <th>Turunan</th>
              <th>Created At</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    let _url = {
      datatable: `{{ route($help_key . '.datatable') }}`,
    }

    let table;

    $(() => {
      table = $('.dt-wow').DataTable({
        processing: true,
        serverSide: true,
        dom: "<'row'<'col-sm-6'B><'col-sm-3'f><'col-sm-3'l>> <'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
        lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, 'All'],
        ],
        order: [
          [5, 'desc']
        ],
        ajax: {
          url: _url.datatable,
          type: 'POST',
          beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
          }
        },
        columns: [{
            searchable: false,
            orderable: false,
            name: 'action',
            data: 'action',
            className: 'text-center',
            render: (data, meta) => {
              html = `<div class="btn-group btn-group-sm" branch="group">${data}</div>`;
              return html;
            }
          },
          {
            searchable: false,
            orderable: false,
            name: 'cover',
            data: 'cover',
            className: 'text-center',
            render: (data) => {
              return Mola.returnDatatable(data);
            }
          },
          {
            searchable: true,
            orderable: true,
            name: 'name',
            data: 'name',
            render: (data) => {
              return Mola.returnDatatable(data);
            }
          },
          {
            searchable: true,
            orderable: true,
            name: 'products_count',
            data: 'products_count',
            render: (data) => {
              return Mola.returnDatatable(data);
            }
          },
          {
            searchable: true,
            orderable: true,
            name: 'parent',
            data: 'parent',
            render: (data) => {
              return Mola.returnDatatable(data);
            }
          },
          {
            searchable: true,
            orderable: true,
            name: 'created_at',
            data: 'created_at',
            render: (data) => {
              return Mola.returnDate(data);
            }
          },
        ],
      })
    })
  </script>
@endsection
