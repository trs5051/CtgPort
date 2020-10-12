@extends('layouts.customer-master')
@section('content')
<div class="col-md-10" id="content_term_condition" style="margin-top:10px; ">  	
  <div class="content-area" style="padding-top: 15px;">
    <div class="container-fluid  pl-0 pr-0" >
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Your Applications for Vehicle Sticker</h3></div>
        <div class="panel-body" style="padding:10px 0;">
          @if($errors->any())
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Not Allowed!</strong> {{$errors->first()}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div id="example-wrapper">
            <table id="example" class="table table-bordered dt-responsive" style="text-align: center;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Reg. No.</th>
                  <th scope="col">Phone No.</th>
                  <th scope="col">Date</th>
                  <th scope="col">Vehicle Type</th>
                  <th scope="col">Nat ID</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(isset(auth()->guard('applicant')->user()->applications))
                <?php $sl=1; ?>
                @foreach(auth()->guard('applicant')->user()->applications->where('app_status','!=','processing')->sortByDesc('created_at') as $key => $app)
                <tr>
                 <th scope="row">{{$sl++}}</th>
                 <td>
                  <a href="{{url('/application/edit/applicant')}}/{{$app->app_number}}"> {{$app->applicant->name}} </a></td>
                  <td>{{!empty($app->vehicleinfo->reg_number)?$app->vehicleinfo->reg_number:''}}</td>
                  <td>{{$app->applicant->phone}} </td>
                  <td>{{$app->app_date}}</td>
                  <td>{{!empty($app->vehicleinfo->vehicleType->name)?$app->vehicleinfo->vehicleType->name:''}}</td>
                  <td>{{ isset($app->applicant->applicantDetail->nid_number) ? $app->applicant->applicantDetail->nid_number : '-' }}</td>
                  <td>{{$app->app_status}} </td>
                  <td> 
                    <a class="btn btn-info" href="{{url('/application/edit/applicant')}}/{{$app->app_number}}"> Edit </a>  
                    <a class="btn btn-success" href="{{url('/application/view/applicant')}}/{{$app->app_number}}"> View </a> 
                  </td>
                </tr>
                @endforeach
                @endif

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    

  </div>


</div>

@endsection