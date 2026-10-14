ima send u my index.php code and check it for me :<?php 
session_start();
require_once 'products.php';
if(!isset($_session['cart'])){
    $_session['cart'] = [];
}//adding and cheching if it's alr there in the cart 
if($_server['request_method']=='post'){
    $action=$_post['action']??'';
    $product_id=$_post['product_id']??'';
}
if($action=='add'&&$product_id){
    if(isset($products[$product_id])){
            $_session['cart'][$product_id]++;
        }else{
            $_session['cart'][$product_id]=1;
        }
header('location:index.php');
exit;
    }
//cart total
$cart_total = 0;
$cart_subtotal=0;
foreach($_session['cart'] as $product_id=>$quantity){
    if(isset($products[$product_id])){
        $product+=$products[$product_id];
        $cart_subtotal+=$product['price']*$quantity;
    }}?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherry Brew — Freshly Roasted Beans</title>
    <link rel="stylesheet" href="style.css">
    <!-- google fonts retro swash style ig-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@1,9..144,700;1,9..144,900&family=Space+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="navigate-container">
            <a href="index.php" class="logo">Cherry Brew</a>
            <button class="cart-button" onclick="togglecart()">
               <span id="cart-count"><?php echo array_sum($_session['cart']??[]);></span>
<img src="cart-icon.jpg" alt="Cart Icon">
</header>
<section class="hero">
<h1 class="hero-title">sweet beans,sweeter moment.</h1>
<p class="hero-subtitle">Discover the perfect cup of coffee with our freshly roasted beans, crafted to delight your senses.</p>
</section>
<main class="product-list">
<div class="product-grid">
<?php foreach($products as $product_id=>$product):?>
    <div class="product-cart">
        <img src="<?php echo htmlspecialchars($product['image']);?>" alt="<?php echo htmlspecialchars($product['name']);?>">
        <span class ="product-catgory"><?php echo htmlspecialchars($product['category']);?></span>
        <h2><?php echo htmlspecialchars($product['name']);?></h2>
        <p><?php echo htmlspecialchars($product['tagline']);?></p>
        <p>Price: $<?php echo number_format($product['price'],2);?></p>
        <form method="post" action="index.php">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
<div class="card-content">
    <small class="tagline"><?php echo htmlspecialchars($product['tagline']);?></small>
    <p class="roast"><?php echo htmlspecialchars($product['roast']);?></p>
</div>
<div class="notes-wrap"><?php foreach ($item['notes'] as $note): ?>
 <span class="note-pill"><?php echo htmlspecialchars($note); ?></span>
<?php endforeach; ?>
</div>
<div class="product-price">
    <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
     <form method="post" action="index.php">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div> </div> </div> 
<?php endforeach;?>
</div>
</main>
<div class="cart-ovelay" id="cart-overlay" onclick="togglecart()"></div>
<aside class="cart-sidebar" id="cart-sidebar">
    <div class="cart-header">
<h3>your coffee bag</h3>
<button class="close-cart" onclick ="togglecart()">&times;</button>
</div>
<div class="cart-items">
   <?php if (empty($_SESSION['cart'])): ?>
                <div class="cart-empty">
                    <p>Your bag is empty.</p>
                    <small>Grab a bag of fresh beans to get started!</small>
                </div>
            <?php else: ?>
    <ul class="cart-list">
        <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
            <?php if (isset($products[$id])): ?>
              <li class="cart-item">
<div>
 <strong><?php echo htmlspecialchars($products[$id]['name']); ?></strong>
  <small><?php echo $qty; ?> × $<?php echo number_format($products[$id]['price'], 2); ?></small>
    </div>
    <form method="POST" action="index.php">
     <input type="hidden" name="action" value="remove">
     <input type="hidden" name="id" value="<?php echo $id; ?>">
      <button type="submit" class="btn-remove">&times;</button>
    </form> </li> <?php endif; ?>  
    <?php endforeach; ?> </ul>
<div class="cart-summary">
    <div class="summary-line">
        <span>subtotal</span>
        <strong>$<?php echo number_format($cart_subtotal,2);?></strong>
            </div>
    <div class="cart-actions">
        <a href="checkout.php" class="btn-checkout">checkout</a>
        <form method="POST" action="index.php">
            <input type="hidden" name="action" value="clear">
            <button type="submit" class="btn-clear">clear bag</button>
        </form>
        <a href="index.php" class="btn-contain">continue shopping</a>
            </div> </div> <?endif;?> </div> </aside>  
            <script>
            function togglecart(){
                document.getelementbyid('cart-overlay').classlist.toggle('active');
                document.getelementbyid('cart-sidebar').classlist.toggle('open');}
</script>
            </body> </html>
          
