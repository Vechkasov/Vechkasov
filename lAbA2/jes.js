function save()
{
    costFrom = document.getElementById("costFrom").value;
    costTo = document.getElementById("costTo").value;
    category = document.getElementById("category").value;
    name = document.getElementById("name").value;
    description = document.getElementById("description").value;

    object = {
        costFrom:costFrom,
        costTo:costTo,
        category:category,
        name:name,
        description:description,
    }

    localStorage.setItem('product', JSON.stringify(object));
}

window.onload = function()
{

    let product = localStorage.getItem('product');
    if (product)
    {
        let raw = JSON.parse(product);

        document.getElementById("costFrom").value = raw.costFrom;
        document.getElementById("costTo").value = raw.costTo;
        document.getElementById("category").value = raw.category;
        document.getElementById("name").value = raw.name;
        document.getElementById("description").value = raw.description;
    }

}

function remove()
{
    localStorage.removeItem('product');
}



