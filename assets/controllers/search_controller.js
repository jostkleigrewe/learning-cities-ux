import { Controller } from '@hotwired/stimulus';

/*
* The following line makes this controller "lazy": it won't be downloaded until needed
* See https://symfony.com/bundles/StimulusBundle/current/index.html#lazy-stimulus-controllers
*/

/* stimulusFetch: 'lazy' */
export default class extends Controller {

    static values = { param: String, frame: String };

    initialize() {
        console.log('Search initialize');
        // Called once when the controller is first instantiated (per element)

        // Here you can initialize variables, create scoped callables for event
        // listeners, instantiate external libraries, etc.
        // this._fooBar = this.fooBar.bind(this)
    }

    connect() {
        console.log('Search connect');
        // Called every time the controller is connected to the DOM
        // (on page load, when it's added to the DOM, moved in the DOM, etc.)

        // Here you can add event listeners on the element or target elements,
        // add or remove classes, attributes, dispatch custom events, etc.
        // this.fooTarget.addEventListener('click', this._fooBar)
    }

    // Add custom controller actions here
    // fooBar() { this.fooTarget.classList.toggle(this.bazClass) }

    disconnect() {
        console.log('Search disconnect');
        // Called anytime its element is disconnected from the DOM
        // (on page change, when it's removed from or moved in the DOM, etc.)

        // Here you should remove all event listeners added in "connect()"
        // this.fooTarget.removeEventListener('click', this._fooBar)
    }

    submit() {
        // console.log('Search submit');
        // const input = this.element.querySelector(`[name="${this.paramValue}"]`);
        // const url = new URL(this.element.action, window.location.origin);
        // if (input && input.value) url.searchParams.set(this.paramValue, input.value);
        // else url.searchParams.delete(this.paramValue);
        //
        // // Turbo Frame ansteuern
        // const frame = document.getElementById(this.frameValue);
        // if (frame) frame.src = url.toString(); // lädt nur den Frame neu
        // else window.location.href = url.toString(); // Fallback

        const input = this.element.querySelector(`[name="${this.paramValue}"]`);
        const url = new URL(this.element.action, window.location.origin);
        if (input?.value) url.searchParams.set(this.paramValue, input.value);
        else url.searchParams.delete(this.paramValue);

        const frame = document.getElementById(this.frameValue);
        if (frame) frame.src = url.toString();
        else window.location.href = url.toString();
    }
}
