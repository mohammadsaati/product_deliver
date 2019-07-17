class Farmer {

    //Get framers from farmers table
    async getFarmers(url) {
        const farmerFetch = await fetch(url);

        const farmerData = await farmerFetch.json();

        return farmerData;
    }

    //Get farmer's products
    async myProduct(url) {
        const productFetch = await fetch(url);

        const productData = await productFetch.json();

        return productData;
    }


}