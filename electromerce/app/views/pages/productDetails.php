<?php require APPROOT . '/views/inc/header.php'; ?>

<?php
$product = $data['product'];
$catName = $data['catName']->name;
?>
<div class="flex flex-col lg:flex-row items-center mb-6">
  <div class="w-full lg:w-1/2 lg:pr-6">
    <img src="<?php echo URLROOT . '/public/' . $product->photo ?>" alt="Product Image" class="h-96 w-80 rounded-lg shadow-md m-auto" />
  </div>
  <div class="w-full lg:w-1/2 lg:pl-6 ml-8">
    <h1 class="text-3xl text-center font-bold"><?= $catName ?></h1>
    <h2 class="text-2xl font-bold text-gray-900 mb-2"><?= $product->title ?></h2>
    <p class="text-gray-600 mb-6"><?= $product->description ?>
    </p>
    <div class="mb-4">
      <span class="text-xl font-bold text-gray-900">$<?= $product->finalPrice ?></span>
      <span class="text-gray-600 ml-2 text-sm">(Free Shipping)</span>
    </div>
    <form action="<?php echo URLROOT . '/orders/add' ?>" method="post">
      <div class="mb-6">
        <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
        <input type="number" id="quantity" value="1" name="quantity" class="appearance-none border rounded w-20 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue" />
      </div>
      <input type="hidden" name="id" value="<?php echo $product->id ?>">
      <input type="submit" value="Add To Card" class="my-4 text-white bg-green-600 rounded-full p-1 px-4">
    </form>
    <!-- <a class="my-4 text-white bg-green-600 rounded-full p-1 px-4" href="<?php // echo URLROOT . '/orders/add' . $product->id 
                                                                              ?>">Add to card</a> -->
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>