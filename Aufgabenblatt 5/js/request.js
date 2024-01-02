const REQUEST_TYPE = {
    GET: "GET",
    POST: "POST",
    DELETE: "DELETE",
    PUT: "PUT"
};

async function phpRequest(requestType, url, body, auth){
    let requestBody = (typeof body !== "undefined") ? JSON.stringify(body) : undefined;
    let tokenHeader =
    {
        headers: {
            'Content-Type': 'application/json'
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
            let data = await response.json().catch((error)=>{
                console.error("Fetch error: " + error);
            });
            return {
                data: data,
                status: response.status
            };
        })
        .catch((error) => {
            console.error("Fetch error: " + error);
        });
}