<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="p-8 mx-auto max-w-3xl p-8">
  <h1 class="text-3xl font-bold text-gray-800 mb-4">Contact Us</h1>
  <p class="text-gray-600 mb-8">
    If you have any questions or need assistance, please don't hesitate to
    contact us.
  </p>
  <form class="mb-8">
    <label class="block font-bold text-gray-800 mb-2">Name:</label>
    <input type="text" class="w-full p-2 rounded-md shadow-md mb-4" />
    <label class="block font-bold text-gray-800 mb-2">Email:</label>
    <input type="email" class="w-full p-2 rounded-md shadow-md mb-4" />
    <label class="block font-bold text-gray-800 mb-2">Message:</label>
    <textarea class="w-full p-2 rounded-md shadow-md mb-4"></textarea>
    <button class="px-4 py-2 rounded-full bg-green-500 text-white font-bold shadow-md">
      Send Message
    </button>
  </form>
  <div class="mb-8 flex justify-between">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Our Location</h2>
    <p class="text-gray-600 mb-2">123 Main Street</p>
    <p class="text-gray-600 mb-2">Anytown, USA 12345</p>
    <p class="text-gray-600 mb-2">(123) 456-7890</p>
  </div>
  <div class="flex justify-center gap-4">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Follow Us</h2>
    <div class="flex items-center mb-4">
      <a href="#" class="text-gray-600 mr-4">
        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
          <path
            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
        </svg>
      </a>
      <a href="#" class="text-gray-600 mr-4">
        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
          <path
            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
        </svg>
      </a>
      <a href="#" class="text-gray-600">
        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
          <path
            d="M17.53 7.47l-5-5c-.293-.293-.768-.293-1.06 0l-5 5c-.294.293-.294.768 0 1.06s.767.294 1.06 0l3.72-3.72V15c0 .414.336.75.75.75s.75-.336.75-.75V4.81l3.72 3.72c.146.147.338.22.53.22s.384-.072.53-.22c.293-.293.293-.767 0-1.06z" />
          <path
            d="M19.708 21.944H4.292C3.028 21.944 2 20.916 2 19.652V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 1.264-1.028 2.292-2.292 2.292z" />
        </svg>
      </a>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>