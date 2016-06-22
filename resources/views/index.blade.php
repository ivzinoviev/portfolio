@extends('layouts.master')
@section('content')
<div class='container text-center'>
<h1>Портфолио</h1>
</div>
@include('info', ['data' => $info_data])
@include('skill', ['data' => $skill_data])
@include('work', ['data' => $work_data])
@endsection
