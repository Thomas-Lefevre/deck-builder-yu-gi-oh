/**
 * @property {HTMLElement} content
 * @property {HTMLElement} body
 * @property {HTMLFormElement} form
 */

export default class Filter {

    /**
     * @param {HTMLElement|null}element
     */
    constructor(element) {
        if (element === null) {
            return;
        }
        this.content = element.querySelector('.js-filter-content');
        this.form = element.querySelector('.js-filter-form');
        this.body = element.querySelector('body');
        this.limit = 20;
        this.bindEvents();
    }
    /**
     * Ajoute les comportements aux différents elements
     */
    bindEvents() {
        this.form.querySelectorAll('input[type=text]').forEach(input => {
            input.addEventListener('keyup', this.loadForm.bind(this));
        })

        this.form.querySelectorAll('select').forEach(select => {
            select.addEventListener('change', this.loadForm.bind(this));
        })
        this.body.addEventListener('scroll', function () {
            if (body.scrollTop + body.clientHeight >= body.scrollHeight) {
                this.limit += 20;
                this.loadForm.bind(this.limit);
            }

        })




    }
    async loadForm() {
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadurl(url.pathname + '?' + params.toString())
    }
    async loadurl(url) {
        // const pour éviter de tomber sur une page en json qui va être mis en cache par les navigateurs
        const ajaxUrl = url + '&ajax=1'
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300) {
            const data = await response.json()
            this.content.innerHTML = data.content
            history.replaceState({}, '', url)
        }
        else {
            console.log(response);
        }
    }

}