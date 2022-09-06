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
var responseData = [];
var displayLength = 10;

function initDatatable(DTtableSelector,clientDTtableSelector){
    //serverside datatable

         table = $('.'+DTtableSelector).DataTable({
                "bProcessing": true,
                "serverSide": true,
                "paging": true,
                "ordering": false,
                "searching": true,
                "pageLength" : displayLength,
                "bLengthChange" : false,
                "ajax":{    
                            async: false,
                            cache : true,
                            url : mainurl, // json
                            type: "GET",  // type of method
                            data: function ( d ) {
                                    delete d.search;
                                    delete d.columns;
                                    delete d.length;
                                    return $.extend( {}, d, {
                                        "length": displayLength
                                    } );
                            },
                            dataSrc: function(json){
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

                    //disable pagination
                    $(this).nextAll(".dataTables_paginate").find("a").addClass("disabled");
                    
                    //call the other ajax calls based on the total no of records in the DB 
                    setTimeout(() => {
                        reloadDatatable(this.fnGetData(),table,oSettings._iRecordsTotal,displayLength,DTtableSelector,clientDTtableSelector);  
                    }, 1);

                }
        });

        table.on( 'preDraw', function (e, settings) {
                    return false;
                });
}


function loadDatatable(table,data,DTtableSelector,clientDTtableSelector){
    //clienside datatable
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
                        "pageLength" : displayLength,
                        data: data,
                        columns: [
                            { data: 'user_id' },
                            { data: 'name' },
                            { data: 'email' },
                            { data: 'mobile_number' }
                        ]
                    } );
}

// async function reloadDatatable(responseData,table,totalRec,displatLen,DTtableSelector,clientDTtableSelector){
//     let loopLength = Math.floor(totalRec/displatLen);
//     fetchRemainingData(table,responseData,displatLen,loopLength,DTtableSelector,clientDTtableSelector);
// }

function reloadDatatable(responseData,table,totalRec,displatLen,DTtableSelector,clientDTtableSelector){
    let loopLength = Math.floor(totalRec/displatLen);
    let sucessLength = [];
    for(let i = 1; i <= loopLength; i++){
        let postData = {
                "draw":1,
                "start": i*displatLen,
                "length": displatLen
            };
        //var fechedData = await fetchRemainingData(i,displatLen);

         $.ajax({
                async: true,
                url : mainurl, // json
                type: "GET",  // type of method
                data: postData,
                success: function(data){
                    let res = JSON.parse(data);
                    responseData = [...responseData,...res.data];
                    sucessLength.push(true);
                    if(sucessLength.length == loopLength){
                        loadDatatable(table,responseData,DTtableSelector,clientDTtableSelector);
                    }
                }
            });
}
}


$(document).ready(function () {
        let DTtableSelector = "serverSidetable",
        clientDTtableSelector = "clientSidetable";

        $("."+clientDTtableSelector).hide();
        initDatatable(DTtableSelector,clientDTtableSelector);
        //table.draw();
});
</script>