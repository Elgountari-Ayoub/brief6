<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<div class="w-full overflow-x-auto px-8">
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
      <tr>
        <td class="border px-4 py-2">1</td>
        <td class="border px-4 py-2">Computer</td>
        <td class="border px-4 py-2">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere
          ipsum id beatae sint soluta?
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
    </tbody>
  </table>
</div>
<!-- #################### -->
<?php require APPROOT . '/views/inc/footer.php'; ?>