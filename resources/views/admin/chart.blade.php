@extends('admin.layouts.admin')
@section('title', 'Chart')
@section('js')
    <script src="{{ asset('admins/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('admins/highcharts.js') }}"></script>
    <script src="{{ asset('admins/exporting.js') }}"></script>
    <script src="{{ asset('admins/export-data.js') }}"></script>
    <script src="{{ asset('admins/chart-by-month.js') }}"></script>
    <script src="{{ asset('admins/chart-by-year.js') }}"></script>
@endsection
@section('content')
<div class="content-wrapper">

  @include('admin.partials.content_header',['namePage'=>'Chart','childPage'=>'Chart'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row ">
          <div class="col">
            <figure class="highcharts-figure">
                <h1>Chart by month</h1>
                <input type="hidden" id="payments_month" value="{{json_encode($payments_month)}}">
                <div id="chartByMonth"></div>
                <p class="highcharts-description">The chart shows the total number of booking by last 12 months that customer book</p>
            </figure>
            <figure class="highcharts-figure">
                <h1>Chart by year</h1>
                <input type="hidden" id="payments_year" value="{{json_encode($payments_year)}}">
                <div id="chartByYear"></div>
                <p class="highcharts-description">The chart shows the total number of booking by last 5 years that customer book</p>
            </figure>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

