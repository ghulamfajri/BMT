@extends('layouts.apps')

@section('side-navbar')
    @include('layouts.side_navbar')
@endsection

@section('top-navbar')
    @include('layouts.top_navbar')
@endsection

@section('extra_style')
    <link href="{{ URL::asset('css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            <div class="col-md-12 btn-group">
                                <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#addRekModal" title="Tambah Rekening">Tambah Rekening
                                    <i class="pe-7s-add-user"></i>
                                </button>
                            </div>
                            <span></span>
                        </div>

                        <table id="bootstrap-table" class="table">
                            <thead>
                            <th></th>
                            {{--<th data-field="state" data-checkbox="true"></th>--}}
                            <th data-field="id" data-sortable="true" class="text-left">ID Rekening</th>
                            <th data-field="nama" data-sortable="true">Nama Rekening</th>
                            <th data-field="jenis" data-sortable="true">Jenis Rekening</th>
                            <th data-field="detail" data-sortable="true">Detail</th>
                            {{--<th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>--}}
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach ($data as $rek)
                                <tr>
                                    <td></td>
                                    <td>{{ $rek->id_rekening }}</td>
                                    <td>{{ $rek->nama_rekening }}</td>
                                    <td>{{ $rek->jenis_rekening }}</td>
                                    <td>{{ $rek->detail }}</td>

                                    <td class="td-actions text-center">
                                        <button type="button" class="btn btn-social btn-success btn-fill" data-toggle="modal" data-target="#editRekModal" title="Edit"
                                                data-idrek      = "{{$rek->id_rekening}}"
                                                data-namarek    = "{{$rek->nama_rekening}}"
                                                data-indukrek    = "{{$rek->id_induk}}"
                                                data-tiperek    = "{{$rek->jenis_rekening}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        {{--<a class="btn btn-social btn-success btn-fill" data-toggle="modal" data-target="#editRekModal" title="Edit">--}}
                                            {{--<i class="fa fa-edit"></i>--}}
                                        {{--</a>--}}
                                        <button type="button" class="btn btn-social btn-danger btn-fill" data-toggle="modal" data-target="#delRekModal" title="Edit"
                                                data-idrek      = "{{$rek->id_rekening}}"
                                                data-namarek    = "{{$rek->nama_rekening}}">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {{--<a class="btn btn-social btn-danger btn-fill" data-toggle="modal" data-target="#deleteRekModal" title="Delete">--}}
                                            {{--<i class="fa fa-remove"></i>--}}
                                        {{--</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div> <!-- end row -->

        </div>
    </div>

    @include('modal.rekening')

@endsection

@section('extra_script')

    <script type="text/javascript">
//        $('#editRekModal').on('hidden.bs.modal', function () {
//            if (!$('#editRekModal').hasClass('no-reload')) {
//                location.reload();
//            }
//        });
        $('#editRekModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idrek = button.data('idrek');
            var indukrek = button.data('indukrek');
            var namarek = button.data('namarek');
            var jenis_rekening = button.data('tiperek');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#indukRek').val(indukrek);
            $('#id_edit').val(idrek);
            $('#namaRekening').val(namarek);
            $('#tipeRek').val(jenis_rekening);
            $('#editRekLabel').text("Edit Rekening: " + namarek);
        });

        $('#delRekModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idrek = button.data('idrek');
            var namarek = button.data('namarek');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#id_del').val(idrek);
            $('#delReklabel').text("Hapus Rekening: " + namarek);
            $('#toDelete').text("Rekening " + namarek + " akan dihapus!");
        });

    </script>

    <!-- Select2 plugin -->
    <script src=" {{  URL::asset('/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#selRekening").select2({
                dropdownParent: $("#addRekModal")
            });
            $("#indukRek").select2({
                dropdownParent: $("#editRekModal")
            });
            lbd.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700);

            $('#selRekening').select2();
            $('#indukRek').select2();
        });
    </script>

    <script type="text/javascript">
        var $table = $('#bootstrap-table');

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }

        $().ready(function(){
            window.operateEvents = {
                'click .view': function (e, value, row, index) {
                    info = JSON.stringify(row);

                    swal('You click view icon, row: ', info);
                    console.log(info);
                },
                'click .edit': function (e, value, row, index) {
                    info = JSON.stringify(row);

                    swal('You click edit icon, row: ', info);
                    console.log(info);
                },
                'click .remove': function (e, value, row, index) {
                    console.log(row);
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
                }
            };

            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                pageList: [8,10,25,50,100],

                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });

            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();

            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });


        });

