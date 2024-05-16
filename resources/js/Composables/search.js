export function useSearch (query) {
    let url = '/api/v1/pokemon?'

    if (query.s) {
        const encodedQuery = encodeURIComponent(query.s)
        url += `s=${encodedQuery}&`
    }

    if (query.stat_sort) {
        url += `stat_sort=${query.stat_sort}&`
    }

    return axios.get(url)
}
