<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
				<!--I want a card for each team that shows images of each pokemon in it
					I have the vision-->

					<button class="mb-4 bg-transparent hover:bg-sky-500 text-sky-700 font-semibold hover:text-white py-2 px-4 border border-sky-700 hover:border-transparent rounded" onclick="window.location='{{ route('teams.create') }}'"> Create A New Team </button>
				
					
					<div class="card">
						<!-- component -->
						<div class="pb-2 max-w-xl">
							<div class="shadow-2xl bg-white dark:bg-slate-700 rounded-lg tracking-wide" >
								<div class="p-4 mt-2 bg-blue">
									<h2 class="font-bold text-2xl text-white-900 tracking-normal">Team Name</h2>
										<p class="text-sm text-white-800 px-2 mr-1">
											Team description
										</p>
										<div class="author flex items-center -ml-3 my-3">
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4  shadow" src="https://images.unsplash.com/photo-1492562080023-ab3db95bfbce?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=731&q=80" alt="avatar">
										</div>
										<button class='block appearance-none w-1/10 pl-8 bg-slate-800 border border-slate-800 hover:border-slate-700 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'>View </button>
									</div>
								</div>
							</div>
						</div>
						<!-- card end -->
						@foreach($teams as $team)
						<div class="pb-2 max-w-xl">
							<div class="shadow-2xl bg-white dark:bg-slate-700 rounded-lg tracking-wide" >
								<div class="p-4 mt-2 bg-blue">
									<h2 class="font-bold text-2xl text-white-900 tracking-normal">{{$team->name}}</h2>
										<p class="text-sm text-white-800 px-2 mr-1">
											{{$team->description}}
										</p>
									<div class="author flex items-center -ml-3 my-3">
										@foreach($teamPokemon as $teamMon)
										@if($teamMon->team_id == $team->id)
										<!-- {{
											$thisMonId = $customPokemon[$teamMon->custom_pokemon_id]->pokemon_id
										}} -->
										<div class="user-logo">
											<img class="w-12 h-12 object-cover rounded-full mx-4 shadow" src="{{URL($pokemon[$thisMonId]->image_url)}}">
										</div>
										@endif
										@endforeach
										<button onclick="window.location='{{ route('teams.show', $team->id) }}'"class='block appearance-none w-1/10 pl-8 bg-slate-800 border border-slate-800 hover:border-slate-700 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline'>View </button>
									</div>
								</div>
							</div>
						</div>
						@endforeach


					</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
