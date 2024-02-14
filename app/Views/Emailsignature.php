    <!DOCTYPE html>
    <html>

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Generate Signature</title>
    </head>
    <style>
    
    label
    {
      font-size: larger;
      font-weight: bold;
      font-family: PT SANS-NARROW;
      color: steelblue;
    }

    h3
    {
      font-size: xx-large;
      font-weight: bold;
      font-family: PT SANS-NARROW;
      color: #fff;
    }

    #innerbox
    {
     box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    #img-logo
    {   
        width: 100px;
        height: 100px;
        position: absolute;
        top: -45px;
        left: 60px;
    }

    content
    {
        font-family: sans-serif;
    }
        
    #imgcontainer
    {
        position: relative;
        background-color:rgb(137, 196, 244);
        mask-type: luminance;
    }

    #imgcontainer p
    {
        font-size: 1rem;
        font-weight: bold;
        color: rgba(15, 82, 237, 0.79);
    }

    #textcontent a,h3
    {
        font-family: PT SANS-NARROW;
        font-size: 0.8rem;
    }

    #textcontent address
    {
        font-family: PT SANS-NARROW;
        font-size: 0.8rem;
    }

    #textcontent
    {
        background-color:rgb(137, 196, 244);
        padding-left: 10px;
    }

    #contentbox p
    {
        font-size: 0.8rem;
    }

    #UserDesignation1,#UserNumber1,#UserEmail1
    {
        font-size:0.8rem;
    }

    #address
    {
        font-size:1rem;
        line-height: 0.8px;
    }

    #site
    {
        font-size:1rem;
        text-decoration: none;
    }

    #speciality
    {
        font-size:12px;
    }

    #dwnld-png
    {
        display:none;
    }

    #dwnld-png button
    {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    </style>
    <body>
    <!-- ----------------------- DETAILS FORM -------------------------------------------------- -->
            <div class="rounded m-1" id="animationbg">
                <div class="container-fluid mt-5 p-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto" id="innerbox">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="text-start fw-bold fs-4" style="color:#074985">Enter Your Details <img class="pb-2 img-fluid" src="<?=base_url();?>/public/Icons/Details.png"></h2>
                            </div>
                            <div class="card-body">
                                <!-- action="<?=base_url('signature');?>" -->
                                <form class="form-group" id="FormSubmit" method="Post" enctype="multipart/form-data" onsubmit="ajaxrequest(event)">
                                    <div class="row">
                                        <div class="col-sm-6 my-2">
                                            <div class="form-group">
                                                <label>Employee Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name" id="Username" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 my-2">
                                            <div class="form-group">
                                                <label>Employee E-mail</label>
                                                <input class="form-control" type="email" placeholder="Enter E-mail" pattern="(?![_.-])((?![_.-][_.-])[a-zA-Z\d_.-]){0,63}[a-zA-Z\d]@((?!-)((?!--)[a-zA-Z\d-]){0,63}[a-zA-Z\d]\.){1,2}([a-zA-Z]{2,14}\.)?[a-zA-Z]{2,14}" id="UserEmail" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-sm-6 my-2">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input class="form-control" type="text" placeholder="Enter Designation" maxlength="30" id="UserDesignation" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 my-2">
                                            <div class="form-group">
                                                <label>Contact No</label>
                                                <input class="form-control" type="text" placeholder="Enter Contact Number" id="UserNumber"  pattern="[4-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" maxlength="10" title="Please Enter valid contact number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 my-2">
                                            <div class="form-group">
                                                <label>Company Name</label>
                                                <select id="cmpid" class="form-control form-select" onchange="getdetails(event)" required>
                                                    <option value="" Selected disabled>Select Company Name</option>
                                                    <?php foreach ( $data as $value) 
                                                  {
                                                    echo"<option value=".$value['id'].">".$value['company_name']."</option>";
                                                  }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 my-2">
                                            <div class="form-group">
                                                <label>Company Address</label>
                                                <select id="cmpaddress" class="form-control form-select" onchange="getaddress()" required>
                                                    <option value="" selected disabled>Select Company Address</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 my-2 text-center">
                                            <button class="btn btn-primary" type="submit" >Get Signature<img src="<?=base_url();?>/public/Icons/rightarrow.png"></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--PREVIEW TEMPLATE-----------------------------------------------  -->
<div id="preview" class="container pb-3">
    <div class="pt-5">
        <div class="container">
            <!--IMAGE BOX-------------------------------------------- -->
            <div class="row gx-0">
                <div class="d-flex justify-content-center">
                    <div class="col-6 col-md-2 col-sm-6" id="imgcontainer">
                        <img id="img-logo" class="img-fluid" src="<?=base_url('images/Logo.png')?>">
                        <p id="speciality" class="text-center mt-4 pt-5"></p>
                    </div>
                    <!--IMAGE BOX END-------------------------------------------- -->
                    <!--TEXT BOX----------------------------------------------- -->
                    <div class="col-6 col-md-3 col-sm-6">
                        <div class="text-start" id="textcontent">
                            <div class="py-1" style="line-height: normal; font-size: smaller;">
                                <span id="Username1" class="fs-4 fw-bold">NAME</span><br>
                                <span id="UserDesignation1">Designation</span><br>
                                <span id="UserNumber1">Contact No.</span><br>
                                <span id="UserEmail1">E-mail</span>
                            </div>
                            <div class="py-1" style="line-height: normal; font-size: smaller;">
                                <span id="cmpid1" class=" fs-6 fw-bold">Company Name</span><br>
                                <span id="address"></span><br>
                            </div>
                            <div class="pb-2" style="line-height: normal;">
                                <a id="site" href="#">Website</a>
                            </div>
                        </div>
                    </div>
                    <!--TEXT BOX END-------------------------------------------- -->
                </div>
            </div>
            <!--CONTENT BOX------------------------------------------------ -->
            <div class="row gx-0" id="contentbox">
                <div class="col-md-5 bg-light col-sm-12 mx-auto">
                    <p id="content" class="px-1 text-start" style="line-height: normal; font-size: smaller;"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--PREVIEW TEMPLATE END-----------------------------------------------  -->
<!--Download button-------------------------------------------- -->
<div class="container mt-2" id="dwnld-png">
    <div class="row">
        <div class="mb-5 d-flex justify-content-center">
            <button class="btn" onclick="capture(event)">Download Signature</button>
        </div>
    </div>
</div>

</body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
    //----------------------------JS AJAX CALL FOR FORM DATA SUBMITION ----------------------------------//
    function ajaxrequest(e) 
    {
        
        e.preventDefault();
        $('#dwnld-png').css("display", "block");
        
    }

//JS FOR ONKEYUP EVENT----------------------------------------//
    let input = document.getElementById('Username');
    input.onkeyup = () => { document.getElementById('Username1').innerHTML = input.value; }

    let input2 = document.getElementById('UserDesignation');
    input2.onkeyup = () => { document.getElementById('UserDesignation1').innerHTML = input2.value; }

    let input3 = document.getElementById('UserNumber');
    input3.onkeyup = () => { document.getElementById('UserNumber1').innerHTML = input3.value; }

    let input4 = document.getElementById('UserEmail');
    input4.onkeyup = () => { document.getElementById('UserEmail1').innerHTML = input4.value; }


//JS FOR DATA FETCH----------------------------------------------------//
function getdetails(e) 
    {
        let id = $('#cmpid').val();
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: '<?=base_url("fetchdata");?>',
            data: { Id: id },
            dataType: 'JSON',
            success: function(data) 
            {   
                // filling company address dropdown-start----------------------------------------// 
                let len = data.length;
                $("#cmpaddress").empty();
                $("#cmpaddress").append("<option value='' selected disabled>Select Company Address</option>");
                for (let i = 0; i < len; i++) 
                {
                    let id = data[i]['id'];
                    let name = data[i]['address'];
                    $("#cmpaddress").append("<option value='" + id + "'>" + name + "</option>");
                }
                //filling company address dropdown-END ------------------------------------------//

                document.getElementById("cmpid1").innerHTML = data[0].company_name;
                document.getElementById("content").innerHTML = data[0].content;
                document.getElementById("img-logo").src = '<?=base_url().'/public/images/';?>' + data[0].logo;


                // getting speciality column data and displaying it in html----------------------//
                const special = data[0].speciality.split(",");
                let txt = '';
                for (let x in special) 
                {
                    txt += special[x] + " | ";
                }
                txt = txt.substring(0, txt.length - 2);
                document.getElementById("speciality").innerHTML = txt;


                // getting website column data and displaying in html----------------------------//
                const site = data[0].website.split(",");
                let webadd = '';
                for (let x in site) 
                {
                    webadd += site[x] + " | ";
                }
                webadd = webadd.substring(0, webadd.length - 2);
                document.getElementById("site").innerHTML = webadd;
            }
        });
    }


