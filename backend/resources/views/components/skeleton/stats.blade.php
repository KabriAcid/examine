<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @for ($i = 0; $i < 4; $i++)
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <div class="h-3 bg-spiritual-200 rounded w-20 mb-2 skeleton-pulse"></div>
                <div class="h-8 bg-spiritual-200 rounded w-24 skeleton-pulse"></div>
            </div>
            <div class="w-12 h-12 bg-spiritual-200 rounded-xl skeleton-pulse"></div>
        </div>
        <div class="mt-4 h-2 bg-spiritual-200 rounded skeleton-pulse"></div>
</div>
@endfor
</div>