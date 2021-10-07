function save()
{
    login = document.getElementById("login").value;
    object = { login:login };
    localStorage.setItem('login', JSON.stringify(object));
}

window.onload = function()
{
    let local = localStorage.getItem('login');
    if (local)
    {
        let login = JSON.parse(local);
        document.getElementById('login').value = login.login;
    }
    //localStorage.removeItem('login');
}
