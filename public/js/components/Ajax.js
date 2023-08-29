class Http {
    async initializeRequest(url, method, data = null) {
        try {
            const request = {
                method: method,
                // headers: {
                //     'Content-Type': "application/json"
                // },
                body: data ?? null
            };
            const response = await fetch(url, request);
            const responseData = await response.json();
            
            if (!responseData.status) {
                throw new Error(responseData.error || "Request failed!");
            }
            
            return responseData;
        } catch (error) {
            throw new Error(error.message || "Request failed!");
        }
    }

    async get(url) {
        return await this.initializeRequest(url, 'GET');
    }

    async post(url, data) {
        return await this.initializeRequest(url, 'POST', data);
    }

    static async put(url, data) {
        return await this.initializeRequest(url, 'PUT', data);
    }

    static async delete(url) {
        return await this.initializeRequest(url, 'DELETE');
    }
}

export default Http;