
<nav class="hidden navbar navbar-expand-lg navbar-dark bg-dark mb-3 ">
  <div class="container">
    <a class="navbar-brand" href="#"><?php echo SITENAME; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo URLROOT; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">About</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['user_id'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout"><i class="fa fa-sign-out"
              aria-hidden="true"></i> Logout</a>
        </li>
        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- 
  
 -->

<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
    <a href="#" class="flex items-center">
      <img src="<?php echo URLROOT ?>/public/docs/images/ElectroMerce.svg" class="h-6 mr-3 sm:h-9"
        alt="ElectroMerce Logo" />
    </a>
    <div class="flex items-center justify-between gap-4">
      <div class="z-40 group/item">
        <button id="dropdownDefault" data-dropdown-toggle="dropdown"
          class="text-white focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          type="button">
          <i class="fa-solid fa-cart-shopping text-blue-800 text-xl pointer-events-auto"></i>
        </button>
        <!-- Dropdown menu -->
        <!-- <div id="dropdown"
          class="group/item group/edit invisible group-hover/item:visible z-10 w-64 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
          <div class="container mx-auto py-8 px-4">
            <div class="flex flex-col items-center h-64 overflow-scroll overflow-x-hidden">
              <div class="w-full mb-4"> -->
                <!-- <div class="bg-white rounded-lg shadow">
                  <div class="flex items-center mb-4 w-full">
                    <img class="w-16 h-16 rounded-full mr-8"
                      src="<?php //echo URLROOT 
                            ?>/public/docs/images/products/product-1.jpg" alt="Product Image" />
                    <div class="flex-1">
                      <h2 class="text-sm font-bold mb-1">Product Name</h2>
                      <div class="text-gray-600 text-xs mb-1">$50.00</div>
                      <div class="text-gray-600 text-xs">Quantity: 2</div>
                    </div>
                  </div>
                  <div class="flex items-center mb-4">
                    <img class="w-16 h-16 rounded-full mr-4"
                      src="<?php // echo URLROOT 
                            ?>/public/docs/images/products/product-1.jpg" alt="Product Image" />
                    <div class="flex-1">
                      <h2 class="text-sm font-bold mb-1">Product Name</h2>
                      <div class="text-gray-600 text-xs mb-1">$50.00</div>
                      <div class="text-gray-600 text-xs">Quantity: 2</div>
                    </div>
                  </div>
                  <div class="flex items-center mb-4">
                    <img class="w-16 h-16 rounded-full mr-4"
                      src="<?php // echo URLROOT 
                            ?>/public/docs/images/products/product-1.jpg" alt="Product Image" />
                    <div class="flex-1">
                      <h2 class="text-sm font-bold mb-1">Product Name</h2>
                      <div class="text-gray-600 text-xs mb-1">$50.00</div>
                      <div class="text-gray-600 text-xs">Quantity: 2</div>
                    </div>
                  </div>
                  <div class="flex justify-center">
                    <button
                      class="px-8 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800 mr-2 mb-2">
                      <a href="cart.html"> Buy </a>
                    </button>
                  </div>
                </div>
              </div> -->
              <!-- </div>
            </div>
          </div>
        </div> -->
      </div>

      <?php if (isset($_SESSION['user_id'])) { ?>
        Welcome<span class="font-bold "> <?php echo $_SESSION['user_name']?></span>😊
      <a href="<?php echo URLROOT ?>/users/logout"
        class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline bg-red-500 text-white py-2 px-2 rounded-full my-4">log out</a>
      <?php } else { ?>
      <a href="<?php echo URLROOT ?>/users/login"
        class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">Log in</a>
      <a href="<?php echo URLROOT ?>/users/register"
        class="text-sm font-medium dark:text-blue-500 hover:underline bg-blue-800 text-white p-1.5 rounded">Sing
        up</a>
      <?php } ?>

    </div>
  </div>
</nav>


<nav class="flex flex-wrap overflow-x-auto flex-column bg-gray-50 dark:bg-gray-700">
  <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
    <div class="flex items-center">
      <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
        <li>
        <a href="<?php echo URLROOT ?>/pages/index"
          class="text-gray-900 dark:text-white hover:underline hover:text-blue-800" aria-current="page">Home</a>
        </li>
        <li>
          <a href="<?php echo URLROOT ?>/pages/products"
          class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">Products</a>
        </li>
        <li>
          <a href="<?php echo URLROOT ?>/orders/index"
            class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">Orders</a>
        </li>
        <!-- <li>
        <a href="<?php //echo URLROOT ?>/pages/about"
          class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">About</a>
        </li>
        <li>
        <a href="<?php //echo URLROOT ?>/pages/contact"
          class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">Contact
          Us</a>
        </li> -->
        <li>
          <a href="<?php echo URLROOT ?>/products/index"
            class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">ProdsManag</a>
        </li>
        <li>
          <a href="<?php echo URLROOT ?>/categories/index"
            class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">Categories</a>
        </li>
        <li>
          <a href="<?php echo URLROOT ?>/orders/index"
            class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">OrdersManag</a>
        </li>
        <li>
          <a href="<?php echo URLROOT ?>/pages/clients"
            class="text-gray-900 dark:text-white hover:underline hover:text-blue-800">Clients</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

</header>