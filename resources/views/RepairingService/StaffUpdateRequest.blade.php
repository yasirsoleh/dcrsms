<DOCTYPE html!>
<html>    
  <head>
    <title>Update Request</title>

    <!-- taiwind.css -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- /taiwind.css -->
  </head>
  <body> 
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
      <div class="w-5/6">
        <!-- Update New Request -->
        <div class="flex justify-center">
          <div class="card md:card-side bordered">
            <div class="card-body bg-white">
              <h2 class="card-title bg-gray-400 text-center text-white">Request Info for X</h2> 
              <p>
                
              </p> 
              
              <div class="card-actions">
                <button class="btn btn-error text-white">Cancel Update</button> 
                <button class="btn btn-info text-white">Update Status</button>
              </div>
            </div>
          </div>
        </div>
        <!-- /Update New Request -->
      </div>
      <!-- Main -->
    </div>
  </body>
</html>