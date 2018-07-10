var save_method; //for save method string
var table;
var text;
var tableID = $("table").attr('id');

$(document).ready(function() 
{
    if(tableID == "barangays-table")
    {
    //datatables
            table = $('#barangays-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "barangays/barangays_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    else if(tableID == "cis-table")
    {
    //datatables
            table = $('#cis-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "cis/cis_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "family-table")
    {
    //datatables

            // get child_id
            var child_id = $('[name="child_id"]').val();

            table = $('#family-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../profiles/profiles_controller/ajax_list/" + child_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[4],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "hvi-table")
    {
    //datatables

            // get child_id
            var child_id = $('[name="child_id"]').val();

            table = $('#hvi-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../../hvi/hvi_controller/ajax_list/" + child_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "scrollX": true 
            });
    }
    else if(tableID == "deworming-table")
    {
    //datatables
            table = $('#deworming-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "deworming/deworming_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    else if(tableID == "monthly-table")
    {
    //datatables
            table = $('#monthly-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "monthly/monthly_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    else if(tableID == "graduated-table")
    {
    //datatables
            table = $('#graduated-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "graduated/graduated_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],
                "scrollX": true
            });
    }
    else if(tableID == "attendance-table")
    {
    //datatables
            // get date
            var attendance_date = $('[name="attendance_date"]').val();

            //var present_count = 0;

            table = $('#attendance-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../attendance/attendance_controller/ajax_list/" + attendance_date,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var present_stat = data[7],
                      $node = this.api().row(row).nodes().to$();

                    var present_count = data[9];
                    var child_count = data[10];

                  if (present_stat == 'A') 
                  {
                    //present_count = (present_count - 1);
                    $node.css('background-color', '#cccccc');
                  }
                  else
                  {
                    //present_count = (present_count + 1);
                    $node.css('background-color', '#66ff99');
                  }

                  $("#present_count").val(present_count + ' out of ' + child_count + ' are present');
                },

                "scrollX": true
            });      
    }
    else if(tableID == "profiles-deworming-table")
    {
    //datatables

            // get child_id
            var child_id = $('[name="child_id"]').val();

            table = $('#profiles-deworming-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../profiles/profiles_deworming_controller/ajax_list/" + child_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "scrollX": true 
            });
    }
    else if(tableID == "profiles-monthly-table")
    {
    //datatables

            // get child_id
            var child_id = $('[name="child_id"]').val();

            table = $('#profiles-monthly-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../profiles/profiles_monthly_controller/ajax_list/" + child_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "scrollX": true 
            });
    }
    else if(tableID == "notifications-monthly-table")
    {
    //datatables
            table = $('#notifications-monthly-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../cis/cis_controller/ajax_list_monthly",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "notifications-quarterly-table")
    {
    //datatables
            table = $('#notifications-quarterly-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../cis/cis_controller/ajax_list_quarterly",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "notifications-deworming-table")
    {
    //datatables
            table = $('#notifications-deworming-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../cis/cis_controller/ajax_list_deworming",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "notifications-severe-table")
    {
    //datatables
            table = $('#notifications-severe-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../cis/cis_controller/ajax_list_severe",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index )
                {
                  var sex = data[6],
                      $node = this.api().row(row).nodes().to$();

                  if (sex == 'Male') 
                  {
                    $node.css('background-color', '#99ffff');
                  }
                  else
                  {
                    $node.css('background-color', '#ffcccc');
                  }
                },
                "scrollX": true 
            });
    }
    else if(tableID == "logs-table")
    {
            table = $('#logs-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "logs/logs_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var log_type = data[1],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (log_type == 'Add') {
                     $node.css('background-color', '#99ff99');
                  }
                  else if (log_type == 'Update') {
                     $node.css('background-color', '#99ffff');
                  }
                  else if (log_type == 'Delete') {
                     $node.css('background-color', '#ffcc99');
                  }
                  else if (log_type == 'Logout') {
                     $node.css('background-color', '#cccccc');
                  }
                  else if (log_type == 'Report') {
                     $node.css('background-color', '#ccff99');
                  }
                }               
            });           
    }
    else if(tableID == "dec-tree-table")
    {
    //datatables

            // get child_id
            var child_id = $('[name="child_id"]').val();

            table = $('#dec-tree-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "../../dec_tree/dec_tree_controller/ajax_list/" + child_id,
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {

                    // single column color
                    $(row).find('td:eq(0)').css('background-color', '#ffcc99');
                    $(row).find('td:eq(1)').css('background-color', '#99ff99');
                },

                "scrollX": true 
            });
    }
    else if(tableID == "schedules-table")
    {
            table = $('#schedules-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "schedules/schedules_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var log_type = data[6],
                      $node = this.api().row(row).nodes().to$();

                  // set color based on log type
                  if (log_type == 'Today') {
                     $node.css('background-color', '#99ff99');
                  }      
                  else if (log_type == 'Ended') {
                     $node.css('background-color', '#cccccc');
                  }
                  
                }               
            });           
    }

    else if(tableID == "users-table")
    {
            table = $('#users-table').DataTable({ 
         
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.
         
                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "users/users_controller/ajax_list",
                    "type": "POST",
                },
         
                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                ],

                "rowCallback": function( row, data, index ) {
                  var user_type = data[1], user_id = data[0]
                      $node = this.api().row(row).nodes().to$();

                  // set color to light cyan if admin  
                  if (user_type == 'Administrator') {
                     $node.css('background-color', '#66ffff');
                  }
                  // set color to light gold if super admin
                  if (user_id == 'U101') {
                     $node.css('background-color', '#ffff66');
                  }
                },
                "scrollX": true              
            });           
    }
         
});


// ------------------------------------------------- 

// reset file path everytime modal_form_view is closed - for image upload
$('#modal_form_view').on('hidden.bs.modal', function(){
    $("#userfile").val("");
});


// ================================================================== VIEW IMAGE SECTION ==========================================


function readURL(input,image) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $(image).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

$("#userfile1").change(function(){
    readURL(this,'#image1');
});

$("#userfile2").change(function(){
    readURL(this,'#image2');
});

$("#userfile3").change(function(){
    readURL(this,'#image3');
});

// if attendance_date selection box is changed
$("#attendance_date").change(function(){
    window.location.href='../attendance-page/' + $('[name="attendance_date"]').val();
});


// ================================================== VIEW SECTION =================================================================



function view_profile(child_id)
{
     window.location.href='profiles-page/' + child_id;
}

function view_profile_notification(child_id)
{
     window.location.href='../profiles-page/' + child_id;
}

function hvi_view(child_id)
{
    window.location.href='hvi-page/' + child_id;
}

function dec_tree_view(child_id)
{
    window.location.href='dec-tree-page/' + child_id;
}

function view_profiles_deworming(child_id)
{
    window.location.href='../profiles-deworming-page/' + child_id;
}

function view_profiles_monthly(child_id)
{
    window.location.href='../profiles-monthly-page/' + child_id;
}




function edit_privileges(id) // for customer table
{
    save_method = 'update-privileges';
    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "users/users_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_id"]').val(data.user_id);
            $('[name="administrator"]').val(data.administrator).prop('selected', true);
            $('[name="current_administrator"]').val(data.administrator);
            
            //$('[name="report"]').val(data.report).prop('selected', true);

            $('#modal_form_privileges').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Privileges'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function view_edit_user(id) // for customer table
{
    save_method = 'update-user';
    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "users/users_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="user_id"]').val(data.user_id);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
            $('[name="repassword"]').val(data.password);
            $('[name="current_username"]').val(data.username);
            $('[name="lastname"]').val(data.lastname);
            $('[name="firstname"]').val(data.firstname);
            $('[name="middlename"]').val(data.middlename);
            $('[name="current_name"]').val(data.lastname + data.firstname + data.middlename);
            $('[name="contact"]').val(data.contact);
            $('[name="email"]').val(data.email);
            $('[name="address"]').val(data.address);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


// ================================================== ADD SECTION ======================================================================



function add_barangay() // ---> calling for the Add Modal form
{
    save_method = 'add-barangay';
    text = 'Add Barangay';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_cis() // ---> calling for the Add Modal form
{
    save_method = 'add-cis';
    text = 'Add Child Information';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_family() // ---> calling for the Add Modal form
{
    save_method = 'add-family';
    text = 'Add Family Member';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_his() // ---> calling for the Add Modal form
{
    save_method = 'add-his';
    text = 'Add Household Information';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
}

function add_hvi() // ---> calling for the Add Modal form
{
    save_method = 'add-hvi';
    text = 'Add Household Visitation Interview';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_deworming() // ---> calling for the Add Modal form
{
    save_method = 'add-deworming';
    text = 'Add Deworming Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_profiles_deworming() // ---> calling for the Add Modal form
{
    save_method = 'add-profiles-deworming';
    text = 'Add Deworming Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_monthly() // ---> calling for the Add Modal form
{
    save_method = 'add-monthly';
    text = 'Add Monthly Checkup Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_profiles_monthly() // ---> calling for the Add Modal form
{
    save_method = 'add-profiles-monthly';
    text = 'Add Monthly Checkup Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_graduated() // ---> calling for the Add Modal form
{
    save_method = 'add-graduated';
    text = 'Add Graduated Child Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}

function add_schedule() // ---> calling for the Add Modal form
{
    save_method = 'add-schedule';
    text = 'Add Appointment Schedule Record';
    
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text(text); // Set Title to Bootstrap modal title
}


function add_user()
{
    save_method = 'add-user';

    $('#form')[0].reset(); // reset form on modals
    $('#form_privileges')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
}


// ================================================ EDIT SECTION =========================================================================



function edit_barangay(id)
{
    save_method = 'update-barangay';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "barangays/barangays_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="barangay_id"]').val(data.barangay_id);
            $('[name="name"]').val(data.name);
            $('[name="current_name"]').val(data.name);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Barangay'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_schedule(id)
{
    save_method = 'update-schedule';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "schedules/schedules_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="sched_id"]').val(data.sched_id);
            $('[name="title"]').val(data.title);
            $('[name="date"]').val(data.date);
            $('[name="time"]').val(data.time);
            $('[name="remarks"]').val(data.remarks);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Appointment Schedule'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_cis_view(child_id)
{
    window.location.href='edit-cis-page/' + child_id;
}

function add_his_view(child_id)
{
    window.location.href='add-his-page/' + child_id;
}


function edit_his_view(child_id)
{
    window.location.href='edit-his-page/' + child_id;
}


function edit_family(id)
{
    save_method = 'update-family';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../profiles/profiles_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="family_id"]').val(id);
            $('[name="name"]').val(data.name);
            $('[name="relation"]').val(data.relation);
            $('[name="age"]').val(data.age);
            $('[name="sex"]').val(data.sex).prop('selected', true);
            $('[name="status"]').val(data.status);
            $('[name="education"]').val(data.education);
            $('[name="occupation"]').val(data.occupation);
            $('[name="income"]').val(data.income);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Family Member'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_hvi(id)
{
    save_method = 'update-hvi';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../../hvi/hvi_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="hvi_id"]').val(id);
            $('[name="current_period"]').val(data.child_id + data.period + data.year);

            $('[name="period"]').val(data.period).prop('selected', true);
            $('[name="year"]').val(data.year).prop('selected', true);
            $('[name="date"]').val(data.date);
            $('[name="time"]').val(data.time);

            $('[name="height"]').val(data.height)
            $('[name="weight"]').val(data.weight);

            $('[name="appetite"]').val(data.appetite).prop('selected', true);
            $('[name="water"]').val(data.water).prop('selected', true);
            $('[name="bowel"]').val(data.bowel).prop('selected', true);

            $('[name="hair"]').val(data.hair).prop('selected', true);
            $('[name="finger"]').val(data.finger).prop('selected', true);
            $('[name="teeth"]').val(data.teeth).prop('selected', true);

            $('[name="skin"]').val(data.skin).prop('selected', true);
            $('[name="eyes"]').val(data.eyes).prop('selected', true);
            $('[name="nose"]').val(data.nose).prop('selected', true);

            $('[name="ears"]').val(data.ears).prop('selected', true);
            $('[name="comments"]').val(data.comments);
            $('[name="illness"]').val(data.illness);

            $('[name="concerns"]').val(data.concerns);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Home Visitation Interview'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_deworming(id)
{
    save_method = 'update-deworming';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "deworming/deworming_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="deworming_id"]').val(id);

            $('[name="child_id"]').val(data.child_id).prop('selected', true);

            $('[name="current_period"]').val(data.child_id + data.period + data.year);

            $('[name="period"]').val(data.period).prop('selected', true);
            $('[name="year"]').val(data.year).prop('selected', true);
            $('[name="date"]').val(data.date);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Deworming Record'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_monthly(id)
{
    save_method = 'update-monthly';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "monthly/monthly_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="monthly_id"]').val(id);

            $('[name="child_id"]').val(data.child_id).prop('selected', true);

            $('[name="current_period"]').val(data.child_id + data.month + data.year);

            $('[name="month"]').val(data.month).prop('selected', true);
            $('[name="year"]').val(data.year).prop('selected', true);
            $('[name="date"]').val(data.date);

            $('[name="height"]').val(data.height);
            $('[name="weight"]').val(data.weight);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Monthly Checkup Record'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_graduated(id)
{
    save_method = 'update-graduated';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "graduated/graduated_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="graduated_id"]').val(id);

            document.getElementById("child_id").style.display='none';

            $('[name="current_child"]').val(data.child_id);

            $('[name="date"]').val(data.date);

            $('[name="remarks"]').val(data.remarks);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Graduated Child Record'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_profiles_deworming(id)
{
    save_method = 'update-profiles-deworming';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../deworming/deworming_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="deworming_id"]').val(id);

            $('[name="child_id"]').val(data.child_id).prop('selected', true);

            $('[name="current_period"]').val(data.child_id + data.period + data.year);

            $('[name="period"]').val(data.period).prop('selected', true);
            $('[name="year"]').val(data.year).prop('selected', true);
            $('[name="date"]').val(data.date);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Deworming Record'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_profiles_monthly(id)
{
    save_method = 'update-profiles-monthly';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
 
    //Ajax Load data from ajax
    $.ajax({
        url : "../monthly/monthly_controller/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="monthly_id"]').val(id);

            $('[name="child_id"]').val(data.child_id).prop('selected', true);

            $('[name="current_period"]').val(data.child_id + data.month + data.year);

            $('[name="month"]').val(data.month).prop('selected', true);
            $('[name="year"]').val(data.year).prop('selected', true);
            $('[name="date"]').val(data.date);

            $('[name="height"]').val(data.height);
            $('[name="weight"]').val(data.weight);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Monthly Checkup Record'); // Set title to Bootstrap modal title
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// function edit_cis(id)
// {
//     save_method = 'update-cis';
//     $('#form')[0].reset(); // reset form on modals
//     $('.form-group').removeClass('has-error'); // clear error class
//     $('.help-block').empty(); // clear error string
 
//     //Ajax Load data from ajax
//     $.ajax({
//         url : "cis/cis_controller/ajax_edit/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data)
//         {
//             $('[name="lastname"]').val(data.lastname);
//             $('[name="firstname"]').val(data.firstname);
//             $('[name="middlename"]').val(data.middlename);
//             $('[name="current_name"]').val(data.lastname + data.firstname + data.middlename);
            
//             $('[name="pob"]').val(data.pob);
//             $('[name="dob"]').val(data.dob);
//             $('[name="sex"]').val(data.sex);
//             $('[name="religion"]').val(data.religion);
//             $('[name="weight"]').val(data.weight);
//             $('[name="height"]').val(data.height);
//             $('[name="disability"]').val(data.disability);
//             $('[name="contact"]').val(data.contact);
//             $('[name="school"]').val(data.school);
//             $('[name="grade_level"]').val(data.grade_level);
//             $('[name="address"]').val(data.address);
//             $('[name="barangay_id"]').val(data.barangay_id);
//             $('[name="date_registered"]').val(data.date_registered);

//             // $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
//             // $('.modal-title').text('Edit Child information'); // Set title to Bootstrap modal title
 
//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
// }



function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}



// =================================================== SAVE SECTION =====================================================================

// updating cis record
function save_cis()
{
    // resetting errors in form validations
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
    $form = '#form';
    url = "../../cis/cis_controller/ajax_update";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $($form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                var log_type = 'Update';

                var details = 'child CIS record updated C' 
                + $('[name="child_id"]').val() + ': '
                + $('[name="firstname"]').val() + ' ' 
                + $('[name="middlename"]').val() + ' ' 
                + $('[name="lastname"]').val(); 

                set_system_log_two(log_type, details);

                window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function cancel_cis()
{
    window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
}

function save_new_his()
{
    // resetting errors in form validations
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
    $form = '#form';
    url = "../../his/his_controller/ajax_add";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $($form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {

                var log_type = 'Add';

                var details = 'child HIS record added C' 
                + $('[name="child_id"]').val() + ': '
                + $('[name="child_fullname"]').val(); 

                set_system_log_two(log_type, details);

                window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function save_update_his()
{
    // resetting errors in form validations
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    
    $form = '#form';
    url = "../../his/his_controller/ajax_update";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $($form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {

                var log_type = 'Update';

                var details = 'child HIS record updated C' 
                + $('[name="child_id"]').val() + ': '
                + $('[name="child_fullname"]').val(); 

                set_system_log_two(log_type, details);

                window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}

function cancel_his()
{
    window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
}

function cancel_hvi()
{
    window.location.href='../../profiles-page/' + $('[name="child_id"]').val();
}

function cancel_profiles_deworming()
{
    window.location.href='../profiles-page/' + $('[name="child_id"]').val();
}

function cancel_profiles_monthly()
{
    window.location.href='../profiles-page/' + $('[name="child_id"]').val();
}

function save()
{
    // resetting errors in form validations
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    $('#btnSave').text('Saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
 
    // initialize form for both add and update as default 
    $form = '#form';

    if(save_method == 'add-cis') 
    {
        url = "cis/cis_controller/ajax_add";
    }
    if(save_method == 'add-barangay') 
    {
        url = "barangays/barangays_controller/ajax_add";
    }
    else if(save_method == 'update-barangay') 
    {
        url = "barangays/barangays_controller/ajax_update";
    }
    else if(save_method == 'add-family') 
    {
        url = "../profiles/profiles_controller/ajax_add";
    }
    else if(save_method == 'update-family') 
    {
        url = "../profiles/profiles_controller/ajax_update";
    }
    else if(save_method == 'add-hvi') 
    {
        url = "../../hvi/hvi_controller/ajax_add";
    }
    else if(save_method == 'update-hvi') 
    {
        url = "../../hvi/hvi_controller/ajax_update";
    }
    else if(save_method == 'add-deworming') 
    {
        url = "deworming/deworming_controller/ajax_add";
    }
    else if(save_method == 'update-deworming') 
    {
        url = "deworming/deworming_controller/ajax_update";
    }
    else if(save_method == 'add-monthly') 
    {
        url = "monthly/monthly_controller/ajax_add";
    }
    else if(save_method == 'update-monthly') 
    {
        url = "monthly/monthly_controller/ajax_update";
    }
    else if(save_method == 'add-graduated') 
    {
        url = "graduated/graduated_controller/ajax_add";
    }
    else if(save_method == 'update-graduated') 
    {
        url = "graduated/graduated_controller/ajax_update";
    }
    else if(save_method == 'add-profiles-deworming') 
    {
        url = "../deworming/deworming_controller/ajax_add";
    }
    else if(save_method == 'update-profiles-deworming') 
    {
        url = "../deworming/deworming_controller/ajax_update";
    }
    else if(save_method == 'add-profiles-monthly') 
    {
        url = "../monthly/monthly_controller/ajax_add";
    }
    else if(save_method == 'update-profiles-monthly') 
    {
        url = "../monthly/monthly_controller/ajax_update";
    }
    else if(save_method == 'add-schedule') 
    {
        url = "schedules/schedules_controller/ajax_add";
    }
    else if(save_method == 'update-schedule') 
    {
        url = "schedules/schedules_controller/ajax_update";
    }

    else if(save_method == 'add-user') 
    {
        url = "users/users_controller/ajax_add";
    }
    else if(save_method == 'update-user') 
    {
        url = "users/users_controller/ajax_update";
    }
    else if(save_method == 'update-privileges') 
    {
        // change form for add stock to form_add_stock
        $form = '#form_privileges';
        url = "users/users_controller/ajax_privileges_update";
    }
 
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $($form).serialize(),
        dataType: "JSON",
        success: function(data)
        {
 
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                $('#modal_form_edit').modal('hide');
                
                $('#modal_form_privileges').modal('hide');
                
                reload_table();


                // set logs -------------------------------------------------------------------

                var log_type = "";
                var details = "";

                if(save_method == 'add-cis') 
                {
                    log_type = 'Add';

                    details = 'New child CIS record added: ' + $('[name="firstname"]').val() 
                    + ' ' + $('[name="middlename"]').val() 
                    + ' ' + $('[name="lastname"]').val(); 

                    set_system_log(log_type, details);
                }
                if(save_method == 'add-barangay')
                {
                    log_type = 'Add';

                    details = 'New barangay added: ' + $('[name="name"]').val(); 

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-barangay') 
                {
                    log_type = 'Update';

                    details = 'Barangay updated B' + $('[name="barangay_id"]').val() 
                    + ': ' + $('[name="current_name"]').val() + ' to ' + $('[name="name"]').val();

                    set_system_log(log_type, details);
                }
                if(save_method == 'add-schedule')
                {
                    log_type = 'Add';

                    details = 'New schedule added: ' + $('[name="title"]').val(); 

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-schedule') 
                {
                    log_type = 'Update';

                    details = 'Schedule updated S' + $('[name="sched_id"]').val() 
                    + ': ' + $('[name="title"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-family') 
                {
                    log_type = 'Add';

                    details = 'New family member added: ' + $('[name="name"]').val() 
                    + ' - Relation: ' + $('[name="relation"]').val()
                    + ' - Child: C' + $('[name="child_id"]').val() + ': ' + $('[name="child_name"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'update-family') 
                {
                    log_type = 'Update';

                    details = 'Family member updated: ' + $('[name="name"]').val() 
                    + ' - Relation: ' + $('[name="relation"]').val()
                    + ' - Child: C' + $('[name="child_id"]').val() + ': ' + $('[name="child_name"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'add-hvi') 
                {
                    log_type = 'Add';

                    details = 'HVI record added C' + $('[name="child_id"]').val() + ': ' + $('[name="name"]').val();

                    set_system_log_two(log_type, details);
                }
                else if(save_method == 'update-hvi') 
                {
                    log_type = 'Update';

                    details = 'HVI record updated C' + $('[name="child_id"]').val() + ': ' + $('[name="name"]').val();

                    set_system_log_two(log_type, details);
                }
                else if(save_method == 'add-deworming') 
                {
                    log_type = 'Add';

                    details = 'Deworming record added C' + $('[name="child_id"]').val() + ': ' 
                    + $("#child_id option:selected").text();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-deworming') 
                {
                    log_type = 'Update';

                    details = 'Deworming record updated C' + $('[name="child_id"]').val() + ': ' 
                    + $("#child_id option:selected").text();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-monthly') 
                {
                    log_type = 'Add';

                    details = 'Monthly checkup record added C' + $('[name="child_id"]').val() + ': ' 
                    + $("#child_id option:selected").text();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-monthly') 
                {
                    log_type = 'Update';

                    details = 'Monthly checkup record updated C' + $('[name="child_id"]').val() + ': ' 
                    + $("#child_id option:selected").text();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-graduated') 
                {
                    log_type = 'Add';

                    details = 'Graduated child record added C' + $('[name="child_id"]').val() + ': ' 
                    + $("#child_id option:selected").text();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-graduated') 
                {
                    log_type = 'Update';

                    details = 'Graduated child record updated C' + $('[name="current_child"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'add-profiles-deworming') 
                {
                    log_type = 'Add';

                    details = 'Deworming record added C' + $('[name="child_id"]').val() + ': ' 
                    + $('[name="fullname"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'update-profiles-deworming') 
                {
                    log_type = 'Update';

                    details = 'Deworming record updated C' + $('[name="child_id"]').val() + ': ' 
                    + $('[name="fullname"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'add-profiles-monthly') 
                {
                    log_type = 'Add';

                    details = 'Monthly checkup record added C' + $('[name="child_id"]').val() + ': ' 
                    + $('[name="fullname"]').val();

                    set_system_log_one(log_type, details);
                }
                else if(save_method == 'update-profiles-monthly') 
                {
                    log_type = 'Update';

                    details = 'Monthly checkup record updated C' + $('[name="child_id"]').val() + ': ' 
                    + $('[name="fullname"]').val();

                    set_system_log_one(log_type, details);
                }

                else if(save_method == 'add-user') 
                {
                    log_type = 'Add';

                    details = 'New user added: ' + $('[name="username"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-user') 
                {
                    log_type = 'Update';

                    details = 'User record updated U' + $('[name="user_id"]').val() + ': ' 
                    + $('[name="username"]').val();

                    set_system_log(log_type, details);
                }
                else if(save_method == 'update-privileges') 
                {
                    log_type = 'Update';

                    details = 'User record updated U' + $('[name="user_id"]').val();

                    set_system_log(log_type, details);
                }
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('Save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
 
        }
    });
}




// ================================================= LOGS SECTION ===========================================================================




function set_system_log(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "logs/logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// back url by one (../)
function set_system_log_one(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "../logs/logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// back url by two (../../)
function set_system_log_two(log_type, details)
{
    // sanitize illegal string characters
    var cleanString = details.replace(/[|&;$%@"<>()+,]/g, "");

    $.ajax({
        url : "../../logs/logs_controller/ajax_add/" + log_type + '/' + cleanString,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}   






// ================================================= DELETE SECTION =========================================================================



function delete_barangay(id, name)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "barangays/barangays_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Barangay deleted ' + id 
                + ': ' + name; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_schedule(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "schedules/schedules_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Appointment schedule deleted';

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_cis(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "cis/cis_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'child CIS record deleted C' + id; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_family(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "../profiles/profiles_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Family member deleted'; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_hvi(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "../../hvi/hvi_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'HVI record deleted'; 

                set_system_log_two(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_deworming(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "deworming/deworming_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Deworming record deleted'; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_monthly(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "monthly/monthly_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Monthly checkup record deleted'; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_graduated(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "graduated/graduated_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Graduated record deleted'; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_profiles_deworming(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "../deworming/deworming_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Deworming record deleted'; 

                set_system_log_one(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_profiles_monthly(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "../monthly/monthly_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'Monthly checkup record deleted'; 

                set_system_log_one(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });
 
    }
}

function delete_user(id)
{
    if(confirm('Are you sure to delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "users/users_controller/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                var log_type = 'Delete';

                var details = 'User record deleted'; 

                set_system_log(log_type, details);

                //if success reload ajax table
                $('#modal_form').modal('hide');
                $('#modal_form_privileges').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Unable to delete one remaining administrator account');
            }
        });

    }
}



// ================================================= ATTENDANCE SECTION ============================================================



function set_present(id) // ---> calling for the Add Modal form
{
    // get date
    var attendance_date = $('[name="attendance_date"]').val();
    //Ajax Load data from ajax
    $.ajax({
        url : "../attendance/attendance_controller/ajax_add/" + id + '/' + attendance_date,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function set_absent(id)
{
    // get date
    var attendance_date = $('[name="attendance_date"]').val();
    // ajax delete data to database
    $.ajax({
        url : "../attendance/attendance_controller/ajax_delete/" + id + '/' + attendance_date,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error deleting data');
        }
    });
}


// set typeahead value
// function set_typeahead_item(item)
// {
//     $('#srch-term').typeahead('val', item);
// }


// function firstFunction(receipt_window)
// {
//   var d = $.Deferred();
//   // some very time consuming asynchronous code...
//   setTimeout(function() 
//   {
//     // open new window
//     receipt_window.location.href = 'receipt';

//     d.resolve();
//   }, 1000);
//   return d.promise();
// }

// function secondFunction()
// {
//   var d = $.Deferred();
//   setTimeout(function() {
    
//     location.reload();
    
//     d.resolve();
//   }, 1000);
//   return d.promise();
// }




// ========================================================= REPORTS SECTION ==========================================================

// enable / disable generate CIS reports button
$("#report_type").change(function()
{
   var report_type = $('[name="report_type"]').val();

   if (report_type == "null")
   {
       document.getElementById("generate_report").disabled = true;
   }
   else
   {
       document.getElementById("generate_report").disabled = false;
   } 
});

// enable / disable generate Monthly reports button
$("#report_type_monthly").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   } 
});

// enable / disable generate CIS reports button
$("#report_type_child").change(function()
{
   var report_type_child = $('[name="report_type_child"]').val();

   if (report_type_child == "null")
   {
       document.getElementById("generate_report_child").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_child").disabled = false;
   } 
});

// enable / disable generate Monthly reports button
$("#month_selection").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   }
});

// enable / disable generate Monthly reports button
$("#year_selection").change(function()
{
   var report_type_monthly = $('[name="report_type_monthly"]').val();
   var month_selection = $('[name="month_selection"]').val();
   var year_selection = $('[name="year_selection"]').val();

   if (report_type_monthly == "null" || month_selection == "null" || year_selection == "null")
   {
       document.getElementById("generate_report_monthly").disabled = true;
   }
   else
   {
       document.getElementById("generate_report_monthly").disabled = false;
   }
});

// set / generate report based on selected type - CIS
function set_report()
{

    // fetch report type value
    var report_type = $('[name="report_type"]').val();

    // setting report logs
    var log_type = 'Report';

    if (report_type == "cis-active-male")
    {
        var details = 'CIS Active - Male Report generated'; 
        window.open("cis-report-active-male");
    }
    else if (report_type == "cis-active-female")
    {
        var details = 'CIS Active - Female Report generated'; 
        window.open("cis-report-active-female");
    }
    else if (report_type == "cis-graduated-male")
    {
        var details = 'CIS Graduated - Male Report generated'; 
        window.open("cis-report-graduated-male");
    }
    else if (report_type == "cis-graduated-female")
    {
        var details = 'CIS Graduated - Female Report generated';
        window.open("cis-report-graduated-female");
    }
    else
    {
        // window.open("inventory-report/print-report-borrow");   
    }

    set_system_log(log_type, details);
}

// set / generate report based on selected type - Monthly Checkup
function set_report_monthly()
{

    // fetch report type value
    var report_type_monthly = $('[name="report_type_monthly"]').val();
    var month_selection = $('[name="month_selection"]').val();
    var year_selection = $('[name="year_selection"]').val();

    // setting report logs
    var log_type = 'Report';

    if (report_type_monthly == "monthly-male")
    {
        var details = 'Monthly Monitoring - Male Report generated'; 
        window.open("monthly-report-male/" + month_selection + "/" + year_selection);
    }
    else if (report_type_monthly == "monthly-female")
    {
        var details = 'Monthly Monitoring - Female Report generated'; 
        window.open("monthly-report-female/" + month_selection + "/" + year_selection);
    }

    set_system_log(log_type, details);
}

// set / generate report based on selected type - Monthly Checkup
function set_report_child()
{

    // fetch report type value
    var report_type_child = $('[name="report_type_child"]').val();

    // setting report logs
    var log_type = 'Report';

    var details = 'Child Profile Report generated: C' + report_type_child; 
    window.open("child-report/" + report_type_child);

    set_system_log(log_type, details);
}



// ========================================== STATISTICS CHARTS =====================================================



// check if div exist (execute if in dashboard page only)
if (document.getElementById("container-gender")) 
{
    var children_count = parseInt($('[name="children_count"]').val()); // active only

    var children_active_male = parseInt($('[name="children_active_male"]').val());
    var children_active_female = parseInt($('[name="children_active_female"]').val());

    var children_graduated_male = parseInt($('[name="children_graduated_male"]').val());
    var children_graduated_female = parseInt($('[name="children_graduated_female"]').val());

    var graduated_count = (children_graduated_male + children_graduated_female);
    var total_children_count = (children_count + graduated_count);

    var percent_active = parseInt((children_count / total_children_count) * 100);
    var percent_graduated = parseInt((graduated_count / total_children_count) * 100);

    var colors = Highcharts.getOptions().colors,

        categories = ['Active', 'Graduated'],

        data = [{
            y: percent_active,
            color: colors[0],
            drilldown: {
                name: 'Active genders',
                categories: ['Male - ' + children_active_male, 'Female - ' + children_active_female],
                data: [parseInt((children_active_male / total_children_count) * 100), parseInt((children_active_female / total_children_count) * 100)],
                color: colors[0]
            }
        }, {
            y: percent_graduated,
            color: colors[1],
            drilldown: {
                name: 'Graduated genders',
                categories: ['Male - ' + children_graduated_male, 'Female - ' + children_graduated_female],
                data: [parseInt((children_graduated_male / total_children_count) * 100), parseInt((children_graduated_female / total_children_count) * 100)],
                color: colors[1]
            }
        }],

        child_count_data = [],
        gender_count_data = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        child_count_data.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            gender_count_data.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    Highcharts.chart('container-gender', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Children Count: ' + total_children_count
        },
        subtitle: {
            text: 'Active: ' + (children_active_male + children_active_female) 
            + ' MA: ' + parseInt((children_active_male / children_count) * 100) + '%'
            + ' FA: ' + parseInt((children_active_female / children_count) * 100) + '%'
            + ' | ' 
            + 'Graduated: ' + (children_graduated_male + children_graduated_female)
            + ' MG: ' + parseInt((children_graduated_male / graduated_count) * 100) + '%'
            + ' FG: ' + parseInt((children_graduated_female / graduated_count) * 100) + '%'
        },
        yAxis: {
            title: {
                text: 'Total children count'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
            name: 'Children',
            data: child_count_data,
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: '#ffffff',
                distance: -30
            }
        }, {
            name: 'Gender',
            data: gender_count_data,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
                        this.y + '%' : null;
                }
            },
            id: 'gender'
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 400
                },
                chartOptions: {
                    series: [{
                        id: 'gender',
                        dataLabels: {
                            enabled: false
                        }
                    }]
                }
            }]
        }
    });
}

// check if div exist (execute if in dashboard page only)
if (document.getElementById("container-height-status")) 
{

    // fetch age data
    var sst = parseInt($('[name="sst"]').val());
    var st = parseInt($('[name="st"]').val());
    var hn = parseInt($('[name="hn"]').val());
    var t = parseInt($('[name="t"]').val());

    Highcharts.chart('container-height-status', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Height Status<br>Category<br>Percentage',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        subtitle: {
            text: 'Number of children based on height (cm) status category<br>.<br>'
            + ' SSt-Severely Stunted: ' + sst + ' | '
            + ' St-Stunted: ' + st + ' | '
            + ' N-Normal: ' + hn + ' | '
            + ' T-Tall: ' + t
            
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -100,
                endAngle: 100,
                center: ['50%', '50%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Status Percentage',
            innerSize: '50%',
            data: [
                ['SSt',   sst],
                ['St',       st],
                ['N', hn],
                ['T',   t]
            ]
        }]
    });

}

// check if div exist (execute if in dashboard page only)
if (document.getElementById("container-weight-status")) 
{

    // fetch age data
    var su = parseInt($('[name="su"]').val());
    var u = parseInt($('[name="u"]').val());
    var wn = parseInt($('[name="wn"]').val());
    var o = parseInt($('[name="o"]').val());

    Highcharts.chart('container-weight-status', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 0,
            plotShadow: false
        },
        title: {
            text: 'Weight Status<br>Category<br>Percentage',
            align: 'center',
            verticalAlign: 'middle',
            y: 40
        },
        subtitle: {
            text: 'Number of children based on weight (kg) status category<br>.<br>'
            + ' SU-Severely Underweight: ' + su + ' | '
            + ' U-Underweight: ' + u + ' | '
            + ' N-Normal: ' + wn + ' | '
            + ' O-Obese: ' + o
            
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled: true,
                    distance: -50,
                    style: {
                        fontWeight: 'bold',
                        color: 'white'
                    }
                },
                startAngle: -100,
                endAngle: 100,
                center: ['50%', '50%']
            }
        },
        series: [{
            type: 'pie',
            name: 'Status Percentage',
            innerSize: '50%',
            data: [
                ['SU', su],
                ['U', u],
                ['N', wn],
                ['O', o]
            ]
        }]
    });

}

// check if div exist (execute if in dashboard page only)
if (document.getElementById("container-age")) 
{
    // fetch age data
    var m3_up = parseInt($('[name="m3_up"]').val());
    var m4_up = parseInt($('[name="m4_up"]').val());
    var m5_up = parseInt($('[name="m5_up"]').val());
    var m6_up = parseInt($('[name="m6_up"]').val());
    var m7_up = parseInt($('[name="m7_up"]').val());
    var m8_up = parseInt($('[name="m8_up"]').val());
    var m9_up = parseInt($('[name="m9_up"]').val());

    var f3_up = parseInt($('[name="f3_up"]').val());
    var f4_up = parseInt($('[name="f4_up"]').val());
    var f5_up = parseInt($('[name="f5_up"]').val());
    var f6_up = parseInt($('[name="f6_up"]').val());
    var f7_up = parseInt($('[name="f7_up"]').val());
    var f8_up = parseInt($('[name="f8_up"]').val());
    var f9_up = parseInt($('[name="f9_up"]').val());

    Highcharts.chart('container-age', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Number of Children, Grouped by Age'
        },

        subtitle: {
            text: 'Note: Data includes both active & graduated children'
        },

        xAxis: {
            categories: ['3yrs (36mos)', '4yrs (48mos)', '5yrs (60mos)', '6yrs (72mos)',
             '7yrs (84mos)', '8yrs (96mos)', '9yrs (108mos)']
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: 'Number of children'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: [{
            name: 'Male',
            data: [m3_up, m4_up, m5_up, m6_up, m7_up, m8_up, m9_up],
            stack: '1'
        }, {
            name: 'Female',
            data: [f3_up, f4_up, f5_up, f6_up, f7_up, f8_up, f9_up],
            stack: '1'
        }]
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-registrations")) 
{
    // fetch registrations data
    var current_year = $('[name="current_year"]').val();

    var jan = parseInt($('[name="jan"]').val());
    var feb = parseInt($('[name="feb"]').val());
    var mar = parseInt($('[name="mar"]').val());
    var apr = parseInt($('[name="apr"]').val());

    var may = parseInt($('[name="may"]').val());
    var jun = parseInt($('[name="jun"]').val());
    var jul = parseInt($('[name="jul"]').val());
    var aug = parseInt($('[name="aug"]').val());

    var sep = parseInt($('[name="sep"]').val());
    var oct = parseInt($('[name="oct"]').val());
    var nov = parseInt($('[name="nov"]').val());
    var dec = parseInt($('[name="dec"]').val());

        Highcharts.chart('container-registrations', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Child Registrations for Year ' + current_year
        },
        subtitle: {
            text: 'January to December ' + current_year
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of children'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Monthly Registrations',
            data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec]
        }]
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-registrations-prev")) 
{
    // fetch registrations data
    var prev_year = $('[name="prev_year"]').val();

    var prev_jan = parseInt($('[name="prev_jan"]').val());
    var prev_feb = parseInt($('[name="prev_feb"]').val());
    var prev_mar = parseInt($('[name="prev_mar"]').val());
    var prev_apr = parseInt($('[name="prev_apr"]').val());

    var prev_may = parseInt($('[name="prev_may"]').val());
    var prev_jun = parseInt($('[name="prev_jun"]').val());
    var prev_jul = parseInt($('[name="prev_jul"]').val());
    var prev_aug = parseInt($('[name="prev_aug"]').val());

    var prev_sep = parseInt($('[name="prev_sep"]').val());
    var prev_oct = parseInt($('[name="prev_oct"]').val());
    var prev_nov = parseInt($('[name="prev_nov"]').val());
    var prev_dec = parseInt($('[name="prev_dec"]').val());

        Highcharts.chart('container-registrations-prev', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Monthly Child Registrations for Year ' + prev_year
        },
        subtitle: {
            text: 'January to December ' + prev_year
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Number of children'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [{
            name: 'Monthly Registrations',
            data: [prev_jan, prev_feb, prev_mar, prev_apr, prev_may, prev_jun, 
            prev_jul, prev_aug, prev_sep, prev_oct, prev_nov, prev_dec]
        }]
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-target-male-low")) 
{
    // fetch latest observation values
    var latest_observation_male = [];
    //Ajax Load data from ajax
    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_low/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male.push({name: data[i][2],
                x: data[i][0], y: data[i][1]});
            }

            // fetch latest observation values
            var target_observation = [];


            $.ajax({
                url : "statistics/statistics_controller/get_target_observation_low/male",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        target_observation.push(data[i]);
                    }

                    Highcharts.chart('container-target-male-low', {
                        title: {
                            text: 'Male - Height | Weight Observations (3-6 yrs old)'
                        },
                        subtitle: {
                            text: 'Male height and weight latest data compared to expected target'
                        },
                        xAxis: {
                            gridLineWidth: 1,
                            title: {
                                enabled: true,
                                text: 'Height (cm)'
                            },
                            startOnTick: true,
                            endOnTick: true,
                            showLastLabel: true
                        },
                        yAxis: {
                            title: {
                                text: 'Weight (kg)'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        series: [{
                            name: 'Target',
                            type: 'polygon',
                            data: target_observation,
                            color: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.5).get(),
                            enableMouseTracking: true

                        }, {
                            name: 'Observations',
                            type: 'scatter',
                            color: Highcharts.getOptions().colors[1],
                            data: latest_observation_male

                        }],
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.name}: {point.x} cm, {point.y} kg'
                        }
                    });

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-target-female-low")) 
{
    // fetch latest observation values
    var latest_observation_female = [];
    //Ajax Load data from ajax
    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_female_low/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_female.push({name: data[i][2],
                x: data[i][0], y: data[i][1]});
            }

            // fetch latest observation values
            var target_observation = [];


            $.ajax({
                url : "statistics/statistics_controller/get_target_observation_low/female",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        target_observation.push(data[i]);
                    }

                    Highcharts.chart('container-target-female-low', {
                        title: {
                            text: 'Female - Height | Weight Observations (3-6 yrs old)'
                        },
                        subtitle: {
                            text: 'Female height and weight latest data compared to expected target'
                        },
                        xAxis: {
                            gridLineWidth: 1,
                            title: {
                                enabled: true,
                                text: 'Height (cm)'
                            },
                            startOnTick: true,
                            endOnTick: true,
                            showLastLabel: true
                        },
                        yAxis: {
                            title: {
                                text: 'Weight (kg)'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        series: [{
                            name: 'Target',
                            type: 'polygon',
                            data: target_observation,
                            color: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.5).get(),
                            enableMouseTracking: true

                        }, {
                            name: 'Observations',
                            type: 'scatter',
                            color: Highcharts.getOptions().colors[1],
                            data: latest_observation_female

                        }],
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.name}: {point.x} cm, {point.y} kg'
                        }
                    });

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-target-male-high")) 
{
    // fetch latest observation values
    var latest_observation_male_high = [];
    //Ajax Load data from ajax
    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_high/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male_high.push({name: data[i][2],
                x: data[i][0], y: data[i][1]});
            }

            // fetch latest observation values
            var target_observation = [];


            $.ajax({
                url : "statistics/statistics_controller/get_target_observation_high/male",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        target_observation.push(data[i]);
                    }

                    Highcharts.chart('container-target-male-high', {
                        title: {
                            text: 'Male - Height | Weight Observations (7-9 yrs old)'
                        },
                        subtitle: {
                            text: 'Male height and weight latest data compared to expected target'
                        },
                        xAxis: {
                            gridLineWidth: 1,
                            title: {
                                enabled: true,
                                text: 'Height (cm)'
                            },
                            startOnTick: true,
                            endOnTick: true,
                            showLastLabel: true
                        },
                        yAxis: {
                            title: {
                                text: 'Weight (kg)'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        series: [{
                            name: 'Target',
                            type: 'polygon',
                            data: target_observation,
                            color: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.5).get(),
                            enableMouseTracking: true

                        }, {
                            name: 'Observations',
                            type: 'scatter',
                            color: Highcharts.getOptions().colors[1],
                            data: latest_observation_male_high

                        }],
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.name}: {point.x} cm, {point.y} kg'
                        }
                    });

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-target-female-high")) 
{
    // fetch latest observation values
    var latest_observation_female_high = [];
    //Ajax Load data from ajax
    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_female_high/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_female_high.push({name: data[i][2],
                x: data[i][0], y: data[i][1]});
            }

            // fetch latest observation values
            var target_observation = [];


            $.ajax({
                url : "statistics/statistics_controller/get_target_observation_high/female",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        target_observation.push(data[i]);
                    }

                    Highcharts.chart('container-target-female-high', {
                        title: {
                            text: 'Female - Height | Weight Observations (7-9 yrs old)'
                        },
                        subtitle: {
                            text: 'Female height and weight latest data compared to expected target'
                        },
                        xAxis: {
                            gridLineWidth: 1,
                            title: {
                                enabled: true,
                                text: 'Height (cm)'
                            },
                            startOnTick: true,
                            endOnTick: true,
                            showLastLabel: true
                        },
                        yAxis: {
                            title: {
                                text: 'Weight (kg)'
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },
                        series: [{
                            name: 'Target',
                            type: 'polygon',
                            data: target_observation,
                            color: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.5).get(),
                            enableMouseTracking: true

                        }, {
                            name: 'Observations',
                            type: 'scatter',
                            color: Highcharts.getOptions().colors[1],
                            data: latest_observation_female_high

                        }],
                        tooltip: {
                            headerFormat: '<b>{series.name}</b><br>',
                            pointFormat: '{point.name}: {point.x} cm, {point.y} kg'
                        }
                    });

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });    
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

    
}

// TRUE REGRESSION ANALYSIS (BASED ON ACTUAL DATA)
// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-individuals-reg")) 
{
    var latest_observation_male_all_reg = [];
    // var total_boys_height = 0;
    // var total_boys_weight = 0;
    // var total_girls_height = 0;
    // var total_girls_weight = 0;

    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_all_reg",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male_all_reg.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                x: data[i][0], y: data[i][1]});

                // total_boys_height += data[i][0];
                // total_boys_weight += data[i][1];
            }

            var latest_observation_female_all_reg = [];

            $.ajax({
                url : "statistics/statistics_controller/get_latest_observation_female_all_reg",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        latest_observation_female_all_reg.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                        x: data[i][0], y: data[i][1]});

                        // total_girls_height += data[i][0];
                        // total_girls_weight += data[i][1];
                    }

                    var male_reg_line_reg = [];

                    $.ajax({
                        url : "statistics/statistics_controller/get_actual_reg_line_male",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // alert('boys: ' + total_boys_height + ' '  + total_boys_weight + ' girls: ' + total_girls_height + ' '  + total_girls_weight);

                            for (var i = 0, len = data.length; i < len; i++)
                            {
                                male_reg_line_reg.push({x: data[i][0], y: data[i][1]});
                            }


                            var female_reg_line_reg = [];

                            $.ajax({
                                url : "statistics/statistics_controller/get_actual_reg_line_female",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data)
                                {

                                    for (var i = 0, len = data.length; i < len; i++)
                                    {
                                        female_reg_line_reg.push({x: data[i][0], y: data[i][1]});
                                    }


                                    Highcharts.chart('container-individuals-reg', {
                                        chart: {
                                            type: 'scatter',
                                            zoomType: 'xy'
                                        },
                                        title: {
                                            text: 'Regression Analysis (Actual Statistics Data) - X: Height (independent) | Y: Weight (dependent)' 
                                            + '<br />Scattered Plots of the Height Versus Weight Data of '
                                            + (latest_observation_male_all_reg.length + latest_observation_female_all_reg.length) 
                                            + ' Children by Gender'
                                        },
                                        subtitle: {
                                            text: '<i>Data gathered is from the latest height and weight observations obtained from monthly monitoring records</i>'
                                            + '<br /><i>The Starting point of the regression line (line of best fit) is the predicted weight of a child when the height is 80 cm</i>'
                                            + '<br /><i>while the end point is the predicted weight of a child when the height is 150 cm</i>'
                                            + '<br / ><i>The slope value was calculated based on the actual children height and weight data gathered using the regression model fomula.</i>'

                                        },
                                        xAxis: {
                                            crosshair: true,
                                            title: {
                                                enabled: true,
                                                text: 'Height (cm)'
                                            },
                                            startOnTick: true,
                                            endOnTick: true,
                                            showLastLabel: true
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Weight (kg)'
                                            }
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'left',
                                            verticalAlign: 'top',
                                            x: 100,
                                            y: 140,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                            borderWidth: 1
                                        },
                                        plotOptions: {
                                            scatter: {
                                                marker: {
                                                    radius: 4,
                                                    states: {
                                                        hover: {
                                                            enabled: true,
                                                            lineColor: 'rgb(100,100,100)'
                                                        }
                                                    }
                                                },
                                                states: {
                                                    hover: {
                                                        marker: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                tooltip: {
                                                    headerFormat: '<b>{series.name}</b><br>',
                                                    pointFormat: '<b>{point.name}: {point.x} cm, {point.y} kg</b>'
                                                    + '<br />____________________________________________________'
                                                    + '<br />Predicted Weight: {point.predicted} kg<br />(Residual Value: {point.residual} kg)'
                                                }
                                            },
                                        },
                                        series: [{
                                            type: 'line',
                                            name: 'Male Regression Line',
                                            //data: male_reg_line,
                                            data: male_reg_line_reg,
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true,
                                        }, {
                                            type: 'line',
                                            name: 'Female Regression Line',
                                            color: 'rgba(223, 83, 83, .5)',
                                            // data: female_reg_line,
                                            data: female_reg_line_reg,
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true
                                        }, {
                                            name: 'Female',
                                            color: 'rgba(223, 83, 83, .6)',
                                            data: latest_observation_female_all_reg
                                        }, {
                                            name: 'Male',
                                            color: 'rgba(119, 152, 255, 1)',
                                            data: latest_observation_male_all_reg
                                        }]
                                    });
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-individuals")) 
{
    var latest_observation_male_all = [];
    // var total_boys_height = 0;
    // var total_boys_weight = 0;
    // var total_girls_height = 0;
    // var total_girls_weight = 0;

    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_all",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male_all.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                x: data[i][0], y: data[i][1]});

                // total_boys_height += data[i][0];
                // total_boys_weight += data[i][1];
            }

            var latest_observation_female_all = [];

            $.ajax({
                url : "statistics/statistics_controller/get_latest_observation_female_all",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        latest_observation_female_all.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                        x: data[i][0], y: data[i][1]});

                        // total_girls_height += data[i][0];
                        // total_girls_weight += data[i][1];
                    }

                    var male_reg_line = [];

                    $.ajax({
                        url : "statistics/statistics_controller/get_reg_line/male",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // alert('boys: ' + total_boys_height + ' '  + total_boys_weight + ' girls: ' + total_girls_height + ' '  + total_girls_weight);

                            for (var i = 0, len = data.length; i < len; i++)
                            {
                                male_reg_line.push({x: data[i][0], y: data[i][1]});
                            }


                            var female_reg_line = [];

                            $.ajax({
                                url : "statistics/statistics_controller/get_reg_line/female",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data)
                                {

                                    for (var i = 0, len = data.length; i < len; i++)
                                    {
                                        female_reg_line.push({x: data[i][0], y: data[i][1]});
                                    }


                                    Highcharts.chart('container-individuals', {
                                        chart: {
                                            type: 'scatter',
                                            zoomType: 'xy'
                                        },
                                        title: {
                                            text: 'Regression Analysis (W.H.O. Statistics Data) - X: Height (independent) | Y: Weight (dependent)' 
                                            + '<br />Scattered Plots of the Height Versus Weight Data of '
                                            + (latest_observation_male_all.length + latest_observation_female_all.length) 
                                            + ' Children by Gender'
                                        },
                                        subtitle: {
                                            text: '<i>Data gathered is from the latest height and weight observations obtained from monthly monitoring records</i>'
                                            + '<br /><i>The Starting point of the regression line (line of best fit) is the assumed normal weight of a child when the height is 80 cm</i>'
                                            + '<br /><i>while the end point is the assumed normal weight of a child when the height is 150 cm</i>'
                                            + '<br / ><i>The slope value was calculated based on the WHO child growth standard data using the regression model fomula.</i>'
                                            + '<br / ><i>(Normal weight value used is the average or above the most conservative normal value)</i>'

                                        },
                                        xAxis: {
                                            crosshair: true,
                                            title: {
                                                enabled: true,
                                                text: 'Height (cm)'
                                            },
                                            startOnTick: true,
                                            endOnTick: true,
                                            showLastLabel: true
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Weight (kg)'
                                            }
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'left',
                                            verticalAlign: 'top',
                                            x: 100,
                                            y: 140,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                            borderWidth: 1
                                        },
                                        plotOptions: {
                                            scatter: {
                                                marker: {
                                                    radius: 4,
                                                    states: {
                                                        hover: {
                                                            enabled: true,
                                                            lineColor: 'rgb(100,100,100)'
                                                        }
                                                    }
                                                },
                                                states: {
                                                    hover: {
                                                        marker: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                tooltip: {
                                                    headerFormat: '<b>{series.name}</b><br>',
                                                    pointFormat: '<b>{point.name}: {point.x} cm, {point.y} kg</b>'
                                                    + '<br />____________________________________________________'
                                                    + '<br />Predicted Weight: {point.predicted} kg<br />(Residual Value: {point.residual} kg)'
                                                }
                                            },
                                        },
                                        series: [{
                                            type: 'line',
                                            name: 'Male Regression Line',
                                            data: male_reg_line,
                                            // data: [[80, 7.98], [150, 31.55]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true,
                                        }, {
                                            type: 'line',
                                            name: 'Female Regression Line',
                                            color: 'rgba(223, 83, 83, .5)',
                                            data: female_reg_line,
                                            // data: [[80, 8.59], [150, 31.48]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true
                                        }, {
                                            name: 'Female',
                                            color: 'rgba(223, 83, 83, .6)',
                                            data: latest_observation_female_all
                                        }, {
                                            name: 'Male',
                                            color: 'rgba(119, 152, 255, 1)',
                                            data: latest_observation_male_all
                                        }]
                                    });
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-individuals-age-reg")) 
{
    var latest_observation_male_all_reg_age = [];
    // var total_boys_height = 0;
    // var total_boys_weight = 0;
    // var total_girls_height = 0;
    // var total_girls_weight = 0;

    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_all_reg_age",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male_all_reg_age.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                x: data[i][0], y: data[i][1]});

                // total_boys_height += data[i][0];
                // total_boys_weight += data[i][1];
            }

            var latest_observation_female_all_reg_age = [];

            $.ajax({
                url : "statistics/statistics_controller/get_latest_observation_female_all_reg_age",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        latest_observation_female_all_reg_age.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                        x: data[i][0], y: data[i][1]});

                        // total_girls_height += data[i][0];
                        // total_girls_weight += data[i][1];
                    }

                    var male_reg_line_age = [];

                    $.ajax({
                        url : "statistics/statistics_controller/get_actual_reg_line_male_age",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // alert('boys: ' + total_boys_height + ' '  + total_boys_weight + ' girls: ' + total_girls_height + ' '  + total_girls_weight);

                            for (var i = 0, len = data.length; i < len; i++)
                            {
                                male_reg_line_age.push({x: data[i][0], y: data[i][1]});
                            }


                            var female_reg_line_age = [];

                            $.ajax({
                                url : "statistics/statistics_controller/get_actual_reg_line_female_age",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data)
                                {

                                    for (var i = 0, len = data.length; i < len; i++)
                                    {
                                        female_reg_line_age.push({x: data[i][0], y: data[i][1]});
                                    }


                                    Highcharts.chart('container-individuals-age-reg', {
                                        chart: {
                                            type: 'scatter',
                                            zoomType: 'xy'
                                        },
                                        title: {
                                            text: 'Regression Analysis (Actual Statistics Data) - X: Age in Months (independent) | Y: Weight (dependent)' 
                                            + '<br />Scattered Plots of the Age in Months Versus Weight Data of '
                                            + (latest_observation_male_all_reg_age.length + latest_observation_female_all_reg_age.length) 
                                            + ' Children by Gender'
                                        },
                                        subtitle: {
                                            text: '<i>Data gathered is from the current age in months and latest weight observations obtained from monthly monitoring records</i>'
                                            + '<br /><i>The Starting point of the regression line (line of best fit) is the predicted weight of a child when the age in months is 30 months</i>'
                                            + '<br /><i>while the end point is the predicted weight of a child when the age in months is 160 months</i>'
                                            + '<br / ><i>The slope value was calculated based on the actual children height and weight data gathered using the regression model fomula.</i>'
                                        },
                                        xAxis: {
                                            crosshair: true,
                                            title: {
                                                enabled: true,
                                                text: 'Age (months)'
                                            },
                                            startOnTick: true,
                                            endOnTick: true,
                                            showLastLabel: true
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Weight (kg)'
                                            }
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'left',
                                            verticalAlign: 'top',
                                            x: 100,
                                            y: 140,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                            borderWidth: 1
                                        },
                                        plotOptions: {
                                            scatter: {
                                                marker: {
                                                    radius: 4,
                                                    states: {
                                                        hover: {
                                                            enabled: true,
                                                            lineColor: 'rgb(100,100,100)'
                                                        }
                                                    }
                                                },
                                                states: {
                                                    hover: {
                                                        marker: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                tooltip: {
                                                    headerFormat: '<b>{series.name}</b><br>',
                                                    pointFormat: '<b>{point.name}: {point.x} months, {point.y} kg</b>'
                                                    + '<br />____________________________________________________'
                                                    + '<br />Predicted Weight: {point.predicted} kg<br />(Residual Value: {point.residual} kg)'
                                                }
                                            },
                                        },
                                        series: [{
                                            type: 'line',
                                            name: 'Male Regression Line',
                                            data: male_reg_line_age,
                                            // data: [[80, 7.98], [150, 31.55]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true,
                                        }, {
                                            type: 'line',
                                            name: 'Female Regression Line',
                                            color: 'rgba(223, 83, 83, .5)',
                                            data: female_reg_line_age,
                                            // data: [[80, 8.59], [150, 31.48]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true
                                        }, {
                                            name: 'Female',
                                            color: 'rgba(223, 83, 83, .6)',
                                            data: latest_observation_female_all_reg_age
                                        }, {
                                            name: 'Male',
                                            color: 'rgba(119, 152, 255, 1)',
                                            data: latest_observation_male_all_reg_age
                                        }]
                                    });
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-individuals-age")) 
{
    var latest_observation_male_all_age = [];
    // var total_boys_height = 0;
    // var total_boys_weight = 0;
    // var total_girls_height = 0;
    // var total_girls_weight = 0;

    $.ajax({
        url : "statistics/statistics_controller/get_latest_observation_male_all_age",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                latest_observation_male_all_age.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                x: data[i][0], y: data[i][1]});

                // total_boys_height += data[i][0];
                // total_boys_weight += data[i][1];
            }

            var latest_observation_female_all_age = [];

            $.ajax({
                url : "statistics/statistics_controller/get_latest_observation_female_all_age",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    for (var i = 0, len = data.length; i < len; i++)
                    {
                        latest_observation_female_all_age.push({name: data[i][2], residual: data[i][3], predicted: data[i][4],
                        x: data[i][0], y: data[i][1]});

                        // total_girls_height += data[i][0];
                        // total_girls_weight += data[i][1];
                    }

                    var male_reg_line_age_who = [];

                    $.ajax({
                        url : "statistics/statistics_controller/get_reg_line_age/male",
                        type: "GET",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // alert('boys: ' + total_boys_height + ' '  + total_boys_weight + ' girls: ' + total_girls_height + ' '  + total_girls_weight);

                            for (var i = 0, len = data.length; i < len; i++)
                            {
                                male_reg_line_age_who.push({x: data[i][0], y: data[i][1]});
                            }


                            var female_reg_line_age_who = [];

                            $.ajax({
                                url : "statistics/statistics_controller/get_reg_line_age/female",
                                type: "GET",
                                dataType: "JSON",
                                success: function(data)
                                {

                                    for (var i = 0, len = data.length; i < len; i++)
                                    {
                                        female_reg_line_age_who.push({x: data[i][0], y: data[i][1]});
                                    }


                                    Highcharts.chart('container-individuals-age', {
                                        chart: {
                                            type: 'scatter',
                                            zoomType: 'xy'
                                        },
                                        title: {
                                            text: 'Regression Analysis (W.H.O. Statistics Data) - X: Age in Months (independent) | Y: Weight (dependent)' 
                                            + '<br />Scattered Plots of the Age in Months Versus Weight Data of '
                                            + (latest_observation_male_all_age.length + latest_observation_female_all_age.length) 
                                            + ' Children by Gender'
                                        },
                                        subtitle: {
                                            text: '<i>Data gathered is from the current age in months and latest weight observations obtained from monthly monitoring records</i>'
                                            + '<br /><i>The Starting point of the regression line (line of best fit) is the assumed normal weight of a child when the age in months is 30 months</i>'
                                            + '<br /><i>while the end point is the assumed normal weight of a child when the age in months is 160 months</i>'
                                            + '<br / ><i>The slope value was calculated based on the WHO child growth standard data gathered using the regression model fomula.</i>'
                                            + '<br / ><i>(Normal weight value used is the average or above the most conservative normal value)</i>'
                                            
                                        },
                                        xAxis: {
                                            crosshair: true,
                                            title: {
                                                enabled: true,
                                                text: 'Age (months)'
                                            },
                                            startOnTick: true,
                                            endOnTick: true,
                                            showLastLabel: true
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Weight (kg)'
                                            }
                                        },
                                        legend: {
                                            layout: 'vertical',
                                            align: 'left',
                                            verticalAlign: 'top',
                                            x: 100,
                                            y: 140,
                                            floating: true,
                                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
                                            borderWidth: 1
                                        },
                                        plotOptions: {
                                            scatter: {
                                                marker: {
                                                    radius: 4,
                                                    states: {
                                                        hover: {
                                                            enabled: true,
                                                            lineColor: 'rgb(100,100,100)'
                                                        }
                                                    }
                                                },
                                                states: {
                                                    hover: {
                                                        marker: {
                                                            enabled: true
                                                        }
                                                    }
                                                },
                                                tooltip: {
                                                    headerFormat: '<b>{series.name}</b><br>',
                                                    pointFormat: '<b>{point.name}: {point.x} months, {point.y} kg</b>'
                                                    + '<br />____________________________________________________'
                                                    + '<br />Predicted Weight: {point.predicted} kg<br />(Residual Value: {point.residual} kg)'
                                                }
                                            },
                                        },
                                        series: [{
                                            type: 'line',
                                            name: 'Male Regression Line',
                                            data: male_reg_line_age_who,
                                            // data: [[80, 7.98], [150, 31.55]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true,
                                        }, {
                                            type: 'line',
                                            name: 'Female Regression Line',
                                            color: 'rgba(223, 83, 83, .5)',
                                            data: female_reg_line_age_who,
                                            // data: [[80, 8.59], [150, 31.48]],
                                            marker: {
                                                enabled: false
                                            },
                                            states: {
                                                hover: {
                                                    lineWidth: 4
                                                }
                                            },
                                            tooltip: {
                                                    valueDecimals: 2
                                                },
                                            enableMouseTracking: true
                                        }, {
                                            name: 'Female',
                                            color: 'rgba(223, 83, 83, .6)',
                                            data: latest_observation_female_all_age
                                        }, {
                                            name: 'Male',
                                            color: 'rgba(119, 152, 255, 1)',
                                            data: latest_observation_male_all_age
                                        }]
                                    });
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

// check if div exist (execute if in dashboard page only) // chart for registration count
if (document.getElementById("container-regression")) 
{
    var id = $('[name="child_id"]').val();

    var peak_weight = parseFloat($('[name="peak_weight"]').val());
    var initial_weight = parseFloat($('[name="initial_weight"]').val());
    var slope = parseFloat($('[name="slope"]').val());

    var weight_monthly = [];
    var reg_line_monthly = [];
    // weight_monthly.push({y: initial_weight, predicted: initial_weight, residual: 0});

    // fetch all monthly checkup weights (ascending order)
    //Ajax Load data from ajax
    $.ajax({
        url : "../profiles/profiles_controller/ajax_all_child_monthly_ascending/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            for (var i = 0, len = data.length; i < len; i++)
            {
                //weight_monthly.push(parseFloat(data[i].weight));
                var weight = parseFloat(data[i].weight);
                var predicted = initial_weight + (slope * (i + 1));
                var residual = weight - predicted;

                weight_monthly.push({x: i + 1, y: weight, predicted: predicted, residual: residual});
            }

            reg_line_monthly.push({x: 0, y: initial_weight, predicted: initial_weight, residual: 0});
            reg_line_monthly.push({x: 24, y: peak_weight, predicted: peak_weight, residual: 0});

            Highcharts.chart('container-regression', {
                xAxis: {
                    min: 0, // 0 to 24 mos. child spent on ANC
                    max: 24,
                    title: {
                        text: 'Months'
                    },
                    crosshair: true
                },
                yAxis: {
                    min: 8,
                    title: {
                        text: 'Weight (kg)'
                    }
                },
                
                tooltip: {
                        formatter: function () {
                            return '<b>● ' + this.series.name + '</b><br/>' 
                                 + '<b>' + this.x + ' mos.</b><br/>' 
                                 + '<b>Actual Weight:' + this.y + ' kg</b><br/>____________________________<br/>'
                                 + 'Predicted Weight: ' +  this.point.predicted.toFixed(2) + ' kg</b><br/>'
                                 + 'Residual Value: ' + this.point.residual.toFixed(2) + ' kg</b><br/>';
                        }
                },
                
                title: {
                    text: 'Child Progress Analysis - X: Months (independent) | Y: Weight (dependent)'   
                },
                subtitle: {
                    text: '<i>The regression line shown is a simulation of gradually improving weight of the child in order</i>'
                    + '<br /><i>to reach the expected or target normal weight after the specified month in ANC.</i>'
                    + '<br /><i>Data used were based on child CIS (initial data), monthly monitoring (presented as dots),</i>'
                    + '<br /><i>and WHO child growth standard data.</i>'
                    + '<br /><i>The Starting point of the regression line is the initial weight of the child upon registration</i>'
                    + '<br /><i>while the end point is the target or expected weight after 2 years (24 months) in ANC.</i>'
                    
                },
                series: [{
                    type: 'line',
                    name: 'Regression Line',
                    data: reg_line_monthly, 
                    marker: {
                        enabled: true
                    },
                    states: {
                        hover: {
                            lineWidth: 0
                        }
                    },
                    enableMouseTracking: true
                }, {
                    type: 'scatter',
                    name: 'Monthly Checkup Data',
                    data: weight_monthly,
                    marker: {
                        radius: 4
                    }
                }]
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}   

// fetch registrations data
// var no_quarterly = $('[name="no_quarterly"]').val();

// alert(no_quarterly);

