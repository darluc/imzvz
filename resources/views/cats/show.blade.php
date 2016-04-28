@extends('layouts.master')

@section('header')
    <a href="{{ url('/') }}">Back to overview</a>
    <h2> {{ $cat->name }} </h2>
    <a href="{{ url('cat/'.$cat->id.'/edit') }}">
        <span class="glyphicon glyphicon-edit"></span> Edit
    </a>
    {{ Form::open(array('route' => array('cat.destroy', $cat->id), 'method' => 'delete')) }}
    <button type="submit" class="btn btn-danger btn-mini">
        <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Delete
    </button>
    {{ Form::close() }}
    <p>Last edited: {{ $cat->updated_at->diffForHumans() }}</p>
@stop

@section('content')
    <p>Owner: {{ $cat->user->username }}</p>
    <p>Date of Birth: {{ $cat->date_of_birth }}</p>
    <p>
        @if ($cat->breed)
            Breed: {{ link_to('cats/breeds/'.$cat->breed->name, $cat->breed->name) }}
        @endif
    </p>
@stop
