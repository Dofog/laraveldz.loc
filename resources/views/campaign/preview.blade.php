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
                                <th width="20%">Subject	</th>
                                <th width="80%">{{$title}}</th>
                            </tr>
                            <tr>
                                <th width="20%">To</th>
                                <th width="80%">
                                    @foreach ($emails as $model)
                                         {{$model}} ,
                                    @endforeach
                                </th>
                            </tr>
                            <tr>
                                <th width="20%">From</th>
                                <th width="80%">{{$email}}</th>
                            </tr>
                            <tr>
                                <th width="20%">Message</th>
                                <th width="80%">{!! $message !!}  </th>
                            </tr>
                           


                        </table>

                        {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $campaign->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('campaign.send', 'send',  [$campaign->id], ['class' => 'btn btn-info btn-xs']) }} |
                        {{ link_to_route('campaign.show', 'info', [$campaign->id], ['class' => 'btn btn-info btn-xs']) }} |
                        {{ link_to_route('campaign.edit', 'Edit', [$campaign->id], ['class' => 'btn btn-success btn-xs']) }}
                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection