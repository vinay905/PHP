<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MailForm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body
    {
        background-color: rgba(50, 115, 220, 0.3);
    }

    .lds-ellipsis {
  display: none;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 33px;
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: #fff;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 8px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 8px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 32px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 56px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}
</style>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-6 mt-3">
            <h3>Forgot Password</h3>
            <form method="post" onsubmit="ajaxcall(event)">
                <div class="form-group my-2">
                    <label for="">Email:</label>
                    <input type="email" class="form-control" id="mail" placeholder="Enter your mail address" name="email" required>
                </div>
                <button class="btn btn-primary my-3">Send</button>
            </form>
            <div class="lds-ellipsis my-3" id="loader">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="alert alert-success my-2" id="alert" style="display:none;">Please Check Your mail for reset code</div>
            <div class="alert alert-danger my-2" id="alert2" style="display:none;">Mail id Does not exists</div>
        </div>
    </div>
</div>
</body>

</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    function ajaxcall(e)
    {   
        let Mail=$("#mail").val();
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: '<?=base_url("sentmail");?>',
            data:{
                mail:Mail
            },
            beforeSend: function()
            {
                $("#loader").show();
            },
            success:function(response)
            {   
                if(response=="mail sent")
                {   
                    $("#alert").show();
                }
                else if(response=="Not exists")
                {      
                    $("#alert2").show();
                    $("#alert").hide();
                    var timeout = 3000; // in miliseconds (3*1000)
                    $("#alert2").delay(timeout).fadeOut(300);
                }
                else
                {
                    alert(response);
                }
            },
            complete:function(data)
           {
            $("#loader").hide();
           }
        });
    }
</script>