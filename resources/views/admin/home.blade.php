@extends('admin.layouts.admin')

@section('title', __('admin.title_home_page'))
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @include('admin.partials.content_header',['namePage'=>__('admin.page_home'),'childPage'=>''])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <h1>@lang('admin.page_home')</h1>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
