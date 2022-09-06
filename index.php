<!DOCTYPE html>

<html>
    <head>
      
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
      
    <div class="container">
    <div class="">
        <h1>Server Side Datatable</h1>
            <div class="">
                <table class="serverSidetable" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                    </tr>
                </thead>
               </table>
               <table class="clientSidetable" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                    </tr>
                </thead>
               </table>
        </div>
    </div>
</div>
<script type="text/javascript">
var table;
var mainurl = "getData.php";

function initDatatable(DTtableSelector,clientDTtableSelector){
    //serverside
        let table = $('.'+DTtableSelector).DataTable({
                "bProcessing": true,
                "serverSide": true,
                "paging": true,
                "ordering": false,
                "searching": true,
                //"deferLoading": 57,
                "pageLength" : 10,
                "bLengthChange" : false,
                "ajax":{
                            cache : true,
                            url : mainurl, // json
                            type: "GET",  // type of method
                            data: function ( d ) {
                                let len = d.length;
                                    delete d.search;
                                    delete d.columns;
                                    delete d.length;
                                    return $.extend( {}, d, {
                                        "length": len
                                    } );
                            },
                            dataSrc: function(json){
                                console.log(json);
                                    //json.draw = 2;
                                    json.recordsTotal = json.recordsTotal;
                                    json.recordsFiltered = json.recordsFiltered;
                                    return json.data;
                            },
                            error: function(){  
                            }
                },
                columns: [
                            { data: 'user_id' },
                            { data: 'name' },
                            { data: 'email' },
                            { data: 'mobile_number' }
                        ],
                "fnDrawCallback": function( oSettings ) {
                    console.log(oSettings);
                    //disable search
                    $(this).parents(".dataTables_wrapper").find('.dataTables_filter input').attr("disabled", true);
                    table.on( 'preDraw', function (e, settings) {
                            return false;
                    });
                    //disable pagination
                    $(this).nextAll(".dataTables_paginate").find("a").addClass("disabled");
                    
                    //call the other ajax calls based on the total no of records in the DB 
                    reloadDatatable(this.fnGetData(),table,oSettings._iRecordsTotal,oSettings._iDisplayLength,DTtableSelector,clientDTtableSelector);
                }
        });
}


function loadDatatable(table,data,DTtableSelector,clientDTtableSelector){
                    table.destroy();
                    $("."+DTtableSelector).remove();
                    $("."+clientDTtableSelector).show();
                    $('.'+clientDTtableSelector).DataTable({
                        "bProcessing": true,
                        "serverSide": false,
                        "paging": true,
                        "ordering": true,
                        "searching": true,
                        "bLengthChange" : false,
                        "aaSorting": [],
                        data: data,
                        columns: [
                            { data: 'user_id' },
                            { data: 'name' },
                            { data: 'email' },
                            { data: 'mobile_number' }
                        ]
                    } );
}

function reloadDatatable(initialData,table,totalRec,displatLen,DTtableSelector,clientDTtableSelector){
    //clienside
    let finalData = initialData;
    
    console.log(initialData);
    console.log(Math.ceil(totalRec/displatLen));
    let loopLength = Math.ceil(totalRec/displatLen);
    for(let i = 1; i <= loopLength; i++){
        
        setTimeout(() => {
            var fechedData = fetchRemainingData(i,displatLen);
            finalData = [...finalData,...fechedData];
            
            if(loopLength == i){
                 console.log(finalData);
                 loadDatatable(table,finalData,DTtableSelector,clientDTtableSelector);
            }
        }, 2000);
    }
    
    //table.destroy();
}

function fetchRemainingData(start,displatLen){
    return [{user_id: "1", name: "test feached", email: "sa", mobile_number: "1111111111"}];
}


$(document).ready(function () {
        let DTtableSelector = "serverSidetable",
        clientDTtableSelector = "clientSidetable";

        $("."+clientDTtableSelector).hide();
        initDatatable(DTtableSelector,clientDTtableSelector);
        //table.draw();
});
</script>