 <style>
    /* Kill every trace of Google's own UI, including late-injected iframes */
    #google_translate_element,
    .goog-te-banner-frame,
    .goog-te-menu-frame,
    iframe.skiptranslate,
    .skiptranslate,
    .goog-tooltip,
    .goog-tooltip:hover,
    .goog-text-highlight,
    .goog-te-balloon-frame,
    .VIpgJd-ZVi9od-aZ2wEe-wOHMyf-ti6hGc {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        width: 0 !important;
        position: absolute !important;
        top: -9999px !important;
        left: -9999px !important;
    }

    body {
        top: 0px !important;
        position: static !important;
    }

    /* Custom language switcher */
    .lang-switcher {
        position: relative;
        margin-right: 20px;
        z-index: 1050; /* sit above header-sticky */
    }
    .lang-switcher-toggle {
        background: transparent;
        border: none;
        color: #fff;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    .lang-switcher-toggle i {
        font-size: 10px;
    }
    .lang-switcher-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        min-width: 130px;
        list-style: none;
        margin: 8px 0 0;
        padding: 6px 0;
        border-radius: 4px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1051;
    }
    .lang-switcher-menu.open {
        display: block;
    }
    .lang-switcher-menu li {
        padding: 8px 16px;
        color: #222;
        font-size: 14px;
        cursor: pointer;
    }
    .lang-switcher-menu li:hover,
    .lang-switcher-menu li.active {
        background: #f2f2f2;
    }
</style>