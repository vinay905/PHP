<html>
<head>
</head>
<body>
    <style>
        body
        {
            background-color:#85C1E9 ;
        }
        #body
        {
            color: #5DADE2;
        }
 
        #body a 
        {
            text-decoration: none;
        }

        #head
        {
            background-color:#85C1E9 ;
            color: #fff;
        }

        #title
        {
            text-align: center;
            font-size: 20px;
            padding: 10px 10px;
        }

        .link,.code
        {
            display: grid;
            text-align: center;
            padding: 10px 10px;
        }

        .imgbox
        {
            width: 350px;
        }

        #instruction
        {
            font-size: 15px;
        }
    </style>
    <h3>Test Mail - Support</h3>
    <div class="container">
        <div class="card">
            <div class="card-header" id="head">
                <h2 id="title">RESET PASSWORD</h2>
            </div>
            <div class="card-body" id="body">
                <span id='instruction'>Instruction</span>
                <ul>
                <li>Copy the reset Code</li>
                <li>click the below link to reset your password</li>
                <li>Paste the copied code in the reset page and create new password</li>
                </ul>
                <div style="background-color: #D5DBDB;">
                    <h1 class="code"><?=$token;?></h1>
                    <a class="link" style="font-size: 15px;"href="<?=base_url('resetpass/'.$id)?>">Click here to reset the password</a>
                </div>
                <img src="GFpcwfbi5W.jpg" class="imgbox">
            </div>
        </div>
    </div>
    
</body>
</html>