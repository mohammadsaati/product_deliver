/**
* Fetch user's API  and do some oparation on them
* @auther Mohamad Saati
**/
class Data {
    constructor() {
        this.userName;
        this.showData();
    }

    showData() {
        const cookies = new CookiesData;
        cookies.getCookies('http://localhost/university_project/js/json_php/cookiesJson.php')
        .then(res => {
           
           //Check idenetity
           switch(res.identity) {
               case 'farmers' :
                   
                   const ui = new Ui();
                    const farmer = new Farmer();

                    //Delete some items form farmer : 
                    ui.order_title.style.display = 'none';
                    ui.order_user.style.display = 'none';

                    //Get farmer data
                    farmer.getFarmers('http://localhost/university_project/js/json_php/farmerJson.php')
                    .then(farmerData => {
                        
                        ui.firstName.appendChild(document.createTextNode(", "+farmerData.firstName + " "+farmerData.lastName));
                  
                    })
                    .catch(error => console.log(error));

                    //show user product
                    farmer.myProduct('http://localhost/university_project/js/json_php/userProductJson.php')
                    .then(productData => {
                     
                        productData.forEach(function(product){
                            const trTable = document.createElement('tr');
                            const thTitle = document.createElement('th');
                            const thBody = document.createElement('th');
                            const thPrice = document.createElement('th');
                            const thDelete = document.createElement('th');
                            const thUpadte = document.createElement('th');
                         
                            const deleteItem = document.createElement('a');
                            deleteItem.href = `modifireProduct.php?delete=${product.id}`
                            deleteItem.innerHTML = `<i class="far fa-trash-alt"></i>`;
                            deleteItem.className = "deleteItem";
                            

                            const updateItem = document.createElement('a');
                            updateItem.href = `modifireProduct.php?update=${product.id}`;
                            updateItem.innerHTML = `<i class="fas fa-edit"></i>`;
                            updateItem.className = "updateItem";

                            thTitle.appendChild(document.createTextNode(product.title));
                            thBody.appendChild(document.createTextNode(product.body));
                            if(product.price == "0") {
                                thPrice.appendChild(document.createTextNode("free"));
                            } else {
                                thPrice.appendChild(document.createTextNode(product.price + "$"));
                            }
                            thDelete.appendChild(deleteItem);
                            thUpadte.appendChild(updateItem);
                           

                            trTable.appendChild(thTitle);
                            trTable.appendChild(thBody);
                            trTable.appendChild(thPrice);
                            trTable.appendChild(thDelete);
                            trTable.appendChild(thUpadte);

                            ui.product_table.appendChild(trTable);

                            console.log(productData);
                        });   
                    
                    })
                    .catch(error => console.log(error));
                    
               break;
                
               //Customers
                case 'customers' :

                    const uiCustomer = new Ui();
                    //Delete some items from ui
                    uiCustomer.product_user.style.display = 'none';
                    uiCustomer.product_title.style.display = 'none';
                    uiCustomer.addProductBtn.style.display = 'none';

                    const customer = new Customers();
                    //Get own data
                    customer.getData('http://localhost/university_project/js/json_php/customerJson.php')
                    .then(customerData => {
                        uiCustomer.firstName.appendChild(document.createTextNode(", " + customerData.firstName + " " + customerData.lastName));
                    })
                    .catch(error => console.log(error));

                    
                break;
                
                case 'drivers' :
                    console.log('driver');
                break;    
           }
        
           console.log(this.uid);
        })
        .catch(error => console.log(error));
    }


}

const data = new Data;

