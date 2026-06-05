<x-layouts.app>
    <h2 class="text-2xl font-bold mb-6">Top 10 thí sinh khối A (Toán, Vật lí, Hóa học)</h2>
    @if($top10->isEmpty())
        <p class="text-gray-500">Chưa có dữ liệu.</p>
    @else
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">STT</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SBD</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Toán</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Vật lí</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Hóa học</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tổng</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($top10 as $index => $score)
                        <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $score->sbd }}</td>
                            <td class="px-4 py-2">{{ $score->toan }}</td>
                            <td class="px-4 py-2">{{ $score->vat_li }}</td>
                            <td class="px-4 py-2">{{ $score->hoa_hoc }}</td>
                            <td class="px-4 py-2 font-bold">{{ $score->khoi_a_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layouts.app>