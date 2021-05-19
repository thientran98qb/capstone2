@extends('admin.layouts.admin')
@section('title', 'Setting')

@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Page','childPage'=>'Add Page'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <form action=""  method="POST">
              @csrf
                <div class="form m-3">
                    <div class="form-group">
                        <label for="">Name page</label>
                        <input type="text" placeholder="config_key" name="config_key" class="form-control col-md-4">
                    </div>

                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" class="form-control col-md-4 my-editor"  id="" cols="30" rows="20">{{ old('content') }}</textarea>
                    </div>
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
@section('js')
<script src="https://cdn.tiny.cloud/1/5vpl923wc92zcmi0pzv4l1jrq85qt6ulh8st9mu4osx7ywow/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

   <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
     });
   </script>

@endsection
