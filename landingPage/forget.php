<div class="card w-full h-full">

  <div class="card-header text-center">
      <div class="flex-1 justify-center flex items-center">
            <i class="fas fa-lock text-8xl text-red-900"></i>
      </div>
      <h3 class="mt-2 text-center">Get Pin Code</h3>
  </div>

  <div class="card-body">
    <form id="emailForm">
        <div class="relative"> 
          <input type="email" id="forgetEmail" required name="email" class="h-10 pr-8 pl-5 rounded z-0 focus:shadow focus:outline-none text-center h-14 w-full border-2 border-gray-300 mt-5" placeholder="Email">
          <input type="text" id="passCodeForget" name="passCodeForget" class="hidden">
        <div class="absolute top-3 left-3 mt-5"> 
          <i class="far fa-envelope text-4xl"></i>
        </div>

        <input type="submit" id="forgetBtn" class="h-12 w-full mt-2 hover:border-red-600 hover:bg-red-100 hover:text-red-600 tracking-wide text-lg text-white bg-red-900 px-9 py-2 rounded-3xl border-red-900 border-2 mt-5" value="SEND EMAIL" />
    </form>
  </div>
 </div>
</div>