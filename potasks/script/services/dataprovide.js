const Source = "potasks/potasks4.json"
const SourceCustom = "potasks/potasks_custom.json"
export const GetData = async (sr = Source) => {
    try {
        const { data } = await $http.get(sr)
        const hash = CryptoJS.MD5(JSON.stringify(data)).toString()
        const { tasks, babies } = data
        return { tasks, babies, hash }
    } catch (e) {
        return {}
    }
}