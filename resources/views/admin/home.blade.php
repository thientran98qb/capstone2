@extends('admin.layouts.admin')

@section('title', 'Admin Home Page')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @include('admin.partials.content_header',['namePage'=>'Home','childPage'=>''])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <h1>Trang Chu</h1>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
