<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'gu,en,hi',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false
        }, 'google_translate_element');

        // Re-hide any Google-injected iframe that slips past CSS on load
        setTimeout(function () {
            document.querySelectorAll('iframe.skiptranslate, .goog-te-banner-frame')
                .forEach(function (el) {
                    el.style.display = 'none';
                    el.style.visibility = 'hidden';
                });
            document.body.style.top = '0px';
        }, 300);
    }
</script>

<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    async></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.getElementById('langSwitcherToggle');
        var menu = document.getElementById('langSwitcherMenu');
        var label = document.getElementById('langSwitcherLabel');
        var items = menu.querySelectorAll('li');

        // Open/close dropdown
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('open');
        });
        document.addEventListener('click', function () {
            menu.classList.remove('open');
        });

        // Reflect current cookie language on load
        var currentLang = getCookieLang();
        items.forEach(function (item) {
            if (item.dataset.lang === currentLang) {
                label.textContent = item.dataset.label;
                items.forEach(function (i) { i.classList.remove('active'); });
                item.classList.add('active');
            }
        });

        // Handle language selection
        items.forEach(function (item) {
            item.addEventListener('click', function () {
                var lang = item.dataset.lang;
                label.textContent = item.dataset.label;
                items.forEach(function (i) { i.classList.remove('active'); });
                item.classList.add('active');
                menu.classList.remove('open');
                setLanguage(lang);
            });
        });

        function getCookieLang() {
            var match = document.cookie.match(/googtrans=\/en\/([a-z]{2})/);
            return match ? match[1] : 'gu';
        }

        function setLanguage(lang) {
            var value = '/en/' + lang;
            document.cookie = 'googtrans=' + value + '; path=/';
            document.cookie = 'googtrans=' + value + '; path=/; domain=' + window.location.hostname;
            window.location.reload();
        }
    });
</script>