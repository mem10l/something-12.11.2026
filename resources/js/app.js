import './bootstrap';

const quantityControls = document.querySelector('[data-quantity-controls]');

if (quantityControls) {
    const quantityDisplay = document.querySelector('[data-product-quantity]');
    const decreaseButton = quantityControls.querySelector('[data-quantity-action="decrease"]');
    const increaseButton = quantityControls.querySelector('[data-quantity-action="increase"]');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    const setQuantity = (quantity) => {
        quantityDisplay.textContent = quantity;
        decreaseButton.disabled = quantity < 1;
    };


    const adjustQuantity = async (action) => {
        const url = quantityControls.dataset[`${action}Url`];


        try {
            const response = await window.axios.patch(url, {}, {
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
            });

            setQuantity(response.data.quantity);
        } finally {
            const data = response?.data;

            if (data?.quantity !== undefined) {
                setQuantity(data.quantity);
            }

        } 
    };

    increaseButton.addEventListener('click', () => adjustQuantity('increase'));
    decreaseButton.addEventListener('click', () => adjustQuantity('decrease'));
}
