@extends('layouts.admin')

@section('title', $module_name)

@section('content')
  <div class="container">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">
          {{ __('Edit ') . $module_name }}
        </h6>
        <div class="ml-auto">
          <a href="{{ route( $help_key. '.index') }}" class="btn btn-primary">
            <span class="icon text-white-50">
              <i class="fa fa-home"></i>
            </span>
            <span class="text">{{ __('Kembali ke ').  $module_name }}</span>
          </a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route($help_key . '.update', $category) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="name">Nama</label>
                <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Masukkan Nama {{ $module_name }}">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="category_id">Turunan {{ $module_name }}</label>
                <select name="category_id" id="category_id" class="form-control select2">
                  <option value=""></option>
                  @forelse($parent_categories as $parent_category)
                    <option value="{{ $parent_category->id }}" {{ old('category_id', $category->category_id) == $parent_category->id ? 'selected' : null }}>
                      {{ $parent_category->name }}
                    </option>
                  @empty
                    <option value="" disabled>Kategori tidak ditemukan</option>
                  @endforelse
                </select>
                @error('parent_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>


          <div class="row pt-4">
            <div class="col-12">
              <label for="cover">Cover gambar</label><br>
              @if ($category->cover)
                <img class="mb-2" src="{{ Storage::url('images/categories/' . $category->cover) }}" alt="{{ $category->name }}" width="100" height="100">
              @else
                <img class="mb-2" src="{{ asset('img/no-img.png') }}" alt="{{ $category->name }}" width="60" height="60">
              @endif
              <br>
              <div class="file-loading">
                <input type="file" name="cover" id="category-img" class="file-input-overview">
                <span class="form-text text-muted">Gambar harus berukuran 500px x 500px</span>
              </div>
              @error('cover')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group pt-4">
            <button class="btn btn-primary" type="submit" name="submit">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    $('#category_id').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Salah Satu",
    });

    $(function() {
      $("#category-img").fileinput({
        theme: "fas",
        maxFileCount: 1,
        allowedFileTypes: ['image'],
        showCancel: true,
        showRemove: false,
        showUpload: false,
        overwriteInitial: false
      })
    })
  </script>
@endsection
