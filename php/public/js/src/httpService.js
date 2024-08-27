 
   const WEBROOT="http://localhost:8051"

async   function getData (url) {
    const reponse = await fetch(url);
    const data = await reponse.json();
    return data;
  }

  // Exemple d'implémentation pour une requête POST
  async   function postData(url = "", donnees = {}) {
    // Les options par défaut sont indiquées par *
    const response = await fetch(url, {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      credentials: "same-origin", // include, *same-origin, omit
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(donnees), // le type utilisé pour le corps doit correspondre à l'en-tête "Content-Type"
    });
    return response.json(); // transforme la réponse JSON reçue en objet JavaScript natif
  }

  export default {
    getData,
    postData,
    WEBROOT

  }

