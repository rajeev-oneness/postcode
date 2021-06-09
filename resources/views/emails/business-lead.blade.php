<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">

  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Quotation Request</h1> 
        <p>User Details:-</p>
		    <p>Request By-<?php echo $userName; ?></p>
		    <p>Email-<?php echo $userEmail; ?></p>
		    <p>Phone-<?php echo $userPhn; ?></p>
        <p>Note: 
          <?php
            if ($importance == 1) {
              echo "I want to purchase immediately";
            }
            elseif ($importance == 2) {
              echo "I just want a quote";
            }
            elseif ($importance == 3){
              echo "I'm not ready to purchase but have an interest";
            }
          ?>
        </p>
		    <h3>You can respond to this request!</h3> 
      </div>
    </body>
</html>