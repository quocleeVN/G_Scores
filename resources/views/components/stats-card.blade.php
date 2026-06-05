@props(['title', 'value', 'color'])
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-700">{{ $title }}</h3>
    <p class="text-3xl font-bold text-{{ $color }}-500 mt-2">{{ $value }}</p>
</div>