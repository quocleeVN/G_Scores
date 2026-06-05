<x-layouts.app>
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Tra cứu điểm thi</h2>
        <form method="POST" action="{{ route('scores.lookup') }}" class="bg-white p-6 rounded-lg shadow">
            @csrf
            <div class="mb-4">
                <label for="sbd" class="block text-sm font-medium text-gray-700">Số báo danh</label>
                <input type="text" name="sbd" id="sbd" value="{{ old('sbd', request('sbd')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('sbd')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Tra cứu</button>
        </form>

        @if(session('error'))
            <div class="mt-6 bg-red-100 text-red-700 p-4 rounded-lg">{{ session('error') }}</div>
        @endif

        @isset($result)
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Kết quả: SBD {{ $result->sbd }}</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Môn</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Điểm</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach(['toan'=>'Toán','ngu_van'=>'Ngữ văn','ngoai_ngu'=>'Ngoại ngữ','vat_li'=>'Vật lí','hoa_hoc'=>'Hóa học','sinh_hoc'=>'Sinh học','lich_su'=>'Lịch sử','dia_li'=>'Địa lí','gdcd'=>'GDCD'] as $key => $label)
                            <tr>
                                <td class="px-4 py-2 font-medium">{{ $label }}</td>
                                <td class="px-4 py-2">{{ $result->$key ?? '--' }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 font-semibold">
                            <td class="px-4 py-2">Mã ngoại ngữ</td>
                            <td class="px-4 py-2">{{ $result->ma_ngoai_ngu ?? '--' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endisset
    </div>
</x-layouts.app>