export function useSearch (query) {
    if (query) {
        const encodedQuery = encodeURIComponent(query)
        return axios.get(`/api/v1/pokemon?s=${encodedQuery}`)
    }
    return axios.get(`/api/v1/pokemon`)
}
