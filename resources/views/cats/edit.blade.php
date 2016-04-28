@extends('layouts.master')

@section('header')
    <h2>Edit a cat</h2>
@stop

@section('content')
    {!! Form::model($cat, ['url' => '/cat/' . $cat->id, 'method' => 'put']) !!}
    @include('partials.forms.cat')
    {!! Form::close() !!}
@stop