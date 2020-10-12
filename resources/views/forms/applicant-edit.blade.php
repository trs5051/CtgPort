@extends('layouts.customer-master')
@section('content')
<div class="col-md-10" id="content_term_condition" style="margin-top:0px; ">  	
        <div class="content-area" style="padding-top: 0px;">
        <div class="container-fluid  pl-0 pr-0" >
        	@if(!empty($app))
                        @if($app->sticker_category == 'A' ||$app->sticker_category == 'B' ||
                            $app->sticker_category == 'C' ||$app->sticker_category == 'D' )
                                  @include('forms.apply-form-B-edit')
                        @elseif($app->sticker_category == 'E' || $app->sticker_category == 'F' 
                        || $app->sticker_category == 'M' || $app->sticker_category == 'S'
                        || $app->sticker_category == 'T')
                        
                                  @include('forms.apply-form-E-edit')
                        @endif
            @endif
        </div>
       </div>
</div>
@endsection
@section('script')
 <script type="text/javascript" src="{{asset('assets/js/applyform.js') }}"></script>

@endsection
