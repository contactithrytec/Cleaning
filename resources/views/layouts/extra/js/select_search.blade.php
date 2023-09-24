<script>
    function toggleOptions() {
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.style.display = optionsContainer.style.display === 'block' ? 'none' : 'block';
    }

    function toggleOption(option) {
        option.classList.toggle('selected');
    }

    function filterOptions() {
        const searchBox = document.getElementById('search-box');
        const filter = searchBox.value.toUpperCase();
        const options = document.querySelectorAll('.option');

        options.forEach((option) => {
            const text = option.textContent || option.innerText;
            if (text.toUpperCase().indexOf(filter) > -1) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    }
</script>
