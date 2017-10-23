<div class="form-group">
    {!!Form::label('name', 'Name') !!}
    {!!Form::text('name', null, ['class' => 'form-control']) !!}

    {!! Form::label('template_id', 'Template') !!}
    {!! Form::select(
        'template_id',
        \App\Template::getSelectList(),
        isset($campaign) ? $campaign->template_id : null,
        ['class' => 'form-control']
    )!!}
    {!! Form::select(
        'bunch_id',
        \App\Bunch::getSelectList(),
        isset($campaign) ? $campaign->bunch_id : null,
        ['class' => 'form-control']
    )!!}



    {!!Form::label('description', 'Description') !!}
    {!!Form::textarea('description', null, ['class' => 'form-control ske']) !!}

</div>
