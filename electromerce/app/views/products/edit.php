<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- <div class="w-full overflow-x-auto px-8"> -->
<div class="p-8 mx-auto max-w-3xl p-8">
  <!-- Our Products -->
  <?php $product = $data['products']; ?>

  <!-- Our Form -->
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="<?php echo URLROOT ?>/products/edit/" enctype="multipart/form-data">
    <!-- The Product ID -->
    <input type="text" class="hidden" value="<?php echo $product->id ?>" name='id'>

    <!-- The Product Category -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="categories">
        Category
      </label>
      <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="categories" name="idCat">

        <?php foreach ($data['categories'] as $category) : ?>
          <option value="<?php echo $category->id ?>" <?php echo $category->id === $data['products']->idCat ? 'selected' : '' ?>>
            <?php echo $category->name ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <!-- The Product Title -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
        Title
      </label>
      <input value="<?php echo empty($data['title_err']) ? $product->title : $data['title_err'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="Title">
    </div>

    <!-- The Product Reference -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="reference">Reference</label>
      <input value='<?php echo empty($data['reference_err']) ? $product->reference : $data['reference_err'] ?>' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="reference" name="reference" type="text" placeholder="Reference">
    </div>

    <!-- The Product Description -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
      <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" placeholder="Description">
<?php echo empty($data['description_err']) ? $product->description : $data['description_err'] ?></textarea>
    </div>

    <!-- The Product BarCode -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="barCode">
        Bar Code
      </label>
      <input value="<?php echo empty($data['barCode_err']) ? $product->barCode : $data['barCode_err'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="barCode" name="barCode" type="text" placeholder="Bar Code">
    </div>

    <!-- The Product Photo -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
        Photo
      </label>
      <input value="<?php echo $product->photo ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="photo" name="photo" type="file" placeholder="Photo">
      <input type="hidden" name="oldPhoto" value="<?= $product->photo ?>">
    </div>

    <!-- The Product Purchase Price -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="purchasePrice">
        Purchase Price
      </label>
      <input value="<?php echo empty($data['purchasePrice_err']) ? $product->purchasePrice : $data['purchasePrice_err'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="purchasePrice" name="purchasePrice" type="number" placeholder="Purchase Price">
    </div>

    <!-- The Product Final Price -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="finalPrice">
        Final Price
      </label>
      <input value="<?php echo empty($data['finalPrice_err']) ? $product->finalPrice : $data['finalPrice_err'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="finalPrice" name="finalPrice" type="number" placeholder="Final Price">
    </div>

    <!-- The Product Purchase Price -->
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="offerPrice">
        Offer Price
      </label>
      <input value="<?php echo empty($data['offerPrice_err']) ? $product->offerPrice : $data['offerPrice_err'] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="offerPrice" name="offerPrice" type="number" placeholder="Offer Price">
    </div>

    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
        Edit
      </button>
    </div>
  </form>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>