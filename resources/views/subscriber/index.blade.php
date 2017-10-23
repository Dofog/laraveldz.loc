@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subscribers <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('bunch.index')}}">
                            <i class="fa fa-backward" aria-hidden="true"></i> back
                        </a></div>

                    <div class="panel-body">
                         <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="15%">F_name</th>
                                <th width="55%">L_name</th>
                                <th width="5%">Email</th>
                                <th width="25%">action</th>
                            </tr>
                            <tr>
                                <td colspan="4" class="light-green-background no-padding" title="Create new subscriber">
                                    <div class="row centered-child">
                                        <div class="col-md-12">
                                            {{ link_to_route('subscriber.create', 'create', ['bunch'=>$bunch->id], ['class' => 'btn btn-primary btn-block']) }}

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @foreach ($subscribers as $model)
                                <tr>
                                    <td>{{$model->f_name}}</td>
                                    <td>{{$model->l_name}}</td>
                                    <td>{{$model->email}}</td>
                                    <td>
                                      
                                        {{Form::open(['class' => 'confirm-delete', 'route' => array_merge(['subscriber.destroy',$model->id],compact('bunch','subscriber')), 'method' => 'DELETE'])}}
                                        {{Form::open(['route' => array_merge(['subscriber.destroy'],compact('bunch','subscriber')),'method' => 'DELETE'])}}
                                        {{ link_to_route('subscriber.show', 'info', ['bunch'=>$bunch->id,'subscriber'=>$model->id], ['class' => 'btn btn-info btn-xs']) }} |
                                        {{ link_to_route('subscriber.edit', 'edit', ['bunch'=>$bunch->id,'subscriber'=>$model->id], ['class' => 'btn btn-success btn-xs']) }}
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