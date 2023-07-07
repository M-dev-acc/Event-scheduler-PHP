class Modal{
    /**
     * Set properties to the class
     * 
     * @param {string} modalId 
     */
    constructor(modalId) {
        this.templatesContainer = document.getElementById('htmlTemplates');
        const templateClones = document.importNode(this.templatesContainer.content, true);
        this.modal = templateClones.querySelector(modalId);

        this.initialize(this.modal);
    }
    
    /**
     * Initialize the modal
     * 
     * @param {Node} modal 
     */
    initialize(modal) {
        document.body.appendChild(modal);
    }

    /**
     * Open the modal
     */
    open() {
        this.modal.showModal();
    }
}

export default Modal;