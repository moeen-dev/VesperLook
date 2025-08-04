@extends('layouts.frontend')
@section('title', 'Cart')
@section('content')

<livewire:shopping-cart />

@endsection
@section('scripts')
<script>
    document.getElementById('phone').addEventListener('focus', function() {
            if (!this.value.startsWith('+880')) {
                this.value = '+880' + this.value.replace(/^0/, '');
            }
        });
</script>
@endsection