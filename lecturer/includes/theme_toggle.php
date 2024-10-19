<div class="sticky-theme-toggle">
    <button id="themeToggle" class="theme-toggle btn btn-primary light">🌚</button>
</div>

<style>
    .sticky-theme-toggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    .theme-toggle {
        padding: 0.5rem 1rem;
        border-radius: 13px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .theme-toggle.dark {
        background-color: #f8f9fa;
        color: #212529;
    }

    .theme-toggle.light {
        background-color: #212529;
        color: #f8f9fa;
    }
</style>

<script>
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;

    // Check and apply stored theme
    const storedTheme = localStorage.getItem('theme');
    if (storedTheme) {
        body.classList.toggle('dark-theme', storedTheme === 'dark');
        updateThemeToggleText(storedTheme === 'dark');
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-theme');
        const theme = body.classList.contains('dark-theme') ? 'dark' : 'light';
        localStorage.setItem('theme', theme);
        updateThemeToggleText(theme === 'dark');
    });

    function updateThemeToggleText(isDark) {
        if (isDark) {
            themeToggle.innerText = '🌞';
            themeToggle.classList.remove('btn-primary');
            themeToggle.classList.add('btn-light', 'dark');
        } else {
            themeToggle.innerText = '🌚';
            themeToggle.classList.remove('btn-light', 'dark');
            themeToggle.classList.add('btn-primary', 'light');
        }
    }
</script>
