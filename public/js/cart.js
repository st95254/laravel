document.addEventListener('DOMContentLoaded', () => {
    const updateTotalAndFees = () => {
        let total = 0;
        document.querySelectorAll('.item_body').forEach(item => {
            const price = parseFloat(item.querySelector('.price').textContent.replace('$', ''));
            const quantity = parseInt(item.querySelector('.count span').textContent, 10);
            total += price * quantity;
            item.querySelector('.sum').textContent = `$${price * quantity}`;
        });

        const shippingFeeValue = total > 1000 ? 0 : 60;
        document.getElementById('product').textContent = `$${total}`;
        document.getElementById('delivery_fee').textContent = `$${shippingFeeValue}`;
        document.getElementById('total').textContent = `$${total + shippingFeeValue}`;
        document.getElementById('totalInput').value = total + shippingFeeValue;
        document.getElementById('shippingFeeInput').value = shippingFeeValue;
        document.getElementById('orderStatusInput').value = "處理中";
    };

    document.querySelector('.content').addEventListener('click', function(event) {
        const btn = event.target;
        if (!['sub', 'plus', 'delete'].includes(btn.className)) {
            return;
        }

        const itemElement = btn.closest('.item_body');
        const itemId = itemElement.dataset.itemId;
        const countSpan = itemElement.querySelector('.count span');
        let quantity = parseInt(countSpan.textContent, 10);

        if (btn.classList.contains('sub') && quantity > 1) {
            quantity--;
        } else if (btn.classList.contains('plus')) {
            quantity++;
        }

        if (btn.classList.contains('delete')) {
            itemElement.remove(); // Optimistically remove the item from the DOM
        } else {
            countSpan.textContent = quantity; // Optimistically update the quantity in the UI
        }

        // Send AJAX request to update the cart on the server
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/update', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.onload = () => {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    alert('Error: ' + response.error);
                    // Optionally, revert UI changes here if server update fails
                } else {
                    updateTotalAndFees(); // Only update totals if server update is successful
                }
            }
        };
        xhr.send(`item_id=${itemId}&quantity=${quantity}&action=${btn.classList.contains('delete') ? 'delete' : 'update'}`);
    });

    updateTotalAndFees();
});
