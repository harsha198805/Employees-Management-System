@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between" >
                        <div>Employees Management System</div>
                          <div><a href="{{route('companies.create')}}" class="btn btn-success">Create Companies</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <div class="mb-2">
                      <form class="form-inline" action="">
                      <label for="keyword">&nbsp;&nbsp;</label>
                      <input type="text" class="form-control"  name="keyword" placeholder="Enter keyword" id="keyword">
                      <span>&nbsp;</span> 
                       <button type="button" onclick="search_post()" class="btn btn-primary" >Search</button>
                       @if(Request::query('keyword'))
                        <a class="btn btn-success" href="{{route('companies.index')}}">Clear</a>
                       @endif

                    </form>
                  </div>
                  <div class="table-responsive">
                    <table style="width: 100%;" class="table table-stripped ">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Company Name</th>
                          <th>Email</th>
                          <th>WebSite</th>
                          <th>Logo</th>
                          <th style="width: 15%;">Created By</th>
                          <th style="width: 30%;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(count($companies))
                          @foreach($companies as $employe)
                        <tr>
                            <td >{{$employe->id}}</td>
                            <td style="width:15%">{{$employe->name}}</td>
                            <td >{{$employe->email}}</td>
                            <td >{{$employe->website}}</td>
                            <td>
                              <img width="100px" height="100px" src="{{asset('post_images/'.$employe->logo)}}">
                            </td>
                            <td >{{$employe->created_at}}</td>
                            <td  style="width:250px;">
                              <a  href="{{route('companies.show',$employe->id)}}" class="btn btn-primary">View</a>
                              <a href="{{route('companies.edit',$employe->id)}}" class="btn btn-success">Edit</a>
                              <a href="javascript:delete_company('{{route('companies.destroy',$employe->id)}}')" class="btn btn-danger">Delete</a>
                            </td>
                          </tr>


                          @endforeach
                        @else

                          <tr>
                            <td colspan="6" >No companies found</td>
        
                          </tr>
                        @endif

                
                      </tbody>
                    </table>
  @if(count($companies))
   {{$companies->appends(Request::query())->links()}}
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
  var query=<?php echo json_encode((object)Request::only(['keyword'])); ?>;


  function search_post(){
    Object.assign(query,{'keyword': $('#keyword').val()});

    window.location.href="{{route('companies.index')}}?"+$.param(query);

  }


  function delete_company(url){

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this companies!",
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