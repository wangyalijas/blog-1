@extends('console.layouts.frame')

@section('content')

    <articles-editor @if(isset($id)) :id="{{ $id }}" @endif/>

@endsection
