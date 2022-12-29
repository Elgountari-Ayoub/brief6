<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="mx-4">
  <button id="dropdownDefault" data-dropdown-toggle="dropdown1"
    class="mx-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Categories
    <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
      xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
    </svg>
  </button>
  <!-- Dropdown menu -->
  <div id="dropdown1" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
    <ul class="mx-4 py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Computers</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Phones</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Office
          equipment</a>
      </li>
      <li>
        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Home
          appliances</a>
      </li>
      <li>
        <a href="#"
          class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Entertainment</a>
      </li>
    </ul>
  </div>
</div>


<!-- Products Page for Electronic Store Website -->
<div class="bg-white min-h-screen p-8">
  <div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Our Products</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
      <!-- Product 1 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 1"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 1</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$199.99</span>
          <a href="/products/product-1"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 2"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 2</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$299.99</span>
          <a href="/products/product-2"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 2"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 2</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$299.99</span>
          <a href="/products/product-2"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 2"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 2</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$299.99</span>
          <a href="/products/product-2"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 2"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 2</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$299.99</span>
          <a href="/products/product-2"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
      <!-- Product 2 -->
      <div class="bg-white rounded-lg shadow p-4">
        <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 2"
          class="w-full h-48 object-cover rounded-t-lg" />
        <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2">Product 2</h3>
        <p class="text-gray-700 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin
        </p>
        <div class="flex items-center justify-between">
          <span class="font-bold text-xl text-gray-800">$299.99</span>
          <a href="/products/product-2"
            class="px-4 py-2 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-500">View Product</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>