<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Name') !!}
    <div class="form-controls">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        @if ($errors->has('name'))
            <span class="help-block">
                @foreach ($errors->get('name') as $error)
                    {{ $error }}
                @endforeach
            </span>
        @endif
    </div>
</div>
<div class="form-group @if ($errors->has('date_of_birth')) has-error @endif">
    {!! Form::label('date_of_birth', 'Date of Birth') !!}
    <div class="form-controls">
        {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
        @if ($errors->has('date_of_birth'))
            <span class="help-block">
                @foreach ($errors->get('date_of_birth') as $error)
                    {{ $error }}
                @endforeach
            </span>
        @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('breed_id', 'Breed') !!}
    <div class="form-controls">
        {!! Form::select('breed_id', $breeds, null, ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::submit('Save Cat', ['class' => 'btn btn-primary']) !!}