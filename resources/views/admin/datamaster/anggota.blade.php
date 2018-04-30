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
            @if($errors)
                @foreach ($errors->all() as $error)
                    <div class="row ">
                        <div class="alert-danger text-center">{{ $error }}</div>
                    </div>
                @endforeach
                    <br>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                            <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                            <div class="col-md-12 btn-group">
                                <button type="button" class="btn btn-primary btn-fill" data-toggle="modal" data-target="#addUsrModal" title="Tambah Anggota">Tambah User
                                    <i class="pe-7s-add-user"></i>
                                </button>
                                {{--<div class="col-md-2">--}}
                                    {{--<button class="btn btn-default btn-block" onclick="demo.showNotification('top','right')">Top Right</button>--}}
                                {{--</div>--}}
                            </div>
                            <span></span>
                        </div>

                        <table id="bootstrap-table" class="table">
                            <thead>
                            <th></th>
                            {{--<th data-field="state" data-checkbox="true"></th>--}}
                            <th data-field="id" data-sortable="true" class="text-left">No KTP</th>
                            <th data-field="nama" data-sortable="true">Nama</th>
                            <th data-field="alamat" data-sortable="true">Alamat</th>
                            <th data-field="jenis" data-sortable="true">Tipe</th>
                            <th data-field="registrasi" data-sortable="true">Tgl Registrasi</th>
                            {{--<th data-field="actions" class="td-actions text-right" data-events="operateEvents" data-formatter="operateFormatter">Actions</th>--}}
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach ($data as $usr)
                                <tr>
                                    <td></td>
                                    <td>{{ $usr->no_ktp }}</td>
                                    <td>{{ $usr->nama   }}</td>
                                    <td>{{ $usr->alamat }}</td>
                                    <td>{{ $usr->tipe }}</td>
                                    <td>{{ $usr->tanggal_registrasi }}</td>

                                    <td class="td-actions text-center">
                                        <button type="button" class="btn btn-social btn-info btn-fill" data-toggle="modal" data-target="#editPassUsrModal" title="Ubah Password"
                                                data-id      = "{{$usr->no_ktp}}"
                                                data-nama    = "{{$usr->nama}}">
                                            <i class="fa fa-key"></i>
                                        </button>

                                        <button type="button" class="btn btn-social btn-success btn-fill" data-toggle="modal" data-target="#editUsrModal" title="Edit"
                                                          data-id      = "{{$usr->no_ktp}}"
                                                          data-nama    = "{{$usr->nama}}"
                                                          data-alamat    = "{{$usr->alamat}}"
                                                          data-tipe    = "{{$usr->tipe}}"
                                                          data-p    = "{{$usr->password}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button"  class="btn btn-social btn-danger btn-fill" data-toggle="modal" data-target="#delUsrModal" title="Delete"
                                                data-id         = "{{$usr->no_ktp}}"
                                                data-nama       = "{{$usr->nama}}">
                                            <i class="fa fa-remove"></i>
                                        </button>
                                        {{--<a class="btn btn-social btn-danger btn-fill" data-toggle="modal" data-target="#deleteUsrModal" title="Delete">--}}
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

    @include('modal.anggota')

@endsection

@section('extra_script')

    <script type="text/javascript">
           //        $('#editUsrModal').on('hidden.bs.modal', function () {
        //            if (!$('#editUsrModal').hasClass('no-reload')) {
        //                location.reload();
        //            }
        //        });
           $('#editPassUsrModal').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget); // Button that triggered the modal
               var id = button.data('id');
               var nama = button.data('nama');
               // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
               // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
               $('#id_usr_p').val(id);
               $('#editPassUsrlabel').text("Edit Password User: " + nama);
           });

           $('#editUsrModal').on('show.bs.modal', function (event) {
               var button = $(event.relatedTarget); // Button that triggered the modal
               var id = button.data('id');
               var alamat = button.data('alamat');
               var nama = button.data('nama');
               var tipe = button.data('tipe');
               // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
               // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
               $('#id_edit').val(id);
               $('#id_usr_edit').val(id);
               $('#nama_usr').val(nama);
               $('#alamat_usr').val(alamat);
               $('#tipe_usr').val(tipe);
               $('#editUsrLabel').text("Edit User: " + nama);
           });

        $('#delUsrModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id');
            var nama = button.data('nama');
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $('#id_del').val(id);
            $('#delUsrLabel').text("Hapus Anggota: " + nama);
            $('#toDelete').text("Anggota " + nama + " akan dihapus!");
        });

    </script>
    

    <script type="text/javascript">
        var $table = $('#bootstrap-table');


        $().ready(function(){

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

    </script>

    <script type="text/javascript">
        url_add = "{{route('admin.datamaster.anggota.add_anggota')}}";
        url_edit = "{{route('admin.datamaster.anggota.edit_anggota')}}";
        url_delete = "{{route('admin.datamaster.anggota.delete_anggota')}}";
    </script>

    <script>
        notif ={
            statusAnggota: function () {
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
            $('#addUrs').validate();
            $('#editUsr').validate();
            $('#delUsr').validate();
            @if($status)
                notif.statusRekening();
                    @endif

//            var selTip = $('#tipeRekAdd');
//            selTip.on('change', function () {
//
//                alert("I am an alert box!");
//                if(selTip .val() == 1) {
//                    selAr.show();
//                }
//                else {
//                    selAr.hide();
//                }
//            });


        });
        type = ['','info','success','warning','danger'];

        demo = {

                    showSwal: function(type){
                        if(type == 'basic'){
                            swal("Here's a message!");

                        }else if(type == 'title-and-text'){
                            swal("Here's a message!", "It's pretty, isn't it?")

                        }else if(type == 'success-message'){
                            swal("Good job!", "You clicked the button!", "success")

                        }else if(type == 'warning-message-and-confirmation'){
                            swal({  title: "Are you sure?",
                                text: "You will not be able to recover this imaginary file!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonClass: "btn btn-info btn-fill",
                                confirmButtonText: "Yes, delete it!",
                                cancelButtonClass: "btn btn-danger btn-fill",
                                closeOnConfirm: false,
                            },function(){
                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            });

                        }else if(type == 'warning-message-and-cancel'){
                            swal({  title: "Are you sure?",
                                text: "You will not be able to recover this imaginary file!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Yes, delete it!",
                                cancelButtonText: "No, cancel plx!",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },function(isConfirm){
                                if (isConfirm){
                                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                }else{
                                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                                }
                            });

                        }else if(type == 'custom-html'){
                            swal({  title: 'HTML example',
                                html:
                                'You can use <b>bold text</b>, ' +
                                '<a href="http://github.com">links</a> ' +
                                'and other HTML tags'
                            });

                        }else if(type == 'auto-close'){
                            swal({ title: "Auto close alert!",
                                text: "I will close in 2 seconds.",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else if(type == 'input-field'){
                            swal({
                                    title: 'Input something',
                                    html: '<p><input id="input-field" class="form-control">',
                                    showCancelButton: true,
                                    closeOnConfirm: false,
                                    allowOutsideClick: false
                                },
                                function() {
                                    swal({
                                        html:
                                        'You entered: <strong>' +
                                        $('#input-field').val() +
                                        '</strong>'
                                    });
                                })
                        }
                    },
                    showNotification: function(from, align,msg){
                        color = Math.floor((Math.random() * 4) + 1);

                        $.notify({
                            icon: "pe-7s-gift",
                            message: "<b>msg</b>"

                        },{
                            type: type[color],
                            timer: 1000,
                            placement: {
                                from: from,
                                align: align
                            }
                        });
                    },
                };
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

