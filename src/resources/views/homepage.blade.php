@extends('layout.main')
@section('main-container')
  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" action="{{ route('submitForm') }}" method="post">
          @csrf
            <div class="row">
              <div class="col-lg-12">
              
                <div class="fill-form">
                  <div class="row">
                    <div class="col-lg-12">
                      <fieldset>
                      <label for="symbol">Company Symbol:</label>
                      <select id="symbol" name="symbol" class="form-control" required>
                          <option value="">Select a symbol</option>
                          @foreach ($symbols as $symbol)
                              <option value="{{ $symbol['Symbol'] }}" {{ old('symbol') == $symbol['Symbol'] ? 'selected' : '' }}>{{ $symbol['Symbol'] }}</option>
                          @endforeach
                      </select>
                      </fieldset>
                      <fieldset>
                        <input type="text" id="start_date" value="{{ old('start_date') }}" data-date-format="mm/dd/yyyy" name="start_date" autocomplete="off" id="start_date" placeholder="Start date" required>
                      </fieldset>
                      <fieldset>
                        <input type="text" name="end_date" value="{{ old('end_date') }}" id="end_date" placeholder="End date" autocomplete="off"  placeholder="End date" required>
                      </fieldset>
                      <fieldset>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                      </fieldset>
                      
                    </div>
                   
                    <div class="col-lg-12">
                      <fieldset>
                        <button type="submit" id="form-submit" class="main-button ">Submit</button>
                      </fieldset>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection