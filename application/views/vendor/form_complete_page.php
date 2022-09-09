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
		<div class="logo">
                    <img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" style="width: 250px;" class="logo">
		</div>

		<main>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2" style="width: 100px; margin-left: 45%; margin-top: 5%">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
                    </svg>
			<h3>Thankyou for your time <br>Our Team will be contact with you soon.</h3>
                        
		</main>
		<h3 style="font-weight: 900;margin-bottom: 5px;">INSTRUCTIONS</h3>
		<ul>
			<li>01. (*) Mandatory Fields.</li>
			<li>02. Hand written form will not be acceptable.</li>
			<li>03. All the pages of Registration form should duly signed by the authorized person along with the stamp.</li>
			<li>04. Bank Details should be verified by the respective Bank.</li>
		</ul>
		
	</div>

</body>

</html>