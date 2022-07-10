<?php
if (isset($_POST["submit"])) {
  // Make sure it's an .xml file
  if (pathinfo($_FILES["flightPlan"]["name"], PATHINFO_EXTENSION) == "xml") {
    // Save the file in the uploads folder with the same name
    move_uploaded_file($_FILES["flightPlan"]["tmp_name"], "uploads/" . $_FILES["flightPlan"]["name"]);
    
    // Set a cookie for the user called 'flightPlan' with the filename as the value
    setcookie("flightPlan", $_FILES["flightPlan"]["name"], time() + (86400 * 30), "/");
    // Redirect to /plan
    header("Location: /plan?plan_name=" . $_FILES["flightPlan"]["name"]);
  } else {
    // Set error
    $error = 'Please upload a valid .xml flight plan from SimBrief.';
  }
}
?>

<main class='container mt-5'>
  <h3>Upload your SimBrief flight plan</h3>
  <a class='btn btn-secondary mt-2' href="https://www.simbrief.com" target="_blank" rel="noreferrer">Click here to visit SimBrief.</a>

  <form action="/" method="post" enctype="multipart/form-data" class='mt-5'>
    <input type="file" name="flightPlan" id="flightPlan" accept=".xml" required/>
    <input type="submit" class="btn btn-primary" name="submit" value="Upload"/>
  </form>

  <?php if (isset($error)) { ?>
    <div class="alert alert-danger mt-5" role="alert">
      <?php echo $error; ?>
    </div>
  <?php } ?>
</main>
