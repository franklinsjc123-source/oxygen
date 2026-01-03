 <?php
$baseUrl = url('/');
 foreach ($records as $row) {  ?>
     <div class="product product-cart">
         <div class="product-detail"> <a href="#" class="product-name"><?= $row['name'] ?></a>
             <div class="price-box"> <span class="product-quantity"><?= $row['quantity'] ?></span> <span class="product-price">Rs.<?= $row['price'] ?></span> </div>
         </div>
         <figure class="product-media">
             <a href="#"> <img src="<?= $baseUrl ?>/assets/images/products/detail/<?= $row['attributes']['image'] ?>" alt="product" height="84" width="94" /> </a>
         </figure>
         <button class="btn btn-link btn-close" aria-label="button" onclick="removeCart('<?= $row['id'] ?>')"> <i class="fas fa-times"></i> </button>
     </div>
 <?php } ?>