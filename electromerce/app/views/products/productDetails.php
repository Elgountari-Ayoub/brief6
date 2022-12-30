<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="flex flex-col lg:flex-row items-center mb-6">
  <div class="w-full lg:w-1/2 lg:pr-6">
    <img src="/docs/images/products/product-1.jpg" alt="Product Image" class="h-96 w-80 rounded-lg shadow-md m-auto" />
  </div>
  <div class="w-full lg:w-1/2 lg:pl-6 ml-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-2">Product Name</h2>
    <p class="text-gray-600 mb-6">
      Product description goes here. Lorem ipsum dolor sit amet, consectetur
      adipiscing elit. Suspendisse varius enim in eros elementum tristique.
    </p>
    <div class="mb-4">
      <span class="text-xl font-bold text-gray-900">$299.99</span>
      <span class="text-gray-600 ml-2 text-sm">(Free Shipping)</span>
    </div>
    <div class="mb-6">
      <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
      <input type="number" id="quantity" value="1"
        class="appearance-none border rounded w-20 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue" />
    </div>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
      Add to Cart
    </button>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>