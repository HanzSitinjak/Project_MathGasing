function populateDropdown(url, dropdownId) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const dropdown = document.getElementById(dropdownId);
            // Clear existing options
            dropdown.innerHTML = '<option value="">Pilih</option>';
            // Populate dropdown with fetched data
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.text = item.id;
                dropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}
populateDropdown('https://mathgasing.cloud/api/getMateri', 'id_materi');

populateDropdown('https://mathgasing.cloud/api/getPosttest', 'id_posttest');