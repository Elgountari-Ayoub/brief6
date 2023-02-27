<?php require APPROOT . '/views/inc/header.php'; ?>
<?php 
$products = $data['products']
?>
<div class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-4 text-center">Cart</h1>
  <div class="flex flex-col items-center">
    <div class="w-full max-w-md mb-4">
      <div class="bg-white rounded-lg shadow p-6">
        <?php foreach ($products as $product) :?>
        <div class="flex items-center mb-4">
          <img class="w-24 h-24 rounded-full mr-4" src="<?php echo URLROOT . '/public/' . $product['product']->photo ?>"
            alt="Product Image" />
          <div class="flex-1">
            <h2 class="text-lg font-bold mb-2"><?=$product['product']->title?></h2>
            <div class="text-gray-600 mb-2">$<?=$product['product']->finalPrice?>.00</div>
            <div class="mb-6">
              <label for="quantity" class="text-gray-700 text-sm font-bold mb-2">Quantity:</label>
              <input min="1" type="number" id="quantity" value="<?=$product['quantity'] ?? 1?>"
                class="appearance-none border rounded w-16 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue" />
            </div>
          </div>
          <div>
            <form action="" method="post">
            
              <input type="hidden" name="clientId" value="<?=$product['clientId']?>">
              <input type="hidden" name="orderId" value="<?=$product['orderId']?>">
              <input type="submit" value="Edit">
            </form>
          <button
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800">
            Edit
          </button>
          <button
            class="px-4 py-2 font-bold text-white bg-red-500 rounded-full hover:bg-red-700 focus:outline-none focus:shadow-outline active:bg-blue-800 mr-2 mb-2">
            Delete
          </button>

          </div>
        </div>
        <?php endforeach?>



        <div class="flex justify-between">
          <span class="px-4 py-2 font-bold text-white bg-green-500 rounded-t-lg mr-2 mb-2">Total = $ <?=$data['total']?></span>

          <button
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800">
            BUY
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>