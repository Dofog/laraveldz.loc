@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Campaign</div>

                    <div class="panel-body">
                        
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>

                                <th width="15%">Name</th>
                                <th width="20%">Description</th>
                                <th width="20%">Template</th>
                                <th width="20%">Bunch</th>
                                <th width="25%">action</th>
                            </tr>
                            <tr>
                                <td colspan="5" class="light-green-background no-padding" title="Create new campaign">
                                    <div class="row centered-child">
                                        <div class="col-md-12">
                                            {{ link_to_route('campaign.create', 'create', null, ['class' => 'btn btn-primary btn-block']) }}

                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @foreach ($campaigns as $model)
                                <tr>

                                    <td>{{$model->name}}</td>
                                    <td>{{$model->description}}</td>
                                    <td>{{$model->template_id}}</td>
                                    <td>{{$model->bunch_id}}</td>
                                    <td>
                                        {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $model->id], 'method' => 'DELETE'])}}
                                        {{ link_to_route('campaign.preview', 'preview', [$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('campaign.show', 'info', [$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('campaign.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
                                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                        {{Form::close()}}
                                    </td>

                                </tr>
                            @endforeach
                        </table>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection