@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pb-3 border-b-2 border-[#11999E] font-medium leading-5 text-[#F5F7F8] focus:outline-none focus:border-[#0D7A7E] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 <pb-3></pb-3> border-b-2 border-transparent text-sm font-medium leading-5 text-black hover:text-[#F5F7F8] hover:border-[#0D7A7E] focus:outline-none focus:text-[#F5F7F8] focus:border-[#0D7A7E] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
