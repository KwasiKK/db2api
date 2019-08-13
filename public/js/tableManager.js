$(document).ready(function() {
    setTableBtnHandler();

    // var opts = {
    //     name: ,
    //     type: ,
    //     length: ,
    //     key: 
    // }
    function getTableRow(opts) {
        if (!opts) {
            opts = {
                name: "",
                type: "",
                length: "",
                key: ""
            };
        }

        if (opts.type)
            opts.type = "<option selected='true'>" + opts.type + "</option>";

        return `<tr class="field">
                <td><button type="button" class="btnAddFieldBefore" title="Add field before this row." >+</button></td>
                <td><input type="text" class="column_name form-control" placeholder="Column Name" value="` + opts.name + `" required /></td>
                <td>
                    <select class="column_type form-control" name="field_type[0]" id="field_0_2">` + opts.type + `<option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option><option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option><option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><optgroup label="Numeric"><option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">TINYINT</option><option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">SMALLINT</option><option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">MEDIUMINT</option><option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option><option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">BIGINT</option><option disabled="disabled">-</option><option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)">DECIMAL</option><option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38">FLOAT</option><option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308">DOUBLE</option><option title="Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)">REAL</option><option disabled="disabled">-</option><option title="A bit-field type (M), storing M of bits per value (default is 1, maximum is 64)">BIT</option><option title="A synonym for TINYINT(1), a value of zero is considered false, nonzero values are considered true">BOOLEAN</option><option title="An alias for BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE">SERIAL</option></optgroup><optgroup label="Date and time"><option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option><option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59">DATETIME</option><option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)">TIMESTAMP</option><option title="A time, range is -838:59:59 to 838:59:59">TIME</option><option title="A year in four-digit (4, default) or two-digit (2) format, the allowable values are 70 (1970) to 69 (2069) or 1901 to 2155 and 0000">YEAR</option></optgroup><optgroup label="String"><option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored">CHAR</option><option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option><option disabled="disabled">-</option><option title="A TEXT column with a maximum length of 255 (2^8 - 1) characters, stored with a one-byte prefix indicating the length of the value in bytes">TINYTEXT</option><option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option><option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes">MEDIUMTEXT</option><option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes">LONGTEXT</option><option disabled="disabled">-</option><option title="Similar to the CHAR type, but stores binary byte strings rather than non-binary character strings">BINARY</option><option title="Similar to the VARCHAR type, but stores binary byte strings rather than non-binary character strings">VARBINARY</option><option disabled="disabled">-</option><option title="A BLOB column with a maximum length of 255 (2^8 - 1) bytes, stored with a one-byte prefix indicating the length of the value">TINYBLOB</option><option title="A BLOB column with a maximum length of 16,777,215 (2^24 - 1) bytes, stored with a three-byte prefix indicating the length of the value">MEDIUMBLOB</option><option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value">BLOB</option><option title="A BLOB column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) bytes, stored with a four-byte prefix indicating the length of the value">LONGBLOB</option><option disabled="disabled">-</option><option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value">ENUM</option><option title="A single value chosen from a set of up to 64 members">SET</option></optgroup><optgroup label="Spatial"><option title="A type that can store a geometry of any type">GEOMETRY</option><option title="A point in 2-dimensional space">POINT</option><option title="A curve with linear interpolation between points">LINESTRING</option><option title="A polygon">POLYGON</option><option title="A collection of points">MULTIPOINT</option><option title="A collection of curves with linear interpolation between points">MULTILINESTRING</option><option title="A collection of polygons">MULTIPOLYGON</option><option title="A collection of geometry objects of any type">GEOMETRYCOLLECTION</option></optgroup>    </select>
                </td>
                <td><input type="number" class="column_length form-control" value="` + opts.length + `" /></td>
                <td><button type="button" class="btnAddFieldAfter" title="Add field after this row." >+</button></td>
                <td><button type="button" class="btnRemoveRow" title="Remove this row." >x</button></td>
            </tr>`;        
    };

    function setTableBtnHandler(){
        $(".btnAddFieldBefore").unbind().on("click", function (e) {
            e.preventDefault();

            var row = $(this).parent().parent();
            $(getTableRow()).insertBefore(row);      

            setTableBtnHandler();
        }); 

        $(".btnAddFieldAfter").unbind().on("click", function (e) {
            e.preventDefault();

            var row = $(this).parent().parent();

            $(getTableRow()).insertAfter(row); 
        
            setTableBtnHandler();
        }); 

        $(".btnRemoveRow").unbind().on("click", function (e) {
            if($(".field").length > 1){
                var row = $(this).parent().parent();
                row.remove();
            }
        }); 
    };

    function renderTable(columns, el) {
        var row = $(this).parent().parent();
        for (var i = 0; i < columns.length; i++) {
            el.append(getTableRow(columns[i]));
        }
        setTableBtnHandler();
    }

    $("#frmCreateTable").on("submit", function (e) {
        e.preventDefault();

        var columns = [];

        $("tr.field").each(function (i) {
            columns[i] = {
                name: $(this).find(".column_name").val(),
                type: $(this).find(".column_type").val(),
                length: $(this).find(".column_length").val()
            };
        });

        if (columns.length === 0) {
            $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Please add atleast one column for your table.
                </div>`);
            return;
        }

        var table_name = $('input.table_name').val().trim();
        if (table_name.length === 0) {
            $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Please enter the table name.
                </div>`);
            return;
        }

        var data = {
            "name": $('input.table_name').val(),
            "columns": columns,
            "project_id": $('input.project_id').val()
        };

        var method = "POST";
        var action = "creating";
        var url = "/table";

        if ($('input[name=edit]').val() == "true") {
            method = "PUT";
            action = "Editing";
            url = "/table/" + $("input[name=table_id]").val();
        }

        $.ajax({ //ajaxing the  data
            url: url,
            data: data,
            cache: false,
            method: method,
            success: function(response){
                console.log({response});
                if (response.success) {
                    window.location.reload();
                }
                else {
                    $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            Error occured while ` + action + ` the table.
                            Details:
                            <pre>` + response.output + `</pre>
                        </div>`);
                }
            },
        }).done(function(data) {
            console.log(data);
            //$(".debug").html(response);
        }).fail(function(jqXHR,status, errorThrown) {
            $(".feedback").html(`<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    Error occured while ` + action + ` the table.
                    Details:
                    <pre>` + jqXHR.responseText + `</pre>
                </div>`);
            console.error(errorThrown);
            console.log(jqXHR.responseText);
            console.log(jqXHR.status);
        });
    });
});