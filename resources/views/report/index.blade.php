@extends("dashboard")

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Список репортов</h1>

    <img src="{{ Vite::asset('resources/images/images.jpg') }}" alt="Hi!" class=" mb-4 border rounded-lg boborder">
    <!-- Список отчетов -->
    <div class="space-y-4">
        @foreach($reports as $report)
        <div class="bg-blue-50 shadow-md rounded-lg p-4 flex justify-between items-center border-2 border-blue-300">
            <div>
                <p class="text-sm text-red-500 font-semibold">{{ $report->created_at->format('d.m.Y') }}</p>
                <p class="text-lg font-semibold text-black mt-2">{{ $report->number }}</p>
                <p class="text-gray-600 mt-2">{{ $report->description }}</p>
                @if (auth()->user()->role === 'admin')
                <p class="text-gray-600 mt-2">{{ $report->user->surname }} {{ $report->user->name }} {{ $report->user->middlename }}</p>
                @endif
            </div>
            <div>
                @if (auth()->user()->role === 'admin')
                    <form method="POST" action="{{ route('report.update-status', $report->id) }}">
                        @csrf
                        @method('PUT')
                        <select name="status_id" class="border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1" @if ($report->status_id === 1) selected @endif>новое</option>
                            <option value="2" @if ($report->status_id === 2) selected @endif>отклонено</option>
                            <option value="3" @if ($report->status_id === 3) selected @endif>подтверждено</option>
                        </select>
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                            Сохранить
                        </button>
                    </form>
                @else
                    @if ($report->status_id === 1)
                        <span class="text-black font-bold">новое</span>
                    @elseif ($report->status_id === 2)
                        <span class="text-red-500 font-bold">отклонено</span>
                    @elseif ($report->status_id === 3)
                        <span class="text-blue-500 font-bold">подтверждено</span>
                    @endif
                @endif
            </div>
        </div>

        @endforeach
        <div>
            <a href="{{route('reports.create');}}" class="ml-2 mt-20 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                Создать заявку
            </a>
        </div>
    </div>
</div>
@endsection
