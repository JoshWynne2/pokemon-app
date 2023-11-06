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
                    you are editing fr 
					<form action="{{route('custom.update', $thismon->id)}}" method="POST">
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

						<button type="submit" name="submit" id="submit" class="bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"> Submit </button>
					</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
