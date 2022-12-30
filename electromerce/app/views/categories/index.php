<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<div class="w-full overflow-x-auto px-8">
  <a href="<?php echo URLROOT ?>/products/add">
    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
      Category</button>
  </a>
  <table class="table-auto w-full">
    <thead>
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data['categories'] as $category) : ?>
        <tr>
          <td class="border px-4 py-2"><?php echo $category->id ?></td>
          <td class="border px-4 py-2"><?php echo $category->name ?></td>
          <td class="border px-4 py-2"><?php echo $category->description ?>
          </td>
          <td class="border px-4 py-2">
            <button class="bg-blue-500 text-white py-2 px-4 rounded-full">
              Edit
            </button>
            <button class="bg-red-500 text-white py-2 px-4 rounded-full">
              Delete
            </button>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>
<!-- #################### -->
<?php require APPROOT . '/views/inc/footer.php'; ?>