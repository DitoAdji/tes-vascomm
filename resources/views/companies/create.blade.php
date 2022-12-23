@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Create Companies',
'activePage' => 'companies',
'activeNav' => '',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="title">{{__(" Create Companies")}}</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('companies.store') }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <!-- @method('post') -->
            @include('alerts.success')
            <div class="row">
            </div>
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label>{{__(" Name")}}</label>
                  <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name')}}">
                  @include('alerts.feedback', ['field' => 'name'])
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                  <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                  @include('alerts.feedback', ['field' => 'email'])
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__(" Logo")}}</label>
                  <input type="file" name="logo" onchange="loadPreview(this);" class="form-control">
                  <div class="image">
                    <img src="{{asset('assets')}}/img/camera.png" id="preview" width="100px">
                  </div>
                  @include('alerts.feedback', ['field' => 'logo'])
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 pr-1">
                <div class="form-group">
                  <label for="exampleInputEmail1">{{__(" Website")}}</label>
                  <input type="text" name="website" class="form-control" placeholder="www.example.com"
                    value="{{ old('website') }}">
                  @include('alerts.feedback', ['field' => 'website'])
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
            </div>
            <hr class="half-rule" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function loadPreview(input, id) {
    id = id || '#preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    .width(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
 }
</script>
@endsection