<div>
    <div class="w-full h-screen bg-gradient-to-r from-blue-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Grid -->
    <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
      <div>
        <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">Uniformes para tus hijos con <span class="text-blue-600">RM Sport</span></h1>
        <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Todos los uniformes de Latacunga al alcance de un click</p>

      </div>
      <!-- End Col -->

      <div class="relative ms-4">
        <img class="w-full rounded-md" src="images\RMlogotipo1.png" alt="Logotipo de la empresa">
        <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0"></div>

        <!-- SVG-->
        <div class="absolute bottom-0 start-0">
          
        </div>
        <!-- End SVG-->
      </div>
      <!-- End Col -->
    </div>
    <!-- End Grid -->
  </div>
</div>

<!--Brand section -->
<section class="py-20">
  <div class="max-w-xl mx-auto">
    <div class="text-center ">
      <div class="relative flex flex-col items-center">
        <h1 class="text-5xl font-bold dark:text-gray-200"> Conoce los <span class="text-blue-500"> Colegios
          </span> </h1>
        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
          <div class="flex-1 h-2 bg-blue-200">
          </div>
          <div class="flex-1 h-2 bg-blue-400">
          </div>
          <div class="flex-1 h-2 bg-blue-600">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">

    @foreach ($categories as $categorie)
    <div class="bg-white rounded-lg shadow-md dark:bg-gray-800" wire:key="{{$categorie->id}}">
        <a href="#" class="">
          <img src="{{url('storage', $categorie->image )}}" alt="{{$categorie->name}}" class="object-cover w-full h-64 rounded-t-lg">
        </a>
        <div class="p-5 text-center">
          <a href="" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
            {{$categorie->name}}
          </a>
        </div>
      </div>
    @endforeach

     

    </div>
  </div>
</section>
</div>
