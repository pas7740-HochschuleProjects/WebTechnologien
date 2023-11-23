const REQUEST_TYPE = {
    GET: "GET",
    POST: "POST",
    DELETE: "DELETE",
    PUT: "PUT"
};

async function postRequest(endpoint, body){
    return await sendRequest(REQUEST_TYPE.POST, endpoint, body, true);
}

async function getRequest(endpoint){
    return await sendRequest(REQUEST_TYPE.GET, endpoint, undefined, true);
}

async function sendRequest(requestType, endpoint, body, auth) {
    let url = BASE_URL + "/" + COLLECTION_ID + "/" + endpoint;
    let requestBody = (typeof body !== "undefined") ? JSON.stringify(body) : undefined;
    let tokenHeader =
    {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + ACCESS_TOKEN
        },
        method: requestType,
        body: requestBody
    };
    let basicHeader =
    {
        headers: {
            'Content-Type': 'application/json'
        },
        method: requestType,
        body: requestBody
    };
    return await fetch(url, (auth) ? tokenHeader : basicHeader)
        .then(async (response) => {
            let data = await response.json().catch((error)=>{});
            return {
                data: data,
                status: response.status
            };
        })
        .catch((error) => {
            console.error("Fetch error: " + error);
        });
}