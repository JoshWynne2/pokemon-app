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
				You are editing a Custom Pokemon
				<form class="inline" action="{{route('custom.update', $thismon->id)}}" method="POST">
						@csrf
						@method('PUT')
						<div>

							<label>Pokemon<label>
								<select name="pokemon" id="pokemon" class="block appearance-none w-1/2 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								@forelse($pokemon as $mon)
								@if($mon->name == $thismon->rname)
								<option selected="selected" value="{{$mon->id}}"> {{$mon->name}} </option>
								@else
								<option value="{{$mon->id}}"> {{$mon->name}} </option>
								@endif
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
						</div>
						<br>
						
						<label>Nickname</label>
						<input value="{{$thismon->name}}"type='text' name='nickname' id='nickname' class='block appearance-none w-1/2 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'>
						<br>

						<label>Moveset</label>

						<!-- {{$movecount = count($thismoves)}} -->

						<div class="grid grid-cols-2 gap-2 w-1/2">
						@for ($i = 1; $i <= 4; $i++)

							<select name="move{{$i}}" id="move{{$i}}" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								<option value=""> Move {{$i}} </option>

								@forelse($moves as $move)
									
								@if($movecount != 0)
									@if($move->id == $thismoves[$movecount-1]->id)
									<option selected="selected" value="{{$move->id}}"> {{$move->name}} </option>
									@else
									<option value="{{$move->id}}"> {{$move->name}} </option>
									@endif
								@else 
								<option value="{{$move->id}}"> {{$move->name}} </option>
								@endif

								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>

							@if($movecount > 0)
							<!-- {{$movecount--}} -->
							@endif

						@endfor
						</div>
						<br>

						<button type="submit" name="submit" id="submit" class="mr-2 bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"> Submit </button>

						</form>

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
									Are you sure you want to delete "{{$thismon->name}}"? this a action is permanent.
								</div>
								<div class="flex shrink-0 flex-wrap items-center justify-end pt-2 px-4 text-blue-gray-500">
								<button
									data-ripple-dark="true"
									data-dialog-close="true"
									class=" mx-4 mb-4 bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"
									>
									Cancel
								</button>
								<form method="POST" action="{{ route('custom.destroy',$thismon->id) }}">
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

</x-app-layout>
