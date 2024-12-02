@extends("dashboard")

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Список репортов</h1>

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
    </div>

    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Создать репорт</h2>
        <form method="POST" action="{{ route('reports.store') }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Описание отчета</label>
                <textarea id="description" name="description" rows="4" class="w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Введите описание" required></textarea>
            </div>
            <div>
                <label for="number" class="block text-sm font-medium text-gray-700">Номер</label>
                <input id="number" name="number"  class="w-full mt-1 border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Номер" required />
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200 ease-in-out">
                    Создать
                </button>
            </div>
        </form>
    </div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Управление ролью</h1>

        <p class="mb-4">Текущая роль: <span class="font-bold">{{ auth()->user()->role }}</span></p>

        <div class="space-x-4">
            <form method="POST" action="{{ route('user.make-admin') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                    Стать админом
                </button>
            </form>

            <form method="POST" action="{{ route('user.make-user') }}" class="inline-block">
                @csrf
                <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                    Стать пользователем
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="mt-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>
@endsection
