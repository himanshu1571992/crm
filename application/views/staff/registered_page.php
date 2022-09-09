<!DOCTYPE html>

<html>

<head>

  <title><?php echo $title; ?></title>

  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

  <style type="text/css">

  		body{
  			display: flex;
		    align-items: center;
		    justify-content: center;
		    height: 90vh;
  		}

	  	.warpper{
	  		width: 60%;
		    border: 1px solid #e9e9e9;
		    border-radius: 5px;
		    margin: auto;
		    padding: 30px;
		    -webkit-box-shadow: 0 0 10px rgba(0,0,0,0.05);
		    -moz-box-shadow: 0 0 10px rgba(0,0,0,0.05);
		    box-shadow: 0 0 10px rgba(0,0,0,0.05);
	  	}

	  	.logo{
                   
	  		text-align: center;
	  	}

	  	main h3{
	  		text-align: center;
	  		font-weight: 900;
    		font-size: 26px;
	  	}

	  	.button-row{
	  		text-align: center;
	  	}

	  	button {
		    background: transparent;
		    border: none;
		    cursor: pointer;
		}

		button:focus{
			outline: none;
		}

		button img{
			width: 150px;
		    margin-right: 10px;
		    margin-top: 0px;
		    margin-bottom: 10px;
		}

		ul{
			padding: 0;
			margin: 0;
		}

		ul li{
			list-style: none;
			line-height: 26px;
		}

  </style>

</head>

<body style="font-family: 'Nunito', sans-serif;">

    <div class="warpper">
        <div class="logo col-md-2">
            <img style="width: 20%;"src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
        </div>

        <main>
            <h3>Download your filled document</h3>

            <div class="button-row">
                <button type="button"><a target="_blank" href="<?php echo base_url("staff/employee_print/".$id); ?>" class="actionBtn"><img src="https://schachengineers.com/schacrm_test/uploads/company/print.png"></a></button>
                <button type="button"><a target="_blank" href="<?php echo base_url("staff/employee_pdf/".$id); ?>" class="actionBtn"><img src="https://schachengineers.com/schacrm_test/uploads/company/pdf.png"></a></button>
            </div>
        </main>

    </div>

</body>

</html>