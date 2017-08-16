$(function(){
    formValidationOn();
});

function formValidationOn()
{
    $("#addUser").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
    
    $("#editUser").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });
}
