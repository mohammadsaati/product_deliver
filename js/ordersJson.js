class OrdersJson {
    
    constructor() {
        this.showOrderData();
    }

    //Get data from url
    async getData(url) {
        const orderFetch = await fetch(url);
        const orderData = orderFetch.json();
        return orderData;
    }

    //Show data(s)
    showOrderData() {
        const orderUi = new Ui();
        this.getData('http://localhost/university_project/js/json_php/ownOrdersJson.php')
        .then(orderData => {
            orderData.forEach(function(order) {
               const trTableOrder = document.createElement('tr');
               const nameTableOrder = document.createElement('td');
               const dateTableOrder = document.createElement('td');

               nameTableOrder.appendChild(document.createTextNode(" " +order));

               trTableOrder.appendChild(nameTableOrder);
               
               orderUi.order_tabe.appendChild(trTableOrder);

            });
        })
        .catch(error => console.log(error));
    }
}

//Create init form this class
const orders = new OrdersJson();