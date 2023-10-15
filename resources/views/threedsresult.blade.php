@extends('common.master')
@section('content')
<script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.41.0/adyen.js" integrity="sha384-i+7Em2dyjN9Hkb0A6J/i7ijqRtlgbq2vqHFDShR7r1eDyIQOTtVTjIw/n7ewuAoT" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.41.0/adyen.css" integrity="sha384-BRZCzbS8n6hZVj8BESE6thGk0zSkUZfUWxL/vhocKu12k3NZ7xpNsIK39O2aWuni" crossorigin="anonymous">


<h1>{{ $result }}</h1>

@endsection