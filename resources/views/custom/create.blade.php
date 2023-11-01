<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create A New Pokemon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
					<form action="{{route('custom.store')}}" method="POST">
						@csrf

						<div>
							<label>Pokemon<label>
							<select id="pokemon" class="block appearance-none w-1/2 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								@forelse($pokemon as $mon)
								<option value="{{$mon->id}}"> {{$mon->name}} </option>
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
						</div>
						<br>
						<h4>Moveset</h4>
						<div class="grid grid-cols-2 gap-2 w-1/2">
							<!-- <label>Move 1:</label> -->
							<select id="move1" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								<option value="" selected="selected"> Move 1 </option>
								@forelse($moves as $move)
								<option value="{{$move->id}}"> {{$move->name}} </option>
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
							<select id="move2" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								<option value="" selected="selected"> Move 2 </option>
								@forelse($moves as $move)
								<option value="{{$move->id}}"> {{$move->name}} </option>
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
							<select id="move3" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								<option value="" selected="selected"> Move 3 </option>
								@forelse($moves as $move)
								<option value="{{$move->id}}"> {{$move->name}} </option>
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
							<select id="move4" class="block appearance-none w-30 bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								<option value="" selected="selected"> Move 4 </option>
								@forelse($moves as $move)
								<option value="{{$move->id}}"> {{$move->name}} </option>
								@empty
								<option>missingNo!!!</option>
								@endforelse
							</select>
						</div>
						<br>
						<button type="submit" name="submit" id="submit" class="bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded"> Submit </button>
					</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
