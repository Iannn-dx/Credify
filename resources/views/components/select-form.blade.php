<select {{ $attributes->merge([
    'class' => 'block w-full pl-3 pr-10 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 bg-white text-gray-700 cursor-pointer'
]) }}>
    {{ $slot }}
</select>