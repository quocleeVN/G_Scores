<x-layouts.app>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-stats-card title="Tổng thí sinh" :value="$totalStudents" color="blue" />
        <x-stats-card title="Số môn thi" :value="$totalSubjects" color="green" />
    </div>
    <p class="mt-8 text-gray-600">Chào mừng đến với hệ thống quản lý điểm thi G-Scores.</p>
</x-layouts.app>