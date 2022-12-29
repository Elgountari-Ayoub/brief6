<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<div class="w-full overflow-x-auto px-8">
  <table class="table-auto w-full">
    <thead>
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Reference</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Bar Code</th>
        <th class="px-4 py-2">Photo</th>
        <th class="px-4 py-2">Purchase Price</th>
        <th class="px-4 py-2">Final Price</th>
        <th class="px-4 py-2">Offer Price</th>
        <th class="px-4 py-2">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="border px-4 py-2">1</td>
        <td class="border px-4 py-2">123456</td>
        <td class="border px-4 py-2">Product 1</td>
        <td class="border px-4 py-2">9876543210</td>
        <td class="border px-4 py-2">
          <img src="<?php echo URLROOT ?>/public/docs/images/products/product-1.jpg" alt="Product 1" class="h-8 w-8" />
        </td>
        <td class="border px-4 py-2">$10.00</td>
        <td class="border px-4 py-2">$15.00</td>
        <td class="border px-4 py-2">$12.50</td>
        <td class="border px-4 py-2">
          <button class="bg-blue-500 text-white py-2 px-4 rounded-full">
            Edit
          </button>
          <button class="bg-red-500 text-white py-2 px-4 rounded-full">
            Delete
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>