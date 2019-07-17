class Customers {
    //Get customer data
    async getData(url) {
        const customerFetch = await fetch(url);
        const customerJson = customerFetch.json();
        return customerJson;
    }
}