<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="w-full overflow-x-auto px-8"> -->
<pre>
  <?php //var_dump($data['categories'])
  // die($data['idCat']);
  ?>
</pre>
<div class="p-8 mx-auto max-w-3xl p-8">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo URLROOT ?>/products/add" enctype="multipart/form-data">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="categories">
        Category
      </label>
      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categories" name="idCat">
        <option value="">Select a category</option>
        <?php foreach ($data['categories'] as $category) : ?>
          <option value="<?php echo $category->id ?>"
          <?php echo $category->id == $data['idCat'] ? 'selected' : '' ?>
          >
            <?php echo $category->name ?> 
          </option>
        <?php endforeach; ?>
      </select>
      <span class="text-red-600"><?php echo empty($data['categories_err']) ? '' : $data['categories_err'] ?></span>

    </div>

    <!-- Title -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
        Title
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title" value="<?php echo empty($data['title_err']) ? $data['title'] : '' ?>">

      <span class="text-red-600"><?php echo empty($data['title_err']) ? '' : $data['title_err'] ?></span>
    </div>

    <!-- Reference -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="reference">
        Reference
      </label>
      <input value="<?php echo empty($data['reference_err']) ? $data['reference'] : '' ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="reference" name="reference" type="text" placeholder="Reference">
      <span class="text-red-600"><?php echo empty($data['reference_err']) ? '' : $data['reference_err'] ?></span>

    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Description
      </label>
      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Description">
<?php echo empty($data['description_err']) ? $data['description'] : '' ?>
      </textarea>
      <span class="text-red-600"><?php echo empty($data['description_err']) ? '' : $data['description_err'] ?></span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="barCode">
        Bar Code
      </label>
      <input value="<?php echo empty($data['barCode_err']) ? $data['barCode'] : '' ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="barCode" name="barCode" type="text" placeholder="Bar Code">
      <span class="text-red-600"><?php echo empty($data['barCode_err']) ? '' : $data['barCode_err'] ?></span>
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
        Photo
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="photo" name="photo" type="file" placeholder="Photo">
      <span class="text-red-600"><?php echo empty($data['photo']) ? '' : $data['photo_err'] ?></span>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="purchasePrice">
        Purchase Price
      </label>
      <input value="<?php echo empty($data['purchasePrice_err']) ? $data['purchasePrice'] : '' ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="purchasePrice" name="purchasePrice" type="number" placeholder="Purchase Price">
      <span class="text-red-600"><?php echo empty($data['purchasePrice_err']) ? '' : $data['purchasePrice_err'] ?></span>

    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="finalPrice">
        Final Price
      </label>
      <input value="<?php echo empty($data['finalPrice_err']) ? $data['finalPrice'] : '' ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="finalPrice" name="finalPrice" type="number" placeholder="Final Price">
      <span class="text-red-600"><?php echo empty($data['finalPrice_err']) ? '' : $data['finalPrice_err'] ?></span>

    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="offerPrice">
        Offer Price
      </label>
      <input value="<?php echo empty($data['offerPrice_err']) ? $data['offerPrice'] : '' ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="offerPrice" name="offerPrice" type="number" placeholder="Offer Price">
      <span class="text-red-600"><?php echo empty($data['offerPrice_err']) ? '' : $data['offerPrice_err'] ?></span>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Add Product
      </button>
    </div>
  </form>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>