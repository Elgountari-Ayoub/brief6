<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<!-- Products Management Admin -->
<div class="w-full overflow-x-auto px-8">
  <a href="<?php echo URLROOT ?>/products/add">
    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
      Product</button>
  </a>

  <table class="table-auto w-full">
    <thead class="table-auto">
      <tr>
        <!-- <th class="px-2 py-2">ID</th> -->
        <th class="px-2 py-2">Photo</th>
        <th class="px-2 py-2">Title</th>
        <th class="px-2 py-2">Reference</th>
        <th class="px-2 py-2 max-w-[10px]">Description</th>
        <th class="px-2 py-2">Bar Code</th>
        <th class="px-2 py-2">Purchase Price</th>
        <th class="px-2 py-2">Offer Price</th>
        <th class="px-2 py-2">Final Price</th>
        <th class="px-2 py-2">Category</th>
        <th class="px-2 py-2">Action</th>
      </tr>
    </thead>
    <tbody></tbody>
    <?php foreach ($data['products'] as $product) : ?>
      <tr>
        <!-- <td class="border px-2 py-2">??</td> -->
        <td class="border px-2 py-2">
          <img src="<?php echo URLROOT . '/public/' . $product->photo ?>" alt="Product 1" class="h-8 w-8" />
        </td>
        <td class="border px-2 py-2">
          <?php echo $product->title ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $product->reference ?>
        </td>

        <td class="border px-2 py-2">
          <?php echo $product->description ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $product->barCode ?>
        </td>
        <td class="border px-2 py-2">$
          <?php echo $product->purchasePrice ?>
        </td>
        <td class="border px-2 py-2">$
          <?php echo $product->offerPrice ?>
        </td>
        <td class="border px-2 py-2">$
          <?php echo $product->finalPrice ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $product->categorey ?>
        </td>
        <td class="border px-2 py-2">
          <a href="<?php echo URLROOT . '/products/edit?id=' . $product->id ?>" class="bg-blue-500 text-white py-2 px-2 rounded-full my-4">
            Edit
          </a>

          <?php if ($product->visibility == 1) : ?>
            <a href="<?php echo URLROOT . '/products/hide?id=' . $product->id ?>" class="bg-red-500 text-white py-2 px-2 rounded-full my-4">
              Hide
            </a>
          <?php endif ?>
          <?php if ($product->visibility == 0) : ?>
            <a href="<?php echo URLROOT . '/products/show?id=' . $product->id ?>" class="bg-green-500 text-white py-2 px-2 rounded-full my-4">
              Show
            </a>
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>