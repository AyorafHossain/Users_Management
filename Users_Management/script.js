let form = document.getElementById("userForm");

let name = document.getElementById("name");
let email = document.getElementById("email");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirm_password");
let dob = document.getElementById("dob");
let phone = document.getElementById("phone");
let country = document.getElementById("country");
let terms = document.getElementById("terms");

function setError(input, errorId, message)
{
    document.getElementById(errorId).innerHTML = message;
    input.classList.add("invalid");
    input.classList.remove("valid");
}

function setSuccess(input, errorId)
{
    document.getElementById(errorId).innerHTML = "";
    input.classList.remove("invalid");
    input.classList.add("valid");
}

function validateForm()
{
    let valid = true;

    if(name.value.trim() == "")
    {
        valid = false;
        setError(name, "nameError", "Name is required");
    }
    else
    {
        setSuccess(name, "nameError");
    }

    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(email.value.trim() == "")
    {
        valid = false;
        setError(email, "emailError", "Email is required");
    }
    else if(!emailPattern.test(email.value))
    {
        valid = false;
        setError(email, "emailError", "Invalid email format");
    }
    else
    {
        setSuccess(email, "emailError");
    }

    let passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!]).{8,16}$/;

    if(password.value == "")
    {
        valid = false;
        setError(password, "passwordError", "Password is required");
    }
    else if(!passPattern.test(password.value))
    {
        valid = false;
        setError(password, "passwordError", "Password must be 8-16 chars with uppercase, lowercase, digit and special character");
    }
    else
    {
        setSuccess(password, "passwordError");
    }

    if(confirmPassword.value == "")
    {
        valid = false;
        setError(confirmPassword, "confirmError", "Confirm password is required");
    }
    else if(confirmPassword.value != password.value)
    {
        valid = false;
        setError(confirmPassword, "confirmError", "Password does not match");
    }
    else
    {
        setSuccess(confirmPassword, "confirmError");
    }

    if(dob.value == "")
    {
        valid = false;
        setError(dob, "dobError", "Date of birth is required");
    }
    else
    {
        let birthDate = new Date(dob.value);
        let today = new Date();

        let age = today.getFullYear() - birthDate.getFullYear();
        let month = today.getMonth() - birthDate.getMonth();

        if(month < 0 || (month == 0 && today.getDate() < birthDate.getDate()))
        {
            age--;
        }

        if(age < 18)
        {
            valid = false;
            setError(dob, "dobError", "User must be at least 18 years old");
        }
        else
        {
            setSuccess(dob, "dobError");
        }
    }

    let phonePattern = /^\d{11}$/;

    if(phone.value.trim() == "")
    {
        valid = false;
        setError(phone, "phoneError", "Phone number is required");
    }
    else if(!phonePattern.test(phone.value))
    {
        valid = false;
        setError(phone, "phoneError", "Phone must be exactly 11 digits");
    }
    else
    {
        setSuccess(phone, "phoneError");
    }

    if(country.value == "")
    {
        valid = false;
        setError(country, "countryError", "Select a country");
    }
    else
    {
        setSuccess(country, "countryError");
    }

    if(!terms.checked)
    {
        valid = false;
        document.getElementById("termsError").innerHTML = "You must accept Terms & Conditions";
    }
    else
    {
        document.getElementById("termsError").innerHTML = "";
    }

    return valid;
}

name.addEventListener("input", validateForm);
email.addEventListener("input", validateForm);
password.addEventListener("input", validateForm);
confirmPassword.addEventListener("input", validateForm);
dob.addEventListener("change", validateForm);
phone.addEventListener("input", validateForm);
country.addEventListener("change", validateForm);
terms.addEventListener("change", validateForm);

form.addEventListener("submit", function(e){

    if(!validateForm())
    {
        e.preventDefault();
    }
    else
    {
        document.getElementById("successMsg").innerHTML = "Form validation successful";
    }

});