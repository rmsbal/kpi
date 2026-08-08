// document.querySelector('.checkbox-edit')?.addEventListener('click', function (event) {
//     let value = this.checked;
//     console.log('Checkbox value:', value);
// });

document.getElementById('submit-button').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent form submission

    const form = document.getElementById('formEdit');
    const formData = new FormData(form);

    // Print all form values
    for (const [key, value] of formData.entries()) {
        console.log(key, value);
    }
});