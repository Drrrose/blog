<?php require_once 'inc/header.php' ?>
<?php require_once 'inc/conn.php'; ?>

<?php 
if (!isset($_SESSION["user_id"])):
header("location:Login.php");
exit();
endif;
?>
 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5">edit Post</h3>
  </div>
  <?php 
    if (isset($_GET['id'])) {
      $id = htmlspecialchars($_GET['id']);
    }else{
      $_SESSION['errors'] = ["view not found "];
      header('location: index.php');
    }
  ?>
    <form method="POST" action="handle/update.php?id=<?php echo $id ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea class="form-control" id="body" name="body" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">image</label>
            <input type="file" class="form-control-file" id="image" name="image" >
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>


<?php require_once 'inc/footer.php' ?>