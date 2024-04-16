window.dataIndicator = function (object, value) {
    // Cache jQuery objects
    let $label = object.find('.indicator-label');
    let $progress = object.find('.indicator-progress');

    if (value === 'on') {
        object.prop('disabled', true);
        $label.addClass('d-none');
        $progress.removeClass('d-none');
    } else {
        object.prop('disabled', false);
        $label.removeClass('d-none');
        $progress.addClass('d-none');
    }
}

window.showFormErrorsByClass = function (errors) {
    // Cache the jQuery selector
    const $errorElements = $('span[class*="error_"]');
    $.each(errors, function(index, value) {
        // Filter error elements based on the class name
        let $errorElement = $errorElements.filter(`.error_${index}`);
        // Update the HTML content
        $errorElement.html(value);
    });
}

window.removeFromErrorsByClass = function(form) {
    // Serialize the form and iterate over each field
    const fieldArray = form.serializeArray();

    // Regular expression for matching field names with brackets
    const regExp = /[\(\)\[\]]/g;

    fieldArray.forEach(function(field) {
        let fieldNameWithBrackets;
        let fieldName = fieldNameWithBrackets = field.name;
        // Checking for brackets or not, and excluding '_token'
        let newFieldName;
        if (fieldName !== '_token') {
            newFieldName = fieldName.replace(/\[|]/g, '');
            $('.error_' + newFieldName).html('');
        }
    });
};
