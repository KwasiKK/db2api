@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit table
                    <a href="/project/view/{{ $table->project_id }}" type="button" class="btn btn-default pull-right" >
                        <span class="glyphicon glyphicon-plus"></span> New Table
                    </a> 
                </h1>
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info alert-dismissable">
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="feedback">
                    <!-- <pre>{{ print_r($table) }}</pre> -->
                </div> 
                <div class="output"></div>                                              
            </div>
            <!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row createTable">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" >
                <div class="panel panel-default createProjectPanel">
                    <div class="panel-heading">
                        <i class="fa fa-plus fa-fw"></i> Edit Table <input type="text" class="table_name" placeholder="Table Name" value="{{ $table->name }}">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        {!! Form::open(["id" => "frmCreateTable" , "class" => "form-horizontal frmCreateTable jqForm"]) !!}
                        <div class="table-responsive" >      
                            <table class="table table-overed table-bordered">
                                <thead><tr><th>Add</th><th>Name</th><th>Type</th><th>Length</th><th>Add</th><th>Del</th></tr></thead>
                                <tbody class="create-table-rows">
                                </tbody>
                            </table>
                            <p>*Note. id, created_at and updated_at fields will be added to your table.</p>
                        </div>
                        <div class="form-group">
                          <div class="col-xs-6 col-xs-offset-3">
                            <button type="submit" class="btn btn-default form-control" >SUBMIT</button>
                          </div> 
                        </div>
                        <input type="hidden" name="edit" value="true">
                        <input type="hidden" name="table_id" value="{{ $table->id }}">
                        {!! Form::close() !!}                  
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" class="project_id" value="{{ $table->project_id }}">
    <input type="hidden" name="columns" value="{{ $table->columns }}">
@stop

@section('scripts')
<script type="text/javascript" src="/js/tableManager.js"></script>
<script type="text/javascript">
    var columns = JSON.parse($("input[name=columns]").val());
    console.log('$(".create-table-rows")', $(".create-table-rows"));
    renderTable(columns, $(".create-table-rows"));
</script>
@stop