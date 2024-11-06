<form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>

{{ Auth::user()->last_update }}

@php
use Carbon\Carbon;
$user = Auth::user();
$lastUpdate = Carbon::parse($user->last_update);
print($lastUpdate);
@endphp