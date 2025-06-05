function goToItemPage() {
    window.location.href = "items.php";
}

function toggleSortOptions() {
    const sortOptions = document.getElementById("sort-options-form");
    if (sortOptions) {
        sortOptions.style.display = (sortOptions.style.display === "none" || sortOptions.style.display === "") ? "block" : "none";
    }
}

// Handle file upload
function handleFileUpload(input) {
    // Placeholder for validation/UI if needed
}

document.addEventListener("DOMContentLoaded", function () {
    // 🛒 Cart Count
    const cartCountElement = document.getElementById("cart-count");
    const count = localStorage.getItem("cartCount");
    if (cartCountElement) {
        if (count && parseInt(count) > 0) {
            cartCountElement.textContent = count;
            cartCountElement.style.display = "inline";
        } else {
            cartCountElement.style.display = "none";
        }
    }

    // 🍔 Category Filtering
    const links = document.querySelectorAll('.navbar-link');
    const items = document.querySelectorAll('.item');

    function applyFilter(filter) {
        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            item.style.display = (itemCategory === filter) ? 'block' : 'none';
        });
    }

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = link.getAttribute('data-filter');
            applyFilter(filter);
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        applyFilter(categoryParam.toLowerCase());
    }

    // 📦 Sort Toggle Button
    const sortBtn = document.querySelector('.sortbtn');
    if (sortBtn) {
        sortBtn.addEventListener('click', function () {
            toggleSortOptions();
        });
    }

    // 🔍 Search Form Submit
    const searchBtn = document.getElementById("searchBtn");
    const searchForm = document.getElementById("searchForm");
    if (searchBtn && searchForm) {
        searchBtn.addEventListener("click", function (e) {
            e.preventDefault();
            searchForm.submit();
        });
    }

    // 🔄 Image Upload triggers search with hidden input
    const imageUpload = document.getElementById('imageUpload');
    if (imageUpload) {
        imageUpload.addEventListener('change', function () {
            const form = this.form;
            if (!form.querySelector('input[name="submit-search"]')) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'submit-search';
                hiddenInput.value = '1';
                form.appendChild(hiddenInput);
            }
            form.submit();
        });
    }

    // 📝 Show item description modal (or alert)
    document.querySelectorAll('.show-description').forEach(button => {
        button.addEventListener('click', () => {
            const name = button.dataset.name;
            const price = button.dataset.price;
            const calories = button.dataset.calories;
            const category = button.dataset.category;
            alert(`${name}\nPrice: £${price}\nCalories: ${calories} cal\nCategory: ${category}`);
        });
    });

    // 🛒 Add to Cart (robust and works on both items.php & search.php)
    const cartForms = document.querySelectorAll('form.add-to-cart-form');
    if (cartForms.length > 0) {
        cartForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);
                formData.append('submit', true); // ✅ Required by your PHP script

                fetch('addtocart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showCartMessage(data.message);
                        updateCartCount();
                    } else {
                        alert('Failed to add item to cart.');
                    }
                })
                .catch(() => alert('Error adding item.'));
            });
        });
    }
});

// temporary message when item is added
function showCartMessage(message) {
    let msgDiv = document.getElementById('cart-message');
    if (!msgDiv) {
        msgDiv = document.createElement('div');
        msgDiv.id = 'cart-message';
        msgDiv.style.position = 'fixed';
        msgDiv.style.top = '10px';
        msgDiv.style.right = '10px';
        msgDiv.style.backgroundColor = 'white';
        msgDiv.style.color = 'black';
        msgDiv.style.padding = '10px 20px';
        msgDiv.style.borderRadius = '5px';
        msgDiv.style.zIndex = '9999';
        document.body.appendChild(msgDiv);
    }
    msgDiv.textContent = message;
    msgDiv.style.display = 'block';
    setTimeout(() => { msgDiv.style.display = 'none'; }, 750);
}

// 🔢 Update Cart Count
function updateCartCount() {
    const cartCountElem = document.getElementById('cart-count');
    if (cartCountElem) {
        let count = parseInt(cartCountElem.textContent) || 0;
        count += 1;
        cartCountElem.textContent = count;
        cartCountElem.style.display = 'inline';
        localStorage.setItem('cartCount', count);
    }
}
