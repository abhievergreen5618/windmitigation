$(document).ready(function () {
    $(".alert").delay(2000).slideUp(200, function () {
        $(this).alert('close');
    });
    var inspectiontable = $('#inspectiontable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "inspectiontypedetails",
            "type": "POST",
            'beforeSend': function (request) {
                request.setRequestHeader("X-CSRF-TOKEN", jQuery('meta[name="csrf-token"]').attr('content'));
            },
        },
        "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
        ],
        "columns": [
            {
                "data": "created_at",
            },
            {
                "data": "sno",
            },
            {
                "data": "name",
            },
            {
                "data": "description",
            },
            {
                "data": "status",
            },
            {
                "data": "action",
            },
        ],
    });
    var sendinvoicetable = $('#sendinvoicetable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "sendinvoicedetails",
            "type": "POST",
            'beforeSend': function (request) {
                request.setRequestHeader("X-CSRF-TOKEN", jQuery('meta[name="csrf-token"]').attr('content'));
            },
        },
        "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
        ],
        "columns": [
            {
                "data": "created_at",
            },
            {
                "data": "sno",
            },
            {
                "data": "name",
            },
            {
                "data": "description",
            },
            {
                "data": "status",
            },
            {
                "data": "action",
            },
        ],
    });
    inspectiontable.on('click', '.delete', function () {
        $('#userdetails_processing').show();
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspection-type-delete',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function (data) {
                        inspectiontable.ajax.reload();
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            };
        });
    });
    inspectiontable.on('click', '.status', function () {
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspection-type-status-update',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function (data) {
                        inspectiontable.ajax.reload();
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            };
        });
    });
    sendinvoicetable.on('click', '.delete', function () {
        $('#userdetails_processing').show();
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'send-invoice-delete',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function (data) {
                        sendinvoicetable.ajax.reload();
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            };
        });
    });
    sendinvoicetable.on('click', '.status', function () {
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'send-invoice-status-update',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function (data) {
                        sendinvoicetable.ajax.reload();
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

    var requesttable = $('#requesttable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "requestdetails",
            "type": "POST",
            'beforeSend': function (request) {
                request.setRequestHeader("X-CSRF-TOKEN", jQuery('meta[name="csrf-token"]').attr('content'));
            },
        },
        "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
        ],
        "columns": [
            {
                "data": "company_id",
            },
            {
                "data": "applicantname",
            },
            {
                "data": "address",
            },
            {
                "data": "inspectiontype",
            },
            {
                "data": "created_at",
            },
            {
                "data": "assigned_inspector",
            },
            {
                "data": "status",
            },
            {
                "data": "action",
            },
        ],
    });
    requesttable.on('click', '.delete', function () {
        $('#userdetails_processing').show();
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspection-type-delete',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function (data) {
                        requesttable.ajax.reload();
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

    var inspectortable = $('#inspectortable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "inspectortabledetails",
            "type": "POST",
            'beforeSend': function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", jQuery('meta[name="csrf-token"]').attr('content'));
            },
        },
        "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
        ],
        "columns": [{
                "data": "company_name",
            },
            {
                "data": "name",
            },
            {
                "data": "color_code",
            },
            {
                "data": "number",
            },
            {
                "data": "email",
            },
            {
                "data": "status",
            },
            {
                "data": "license_number",
            },
            {
                "data": "area_coverage",
            },
            {
                "data": "action",
            },

        ],
    });

    inspectortable.on('click', '.status', function() {
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspector-status-update',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function(data) {
                        inspectortable.ajax.reload();
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

    inspectortable.on('click', '.delete', function() {
        $('#userdetails_processing').show();
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspector-delete',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function(data) {
                        inspectortable.ajax.reload();
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

    // Nav sidebar
    $('nav .nav-item a').click(function (e) {
        $('.nav-item').removeClass('menu-is-opening menu-open');
        $('.nav .nav-treeview').css('display', 'none');
        $(this).parent('li .nav-link').addClass('menu-is-opening menu-open');
        $(this).find('ul').css('display', 'block');
    });


    var usertable = $('#usertable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "usertableedetails",
            "type": "POST",
            'beforeSend': function (request) {
                request.setRequestHeader("X-CSRF-TOKEN", jQuery('meta[name="csrf-token"]').attr('content'));
            },
        },
        "columnDefs": [
            { "className": "dt-center", "targets": "_all" }
        ],
        "columns": [
            {
                "data": "created_at",
            },
            {
                "data": "sno",
            },
            {
                "data": "name",
            },
            {
                "data": "email",
            },
            {
                "data": "status",
            },
            {
                "data": "action",
            },
        ],
    });

    
    usertable.on('click', '.delete', function() {
        $('#userdetails_processing').show();
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspector-delete',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function(data) {
                        usertable.ajax.reload();
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

    usertable.on('click', '.status', function() {
        element = $(this);
        var userid = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'inspector-status-update',
                    data: {
                        id: userid
                    },
                    dataType: 'json',
                    success: function(data) {
                        usertable.ajax.reload();
                    },
                    error: function(data) {
                        // console.log(data);
                    }
                });
            };
        });
    });

});

