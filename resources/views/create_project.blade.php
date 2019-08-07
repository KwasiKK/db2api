@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create a new project @guest "User" @else {{ Auth::user()->name }}  @endguest</h1>
            <div class="feedback"></div> 
            <div class="output">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>                             
        </div>   
        <!-- /.col-lg-12 -->
    </div><!-- /.row -->

    <div class="row createProject">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" >
            <div class="panel panel-default createProjectPanel">
                <div class="panel-heading">
                    <i class="fa fa-plus fa-fw"></i> Create Project
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    {!! Form::open(["id" => "frmCreateProject" , "class" => "form-horizontal frmCreateProject jqForm"]) !!}
                        <div class="form-group">
                          {!! Form::label('project_name', "Project Name:", ["class" => "col-md-4 control-label"]) !!}
                          <div class="col-md-6">
                                {!! Form::text('project_name', null, ["class" => "form-control", "placeholder" => "Name"]) !!}
                          </div> 
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-default form-control" >SUBMIT</button>
                          </div> 
                        </div>
                        <div class="form-group">
                          <div class="col-md-6 col-md-offset-4 loadingTarget">
                          </div> 
                        </div>                                       
                    {!! Form::close() !!}                  
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
var readyStatuses = {
    db: false,
    files: false,
};

var goToList = function() {
    if (readyStatuses.db && readyStatuses.files)
        window.location.href = "/home";
};

$("#frmCreateProject").on("submit", function (e) {
    e.preventDefault();
    //$(this).find('button, input[type=submit]').attr("disabled", true);
    var data = {
        "project_name": $('input[name=project_name]').val()
    };

    // $( ".createProject" ).animate({
    //     width: "0px",
    //     height: "0px",
    //     opacity: 0
    // }, {
    //     queue: true,
    //     duration: 1000
    // }
    // , "linear"
    // ,{complete: function() {
    //     console.log("done");
    //     //$( ".chooseWebsiteType" ).slideDown("slow");
    // }}).fadeOut(0);
    
    //$( ".chooseWebsiteType" ).slideDown("slow");

    $.ajax({ //ajaxing the  data
        url: "/create_project_in_db",
        data: data,
        cache: false,
        method: "POST",
        success: function(response){
            if (response.success) {
                readyStatuses.db = true;
                goToList();
            }
            else {
                $(".feedback").append(`<div class='alert alert-danger alert-dismissable'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                     `+response.message+`
                 </div>`);
            }
            // $(".feedback").append(`<div class='alert alert-success alert-dismissable'>
            //      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            //      `+response.message+`
            //  </div>`);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            $(".feedback").html("<pre>" + xhr.responseText + "</pre>");
        }
    }).done(function(data) {
        //console.log(data);
        //$(".debug").html(response);
    }).fail(function(jqXHR,status, errorThrown) {
        $(".feedback").html("<pre>" + jqXHR.responseText + "</pre>");
        console.log(errorThrown);
        console.log(jqXHR.responseText);
        console.log(jqXHR.status);
    });

    $.ajax({ //ajaxing the  data
        url: "/create_project",
        data: data,
        cache: false,
        method: "POST",
        success: function(response) {
            if (response.success) {
                readyStatuses.files = true;
                goToList();
            }
            else {
                $(".feedback").append(`<div class='alert alert-danger alert-dismissable'>
                     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                     `+response.message+`
                 </div>`);
            }
            //window.location.reload();
            // create_project_status = true;

            // console.log("Done ajaxing now");
            
            // output = JSON.parse(response.output);
            // console.log(output);

            // $(".feedback").append(`<div class='alert alert-success alert-dismissable'>
            //         <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            //         `+response.message+`
            //     </div>`);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            $(".feedback").html("<pre>" + xhr.responseText + "</pre>");
        }
    }).done(function(data) {
        //console.log(data);
        //$(".debug").html(response);
    }).fail(function(jqXHR,status, errorThrown) {
        $(".feedback").html("<pre>" + jqXHR.responseText + "</pre>");
        console.log(errorThrown);
        console.log(jqXHR.responseText);
        console.log(jqXHR.status);
    });   
});
</script>
@endsection