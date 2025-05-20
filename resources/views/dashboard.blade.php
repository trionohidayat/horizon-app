<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <form action="{{ route('dashboard') }}" method="GET" class="flex w-full md:w-auto">
              <input type="text" name="q" value="{{ request('q') }}" placeholder="Search consignment…" class="w-full md:w-64 rounded-l border-gray-300 dark:bg-gray-700 dark:border-gray-600
                      focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2 text-sm">
              <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-r text-sm"> Search </button>
            </form>
            <a href="{{ route('consignments.create') }}" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded"> + Create Consignment </a>
          </div>
          {{-- Tabel --}}
          <div class="overflow-x-auto">
            <table class="min-w-full table-fixed text-sm">
              <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                <tr>
                  <th class="w-24 px-3 py-2 text-center">Consignment Code</th>
                  <th class="w-24 px-3 py-2 text-center">Passport No</th>
                  <th class="w-40 px-3 py-2 text-center">Sender Name</th>
                  <th class="w-40 px-3 py-2 text-center">Receiver Name</th>
                  <th class="w-12 px-3 py-2 text-center">Mode</th>
                  <th class="w-12 px-3 py-2 text-center">Carton</th>
                  <th class="w-12 px-3 py-2 text-center">Weight (kg)</th>
                  <th class="w-12 px-3 py-2 text-center">Cost (SAR)</th>
                  <th class="w-44 px-3 py-2 text-center">Action</th>
                </tr>
              </thead>
              <tbody> @forelse ($consignments as $i => $c) <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td class="px-3 py-2">{{ $c->consignment_code }}</td>
                  <td class="px-3 py-2">{{ $c->passport_no }}</td>
                  <td class="px-3 py-2">{{ $c->sender_name }}</td>
                  <td class="px-3 py-2">{{ $c->receiver_name }}</td>
                  <td class="px-3 py-2 capitalize">{{ $c->shipping_mode }}</td>
                  <td class="px-3 py-2 text-center">{{ $c->carton_type }}</td>
                  <td class="px-3 py-2">{{ $c->weight }}</td>
                  <td class="px-3 py-2">{{ number_format($c->total_cost, 0, ',', '.') }}</td>
                  <td class="px-3 py-2 text-center space-x-1">
                    <a href="{{ route('consignments.show', encrypt($c->id)) }}" target="_blank" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded">
                        
                                        View</a>
                    <a href="{{ route('consignments.print', encrypt($c->id)) }}" target="_blank" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded">
                        
                                        Print
                    </a>
                    <form action="{{ route('consignments.destroy', encrypt($c->id)) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this consignment?')"> @csrf @method('DELETE') <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded"> 
                        
                                            Delete
                                         </button>
                    </form>
                  </td>
                </tr> @empty <tr class="border-t border-gray-200 dark:border-gray-700">
                  <td colspan="10" class="px-3 py-4 text-center">No consignments found.</td>
                </tr> @endforelse </tbody>
            </table>
          </div>
          {{-- Pagination --}}
          <div class="mt-4">
            {{ $consignments->withQueryString()->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>