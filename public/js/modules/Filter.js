/**
 * @property {HTMLElement} content
 * @property {HTMLElement} form
 */

export default class Filter {

    /**
     * @param {HTMLElement|null}element
     */
    constructor(element) {
        if (element === null) {
            return;
        }
        this.content = element.querySelector('.js-filter-content')
        this.form = element.querySelector('.js-filter-form')
        this.bindEvents()
    }
    /**
     * Ajoute les comportements aux différents elements
     */
    bindEvents() {
        this.form.querySelectorAll('option').forEach(a => {
            a.addEventListener('click', e => {

                console.log('change');
            })
        })
    }

    async loadurl(url) {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        if (response.status >= 200 && response.status < 300){
            const data = await response.json()
            this.content.innerHTML = data.content
        }
        else{
            console.log(response);
        }
    }

}