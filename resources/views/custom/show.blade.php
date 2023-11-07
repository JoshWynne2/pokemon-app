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
								<button onclick="window.location='{{ route('custom.edit', $mon->id) }}'" type="btn" name="edit" id="edit" class="bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"> Edit </button>
							<!--this dialoge popop thing was taken from here:https://www.material-tailwind.com/docs/html/dialog and I edited it to be in the same style as the rest of the site and adding the links
							in bootstrap I know you can kinda just say this is the dialogue box and then it just works tailwind kinda just sucks :/ -->
						<button
							data-ripple-light="true"
							data-dialog-target="dialog"
							class="inline mb-4 hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-700 rounded"
							>
							Delete
						</button>
						<div
							data-dialog-backdrop="dialog"
							data-dialog-backdrop-close="true"
							class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300"
							>
							<div
								data-dialog="dialog"
								class="relative m-4 w-2/5 min-w-[40%] max-w-[40%] rounded-lg bg-slate-800 font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased shadow-2xl"
								>
								<div class="flex shrink-0 items-center p-4 font-sans text-2xl font-semibold leading-snug text-blue-gray-900 antialiased">
									Delete Custom Pokemon
								</div>
								<div class="relative p-4 font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased">
									Are you sure you want to delete "{{$mon->name}}"? this a action is permanent.
								</div>
								<div class="flex shrink-0 flex-wrap items-center justify-end pt-2 px-4 text-blue-gray-500">
								<button
									data-ripple-dark="true"
									data-dialog-close="true"
									class=" mx-4 mb-4 bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"
									>
									Cancel
								</button>

								<form method="POST" action="{{ route('custom.destroy',$mon->id) }}">
									@csrf
									@method('DELETE')
									<button
									type="submit"
									data-ripple-light="true"
									data-dialog-close="true"
									class="mb-4 bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-700 hover:border-transparent rounded"
										>
										Delete
									</button>
								</form>
								</div>
							</div>
						</div>
						<!-- from node_modules -->
						<script src="node_modules/@material-tailwind/html@latest/scripts/dialog.js"></script>
						
						<!-- from cdn -->
						<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>
						</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
