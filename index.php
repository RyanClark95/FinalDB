<?php

require_once './config.php';
include './header.php';

if (!(isset($_GET['pagenum']))) {
  $pagenum = 1;
} else {
  $pagenum = $_GET['pagenum'];
}
$page_limit = ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? $_GET["show"] : 8;


try {
  $keyword = trim($_GET["keyword"]);
  if ($keyword <> "" ) {
    $sql = "SELECT * FROM tbl_contacts WHERE 1 AND "
            . " (first_name LIKE :keyword) ORDER BY first_name ";
    $stmt = $DB->prepare($sql);
    
    $stmt->bindValue(":keyword", $keyword."%");
    
  } else {
    $sql = "SELECT * FROM tbl_contacts WHERE 1 ORDER BY first_name ";
    $stmt = $DB->prepare($sql);
  }
  
  $stmt->execute();
  $total_count = count($stmt->fetchAll());

  $last = ceil($total_count / $page_limit);

  if ($pagenum < 1) {
    $pagenum = 1;
  } elseif ($pagenum > $last) {
    $pagenum = $last;
  }

  $lower_limit = ($pagenum - 1) * $page_limit;
  $lower_limit = ($lower_limit < 0) ? 0 : $lower_limit;


  $sql2 = $sql . " limit " . ($lower_limit) . " ,  " . ($page_limit) . " ";
  
  $stmt = $DB->prepare($sql2);
  
  if ($keyword <> "" ) {
    $stmt->bindValue(":keyword", $keyword."%");
   }
   
  $stmt->execute();
  $results = $stmt->fetchAll();
} catch (Exception $ex) {
  echo $ex->getMessage();
}

?>
<div class="row">
<?php if ($ERROR_MSG <> "") { ?>
    <div <?php echo $ERROR_TYPE ?>">
      <button data-dismiss="alert"  type="button">×</button>
      <p><?php echo $ERROR_MSG; ?></p>
    </div>
<?php } ?>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Address Book</h3>
    </div>
    <div class="panel-body">

      <div  style="padding-left: 0; padding-right: 0;" >
        <form action="index.php" method="get" >
        <div style="padding-left: 0;"  >
          <span >  
            <label  for="keyword" style="padding-right: 0;">
              <input type="text" value="<?php echo $_GET["keyword"]; ?>" placeholder="search by first name" id="" class="form-control" name="keyword" style="height: 41px;">
            </label>
            </span>
          <button >search</button>
        </div>
        </form>
        <div  ><a href="contacts.php"><button ><span ></span> Add New Contact</button></a></div>
      </div>

      <div c></div>
<?php if (count($results) > 0) { ?>
        <div >
          <table >
            <tbody><tr>
                
                <th>First Name</th>
                <th>Last Name</th>
                <th>Home Number </th>
                <th>Email </th>
				
                <th>Action </th>

              </tr>
  <?php foreach ($results as $res) { ?>
                <tr>
                
                  <td><?php echo $res["first_name"]; ?></td>
                  <td><?php echo $res["last_name"]; ?></td>
                  <td><?php echo $res["contact_no1"]; ?></td>
                  <td><?php echo $res["email_address"]; ?></td>
				  
                  <td>
                    <a href="view_contacts.php?cid=<?php echo $res["contact_id"]; ?>"><button class="btn btn-sm btn-info"><span class="glyphicon glyphicon-zoom-in"></span> View</button></a>&nbsp;
                    <a href="contacts.php?m=update&cid=<?php echo $res["contact_id"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>"><button class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</button></a>&nbsp;
                    <a href="process_form.php?mode=delete&cid=<?php echo $res["contact_id"]; ?>&keyword=<?php echo $_GET["keyword"]; ?>&pagenum=<?php echo $_GET["pagenum"]; ?>" onclick="return confirm('Are you sure?')"><button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Delete</button></a>&nbsp;
                  </td>
                </tr>
  <?php } ?>
            </tbody></table>
        </div>
        <div >
          <ul >
  <?php
  //Show page links
  for ($i = 1; $i <= $last; $i++) {
    if ($i == $pagenum) {
      ?>
                <li class="active"><a href="javascript:void(0);" ><?php echo $i ?></a></li>
                <?php
              } else {
                ?>
                <li><a href="index.php?pagenum=<?php echo $i; ?>&keyword=<?php echo $_GET["keyword"]; ?>" class="links"  onclick="displayRecords('<?php echo $page_limit; ?>', '<?php echo $i; ?>');" ><?php echo $i ?></a></li>
                <?php
              }
            }
            ?>
          </ul>
        </div>

          <?php } else { ?>
        <div class="well well-lg">No contacts found.</div>
<?php } ?>
    </div>
  </div>
</div>
     