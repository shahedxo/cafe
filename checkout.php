<?php 
session_start();
require_once 'products.php';
$cart=$_session['cart']??[];
$is_placed=isset($_session['order_placed'])&&$_session['order_placed'];
$total=0;
foreach($cart as $id=>$quantity){
    if(isset($products[$id])){
        $total+=$products[$id]['price']*$quantity;
    }
}
if($_SERVER['request_method']=='post' && !empty($cart)){
$name=htmlspecialchars($_post['fullname']??'');
$address=htmlspecialchars($_post['address']??'');
$order_items=$cart;
$_session['cart']=[];
$is-placed=true;
} ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Cherry Brew</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@1,9..144,700;1,9..144,900&family=Space+Grotesk:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="checkout-page">
    <div class="checkout-container">
        <a href="index.php" class="back-button">&larr;back to shop</a>
        <?php if ($is_plced):?>
            <div class="receipt">
                <h2 class="brand-logo" style="text-align:center;margin-bottom:0.5rem;">thank you for your order, <?php echo htmlspecialchars($name);?>!</h2>
                <p style="text-align:center; font-size:0.9rem;margin-bottom:1.5rem">your order has been placed and will be shipped to:#cb-<?echo rand(1000,9999);?></p>
                <p><?php echo nl2br(htmlspecialchars($address));?></p>
                <h3>order summary:</h3>
                <ul class="order-items">
                    <?php foreach($order_items as $id=>$quantity):?>
                        <?php if(isset($products[$id])):?>
                            <li><?php echo htmlspecialchars($products[$id]['name']);?> x <?php echo $quantity;?> - $<?php echo number_format($products[$id]['price']*$quantity,2);?></li>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
                <p class="total">total: $<?php echo number_format($total,2);?></p>
                <p><strong>shipping address:</strong><?php echo nl2br(htmlspecialchars($address));?></p>
                <p><strong>roasted for :</strong> <?php echo htmlspecialchars($name);?></p>
                <hr class="receipt-divider">
                <ul class="receipt-items">
                    <?php foreach($order_items as $id=>$quantity):?>
                        <li>
                            <span><?php echo $quantity;?> x <?php echo htmlspecialchars($products[$id]['name']);?></span>
                            <span>$<?php echo number_format($products[$id]['price']*$quantity,2);?></span>
                    </li>
                    <?php endforeach;?>
                    </ul>
                    <hr class="receipt-divider">
                    <div class="receipt-total">
                        <strong>total paid:</strong>
                        <strong>$<?php echo number_format($total,2);?></strong>
                    </div>
                    <div style="text-align:center;margin-top:1.5rem;">
                        <a href="index.php" class="checkout-button" style="display:inline-block;">back to home</a>
                    </div>
                    <?php elseif(empty($cart)):?>
                        <div class="card" style="text-align:center;">
                            <h2>ur bag is empty :( </h2>
                            <p> cmon u gotta get some coffee, something to keep u going.</p><br>
                            <a href="index.php" class="checkout-button" style="display:inline-block;">back to shop</a>
                    </div>
                    <?php else :?>
                        <h2>checkout details</h2>
                        <form method="post" action="checkout.php" class="form">
                        <label>full name</label>
                        <input type="text" name="fullname" placeholder="taylor swift" required>
                        <label> email </label>
                        <input type="email" name="email" placeholder="taylor@example.com" required>
                        <label>shipping address</label>
                        <textarea name="address" placeholder="123 cherry street,apt4b ,jo" required></textarea>
                        div class="order-summary-box">
                    Order Total: <strong>$<?php echo number_format($total, 2); ?></strong>
                </div>
                <button type="submit" class="btn-checkout" style="width: 100%;">Place Order</button>
            </form>
        <?php endif; ?> </div>
  
</body>
</html>
