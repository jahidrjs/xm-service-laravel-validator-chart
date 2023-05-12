@extends('layout.main')
@section('main-container')
<div id="contact" class="contact-us section">
  <div class="container">
    <div class="row">

      <div class="col-lg-12 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.25s">
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
          @endif
        <h2>Historical Data Based on Symbol <b>{{$symbol_data['symbol']}}</b></h2>
      <table class="table table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Close</th>
            <th>Volume</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historical_data_list as $data)
            <tr>
                <td>{{ date('Y-m-d', $data['date']) }}</td>
                <td>{{ $data['open'] }}</td>
                <td>{{ $data['high'] }}</td>
                <td>{{ $data['low'] }}</td>
                <td>{{ $data['close'] }}</td>
                <td>{{ $data['volume'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
      </div>
    </div>
  </div>
</div>
@endsection