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
							<select class="block appearance-none w-full bg-slate-700 border border-slate-700 hover:border-slate-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
								@forelse($pokemon as $mon)
								<option style="backgroundimage:url({{$mon->image_url}}"> {{$mon->name}} </option>
								@empty
								<option>No pokemon???</option>
								@endforelse
							</select>
						<div>
					</form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
