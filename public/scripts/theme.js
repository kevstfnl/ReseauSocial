class Theme {
    button = document.getElementById("theme");
    media = window.matchMedia('(prefers-color-scheme: dark)');

    constructor() {
        if (localStorage.getItem("theme")) {
            if (localStorage.getItem("theme") == "dark") {
                document.documentElement.classList.add("dark");
            }
        } else if (this.media.matches) {
            this.toggle();
        }

        this.button.addEventListener("click", this.toggle);
    }

    toggle() {
        document.documentElement.classList.toggle("dark");
        localStorage.setItem("theme", document.documentElement.classList.contains("dark") ? "dark" : "light");
    }
}
new Theme();