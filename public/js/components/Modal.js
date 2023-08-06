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
        const closeBtns = modal.querySelectorAll("button[aria-label='Close']");
        closeBtns.forEach(closeBtn => {
            closeBtn.addEventListener('click', () => this.close());
        });
    }

    /**
     * Open the modal
     */
    open() {
        this.modal.showModal();
    }

    /**
     * Close modal
     */
    close() {
        this.modal.close();
    }

    /**
     * Add Html content into the modal
     * 
     * @param {Node} content 
     */
    addModalContent(content) {
        const modalBody = this.modal.querySelector("main#modalContent");
        modalBody.appendChild(content);
    }
}

export default Modal;