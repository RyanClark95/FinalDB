<?php
/*
Ryan Clark MYSQL PROJECT
 */
include'./config.php';
include './header.php';
try {
   $sql = "SELECT * FROM tbl_contacts WHERE 1 AND contact_id = :cid";
   $stmt = $DB->prepare($sql);
   $stmt->bindValue(":cid", intval($_GET["cid"]));
   
   $stmt->execute();
   $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
?>

<div class="row">
  <ul class="homebar">
      <li><a href="index.php">Home</a></li>
      <li class="active"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> Contacts</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($_GET["m"] == "update") ? "Edit" : "Add"; ?> New Contact</h3>
      </div>
      <div class="panel-body">

        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <input type="hidden" name="mode" value="<?php echo ($_GET["m"] == "update") ? "update_old" : "add_new"; ?>" >
          
          <input type="hidden" name="pagenum" value="<?php echo $_GET["pagenum"]; ?>" >
          <fieldset>
            <div class="form-group">
              <label class=" control-label" for="first_name"><span class="required">*</span>First Name:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["first_name"] ?>" placeholder="First Name" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="middle_name">Middle Name:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["middle_name"] ?>" placeholder="Middle Name" id="middle_name" class="form-control" name="middle_name">
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="last_name"><span class="required">*</span>Last Name:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["last_name"] ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="email_id"><span class="required">*</span>Email ID:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["email_address"] ?>" placeholder="Email ID" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="contact_no1"><span class="required">*</span>Home Number:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["contact_no1"] ?>" placeholder="xxx-xxx-xxxx" id="contact_no1" class="form-control" name="contact_no1"><span id="contact_no1_err" class="error"></span>
                <span class="help-block">Maximum of 10 digits only and only numbers.</span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="contact_no2">Cell Number:</label>
              <div class="">
                <input type="text" value="<?php echo $results[0]["contact_no2"] ?>" placeholder="xxx-xxx-xxxx" id="contact_no2" class="form-control" name="contact_no2"><span id="contact_no2_err" class="error"></span>
                <span class="help-block">Maximum of 10 digits only and only numbers.</span>
              </div>
            </div>
            
            
            
            
            
            
            
            <div class="form-group">
              <label class=" control-label" for="address">Address:</label>
              <div class="">
                <textarea id="address" name="address" rows="3" class="form-control"><?php echo $results[0]["address"] ?></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <div class=" col-lg-offset-4">
                <button class="btn btn-primary" type="submit">Submit</button> 
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
	
	// the fade out effect on hover
	$('.error').hover(function() {
		$(this).fadeOut(200);  
	});
	
	
	$("#contact_form").submit(function() {
		$('.error').fadeOut(200);  
		if(!validateForm()) {
            // go to the top of form first
            $(window).scrollTop($("#contact_form").offset().top);
			return false;
		}     
		return true;
    });

});

function validateForm() {
	 var errCnt = 0;
	 
	 var first_name = $.trim( $("#first_name").val());
     var last_name = $.trim( $("#last_name").val());
	 var email_id = $.trim( $("#email_id").val());
	 var contact_no1 = $.trim( $("#contact_no1").val());
	 var contact_no2 = $.trim( $("#contact_no2").val());
     
	 var profile_pic =  $.trim( $("#profile_pic").val());

	// validate name
	if (first_name == "" ) {
		$("#first_name_err").html("Enter your first name.");
		$('#first_name_err').fadeIn("fast"); 
		errCnt++;
	}  else if (first_name.length <= 2 ) {
		$("#first_name_err").html("Enter atleast 3 letter.");
		$('#first_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (last_name == "" ) {
		$("#last_name_err").html("Enter your last name.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	}  else if (last_name.length <= 2 ) {
		$("#last_name_err").html("Enter atleast 3 letter.");
		$('#last_name_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (!isValidEmail(email_id)) {
		$("#email_id_err").html("Enter valid email.");
		$('#email_id_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (contact_no1 == "" ) {
		$("#contact_no1_err").html("Enter first contact number.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	}  else if (contact_no1.length <= 9 || contact_no1.length > 10 ) {
		$("#contact_no1_err").html("Enter 10 digits only.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no1) ) {
		$("#contact_no1_err").html("Must be digits only.");
		$('#contact_no1_err').fadeIn("fast"); 
		errCnt++;
	}
    
    if (contact_no2.length > 0) {
      if (contact_no2.length <= 9 || contact_no2.length > 10 ) {
		$("#contact_no2_err").html("Enter 10 digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	} else if ( !$.isNumeric(contact_no2) ) {
		$("#contact_no2_err").html("Must be digits only.");
		$('#contact_no2_err').fadeIn("fast"); 
		errCnt++;
	}
    }
    
    
   
    
	if(errCnt > 0) return false; else return true;
}

function isValidEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
</script>
