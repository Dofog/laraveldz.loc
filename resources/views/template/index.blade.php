@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Templates</div>

                    <div class="panel-body">
                        
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>

                                <th width="15%">Name</th>
                                <th width="60%">Content</th>
                                <th width="25%">action</th>
                            </tr>
                            <tr>
                                <td colspan="3" class="light-green-background no-padding" title="Create new template">
                                    <div class="row centered-child">
                                        <div class="col-md-12">
                                            {{ link_to_route('template.create', 'create', null, ['class' => 'btn btn-primary btn-block']) }}

                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @foreach ($templates as $model)
                                <tr>

                                    <td >{{$model->name}}</td>
                                    <td width="200px">{!!$model->content!!}</td>
                                    <td >
                                        {{Form::open(['class' => 'confirm-delete', 'route' => ['template.destroy', $model->id], 'method' => 'DELETE'])}}
                                        {{ link_to_route('template.show', 'info', [$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('template.edit', 'Edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
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