//------------------- JS FOR SELECTING AND DISPLAYING DATA------------------------------------// 
function getaddress() 
{
    let input5 = $("#cmpaddress option:selected").text();
    document.getElementById("address").innerHTML = input5;
}
 



// JS FOR DOWNLOADING SIGNATURE 
function capture(e) 
{   
    // JS FOR CREATING IMAGE/////////////////////////
    html2canvas(document.getElementById("preview"),
        {
            allowTaint: true,
            useCORS: true
        }).then(function (canvas){
            var anchorTag = document.createElement("a");
            // document.getElementById("previewImg").appendChild(canvas);
            document.body.appendChild(anchorTag);
            anchorTag.download=randomname()+'.png';
            anchorTag.href = canvas.toDataURL("image/png");
            anchorTag.target = '_blank';
            anchorTag.click();
            
            //AJAX DATA SUBMIT //
            let name = $('#Username').val();
            let email = $('#UserEmail').val();
            let number = $('#UserNumber').val();
            let designation = $('#UserDesignation').val();
            let cmpid = $('#cmpid').val();
            let image=anchorTag.href;
            let imagename=anchorTag.download;

            e.preventDefault();
            $.ajax({
                method: 'POST',
                url: '<?=base_url("signature");?>',
                data: {
                    Name: name,
                    Email: email,
                    Number: number,
                    Designation: designation,
                    Companyid: cmpid,
                    file:image,
                    filename:imagename,
                },
                success: function(response) 
                {
                    if (response == "Successfull") 
                    {
                        // alert("Successfull");
                        $('#FormSubmit').find('input', ).val('');
                        $("#cmpid,#cmpaddress").val("selected");
                    } 
                    else 
                    {
                        alert(response);
                    }
                }
            });
        });
        $('#dwnld-png').css("display", "none");
}


// JS FOR GENERATING RANDOM NAME
function randomname() 
{
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 10; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  return text;
}


</script>