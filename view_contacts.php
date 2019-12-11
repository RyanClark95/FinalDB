<?php

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
      <li class="active">View Contacts</li>
    </ul>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">View Contact</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" name="contact_form" id="contact_form" enctype="multipart/form-data" method="post" action="process_form.php">
          <fieldset>
            <div class="form-group">
              <label class=" control-label" for="first_name"><span class="required">*</span>First Name:</label>
              <div class="">
                <input type="text" readonly="" placeholder="First Name" value="<?php echo $results[0]["first_name"] ?>" id="first_name" class="form-control" name="first_name"><span id="first_name_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="middle_name">Middle Name:</label>
              <div class="">
                <input type="text" readonly="" value="<?php echo $results[0]["middle_name"] ?>" placeholder="Middle Name" id="middle_name" class="form-control" name="middle_name">
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="last_name"><span class="required">*</span>Last Name:</label>
              <div class="">
                <input type="text" readonly="" value="<?php echo $results[0]["last_name"] ?>" placeholder="Last Name" id="last_name" class="form-control" name="last_name"><span id="last_name_err" class="error"></span>
              </div>
            </div>
            
             
            
            <div class="form-group">
              <label class=" control-label" for="email_id"><span class="required">*</span>Email ID:</label>
              <div class="">
                <input type="text" readonly="" value="<?php echo $results[0]["email_address"] ?>" placeholder="Email ID" id="email_id" class="form-control" name="email_id"><span id="email_id_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="contact_no1"><span class="required">*</span>Home Number:</label>
              <div class="">
                <input type="text" readonly="" value="<?php echo $results[0]["contact_no1"] ?>" placeholder="Contact Number" id="contact_no1" class="form-control" name="contact_no1"><span id="contact_no1_err" class="error"></span>
              </div>
            </div>
            
            <div class="form-group">
              <label class=" control-label" for="contact_no2">Cell Number:</label>
              <div class="">
                <input type="text" readonly="" value="<?php echo $results[0]["contact_no2"] ?>" placeholder="Contact Number" id="contact_no2" class="form-control" name="contact_no2"><span id="contact_no2_err" class="error"></span>
              </div>
            </div>
            
           
            
            
            
            <div class="form-group">
              <label class=" control-label" for="address">Address:</label>
              <div class="">
                <textarea id="address" readonly="" name="address" rows="3" class="form-control"><?php echo $results[0]["address"] ?></textarea>
              </div>
            </div>
          </fieldset>
        </form>

      </div>
    </div>
  </div>
