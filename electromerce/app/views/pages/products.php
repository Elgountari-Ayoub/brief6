<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="flex justify-around">
  <div class="mx-4">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown2" class="mx-8 text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
      Price
      <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown2" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
      <ul class="mx-4 py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
        <li>
          <a href="<?php echo URLROOT . '/pages/products/' ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Time Added</a>
        </li>
        <li>
          <a href="<?php echo URLROOT . '/pages/products/-1/expensive' ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">expensive to the cheapest</a>
        </li>
        <li>
          <a href="<?php echo URLROOT . '/pages/products/-1/cheapest' ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">cheapest to the expensive</a>
        </li>
      </ul>
    </div>
  </div>
  <div class="mx-4">
    <button id="dropdownDefault" data-dropdown-toggle="dropdown1" class="mx-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
      Categories
      <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <!-- Dropdown menu -->
    <div id="dropdown1" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
      <ul class="mx-4 py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
        <li>
          <a href="<?php echo URLROOT . '/pages/products/' ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">All</a>
        </li>
        <?php foreach ($data['categories'] as $categories) : ?>
          <li>
            <a href="<?php echo URLROOT . '/pages/products/' . $categories->id ?>" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><?= $categories->name ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</div>

<!-- Products Page for Electronic Store Website -->
<div class="bg-white min-h-screen p-8">
  <div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Our Products</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
      <!-- Product(s) -->
      <?php foreach ($data['products'] as $product) : ?>
        <div class="bg-white rounded-lg shadow p-4">
          <img src="<?php echo URLROOT . '/public/' . $product->photo ?>" alt="Product 1" class="w-full h-48 object-cover rounded-t-lg" />
          <h3 class="text-xl font-bold text-gray-800 mt-4 mb-2"><?= $product->title ?></h3>
          <p class="text-gray-700 mb-4">
            <?= $product->description ?>
          </p>
          <div class="flex items-center justify-between">
            <span class="font-bold text-xl text-gray-800">$<?= $product->finalPrice ?></span>
            <!-- <a class="my-4 text-white bg-green-600 rounded-full p-1 px-4" href="<?php //echo URLROOT . '/orders/add/' . $product->id 
                                                                                      ?>">Add to card</a> -->
            <form action="<?php echo URLROOT . '/orders/add' ?>" method="post">
              <input type="hidden" name="id" value="<?php echo $product->id ?>">
              <input type="submit" value="Add To Card" class="my-4 text-white bg-green-600 rounded-full p-1 px-4 cursor-pointer">
            </form>
          </div>
          <a href="<?php echo URLROOT . '/pages/productDetails/' . $product->id ?>" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-full ">
            View Product
          </a>
        </div>
      <?php endforeach ?>

    </div>
    <div class="text-center">
      <!-- Add pagination links -->
      <?php for ($i = 1; $i <= ceil($data['total_products']->total_products / $data['perPage']); $i++) : ?>
        <?php if ($data['page'] == $i) { ?>
          <a href="?page=<?php echo $i; ?>" class="text-red-600 bold m-2" ><?php echo $i; ?></a>
        <?php }else{ ?>
          <a href="?page=<?php echo $i; ?>"class="m-2"><?php echo $i; ?></a>
          <?php } ?>
      <?php endfor; ?>
    </div>
  </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>