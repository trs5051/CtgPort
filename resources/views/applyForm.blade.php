@extends('layouts.customer-master')
@section('content')
                <div class="col-md-10" id="content_term_condition" style="margin-top:10px;">
                        <div class="container-fluid">
                            <div style="width: 93.5%; height: 40px; background-color: #dededea8; color: #000000b8; padding: 5px 10px; margin-left: 8px; border-radius: 5px; text-align: center;">
                                <h3>Please select a sticker category and read the terms and conditions...</h3>
                            </div>
                            <div class="row form-group col-md-12 mt-4">
                                 <div class="select_cat_label pull-left col-md-2" style="color: #0b6bbd;"><span style="font-size:18px;">Sticker Category:</span> 
                                 </div>
                                    <div class="select_cat_input col-md-10" >
                                      <select  style=" border: 2px solid #0b6bbd73; width: 94%;" class="form-control searchField " name="sticker_category" id="sticker_category" class="form-control{{ $errors->has('sticker_category') ? ' is-invalid' : '' }}">
                                         <option disabled selected value> -- SELECT STICKER TYPE  -- </option>
                                        @foreach($stickers as $sticker)
                                           <option value="{{$sticker->value}}">{{ $sticker->name }}  </option>
                                        @endforeach
                                         </select>
                                        @if ($errors->has('sticker_category_id')) 
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('sticker_category') }}</strong>
                                                </span>
                                        @endif
                              </div>
                            </div>
                        </div>
                    <iframe src="{{asset('assets/pdf/pdf-at-iframe.pdf')}}" height="600px" class="ml-4 col-md-11" style="padding: 0;margin-bottom:10px;">               
                    </iframe>
                    <div class="row mt-2">
                          <div class="col-md-6" >
                        <input type="checkbox" placeholder=""  id="term_checkbox"> <span style="padding-left:10px; color:#f11414; font-size: 17px;"> I accept the terms and conditions.</span>
                         </div>
                         <div class="col-md-2 offset-md-3">
                             <button disabled  id="next_btn"  class="btn btn-info btn-block">Next</button>
                        </div>
                    </div>
                    </div>
                   <div class="col-md-10" id="content_form_B" hidden>
                    @include('forms.apply-form-B')
                </div>
                    <div class="col-md-10" id="content_form_E" hidden>
                          @include('forms.apply-form-E')
                    </div>
    @endsection
    @section('script')
        <script type="text/javascript" src="{{asset('assets/js/applyform.js') }}"></script>

    @endsection
