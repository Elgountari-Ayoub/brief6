<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<!-- Products Management Admin -->
<div class="w-full overflow-x-auto px-8">
  <!-- <a href="<?php //echo URLROOT 
                ?>/products/add">
    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
      Product</button>
  </a> -->

  <table class="table-auto w-full text-center">
    <thead class="table-auto">
      <tr>
        <!-- <th class="px-2 py-2">ID</th> -->
        <th class="px-2 py-2">Client</th>
        <th class="px-2 py-2">Total Price</th>
        <!-- <th class="px-2 py-2">Reference</th> -->
        <th class="px-2 py-2">creationDate</th>
        <th class="px-2 py-2">dispatchDate</th>
        <th class="px-2 py-2">deliveryDate</th>
        <!-- <th class="px-2 py-2">Status</th> -->
        <th class="px-2 py-2">Action</th>
      </tr>
    </thead>
    <tbody></tbody>
    <?php // foreach ($data['orders'] as $order) : 
    ?>
    <?php for ($i = 0; $i < count($data['orders']); $i++) : ?>
      <tr>
        <td class="border px-2 py-2">
          <?php echo $data['clientNames'][$i] ?>
        </td>

        <td class="border px-2 py-2">
          <?php //echo $order->totalPrice 
          ?>
          $<?php echo $data['orders'][$i]->orderTotalPrice ?>

        </td>
        <td class="border px-2 py-2">
          <?php echo $data['orders'][$i]->creationDate == '0000-00-00' ||
            $data['orders'][$i]->creationDate == ''
            ? '-' : $data['orders'][$i]->creationDate ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $data['orders'][$i]->dispatchDate == '0000-00-00' ||
            $data['orders'][$i]->dispatchDate == ''
            ? '-' : $data['orders'][$i]->dispatchDate ?>
        </td>
        <td class="border px-2 py-2">
          <?php echo $data['orders'][$i]->deliveryDate == '0000-00-00' ||
            $data['orders'][$i]->deliveryDate == ''
            ? '-' : $data['orders'][$i]->deliveryDate ?>
        </td>
        <!-- <td class="border px-2 py-2">
          <?php //echo $data['orders'][$i]->reference 
          ?>
        </td> -->

        <?php if ($data['orders'][$i]->status == 'validByClient') { ?>
          <td class="border px-2 py-2 flex justify-around">
            <a href="<?php echo URLROOT . '/orders/updateOrderStatus?status=canceled&id=' . $data['orders'][$i]->id ?>" class="bg-red-500 text-white py-2 px-4 rounded-full my-4">
              Cancel
            </a>
            <a href="<?php echo URLROOT . '/orders/updateOrderStatus?status=validByAdmin&id=' . $data['orders'][$i]->id ?>" class="bg-green-500 text-white py-2 px-4 rounded-full my-4">
              Valid
            </a>
          <?php } elseif ($data['orders'][$i]->status == 'canceled') { ?>
          <td class="border px-2 py-2 flex justify-around font-bold bg-red-600 text-white">
            Canceled
          </td>
        <?php } elseif ($data['orders'][$i]->status == 'validByAdmin') { ?>
          <td class="border px-2 py-2 flex justify-around">
            <a href="<?php echo URLROOT . '/orders/updateOrderStatus?status=dispatched&id=' . $data['orders'][$i]->id ?>" class="bg-green-500 text-white py-2 px-4 rounded-full my-4">
              Dispatch
            </a>
          </td>
        <?php } elseif ($data['orders'][$i]->status == 'dispatched') { ?>
          <td class="border px-2 py-2 flex justify-around">
            <a href="<?php echo URLROOT . '/orders/updateOrderStatus?status=delivered&id=' . $data['orders'][$i]->id ?>" class="bg-green-500 text-white py-2 px-4 rounded-full my-4">
              Deliver
            </a>
          </td>
        <?php } elseif ($data['orders'][$i]->status == 'delivered') { ?>
          <td class="border px-2 py-2 flex justify-around font-bold bg-green-600 text-white">
            Delivered Successfully
          </td>
        <?php } ?>
      </tr>
    <?php endfor; ?>

    </tbody>
  </table>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>