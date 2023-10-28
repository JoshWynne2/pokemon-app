<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Pokemon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
				<table class="w-full">
						<thead class="bg-slate-600"> 
							<tr>
								<th class="px-4 py-2">Nickname</th>
								<th class="px-4 py-2">Pokemon name</th>
								<th class="px-4 py-2">Type</th>
								<th class="px-4 py-2">Secondary Type</th>
								<th class="px-4 py-2"></th>
							</tr>
						</thead>
						<tbody> 
					@forelse ($pokemon as $mon)
					@if ($loop->iteration % 2 == 0)
						<tr class="bg-slate-900 hover:bg-slate-700">
					@else
						<tr class ="bg-slate-800 hover:bg-slate-700">
					@endif 
							<td class="px-3 w-2/4"> {{$mon->name}}</td>
							<td class="px-3 w-1/4"> {{$mon->rname}}</td>
							<td class="px-3 w-1/4"> {{$mon->type}}</td>
							<td class="px-3 w-1/4"> {{$mon->secondary_type}}</td>
							<td class="px-3 w-1/4"> <a href="{{route('custom.edit', $mon->id)}}" >Edit </a> </td>
						</tr>

					@empty
						<h4> You have no pokemon! </h4>
					@endforelse
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
