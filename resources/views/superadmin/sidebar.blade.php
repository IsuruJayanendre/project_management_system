<div class="sidebar">
    <h4 class="text-white text-center" id="usertype">{{ Auth::user()->usertype }}</h4>
    <hr>
    <a href="#" class="menu-item car"><i class="fas fa-car me-2"></i> Car</a>
    <a href="#" class="menu-item van"><i class="fas fa-shuttle-van me-2"></i> Van</a>
    <a href="#" class="menu-item bus"><i class="fas fa-bus me-2"></i> Bus</a>

    <hr>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="fas fa-sign-out-alt me-2" style="border:none; background:none; color:red;">
            Log Out
        </button>
    </form>
</div>

