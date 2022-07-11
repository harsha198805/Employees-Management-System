@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="d-flex justify-content-between" >
                        <div>Edit Employees </div>
                          <div><a href="{{route('employees.index')}}" class="btn btn-success">Back</a></div>
                    </div>
                </div>

                <div class="card-body">
                 <form action="{{route('employees.update',$employees->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="fname">First Name :</label>
                      <input type="text" value="{{ (old('fname')) ? old('fname') : $employees->fname }}" class="form-control"  id="fname" placeholder="Enter First Name" name="fname" >
                      @if($errors->any('fname'))
                        <span class="text-danger"> {{$errors->first('fname')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="lname">Last Name :</label>
                      <input type="text" value="{{ (old('lname')) ? old('lname') : $employees->lname }}" class="form-control"  id="lname" placeholder="Enter Last Name" name="lname" >
                      @if($errors->any('lname'))
                        <span class="text-danger"> {{$errors->first('lname')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="email">Email :</label>
                      <input type="text" value="{{ (old('email')) ? old('email') : $employees->email }}" class="form-control"  id="email" placeholder="Enter Email" name="email" >
                      @if($errors->any('email'))
                        <span class="text-danger"> {{$errors->first('email')}}</span>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone :</label>
                      <input type="text" value="{{ (old('phone')) ? old('phone') : $employees->phone }}" class="form-control"  id="phone" placeholder="Enter Phone" name="phone" >
                      @if($errors->any('phone'))
                        <span class="text-danger"> {{$errors->first('phone')}}</span>
                      @endif
                    </div>

                    <div class="form-group">
                      <label for="companies">Company :</label>
                      <select class="form-control" id="companies" name="companies">
                        <option value="">Select Company</option>

                        @if(count($companies))
                          @foreach($companies as $company)
                             <option value="{{$company->id}}" 

                             @if(old('companies') && old('companies') ==$company->id)
                              {{'selected'}}
                             @elseif($employees->company_id==$company->id)
                             {{'selected'}}
                             @endif

                              >{{$company->name}}</option>
                          @endforeach
                        @endif
                        
                      </select>
                    @if($errors->any('companies'))
                        <span class="text-danger"> {{$errors->first('companies')}}</span>
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
 $("#companies").select2({
    placeholder: "Select a company",
    allowClear: true
  });

</script>
@endsection