@extends('admin.layouts.admin')
@section('title', 'Slide')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Setting','childPage'=>'Edit Setting'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action="{{route('admin.setting.update',$setting->id)}}"  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Config key</label>
                        <input type="text" placeholder="config_key" value="{{ $setting['config_key'] }}" name="config_key" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Config name</label>
                        <input type="text" placeholder="config_name" value="{{ $setting['config_value'] }}" name="config_name" class="form-control col-md-4">
                    </div>
                    <div class="form-group">
                        <label for="">Scope name</label>
                        <input type="text" placeholder="scope" value="{{ $setting['scope'] }}" name="scope" class="form-control col-md-4">
                    </div>
                    <div class="mt-4">
                        <input type="submit" value="Edit Setting" class="btn btn-warning">
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
