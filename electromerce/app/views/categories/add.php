<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="w-full overflow-x-auto px-8"> -->
<div class="p-8 mx-auto max-w-3xl p-8">

  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="<?php echo URLROOT ?>/products/add">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="reference">
        name
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="reference" name="name" type="text" placeholder="Reference">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
      </label>
      <textarea
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="description" name="description" placeholder="Description"></textarea>
    </div>
    <div class="flex items-center justify-between">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
        Add Category
      </button>
    </div>
  </form>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>