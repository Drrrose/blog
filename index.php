
<?php require_once 'inc/conn.php'; ?>
<?php require_once 'inc/header.php' ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            <!-- <h4>Best Offer</h4> -->
            <!-- <h2>New Arrivals On Sale</h2> -->
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <!-- <h4>Flash Deals</h4> -->
            <!-- <h2>Get your best products</h2> -->
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <!-- <h4>Last Minute</h4> -->
            <!-- <h2>Grab last minute deals</h2> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
          <?php require_once 'inc/sucess.php'; ?>
          <?php require_once 'inc/errors.php'; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Posts</h2>
            </div>
          </div>
            <?php
            $query = "select id , title , SUBSTRING(body,1,53) as body , image , created_at from posts";
            $runQ = mysqli_query($conn,$query);
            if (mysqli_num_rows($runQ)>0) {
              $posts = mysqli_fetch_all($runQ,MYSQLI_ASSOC);
            }else {
              echo "No posts found";
            }
            ?>
            
     <?php 
                if (!empty($posts)):
                foreach ($posts as $post): ?>
              <div class="col-md-4">
                  <div class="product-item">
                      <a href="#"><img src="uploads/<?php echo($post['image']); ?>" alt=""></a>
                      <div class="down-content">
                          <a href="#"><h4><?php echo ($post['title']); ?></h4></a>
                          <h6> <br><?php echo ($post['created_at']); ?></h6>
                          <p><?php echo ($post['body']. "..."); ?></p>
                          <div class="d-flex justify-content-end">
                              <a href="viewPost.php?id=<?php echo $post['id']; ?>" class="btn btn-info">View</a>
                          </div>
                      </div>
                  </div>
              </div>
                <?php endforeach;
            else: 
                echo "No data found";
            endif;
            ?>

        </div>
      </div>
    </div>

 
    
<?php require_once 'inc/footer.php' ?>
