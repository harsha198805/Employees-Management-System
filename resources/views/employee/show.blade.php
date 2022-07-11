@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                              <div class="d-flex justify-content-between" >
                        <div>View Employees </div>
                          <div><a href="{{route('employees.index')}}" class="btn btn-success">Back</a></div>
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
        <td>{{$employees->id}}</td>
      
      </tr>
      <tr>
        <td>First Name</td>
        <td>{{$employees->fname}}</td>
      
      </tr>
      <tr>
        <td>Last Name</td>
        <td>{{$employees->lname}}</td>
      
      </tr>
      <tr>
        <td>Email</td>
        <td>{{$employees->email}}</td>
      </tr>
      <tr>
        <td>Phone</td>
        <td>{{$employees->phone}}</td>
      </tr>
     <tr>
        <td>Company</td>
        <td>{{$employees->company->name}}</td>
      
      </tr>
      <tr>
        <td>Created At</td>
        <td>
          {{$employees->created_at}}
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