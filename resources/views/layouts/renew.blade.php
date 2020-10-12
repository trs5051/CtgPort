@extends('layouts.customer-master')
@section('content')
<div class="col-md-10" id="content_term_condition" style="margin-top:10px;">
    @if(!empty($renew_app))
        @if($renew_app->sticker_category == 'A' || $renew_app->sticker_category == 'B' || $renew_app->sticker_category == 'C' || $renew_app->sticker_category == 'D' )
              @include('forms.apply-form-B')
        @elseif($renew_app->sticker_category == 'E' || $renew_app->sticker_category == 'F' || $renew_app->sticker_category == 'M' || $renew_app->sticker_category == 'S')
              @include('forms.apply-form-E')
        @endif
    @endif
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('assets/js/applyform.js') }}"></script>
@endsection
