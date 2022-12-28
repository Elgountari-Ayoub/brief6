<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mx-auto max-w-3xl p-8">
  <h1 class="text-2xl font-bold mb-4">Create an account</h1>
  <form action="<?php URLROOT . 'client/register' ?>" method="POST">
    <div class="mb-4">
      <label class="block font-bold mb-2 text-gray-700" for="full-name">Full Name</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="full-name" type="text" placeholder="John Doe" name="fullName" />
    </div>
    <div class="mb-4">
      <label class="block font-bold mb-2 text-gray-700" for="phoneNumber">Phone Number</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="phone-number" type="tel" placeholder="(123) 456-7890" name="phoneNumber" />
    </div>
    <div class="mb-4">
      <label class="block font-bold mb-2 text-gray-700" for="adress">Address</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="address" type="text" placeholder="123 Main St" name="adress" />
    </div>
    <div class="mb-4">
      <label class="block font-bold mb-2 text-gray-700" for="city">City</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="city" type="text" placeholder="San Francisco" name="city" />
    </div>
    <div class="mb-4">
      <label class="block font-bold mb-2 text-gray-700" for="email">Email</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="john.doe@example.com" name="email" />
    </div>
    <div class="mb-6">
      <label class="block font-bold mb-2 text-gray-700" for="password">Password</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********" name="password" />
    </div>
    <div class="mb-6">
      <label class="block font-bold mb-2 text-gray-700" for="password-confiramtion">Password Confirmation</label>
      <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********" name="passwordConfirmation" />
    </div>
    <div class="flex items-center justify-between">
      <button class="px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline active:bg-blue-800" type="submit">
        Sign Up
      </button>
      <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
        Forgot Password?
      </a>
    </div>
  </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>