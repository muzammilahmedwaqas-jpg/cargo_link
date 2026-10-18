@props(['name', 'label', 'type' => 'text', 'value' => null])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
           value="{{ old($name, $value) }}"
           {{ $attributes->merge([
               'class' => 'w-full rounded-lg border px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 '
                        . ($errors->has($name) ? 'border-red-500' : 'border-gray-300')
           ]) }}>
    @error($name)
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>