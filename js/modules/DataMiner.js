let errorCodes = {
    404: "Not Found! Oh noes! Check your URL",
    500: "Ya sorry can't help you... the server is just borked",
    403: "You shall not pass! Unless you have creds. Then sure go ahead.",
    503: "Service is unavailable! The servers are all having a coffee break."
}


async function fetchData(sourceURL) {
    let resource = await fetch(sourceURL).then(response => {
        if (response.status !== 200) {
            throw new Error(`Who the Hell is Will Robinson? ${response.status}: ${errorCodes[response.status]}`);
        }
        return response;
    });

    let dataset = await resource.json();

    //  for (let object in dataset[0]) {
    //      dataset[0][object].media = dataset[0][object].media.split(",");
    //      dataset[0][object].languages = dataset[0][object].languages.split(",");    
    //  }

    return dataset[0];
}

async function postData(sourceURL) {
    return "You are using the postData API endpoint";
}


export { fetchData };