@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Bunch</div>

                    <div class="panel-body">
                         <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="15%">name</th>
                                <th width="55%">Description</th>
                                <th width="5%">email</th>
                                <th width="25%">action</th>
                            </tr>
                            <tr>
                                <td colspan="4" class="light-green-background no-padding" title="Create new template">
                                    <div class="row centered-child">
                                        <div class="col-md-12">
                                            {{ link_to_route('bunch.create', 'create', null, ['class' => 'btn btn-primary btn-block']) }}

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($bunches as $model)
                                <tr>
                                    <td>{{$model->name}}</td>
                                    <td>{{$model->description}}</td>
                                    <td>{{$model->email}}</td>
                                    <td>
                                        {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $model->id], 'method' => 'DELETE'])}}
                                        {{ link_to_route('subscriber.index', 'subscriber', ['bunch'=>$model], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('bunch.edit', 'edit', [$model->id], ['class' => 'btn btn-success btn-xs']) }}
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