const app = {
    init: function() {
        this.formFiltreElement = document.querySelector('.filterForm');
        this.formFiltreElement.addEventListener('submit', (event) => this.handleSubmitFilterElement(event));
    },
    
    handleSubmitFilterElement: function(event) {
        event.preventDefault();

        const FiltreValue = document.querySelector("#Filtre").value;
        const url = window.location.href;

        let newUrl;
        if (url.includes("vth")) {
            newUrl = 'filtre/vth/' + encodeURIComponent(FiltreValue);
        } else {
            newUrl = 'filtre/tl/' + encodeURIComponent(FiltreValue);
        }
        
        history.replaceState(null, null, '/');
        window.location.href = newUrl;
    },
};

document.addEventListener("DOMContentLoaded", () => {
    app.init();
});
