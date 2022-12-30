<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="w-full overflow-x-auto px-8"> -->
<div class="p-8 mx-auto max-w-3xl p-8">

  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="<?php echo URLROOT ?>/products/add">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="categories">
        Category
        <!-- <pre> -->
        <?php //var_dump($data['categories']) 
        ?>
        <!-- </pre> -->
      </label>
      <select
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="categories" name="idCat">
        <?php foreach ($data['categories'] as $category) : ?>
        <option value="">Select a category</option>
        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="reference">
        Reference
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="reference" name="reference" type="text" placeholder="Reference">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
      </label>
      <textarea
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="description" name="description" placeholder="Description"></textarea>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="barCode">
        Bar Code
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="barCode" name="barCode" type="text" placeholder="Bar Code">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
        Photo
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="photo" name="photo" type="file" placeholder="Photo">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="purchasePrice">
        Purchase Price
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="purchasePrice" name="purchasePrice" type="number" placeholder="Purchase Price">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="finalPrice">
        Final Price
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="finalPrice" name="finalPrice" type="number" placeholder="Final Price">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="offerPrice">
        Offer Price
      </label>
      <input
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        id="offerPrice" name="offerPrice" type="number" placeholder="Offer Price">
    </div>
    <div class="flex items-center justify-between">
      <button
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        type="submit">
        Add Product
      </button>
    </div>
  </form>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>