<DOCTYPE html!>
<html>    
  <head>
    <title>Search Request</title>

    <!-- taiwind.css -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- /taiwind.css -->
  </head>
  <body class="bg-blue-100"> 
    <!-- MAIN SEARCH -->
    <!-- Navbar -->

    <!-- /Navbar -->

    <div class="pt-20 flex flex-cols-2 h-1/12">
      <!-- Sidebar Left-->
      <div class="bg-gray-300 w-1/6">
        <!-- Button Manage Account -->
        <div class="flex pb-6">
            <div class="grid w-full"><a href="#" role="button" class="btn bg-gray-400 text-black hover:text-white h-14">Manage Account</a></div>
        </div>

        <!-- Button Review Repair Service Quatation -->
        <div class="flex pb-6">
          <div class="grid w-ful"><a href="#" role="button" class="btn bg-gray-400 text-black hover:text-white h-14">Review Repair Service Quatation</a></div>
        </div>

        <!-- Button Repairing Service -->
        <div class="flex pb-6">
            <div class="grid w-full"><a href="#" role="button" class="btn bg-gray-400 text-black hover:text-white h-14">Repairing Service</a></div>
        </div>
      </div>
      <!-- /Sidebar Left -->
      <!-- Main -->
      <div class="w-5/6 p-5">
        <!-- Title: Search Request -->
        <div class="flex justify-center pb-5">
          <p class="text-2xl font-mono font-medium">Search Request</p>
        </div>
        <!-- /Title: Search Request -->

        <!-- Search Fuctionality -->
        <div class="flex justify-centers">
        <div class="grid w-11/12">
          <div class="form-control">
            <div class="relative">
              <input type="text" placeholder="Insert Request ID" class="items-center input input-primary text-center text-black rounded-lg w-full bg-gray-50"> 
              <button class="absolute right-0 top-0 p-2 rounded-l-none btn btn-black">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>
          </div>
          </div>
        </div>   
        <!-- /Search Fuctionality -->

        <!-- Total of New Request -->
        <div class="flex justify-end pr-11 pt-8 pb-2">
          <div class="badge">Total of New Request: 123456789010</div> 
        </div>
        <!-- /Total of New Request -->

        <!-- Display New Request -->
        <div class="flex justify-center">
          <div class="grid grid-cols-2 w-11/12 bg-gray-300 gap-10 p-5 rounded-3xl">
            <center><!-- Card 1 -->
            <div class="card-body rounded-box justify-center bg-white w-4/5">
              <h1 class="card-title bg-gray-400 text-center font-mono rounded-sm p-2 text-white">#Request_ID</h1>
              <h2 class="text-center font-medium">Device Name:</h2>
              <p class="text-center">Name of the device retrieve from the database</p>
            </div>
            <!-- /Card 1 --></center>

            <center><!-- Card 2 -->
            <div class="card-body rounded-box justify-center bg-white w-4/5">
              <h1 class="card-title bg-gray-400 text-center font-mono rounded-sm p-2 text-white">#Request_ID</h1>
              <h2 class="text-center font-medium">Device Name:</h2>
              <p class="text-center">Name of the device retrieve from the database</p>
            </div>
            <!-- /Card 2 --></center>

            <center><!-- Card 3 -->
            <div class="card-body rounded-box justify-center bg-white w-4/5">
              <h1 class="card-title bg-gray-400 text-center font-mono rounded-sm p-2 text-white">#Request_ID</h1>
              <h2 class="text-center font-medium">Device Name:</h2>
              <p class="text-center">Name of the device retrieve from the database</p>
            </div>
            <!-- /Card 3 --></center>

            <center><!-- Card 4 -->
            <div class="card-body rounded-box justify-center bg-white w-4/5">
              <h1 class="card-title bg-gray-400 text-center font-mono rounded-sm p-2 text-white">#Request_ID</h1>
              <h2 class="text-center font-medium">Device Name:</h2>
              <p class="text-center">Name of the device retrieve from the database</p>
            </div>
            <!-- /Card 4 --></center>
          </div>
        </div>
        <!-- /Display New Request -->
      </div>
      <!-- Main -->


      <!-- SEARCH RESULT -->
    </div>
  </body>
</html>