$("#attributeForm").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("operation", "add_attribute");
    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data) {
            // alert(data);
            data = JSON.parse(data);
            if (data.success == true) {
                toastr.success("Attribute saved successfully!", "success");
                $("#attributeForm")[0].reset();
                location.reload();
            } else {
                toastr.success("Error: "+data.message, "danger");
            }
            
            
            
        }
    });
});

 $('.edit-attribute').on('click', function() {
        var attributeId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'editAttribute.php',
            data: 'editAttribute=' + attributeId,
            success: function(data) {
                $('#editAttributeModalhtml').html(data);
                $('#editAttributeModal').modal('show');
            }
        });
    });



 $(document).on('submit', '#editAttributeForm', function(e) {
     
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("operation", "update_attribute");
    $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        cache: false,
        success: function(data) {
            data = JSON.parse(data);
            if (data.success == true) {
                toastr.success("Attribute updated successfully!", "success");
                $('#editAttributeModal').modal('hide');
                location.reload();
            } else {
                toastr.error("Error: " + data.message, "danger");
            }
        }
    });
});

