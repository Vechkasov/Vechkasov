function save()
{
    full_name = document.getElementById("full_name").value;
    login = document.getElementById("login").value;
    email = document.getElementById("email").value;
    date = document.getElementById("date").value;
    address = document.getElementById("address").value;
    interest = document.getElementById("interest").value;
    linkToVK = document.getElementById("linkToVK").value;
    blood_type = document.getElementById("blood_type").value;
    rhesus_factor = document.getElementById("rhesus_factor").value;

    object = {
        full_name:      full_name,
        login:          login,
        email:          email,
        date:           date,
        address:        address,
        interest:       interest,
        linkToVK:       linkToVK,
        blood_type:     blood_type,
        rhesus_factor:  rhesus_factor
    };
    localStorage.setItem('register', JSON.stringify(object));
}

window.onload = function()
{
    let reg = localStorage.getItem('register');
    if (reg)
    {
        let r = JSON.parse(reg);

        document.getElementById("full_name").value = r.full_name;
        document.getElementById("login").value = r.login;
        document.getElementById("email").value = r.email;
        document.getElementById("date").value = r.date;
        document.getElementById("address").value = r.address;
        document.getElementById("interest").value = r.interest;
        document.getElementById("linkToVK").value =  r.linkToVK;
        document.getElementById("blood_type").value = r.blood_type;
        document.getElementById("rhesus_factor").value = r.rhesus_factor;
    }
    //localStorage.removeItem('register');
}