import axios from 'axios';

const axiosClient = axios.create({
    baseURL: 'http://127.0.0.1:8000/api'
});

export async function getAll(pPage = 1, pPerPage = 5) {
    try {
        let params = {
            page: pPage,
            per_page: pPerPage
        };
        let response = await axiosClient.get('/user', { params });

        return response.data;
    } catch (error) {
        return null;
    }
}

export async function setOne(pData) {
    try {
        let response = await axiosClient.post('/user', pData);

        return response.data;
    } catch (error) {
        return null;
    }
}

export async function deleteOne(pId) {
    try {
        let response = await axiosClient.delete('/user/' + pId);

        return response.data;
    } catch (error) {
        return null;
    }
}
