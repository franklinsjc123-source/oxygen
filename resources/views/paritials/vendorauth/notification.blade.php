<!--Notification message panel -->
<div class="iq-top-notification">

    <style type="text/css">
        .close {
           /* float: right; */
            font-size: 21px;
            font-weight: bold;
            line-height: 1;
            height: 5px !important;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity=20);
            opacity: .2;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
            filter: alpha(opacity=50);
            opacity: .5;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger divWarning" id="divWarning" style="display: none;">
                <button type="button" class="close close2 " aria-hidden="true"
                    onclick="$('#divWarning').hide();">x</button>
                <span class="errmsg"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success divSuccess" id="divSuccess" style="display: none;">
                <button type="button" class="close close2 " aria-hidden="true"
                    onclick="$('#divSuccess').hide();">x</button>
                <span class="successmsg"></span>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade" id="divConfirm" tabindex="-1" role="dialog" aria-labelledby="divConfirmLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert alert-danger">
                    <button type="button" class="close close2" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="model_label">Confirmation</h4>
                </div>
                <div class="modal-body">
                    Are you sure to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn_noti_cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btn_noti_confrim" class="btn btn-primary">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- modal Alert-->
    <div class="modal fade" id="divAlert" tabindex="-1" role="dialog" aria-labelledby="divAlertLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert alert-info">
                    <button type="button" class="close2" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body m-3">
                    <span id="noti_message"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">OK</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<!--Notification message panel -->
 <script>
    function showSuccessNotification(msg) {
        //toastr.success(msg, "Success!");
        if (!msg) {
            msg = "";
        }
        Toastify({
            className: "alert-success",
            text: msg,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right"

        }).showToast();

        $(".successmsg").html(msg);
        $("#divSuccess").show();
    }

    function showErrorNotification(msg) {
        //toastr.error(msg, "Error!"); 
        if (!msg) {
            msg = "";
        }
        Toastify({
            className: "alert-danger",
            text: msg,
            duration: 3000,
            close: true,
            gravity: "bottom",
            position: "right"

        }).showToast();
        $(".errmsg").html(msg);
        $("#divWarning").show();
    }

    function hideMessage() {
        $("#divSuccess").hide();
        $("#successmsg").html("");
        $("#divWarning").hide();
        $(".errmsg").html("");
    }
 </script>