//        demo = {
//            showSwal: function(type){
//                if(type == 'basic'){
//                    swal("Here's a message!");
//
//                }else if(type == 'title-and-text'){
//                    swal("Here's a message!", "It's pretty, isn't it?")
//
//                }else if(type == 'success-message'){
//                    swal("Good job!", "You clicked the button!", "success")
//
//                }else if(type == 'warning-message-and-confirmation'){
//                    swal({  title: "Are you sure?",
//                        text: "You will not be able to recover this imaginary file!",
//                        type: "warning",
//                        showCancelButton: true,
//                        confirmButtonClass: "btn btn-info btn-fill",
//                        confirmButtonText: "Yes, delete it!",
//                        cancelButtonClass: "btn btn-danger btn-fill",
//                        closeOnConfirm: false,
//                    },function(){
//                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
//                    });
//
//                }else if(type == 'warning-message-and-cancel'){
//                    swal({  title: "Are you sure?",
//                        text: "You will not be able to recover this imaginary file!",
//                        type: "warning",
//                        showCancelButton: true,
//                        confirmButtonText: "Yes, delete it!",
//                        cancelButtonText: "No, cancel plx!",
//                        closeOnConfirm: false,
//                        closeOnCancel: false
//                    },function(isConfirm){
//                        if (isConfirm){
//                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
//                        }else{
//                            swal("Cancelled", "Your imaginary file is safe :)", "error");
//                        }
//                    });
//
//                }else if(type == 'custom-html'){
//                    swal({  title: 'HTML example',
//                        html:
//                        'You can use <b>bold text</b>, ' +
//                        '<a href="http://github.com">links</a> ' +
//                        'and other HTML tags'
//                    });
//
//                }else if(type == 'auto-close'){
//                    swal({ title: "Auto close alert!",
//                        text: "I will close in 2 seconds.",
//                        timer: 2000,
//                        showConfirmButton: false
//                    });
//                } else if(type == 'input-field'){
//                    swal({
//                            title: 'Input something',
//                            html: '<p><input id="input-field" class="form-control"></p>' +
//                                  '<p><input id="input-field" class="form-control"></p>',
//                            showCancelButton: true,
//                            closeOnConfirm: false,
//                            allowOutsideClick: false
//                        },
//                        function() {
//                            swal({
//                                html:
//                                'You entered: <strong>' +
//                                $('#input-field').val() +
//                                '</strong>'
//                            });
//                        })
//                }
//            }
//        };
    </script>

    <script type="text/javascript">
        url_add = "{{route('admin.datamaster.rekening.add_rekening')}}";
        url_edit = "{{route('admin.datamaster.rekening.edit_rekening')}}";
        url_delete = "{{route('admin.datamaster.rekening.delete_rekening')}}";
    </script>

    <script>
        notif ={
            statusRekening: function () {
                status_ = "{{isset($status)?$status[0]:""}}";
                if(status_ === "success")
                    icon_ = "pe-7s-check";
                else if (status_ === "warning")
                    icon_ = "pe-7s-close-circle";
                else
                    icon_ = "";

                $.notify({
                    icon: icon_,
                    message: "<b>{{isset($status)?$status[1]:""}}</b>"

                }, {
                    type: status_,
                    timer: 4000
                });
            }
        }
    </script>
    <script type="text/javascript">
        $().ready(function(){
            var selAr =  document.getElementById$('toHide');
            selAr.hide();
            $('#addRekening').validate();
            @if($status)
                notif.statusRekening();
            @endif

            var selTip = $('#tipeRekAdd');
            selTip.on('change', function () {

                alert("I am an alert box!");
                if(selTip .val() == 1) {
                    selAr.show();
                }
                else {
                    selAr.hide();
                }
            });


        });
    </script>
    {{--<script>--}}
        {{--function IndukCheck(that) {--}}
            {{--if (that.value == "2") {--}}
{{--//                alert("check");--}}
                {{--document.getElementById("ifInduk").style.display = "block";--}}
            {{--} else {--}}
                {{--document.getElementById("ifInduk").style.display = "none";--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

