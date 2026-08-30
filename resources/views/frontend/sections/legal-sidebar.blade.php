<div class="legal-sidebar wow fadeInUp">
    <h3>Legal Pages</h3>
    <ul>
        <li>
            <a href="{{ route('legal.privacy') }}" class="{{ request()->routeIs('legal.privacy') ? 'active' : '' }}">
                <i class="fa-solid fa-shield-halved"></i> Privacy Policy
            </a>
        </li>
        <li>
            <a href="{{ route('legal.terms') }}" class="{{ request()->routeIs('legal.terms') ? 'active' : '' }}">
                <i class="fa-solid fa-file-contract"></i> Terms & Conditions
            </a>
        </li>
        <li>
            <a href="{{ route('legal.disclaimer') }}" class="{{ request()->routeIs('legal.disclaimer') ? 'active' : '' }}">
                <i class="fa-solid fa-triangle-exclamation"></i> Disclaimer
            </a>
        </li>
        <li>
            <a href="{{ route('legal.refund') }}" class="{{ request()->routeIs('legal.refund') ? 'active' : '' }}">
                <i class="fa-solid fa-rotate-left"></i> Refund & Cancellation
            </a>
        </li>
    </ul>
</div>