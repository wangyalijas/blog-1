export default {
    methods: {
        url(path){
            if (path && path.substring(0, 1) != '/') {
                path = '/' + path;
            }
            return path;
        },
        redirectToUrl(url) {
            window.location.href = url;
        },
        redirectToUrlFromBaseUrl(url){
            window.location.href = this.url(url);
        },
        reloadPage(forcedReload = false){
            Location.reload(forcedReload)
        },
    }
}