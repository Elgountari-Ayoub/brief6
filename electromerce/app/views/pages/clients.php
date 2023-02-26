<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- #################### -->
<!-- Products Management Admin -->
<div class="w-full overflow-x-auto px-8">
    <a href="<?php echo URLROOT ?>/products/add">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add
            Product</button>
    </a>
    <pre>
      <?php //var_dump($data) ?>
  </pre>
    <table class="table-auto w-full">
        <thead>
            <tr class="bg-gray-100">
                <!-- <th class="px-4 py-2">ID</th> -->
                <th class="px-4 py-2">Full Name</th>
                <th class="px-4 py-2">Phone Number</th>
                <th class="px-4 py-2">Adress</th>
                <th class="px-4 py-2">City</th>
                <th class="px-4 py-2">Email</th>
            </tr>
        </thead>
        <tbody></tbody>
        <?php foreach ($data['clients'] as $client) : ?>
            <tr>
                <td class="border px-4 py-2">
                    <?php echo $client->fullName ?>
                </td>
                <td class="border px-4 py-2">
                    <?php echo $client->phoneNumber ?>
                </td>
                <td class="border px-4 py-2">
                    <?php echo $client->adress ?>
                </td>
                <td class="border px-4 py-2">
                    <?php echo $client->city ?>
                </td>
                <td class="border px-4 py-2">
                    <?php echo $client->email ?>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>