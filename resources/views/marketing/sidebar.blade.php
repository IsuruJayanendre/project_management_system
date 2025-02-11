<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-white text-center" id="usertype">{{ Auth::user()->usertype }}</h4>
    <hr>
    
    {{-- <a href="#"><i class="fas fa-book me-2"></i></a>
    <a href="#"><i class="fas fa-home me-2"></i> </a>
    <a href="#"><i class="fas fa-home me-2"></i></a>
    <a href="#"><i class="fas fa-home me-2"></i> </a> --}}

    <hr>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <li class="nav-item">
            <button type="submit" class="fas fa-book me-2" style="border:none; padding:0; background:none; color:red;">
                Log Out
            </button>
        </li>
    </form>
</div>

