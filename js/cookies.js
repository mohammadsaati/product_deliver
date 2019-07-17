class CookiesData {
    //Get user cookies
    async getCookies(url) {
        const promis = await fetch(url);
        const data  = await promis.json();

        return data;
    }
}