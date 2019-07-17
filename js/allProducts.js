class AllProducts {
    constructor() {
        
    }

    async show() {
        const ppe = await fetch('http://localhost/university_project/js/json_php/allProductsJson.php');
        const ppo = ppe.json();

        return ppo;
    }
}

const all = new AllProducts();

all.show()
.then(products => {
    const ui = new Ui();

    products.forEach(function(product) {

    const trTable = document.createElement('tr');
    const thTitle = document.createElement('th');
    const thBody = document.createElement('th');
    const thPrice = document.createElement('th');
    const thOrder = document.createElement('th');
    
    const orderItem = document.createElement('a');
    orderItem.href = `addOrder.php?productId=${product.id}`;
    orderItem.innerHTML = `<i class="fas fa-baby-carriage"></i>`;

    thTitle.appendChild(document.createTextNode(product.title));
    thBody.appendChild(document.createTextNode(product.body));
    if(product.price == 0) {
        thPrice.appendChild(document.createTextNode("free"));
    } else {
        thPrice.appendChild(document.createTextNode(product.price + "$"));
    }
    thOrder.appendChild(orderItem);
   

    trTable.appendChild(thTitle);
    trTable.appendChild(thBody);
    trTable.appendChild(thPrice);
    trTable.appendChild(thOrder);

    ui.product_table.appendChild(trTable);

   

    });
 
})
.catch(error => console.log(error));