<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TaskFlow</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-semibold text-gray-900">System Overview</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Last updated: {{ now()->format('M d, Y H:i') }}
                    </p>
                </div>

                <!-- Statistics Grid -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-4 mb-8">
                    <!-- Total Tickets -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-md bg-blue-50 p-3">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Tickets</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalTickets }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Tickets -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-md bg-yellow-50 p-3">
                                        <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Active Tickets</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $activeTickets }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resolved Tickets -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-md bg-green-50 p-3">
                                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Resolved Tickets</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $resolvedTickets }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Response Time -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="rounded-md bg-purple-50 p-3">
                                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Avg. Response Time</dt>
                                        <dd class="text-2xl font-semibold text-gray-900">{{ $avgResponseTime }}h</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Ticket Status Distribution -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Ticket Status Distribution</h3>
                        <canvas id="statusChart" class="w-full" height="300"></canvas>
                    </div>

                    <!-- Top Reported Software -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Top Reported Software</h3>
                        <div class="space-y-4">
                            @foreach($topSoftware as $software)
                            <div class="flex items-center">
                                <span class="flex-1 text-sm text-gray-600">{{ $software->name }}</span>
                                <div class="flex-1">
                                    <div class="relative w-full bg-gray-200 rounded-full h-4">
                                        <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $software->percentage }}%"></div>
                                    </div>
                                </div>
                                <span class="ml-4 text-sm text-gray-600">{{ $software->ticket_count }} tickets</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Unassigned Tickets -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900">Unassigned Tickets</h3>
                        <span class="px-3 py-1 text-sm text-white bg-red-500 rounded-full">{{ $unassignedTickets->count() }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($unassignedTickets as $ticket)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $ticket->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ $ticket->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($ticket->priority === 'high') bg-red-100 text-red-800
                                            @elseif($ticket->priority === 'medium') bg-yellow-100 text-yellow-800
                                            @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $ticket->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.tickets.assign', $ticket) }}" class="text-indigo-600 hover:text-indigo-900">Assign</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No unassigned tickets
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Status Distribution Chart
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Open', 'In Progress', 'Resolved'],
                datasets: [{
                    data: [{{ $statusData->open }}, {{ $statusData->in_progress }}, {{ $statusData->resolved }}],
                    backgroundColor: ['#EF4444', '#F59E0B', '#10B981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>
