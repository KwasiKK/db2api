@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $project->name }} tables
                    <a href="/new_project" type="button" class="btn btn-default pull-right" >
                        <span class="glyphicon glyphicon-plus"></span> New Project
                    </a> 
                </h1>
                <div class="feedback">
                    <!-- <pre>{{ print_r($project) }}</pre> -->
                </div> 
                <div class="output"></div>                                              
            </div>            
            <!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <div class="row createTable">
            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" >
                <div class="panel panel-default createProjectPanel">
                    <div class="panel-heading">
                        <i class="fa fa-plus fa-fw"></i> Create Table <input type="text" class="table_name" placeholder="Table Name">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        {!! Form::open(["id" => "frmCreateTable" , "class" => "form-horizontal frmCreateTable jqForm"]) !!}
                        <div class="table-responsive" >      
                            <table class="table table-overed table-bordered">
                                <thead><tr><th>Add</th><th>Name</th><th>Type</th><th>Length</th><th>Add</th><th>Del</th></tr></thead>
                                <tbody class="create-table-rows">
                                    <tr class="field">
                                        <td><button type="button" class="btnAddFieldBefore" title="Add column before this row." >+</button></td>
                                        <td><input type="text" class="column_name form-control" placeholder="Column Name" /></td>
                                        <td>
                                            <select class="column_type form-control" name="field_type[0]" id="field_0_2">
                                                <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
                                                <option selected title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
                                                <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><optgroup label="Numeric"><option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">TINYINT</option><option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">SMALLINT</option><option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">MEDIUMINT</option><option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option><option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">BIGINT</option><option disabled="disabled">-</option><option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)">DECIMAL</option><option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38">FLOAT</option><option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308">DOUBLE</option><option title="Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)">REAL</option><option disabled="disabled">-</option><option title="A bit-field type (M), storing M of bits per value (default is 1, maximum is 64)">BIT</option><option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true">BOOLEAN</option><option title="An alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE">SERIAL</option></optgroup><optgroup label="Date and time"><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59">DATETIME</option><option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)">TIMESTAMP</option><option title="A time, range is -838:59:59 to 838:59:59">TIME</option><option title="A year in four-digit (4, default) or two-digit (2) format, the allowable values are 70 (1970) to 69 (2069) or 1901 to 2155 and 0000">YEAR</option></optgroup><optgroup label="String"><option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored">CHAR</option><option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option><option disabled="disabled">-</option><option title="A TEXT column with a maximum length of 255 (2^8 - 1) characters, stored with a one-byte prefix indicating the length of the value in bytes">TINYTEXT</option><option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes">MEDIUMTEXT</option><option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes">LONGTEXT</option><option disabled="disabled">-</option><option title="Similar to the CHAR type, but stores binary byte strings rather than non-binary character strings">BINARY</option><option title="Similar to the VARCHAR type, but stores binary byte strings rather than non-binary character strings">VARBINARY</option><option disabled="disabled">-</option><option title="A BLOB column with a maximum length of 255 (2^8 - 1) bytes, stored with a one-byte prefix indicating the length of the value">TINYBLOB</option><option title="A BLOB column with a maximum length of 16,777,215 (2^24 - 1) bytes, stored with a three-byte prefix indicating the length of the value">MEDIUMBLOB</option><option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value">BLOB</option><option title="A BLOB column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) bytes, stored with a four-byte prefix indicating the length of the value">LONGBLOB</option><option disabled="disabled">-</option><option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value">ENUM</option><option title="A single value chosen from a set of up to 64 members">SET</option></optgroup><optgroup label="Spatial"><option title="A type that can store a geometry of any type">GEOMETRY</option><option title="A point in 2-dimensional space">POINT</option><option title="A curve with linear interpolation between points">LINESTRING</option><option title="A polygon">POLYGON</option><option title="A collection of points">MULTIPOINT</option><option title="A collection of curves with linear interpolation between points">MULTILINESTRING</option><option title="A collection of polygons">MULTIPOLYGON</option><option title="A collection of geometry objects of any type">GEOMETRYCOLLECTION</option></optgroup>    </select>
                                        </td>
                                        <td><input type="number" class="column_length form-control" value="100" /></td>
                                        <td><button type="button" class="btnAddFieldAfter" title="Add column after this row." >+</button></td>
                                        <td><button type="button" class="btnRemoveRow" title="Remove this row." >x</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>*Note. id, created_at and updated_at fields will be added to your table.</p>
                        </div>
                        <div class="form-group">
                          <div class="col-xs-6 col-xs-offset-3">
                            <button type="submit" class="btn btn-default form-control" >SUBMIT</button>
                          </div> 
                        </div>                                       
                        {!! Form::close() !!}                  
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <table class="table">
               <thead>
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                       <th>Column Count</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
                    @foreach($tables as $key => $table)
                       <tr>
                           <td>{{ $key }}</td>
                           <td>{{ $table->name }}</td>
                           <td>{{ count(json_decode($table->columns)) }}</td>
                           <td><a href="/table/{{ $table->id }}" class="btn">View</a></td>
                       </tr>
                    @endforeach
               </tbody> 
            </table>
        </div>
    </div>
    <input type="hidden" class="project_id" value="{{ $project->id }}">
@stop

@section('scripts')
<script type="text/javascript" src="/js/tableManager.js"></script>
@stop