<?php require APPROOT . '/views/inc/header.php'; ?>
<?php $products = $data['products']; ?>
<div class="container mx-auto p-8">
  <div class="flex flex-wrap -mx-4">
    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0 relative flex flex-wrap flex-col justify-between">
      <h2 class="text-xl font-bold mb-4">Order details</h2>
      <table class="table-auto w-full">
        <thead>
          <tr>
            <th class="px-4 py-2">name</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2 w-1/10">Quantity</th>
            <th class="px-4 py-2">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($products) > 0) : ?>
            <?php foreach ($products as $product) : ?>
              <tr class="text-center">
                <td class="border px-4 py-2"> <?= $product['product']->title ?></td>
                <td class="border px-4 py-2">$<?= $product['product']->finalPrice ?></td>
                <td class="border px-4 py-2"><?= $product['quantity'] ?></td>
                <td class="border px-4 py-2">$<?= $product['total'] ?></td>
              </tr>
            <?php endforeach ?>
          <?php endif ?>
        </tbody>
      </table>
      <div class="bg-gray-100 rounded-lg p-6 pt-0 mb-auto my-4 ">
        <hr class="my-3">
        <div class="flex justify-between font-bold mb-2">
          <span>Total:</span>
          <span>$<?= $data['total'] ?></span>
        </div>
      </div>
    </div>
    <div class="w-full md:w-1/2 px-4">
      <h2 class="text-xl font-bold mb-4">Customer information</h2>
      <form class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first-name">
              First name
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="first-name" type="text" placeholder="John">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">
              Last name
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" placeholder="Doe">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
              Email address
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="johndoe@example.com">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-boldmb-2" for="phone">
              Phone number
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" type="tel" placeholder="(123) 456-7890">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
              Address
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="address" type="text" placeholder="123 Main St">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
              City
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="city" type="text" placeholder="New York">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip">
              Zip code
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="zip" type="text" placeholder="10001">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="card-number">
              Card number
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="card-number" type="text" placeholder="**** **** **** ****">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="expiration">
              Expiration
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="expiration" type="text" placeholder="MM/YY">
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cvv">
              CVV
            </label><input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cvv" type="text" placeholder="***">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
          <!-- <div class="w-full px-3"> -->
          <a href="<?php echo URLROOT . '/orders/updateOrderStatus?status=validByClient&id=' . $data['orderId'] ?>" class="bg-green-500 text-white py-2 px-4 rounded-full my-4">
            Validate
          </a>
          <!-- </div> -->
        </div>
      </form>
    </div>
    <!-- <div class="w-full md:w-1/2 p-4">
      
    </div> -->
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>