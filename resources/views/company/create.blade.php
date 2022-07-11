@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="d-flex justify-content-between" >
                        <div>Create Companies </div>
                          <div><a href="{{route('companies.index')}}" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <form action="{{route('companies.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="fname">Company Name :</label>
                      <input type="text" value="{{old('fname')}}" class="form-control"  id="fname" placeholder="Enter First Name" name="fname" >
                      @if($errors->any('title'))
                        <span class="text-danger"> {{$errors->first('fname')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" value="{{old('email')}}" class="form-control"  id="email" placeholder="Enter Email" name="email" >
                      @if($errors->any('email'))
                        <span class="text-danger"> {{$errors->first('email')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="image">Logo :</label>
                      <input type="file" class="form-control " id="image" placeholder="Choose an image" name="image" >
                      @if($errors->any('image'))
                        <span class="text-danger"> {{$errors->first('image')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="website">Web Site:</label>
                      <input type="text" value="{{old('website')}}" class="form-control"  id="website" placeholder="Enter website name" name="website" >
                      @if($errors->any('website'))
                        <span class="text-danger"> {{$errors->first('website')}}</span>
                      @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
</script>
@endsection