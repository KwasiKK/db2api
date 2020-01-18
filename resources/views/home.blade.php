@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Your Projects
                    <a href="/new_project" type="button" class="btn btn-default pull-right" >
                        <span class="glyphicon glyphicon-plus"></span> New Project
                    </a> 
                </h1>
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="feedback"></div> 
                <div class="output"></div>                                              
            </div>            
            <!-- /.col-lg-12 -->
        </div><!-- /.row -->
        <div class="row">
            <table class="table">
               <thead>
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                       <!-- <th>Table Count</th> -->
                       <th>Actions</th>
                       <th>Export</th>
                   </tr>
               </thead>
               <tbody>
                    @foreach($projects as $key => $project)
                       <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ strstr($project->name, "__", true) }}</td>
                            <!-- <td>{{ count($project->name) }}</td> -->
                            <td>
                                <a href="/project/view/{{ $project->id }}" class="btn btn-default btn-xs">View</a>
                                {!! Form::open(array('url' => 'project/' . $project->id, 'class' => 'btn table-btn')) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-warning')) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                <a href="/export/laravel/{{ $project->id }}" type="button" class="btn btn-success btn-xs" >
                                    <span class="glyphicon glyphicon-plus"></span> Export Laravel Project
                                </a>
                            </td>
                       </tr>
                    @endforeach
               </tbody> 
            </table>
        </div>
    </div>      
    {!! Form::open(["url" => "build", "id" => "frmTemplateBuilder", "class" => "form-horizontal display-none", "placeholder" => "project_name"]) !!}
        <input type="hidden" name="project" class="currentProjectInput" />
        <input type="hidden" name="project_id" class="currentProjectIdInput" />
    {!! Form::close() !!}

@stop

@section('scripts')
<style type="text/css">

</style>

<script type="text/javascript">

</script>
@stop