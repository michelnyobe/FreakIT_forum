<!-- resources/views/livewire/online-status.blade.php -->
<div>
@if($isOnline)
    <span class="text-green-500">En ligne</span>
@else
    <span class="text-red-500">Hors ligne</span>
@endif
</div>
