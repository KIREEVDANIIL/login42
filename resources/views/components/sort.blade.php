<div>
    {{ $field }}
    @if($field !== $orderByField)
        ⇅
    @else
        @if($direction === 'desc')
            ↑
        @else
            ↓
        @endif
    @endif
</div>
