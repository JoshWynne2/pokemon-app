<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editing A Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					@if ($errors->has('pokemon'))
					hii
					@endif
					<form action="{{route('teams.update', $team->id)}}" method="POST">
						@csrf
						@method('PUT')
						
						<label>Team Name</label>
						<input value="{{$team->name}}" type='text' name='name' id='name' class='block appearance-none w-1/2 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'>
						<br>
						<label>Team Description</label>
						<input value="{{$team->description}}" type='text' name='description' id='description' class='block appearance-none w-1/2 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'>
						<br>
						<div>
							<label>Pokemon<label>
							<div class="grid grid-cols-3 gap-2">
							
							<!-- {{$moncount = count($teamPokemon)}} -->
							@for ($i = 1; $i <= 6; $i++)


							<select name="pokemon{{$i}}" id="pokemon{{$i}}" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
							<option value=""> Pokemon {{$i}} </option>

								@forelse($customPokemon as $mon)
									<!-- I honestly have no idea why I have to put a -1 on the id here but it works now because of it -->
								@if($moncount != 0)
									@if($mon->id == $teamPokemon[$moncount-1]->custom_pokemon_id)
									<option selected value="{{$mon->id }}"> {{$mon->nickname}} - ({{$pokemon[$mon->pokemon_id-1]->name}})  </option>
									@else
									<option value="{{$mon->id }}"> {{$mon->nickname}} - ({{$pokemon[$mon->pokemon_id-1]->name}}) </option>
									@endif
								@else 
								<option value="{{$mon->id }}"> {{$mon->nickname}} - ({{$pokemon[$mon->pokemon_id-1]->name}}) </option>
								@endif

								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>

							@if($moncount > 0)
							<!-- {{$moncount--}} -->
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
