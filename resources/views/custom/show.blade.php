<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Custom Pokemon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<div class="grid grid-cols-8 gap-10">
						<div class="col-span-2">
							<image src="{{URL($mon->image_url)}}">
						</div>
						<div class="col-span-6">
							<h1 class="text-2xl"> {{$mon->name}} </h1>
							<h4 class="text-sm"> {{$mon->rname}} </h4>
							<div class="grid grid-cols-2 gap-2">
								@forelse($moves as $move)
								<div class="max-w-sm rounded overflow-hidden shadow-lg px-6 py-4">
									{{$move->name}}
								</div>
								@empty
								<span> No Moves set </span>
								@endif
							</div>

							<div class="p-2 pt-5 space-x-2">
								<button type="btn" name="edit" id="edit" class="bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"> Edit </button>
								<button type="btn" name="edit" id="edit" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"> Delete </button>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
