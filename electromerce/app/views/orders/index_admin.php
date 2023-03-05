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
        <th class="px-2 py-2">Client</th>
        <th class="px-2 py-2">Reference</th>
        <th class="px-2 py-2">Total Price</th>
        <th class="px-2 py-2">Status</th>
        <th class="px-2 py-2">Action</th>
      </tr>
    </thead>
    <tbody></tbody>
    <?php foreach ($data['orders'] as $order) : ?>
      <tr>
        <td class="border px-2 py-2">
          <?php echo $data['clientName'] ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $order->reference ?>
        </td>

        <td class="border px-2 py-2">
          <?php echo $order->totalPrice ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $order->status ?>
        </td>
        <td class="border px-2 py-2">
          <a href="<?php echo URLROOT . '/products/edit?id=' . $order->id ?>" class="bg-blue-500 text-white py-2 px-2 rounded-full my-4">
            Valid
          </a>

          <?php if ($order->visibility == 1) : ?>
            <a href="<?php echo URLROOT . '/products/hide?id=' . $order->id ?>" class="bg-red-500 text-white py-2 px-2 rounded-full my-4">
              Hide
            </a>
          <?php endif ?>
          <?php if ($order->visibility == 0) : ?>
            <a href="<?php echo URLROOT . '/products/show?id=' . $order->id ?>" class="bg-green-500 text-white py-2 px-2 rounded-full my-4">
              Valid
            </a>
          <?php endif ?>
        </td>
      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>