@extends('admin.layouts.admin')
@section('title', 'Setting')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Setting','childPage'=>'Add Setting'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{ route('admin.setting.store') }}"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Config key</label>
                        <input type="text" placeholder="config_key" name="config_key" class="form-control col-md-4 @error('config_key')
                        is-invalid
                    @enderror">
                    </div>
                    @error('config_key')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Config name</label>
                        <input type="text" placeholder="config_name" name="config_name" class="form-control col-md-4 @error('config_name')
                        is-invalid
                    @enderror">
                    </div>
                    @error('config_name')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">Scope name</label>
                        <input type="text" placeholder="scope" name="scope" class="form-control col-md-4 @error('scope')
                        is-invalid
                    @enderror">
                    </div>
                    @error('scope')
                        <div class="alert alert-danger col-md-4">{{ $message }}</div>
                    @enderror
                    <div class="mt-4">
                        <input type="submit" value="Add Setting" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
