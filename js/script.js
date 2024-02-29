document.addEventListener('DOMContentLoaded', function () {
    var addButton = document.getElementById('addBookButton');
    if (addButton) {
        addButton.addEventListener('click', function() {
            var form = document.getElementById('addBookForm');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
            } else {
                form.classList.add('hidden');
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const bookAdded = urlParams.get('book_added');
    
    if (bookAdded === 'true') {
        const toast = document.createElement('div');
        toast.textContent = 'Książka została pomyślnie dodana!';
        toast.style.position = 'fixed';
        toast.style.top = '60px';
        toast.style.right = '20px';
        toast.style.backgroundColor = '#dff0d8';
        toast.style.color = '#3c763d';
        toast.style.padding = '10px';
        toast.style.borderRadius = '5px';
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 5000);
    }
});