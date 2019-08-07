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
                       <th>Table Count</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
                    @foreach($projects as $key => $project)
                       <tr>
                           <td>{{ $key }}</td>
                           <td>{{ $project->name }}</td>
                           <td>0</td>
                           <td><a href="/project/view/{{ $project->id }}" class="btn">View</a></td>
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

$(".btnShow").on("click", function (e) {
    e.preventDefault();
    $(".currentProjectInput").val($(this).attr("data-name"));
    $(".currentProjectIdInput").val($(this).attr("data-id"));

    $(".feedback").html(`<div class='alert alert-info alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            Making your project editable. Please wait...
        </div>`);

    $(".lastSlide").slideDown(666);

    $("#frmTemplateBuilder").trigger("submit");
});

</script>

@stop