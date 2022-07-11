@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                              <div class="d-flex justify-content-between" >
                        <div>View Companies </div>
                          <div><a href="{{route('companies.index')}}" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">

 <table class="table table-striped">
    <thead>
      <tr>
        <th width="20%">Field Name</th>
        <th width="80%"> Value</th>
     
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Id</td>
        <td>{{$companies->id}}</td>
      
      </tr>
      <tr>
        <td>Company Name</td>
        <td>{{$companies->name}}</td>
      
      </tr>
      <tr>
        <td>Email</td>
        <td>{{$companies->email}}</td>
      </tr>
      <tr>
        <td>Image</td>
        <td>
            <img width="100px" height="100px" src="{{asset('post_images/'.$companies->logo)}}">
        </td>
      
      </tr>
      <tr>
        <td>Created At</td>
        <td>
          {{$companies->created_at}}
        </td>
      </tr>

    </tbody>
  </table>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection