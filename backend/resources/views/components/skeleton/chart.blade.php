<div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-soft border border-white/20">
    <!-- Skeleton Chart Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="h-6 bg-spiritual-200 rounded w-32 skeleton-pulse"></div>
    </div>

    <!-- Skeleton Chart Bars -->
    <div class="space-y-4 mb-6">
        @for ($i = 0; $i < 4; $i++)
            <div class="flex items-center space-x-3">
            <div class="w-24">
                <div class="h-4 bg-spiritual-200 rounded skeleton-pulse"></div>
            </div>
            <div class="flex-1">
                <div class="h-8 bg-spiritual-200 rounded-lg skeleton-pulse"></div>
            </div>
            <div class="w-12">
                <div class="h-4 bg-spiritual-200 rounded skeleton-pulse"></div>
            </div>
    </div>
    @endfor
</div>

<!-- Skeleton Stats -->
<div class="pt-6 border-t border-spiritual-200 grid grid-cols-2 gap-4">
    <div class="text-center">
        <div class="h-8 bg-spiritual-200 rounded w-16 mx-auto mb-2 skeleton-pulse"></div>
        <div class="h-3 bg-spiritual-200 rounded skeleton-pulse"></div>
    </div>
    <div class="text-center">
        <div class="h-8 bg-spiritual-200 rounded w-16 mx-auto mb-2 skeleton-pulse"></div>
        <div class="h-3 bg-spiritual-200 rounded skeleton-pulse"></div>
    </div>
</div>
</div>