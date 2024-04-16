<div class="btn-group">
    <button type="button" class="btn btn-dark btn-sm">Open</button>
    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference{{ $user->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference{{ $user->id }}" style="will-change: transform;">
        <a class="dropdown-item editUser" href="#" data-url="{{ route('user.find', $user->id) }}">Edit</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item deleteUser" href="#" data-url="{{ route('user.delete', $user->id) }}">Delete</a>
    </div>
</div>
