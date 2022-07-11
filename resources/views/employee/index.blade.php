@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between" >
                        <div>Employees Management System</div>
                          <div><a href="{{route('employees.create')}}" class="btn btn-success">Create Employees</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <div class="mb-2">
                      <form class="form-inline" action="">
                      <label for="Company_filter">Filter By Company &nbsp;</label>
                       <select class="form-control" id="companies" name="companies">
                        <option value="">Select Company</option>
                       @if(count($companies))
                          @foreach($companies as $category)
                             <option value="{{$category->name}}"  {{(Request::query('companies') && Request::query('companies')==$category->name)?'selected':''}}  >{{$category->name}}</option>
                          @endforeach
                        @endif

               
                      </select>
                      <label for="keyword">&nbsp;&nbsp;</label>
                      <input type="text" class="form-control"  name="keyword" placeholder="Enter keyword" id="keyword">
                      <span>&nbsp;</span> 
                       <button type="button" onclick="search_post()" class="btn btn-primary" >Search</button>
                       @if(Request::query('category') || Request::query('keyword'))
                        <a class="btn btn-success" href="{{route('employees.index')}}">Clear</a>
                       @endif

                    </form>
                  </div>
                  <div class="table-responsive">
                    <table style="width: 100%;" class="table table-stripped ">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Company</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th style="width: 15%;">Created By</th>
                          <th style="width: 30%;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($employees))
                          @foreach($employees as $employe)
                        <tr>
                            <td >{{$employe->id}}</td>
                            <td style="width:15%">{{$employe->fname}}</td>
                            <td style="width:15%">{{$employe->lname}}</td>
                            <td >{{$employe->company->name}}</td>
                            <td >{{$employe->email}}</td>
                            <td >{{$employe->phone}}</td>
                            <td >{{$employe->created_at}}</td>
                            <td  style="width:250px;">
                              <a  href="{{route('employees.show',$employe->id)}}" class="btn btn-primary">View</a>
                              <a href="{{route('employees.edit',$employe->id)}}" class="btn btn-success">Edit</a>
                              <a href="javascript:delete_employe('{{route('employees.destroy',$employe->id)}}')" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>


                          @endforeach
                        @else

                          <tr>
                            <td colspan="6" >No employees found</td>
        
                          </tr>
                        @endif

                
                      </tbody>
                    </table>
  @if(count($employees))
   {{$employees->appends(Request::query())->links()}}
  @endif

                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="post_delete_form" method="post" action="">
  @csrf
  @method('DELETE')
</form>


@endsection

@section('javascript')
<script type="text/javascript">
  var query=<?php echo json_encode((object)Request::only(['company','keyword'])); ?>;


  function search_post(){

    Object.assign(query,{'company': $('#companies').val()});
    Object.assign(query,{'keyword': $('#keyword').val()});

    window.location.href="{{route('employees.index')}}?"+$.param(query);

  }


  function delete_employe(url){

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this employees!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $('#post_delete_form').attr('action',url);
         $('#post_delete_form').submit();
      } 
    });


  }


</script>
@endsection