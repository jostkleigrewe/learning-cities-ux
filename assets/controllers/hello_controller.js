import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ['output'];


    connect() {
        console.log('Hello Connected');
        // this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }


    ping() {
        console.log('Hello Ping');
        this.outputTarget.textContent = 'pong';
        setTimeout(() => this.outputTarget.textContent = '', 800);
    }

}
