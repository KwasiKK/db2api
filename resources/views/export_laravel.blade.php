@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Exporting {{ $project->name }} tables
                    <a href="/new_project" type="button" class="btn btn-default pull-right" >
                        <span class="glyphicon glyphicon-eye-open"></span> View Project
                    </a>
                    <a href="/new_project" type="button" class="btn btn-default pull-right" >
                        <span class="glyphicon glyphicon-plus"></span> Create New Project
                    </a>
                </h1>
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable">
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="feedback">
                </div> 
                <div class="output"></div>                                              
            </div>            
            <!-- /.col-lg-12 -->
        </div><!-- /.row -->
        <div class="row confirm-tables">
			<h3>The following tables will be used to create the Laravel application. Please de-select tables you want to exclude from the project export.</h3>
			<div class="tables">
				@foreach($tables as $key => $table)
					<div class="form-group">
			            <input type="checkbox" name="table-checkbox-default" id="table-checkbox-default-{{ $table->id }}" autocomplete="off" checked value="{{ $table->id }}" />
			            <div class="btn-group">
			                <label for="table-checkbox-default-{{ $table->id }}" class="btn btn-default">
			                    <span class="glyphicon glyphicon-ok"></span>
			                    <span> </span>
			                </label>
			                <label for="table-checkbox-default-{{ $table->id }}" class="btn btn-default active">
			                    {{ $table->name }}
			                </label>
			            </div>
			        </div>
		        @endforeach
			</div>
        </div><!-- /.row -->
        <div class="row confirm-features">
			<h3>The following Laravel items will be created for your project:</h3>
			<div class="laravel-features">
				@php ( $features = array("routes", "migrations", "models", "controllers", "views", "dependencies", "authentication") )
				@foreach($features as $key => $feature)
					<div class="form-group">
			            <input type="checkbox" name="feature-checkbox-success" id="feature-checkbox-success-{{ $feature }}" autocomplete="off" checked value="{{ $feature }}" />
			            <div class="btn-group">
			                <label for="feature-checkbox-success-{{ $feature }}" class="btn btn-success">
			                    <span class="glyphicon glyphicon-ok"></span>
			                    <span> </span>
			                </label>
			                <label for="feature-checkbox-success-{{ $feature }}" class="btn btn-default active">
			                    Laravel {{ $feature }}
			                </label>
			            </div>
			        </div>
		        @endforeach
			</div>
	    </div>
		<div class="row final-step">
			<button type="button" class="main-btn btn-export"><span class="glyphicon glyphicon-export"></span> Export Project</button>
			<div class="loading-block">
				<div class="alert alert-success alert-dismissable">
	                The project files are being created, this can take several minutes. Please wait...
	            </div>
	            <img src="/img/loading.gif" class="loading-img">
			</div>
		</div>
    </div>
    <input type="hidden" class="project_id" value="{{ $project->id }}">
@stop

@section('scripts')
<script type="text/javascript" src="/js/laravelExportManager.js"></script>
@stop