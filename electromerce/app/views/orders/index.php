<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
$products = $data['products'];
?>
<div class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-4 text-center">Cart</h1>
  <div class="flex flex-col items-center">
    <div class="w-full max-w-md mb-4">
      <div class="bg-white rounded-lg shadow p-6">
        <?php if (count($products) > 0) : ?>
          <?php foreach ($products as $product) : ?>
            <div class="flex items-center mb-4">
              <img class="w-24 h-24 rounded-full mr-4" src="<?php echo URLROOT . '/public/' . $product['product']->photo ?>" alt="Product Image" />
              <div class="flex-1">
                <h2 class="text-lg font-bold mb-2"><?= $product['product']->title ?></h2>
                <div class="text-gray-600 mb-2">$<?= $product['product']->finalPrice ?>.00</div>
              </div>
              <div class="flex items-center mb-4">
                <form class="mb-6" action="<?php echo URLROOT; ?>/orders/editOrderProductQuantity" method="post">
                  <input min="1" type="number" name="quantity" value="<?= $product['quantity'] ?? 1 ?>" class=" appearance-none border rounded w-16 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue" />
                  <input type="hidden" name="prodId" value="<?= $product['product']->id ?>">
                  <input type="hidden" name="orderId" value="<?= $data['orderId'] ?>">
                  <input type="hidden" name="unitPrice" value="<?= $product['product']->finalPrice ?>">
                  <input type="submit" value="Edit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800">
                </form>
                <form class="mb-6" action="<?php echo URLROOT; ?>/orders/deleteOrderProduct" method="post">
                  <input type="hidden" name="prodId" value="<?= $product['product']->id ?>">
                  <input type="hidden" name="orderId" value="<?= $data['orderId'] ?>">
                  <input type="submit" value="Delete" class="px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline active:bg-red-800">
                </form>
              </div>


            </div>
          <?php endforeach ?>
        <?php endif ?>
        <p></p>
        <div class="flex justify-between gap-8">
          <span class="px-4 py-2 font-bold text-white bg-green-500 rounded-t-lg mr-2 mb-2">Total = $ <?= $data['total'] ?></span>
          <a href="<?php echo URLROOT; ?>/pages/products" class="px-4 py-2 font-bold text-white bg-yellow-500 h-fit rounded-t-lg mr-2 mb-2"> Continue Shipping</a>
          <form class="mb-6" action="<?php echo URLROOT . '/orders/updateOrderStatus' ?>" method="get">
            <input type="hidden" name="id" value="<?= $data['orderId'] ?? -1?>">
            <input type="hidden" name="status" value="validByClient">
            <input type="submit" value="Valid" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>